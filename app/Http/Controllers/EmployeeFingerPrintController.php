<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeFingerPrintLocations;
use Illuminate\Http\Request;

class EmployeeFingerPrintController extends Controller
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
        //
        $employee = Employee::find(request('employee_id'));
        return view('finger_print_locations.create' , compact('employee'));
    }

    /**
 * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            $validator = \Validator::make(
            $request->all(),
            [
                'lat'           => 'required',
                'long'        => 'required',
                'employee_id'      => 'required',
                'title'   => 'required'
            ]);
            if($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $data = [
                'lat' => $request -> lat ,
                'long' => $request -> long ,
                'employee_id' => $request -> employee_id ,
                'title' => $request -> title,

            ];
            EmployeeFingerPrintLocations::create($data);
            return redirect() -> back()->with('success', __('messages.Item was added successfully'));
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
        $finger_print_location = EmployeeFingerPrintLocations::find($id);
        return view('finger_print_locations.edit', compact('finger_print_location'));
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
        $validator = \Validator::make(
            $request->all(),
            [
                'lat'           => 'required',
                'long'        => 'required',
                'employee_id'      => 'required',
                'title' => 'required'
            ]);

            if($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $row = EmployeeFingerPrintLocations::find($id);
            $data = [
                'lat' => $request -> lat ,
                'long' => $request -> long ,
                'title' => $request -> title,
            ];
            $row -> update($data);
            return redirect() -> back()->with('success', __('messages.Item was updated successfully'));
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
        $row = EmployeeFingerPrintLocations::find($id);
        $row -> delete();
        return redirect() -> back()->with('success', __('messages.Item was deleted successfully'));
    }
}
