<?php

namespace App\Http\Controllers;

use App\Exports\EvaluationExport;
use App\Http\Requests\NewTheme\StoreEvaluation;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\Question;
use App\Services\EvaluationService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class EvaluationController extends Controller
{
    private EvaluationService $evaluationService;

    public function __construct()
    {
        $this->middleware('permission:Evaluation-List', ['only' => ['index']]);
        $this->middleware('permission:Evaluation-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Evaluation-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Evaluation-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Evaluation-Export', ['only' => ['export']]);
        $this->middleware('permission:Evaluation-Print', ['only' => ['print']]);
        $this->evaluationService = new EvaluationService();
    }


    public function submit_evaluation_answers(Request $request)
    {
        $data = $request->all();
        $evaluation = Evaluation::findorfail($request->evaluation_id);
        unset($data['_token']);
        unset($data['evaluation_id']);
        foreach ($data as $key => $value) {
            $question_type = explode('-', $key)[1];
            $question_id = explode('-', $key)[0];
            EvaluationAnswer::create([
                'evaluation_id' => $evaluation->id,
                'employee_id' => $evaluation->employee_id,
                'question_id' => $question_id,
                'question_type' => $question_type,
                'result' => $value,
                'created_by' => auth()->user()->creatorId(),
            ]);
        }
        dd('success');
    }

    public function employee_form()
    {
        $questions = Question::get();
        return view('evaluation.employee_form', compact('questions'));
    }

    public function hr_evaluation_form($id)
    {
        try {
            $id = decrypt($id);
            $evaluation = Evaluation::with('employee.jobtitle', 'employee.department')->findorfail($id);
            $formtitle = __('HR Evaluation');
            if (!$evaluation->employee) {
                abort(404);
            }
            $questions = Question::where([
                'created_by' => auth()->user()->creatorId(),
                'evaluation_category_id' => 2,
            ])->get();
            return view('evaluation.evaluation_form', compact('evaluation', 'questions', 'formtitle', 'id'));
        } catch (Exception $ex) {
            abort(403);
        }
    }

    public function technical_evaluation_form($id)
    {
        try {
            $id = decrypt($id);
            $evaluation = Evaluation::with('employee')->findorfail($id);
            $formtitle = __('Technical Evaluation');
            if (!$evaluation->employee) {
                abort(404);
            }
            $questions = Question::where([
                'created_by' => auth()->user()->creatorId(),
                'evaluation_category_id' => 3
            ])->get();
            return view('evaluation.evaluation_form', compact('evaluation', 'questions', 'formtitle'));
        } catch (Exception $ex) {
            abort(403);
        }
    }

    public function overall_evaluation_form($id)
    {
        try {
            $id = decrypt($id);
            $evaluation = Evaluation::with('employee')->findorfail($id);
            if (!$evaluation->employee) {
                abort(404);
            }
            $formtitle = __('Overall Evaluation');
            $questions = Question::where([
                'created_by' => auth()->user()->creatorId(),
                'evaluation_category_id' => 1
            ])->get();
            return view('evaluation.evaluation_form', compact('evaluation', 'questions', 'formtitle'));
        } catch (Exception $ex) {
            abort(403);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $evaluations = Evaluation::query()
            ->latest("id")
            ->whereNull('parent_id')
            ->with('childs.employee')
            ->withCount('childs', 'done_childs');

        $this->evaluationService->filter($evaluations);

        if (request()->ajax()) {
            $evaluations = $evaluations->paginate();
            $search = view('new-theme.employee.evaluations.evaluations', compact("evaluations"));
            $paginate = view('new-theme.employee.evaluations.paginate', compact("evaluations"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        $evaluations = $evaluations->paginate(10);

        return view('new-theme.employee.evaluations.index', [
            'evaluations' => $evaluations,
            'evaluationService' => app(EvaluationService::class),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new-theme.employee.evaluations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvaluation $request)
    {

        $data = $request->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');
        $employees = Employee::where([
            'created_by' => auth()->user()->creatorId(),
            'is_active' => 1
        ])->pluck('id')->toarray();
        $array_data = [];
        foreach ($employees as $employee) {
            $val = [
                'employee_id' => $employee,
                'status' => $data['status'],
                'type' => $data['type'],
                'created_by' => $data['created_by'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            array_push($array_data, $val);
        }
        Evaluation::insert($array_data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('evaluation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
//        $evaluation->load("sections.questions.options");
        $evaluation->employee->load(["answers" => function ($q) use ($evaluation) {
            $q->whereIn("evaluation_answers.evaluation_id", [$evaluation?->parent_id]);
        }]);


        return view('new-theme.employee.evaluations.show_employee_evaluation', [
            'evaluation' => $evaluation,
            'evaluationService' => app(EvaluationService::class),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($evaluation)
    {
        $evaluation = Evaluation::findorfail($evaluation);
        if ($evaluation->created_by == auth()->user()->creatorId()) {
            return view('new-theme.employee.evaluations.create', compact('evaluation'));
        }
        return response()->json(['error' => __('Permission denied.')], 401);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'employee_id' => ['required', 'numeric'],
                'status' => ['required', 'string', 'in:pending,completed'],
                'type' => ['required', 'string', 'in:monthly,quarter,semi,yearly'],
            ]);
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $data = $validator->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $evaluation = Evaluation::find($id);
        $evaluation->update($data);
        return redirect()->route('evaluation.index')->with('success', __('messages.Item was updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evaluation = Evaluation::findorfail($id);
        if ($evaluation->created_by == auth()->user()->creatorId()) {
            $evaluation->delete();
            return redirect()->route('evaluation.index')->with('success', __('messages.Item was deleted successfully'));;
        }
        return response()->json(['error' => __('Permission denied.')], 401);
    }

    public function export()
    {
        return Excel::download(new EvaluationExport(), 'evaluation.xlsx');
    }

    public function print()
    {
        return (new EvaluationExport())->view();
    }
}
