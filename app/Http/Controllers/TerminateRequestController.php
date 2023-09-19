<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TerminateRequest;
use Illuminate\Http\Request;

class TerminateRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where(['created_by' => auth()->user()->creatorId() , 'is_active' => 1])->get();
        return view('terminate-request.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function get_leave_information(Request $request){

        $employee = Employee::findorfail($request->employee_id);
        $data = $employee->get_leave_credit($request->date);
        return response()->json($data);

    }
    public function store(Request $request)
    {
        $data = $request->all();
        $employee = Employee::findorfail($data['employee_id']);

        $employee->update(['is_active' => '0']);
        TerminateRequest::Create($data);
        return redirect()->back()->with(['success' => __('messages.Item was added successfully')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
