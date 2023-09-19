<?php

namespace App\Http\Controllers;

use App\Exports\JobOffersExport;
use App\Helpers\FileHelper;
use App\Http\Requests\NewTheme\StoreJobOffer;
use App\Http\Requests\NewTheme\StoreShift;
use App\Http\Requests\NewTheme\UpdateJobOffer;
use App\Http\Requests\ValidateJobFormRequest;
use App\Models\CompanyJobRequest;
use App\Models\JobOfferAnswer;
use App\Models\JobOfferQuestion;
use App\Models\JobOfferSection;
use App\Models\JobOfferUser;
use App\Models\JobRequest;
use App\Models\Question;
use App\Services\JobOfferService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class JobOfferController extends Controller
{
    private JobOfferService $jobOfferService;

    public function __construct()
    {
        $this->middleware('permission:JobOffers-List', ['only' => ['index']]);
        $this->middleware('permission:JobOffers-Create', ['only' => ['create','store']]);
        $this->middleware('permission:JobOffers-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:JobOffers-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:JobOffers-Export', ['only' => ['export']]);
        $this->middleware('permission:JobOffers-Print', ['only' => ['print']]);

        $this->jobOfferService = app(JobOfferService::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        return Excel::download(new JobOffersExport, 'job_offers.xlsx');
    }

    public function print()
    {
        return (new JobOffersExport())->view();
    }

    public function guest_index()
    {
        $offers = CompanyJobRequest::query()
            ->withCount("users")
            ->withCount("seen_users")
            ->latest("id")
            ->whereDate("start_date", "<=", now())
            ->whereDate("end_date", ">=", now())
            ->orderBy("start_date", "asc")
            ->get();

        return view('new-theme.job-offers.guest.guest_job_offers', compact('offers'));
    }

    public function guest_show($code)
    {
        $offer = CompanyJobRequest::query()->where("form_link", $code)->firstOrFail();

        return view('new-theme.job-offers.guest.guest_show_job_offer', compact('offer'));
    }

    public function guest_answer($code)
    {
        $offer = CompanyJobRequest::query()
            ->where("form_link", $code)
            ->firstOrFail()
            ->load("sections.questions");

        $roles = [
            'name' => ['required'],
            'date_of_birth' => 'required',
            'cv' => ['required', 'file'],
            'gender' => 'required|string',
            'nationality_id' => 'required|exists:nationalities,id',
            'qualification_id' => 'required|exists:qualifications,id',
            'country' => 'required|string',
            'city' => 'required|string',
            'area' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'field_of_study' => 'required|string',
            'university' => 'required|string',
            'graduation_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 2),
            'grade' => 'nullable|string',
            'portfolio_link' => 'nullable|string',
        ];

        $offer->sections->each(function (JobOfferSection $section) use (&$roles, &$save) {
            $section->questions->map(function (JobOfferQuestion $question) use (&$roles, &$save) {
                $roles["question.{$question->id}"] = ['required', 'array'];
                $roles["question.{$question->id}.0"] = ['required'];
            });
        });

        $data = request()->validate($roles);

        unset($data['question']);

        $user = JobOfferUser::create(array_merge($data, [
            'cv' => FileHelper::upload_file("cv", request('cv')),
            'company_job_request_id' => $offer->id,
            'name' => request('name'),
        ]));
        $save = [];

        $questions = JobOfferQuestion::query()
            ->with("options")
            ->whereIn('id', array_keys(request('question')))
            ->get();

        foreach (request('question') as $question_id => $values) {
            /** @var JobOfferQuestion $qusetion_i */
            $qusetion_i = $questions->where("id", $question_id)->first();
            foreach ($values as $value) {

                $save[] = [
                    'job_offer_user_id' => $user->id,
                    'company_job_request_id' => $offer->id,
                    'job_offer_question_id' => $question_id,
                    'answer' => $value,
                    'points' => $qusetion_i->isTextType() ? $qusetion_i->point : $qusetion_i->options->first(function ($option) use ($value) {
                        return $option->title == $value;
                    })?->point ?? 0
                ];
            }
        }
        JobOfferAnswer::query()->insert($save);
        dd("saved successfully");
    }

    public function index(Request $request)
    {
        $latest_offers = CompanyJobRequest::with('job_requests')
            ->withCount("users")
            ->latest()
            ->take(3)
            ->get();

        $offers = CompanyJobRequest::query()
            ->with(['job_requests', 'users'])
            ->withCount('users')
            ->latest();

        $this->jobOfferService->filter($offers);

        $offers = $offers->paginate(10);
        if ($request->ajax()) {
            $search = view('new-theme.job-offers.job-offers', compact("offers"));
            $paginate = view('new-theme.job-offers.paginate', compact("offers"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        $incoming_interviews = JobOfferUser::query()
            ->where('interview_from', ">=", today())
            ->orderBy('interview_from')
            ->limit(2)
            ->get();

        return view('new-theme.job-offers.index', compact('offers', 'latest_offers','incoming_interviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new-theme.job-offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobOffer $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');
        if ($request->company_logo) {
            $image = $request->company_logo->store('joboffers');
            $data['company_logo'] = $image;
        }
        CompanyJobRequest::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('job-offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = CompanyJobRequest::findOrFail($id);
        return view('new-theme.job-offers.create', [
            'offer' => $offer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobOffer $request, $id)
    {
        $row = CompanyJobRequest::findorfail($id);
        $data = $request->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');
        if ($request->company_logo) {
            $image = $request->company_logo->store('joboffers');
            $data['company_logo'] = $image;
        }
        $row->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return redirect()->route('job-offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = CompanyJobRequest::findorfail($id);
        $row->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('job-offers.index');
    }
}
