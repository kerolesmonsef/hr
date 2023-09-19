<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateJobFormRequest;
use App\Models\CompanyJobRequest;
use App\Models\JobRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class VacanciesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */


    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function store (ValidateJobFormRequest $request){
        if($request->hasFile('cv')){
            $file_name =  request('cv')->store('uploads/cvs');
        }
        JobRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'age'   => $request->age,
            'role'  => $request->role,
            'interview_day'  => $request->interview_day,
            'findus' => $request->findus,
            'field'  => json_encode($request->field),
            'message'  =>  $request->message ?? null,
            'address' => $request->address,
            'education' => $request->education,
            'experience' => $request->experience,
            'linkedin_profile' => $request->linkedin_profile ?? null,
            'join_us_date' => $request->join_us_date,
            'salary' => $request->salary,
            'english_rate' => $request->english_rate,

            'cv' => $file_name,
            'company_job_request_id' => $request->company_job_request_id,
        ]);
        return redirect()->back()->with(['success' => __('Your request has been sent successfully')]);
     }
    public function show($id)
    {
        try{
            $companyJobRequest = CompanyJobRequest::findorfail(decrypt($id));
            $time_now = Carbon::now();
            $end_time = Carbon::createFromFormat('Y-m-d' , $companyJobRequest->end_date );
            if($time_now->gt( $end_time)){
                return view('errors.403');
            }
            return view('jobOffer.request' , compact('companyJobRequest'));
        }catch(Exception $e){
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
