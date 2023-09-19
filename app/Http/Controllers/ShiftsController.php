<?php

namespace App\Http\Controllers;

use App\Models\Employee_shift;
use App\Models\Place;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftsController extends Controller
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
        $lang = app()->isLocale('ar') ? '_ar' : '';
        $employee_shifts         = Employee_shift::get()->pluck('name'.$lang , 'id');
        $employee_location           = Place::get()->pluck('name'.$lang, 'id');
        return view('shifts.create' , compact('employee_shifts','employee_location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(
            $request->all(),
            [
                'employee_id'   => 'required|numeric',
                'shift_id'      => 'required|numeric',
                'location_id'      => 'required|numeric',
            ]);

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $shift = Shift::where([
            'employee_id' => $request->employee_id ,
            'shift_id' => $request->shift_id ,
            'location_id' => $request->location_id ,
        ])->first();
        if($shift){
            return redirect()->back()->with(['error' => __('Employee already has this shift before')]);
        }
        Shift::Create($request->all());
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

        $lang = app()->isLocale('ar') ? '_ar' : '';
        $shift = Shift::findorfail($id);
        $employee_shifts         = Employee_shift::get()->pluck('name'.$lang , 'id');
        $employee_location           = Place::get()->pluck('name'.$lang, 'id');
        return view('shifts.edit' , compact('shift','employee_shifts','employee_location'));
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
                'shift_id'      => 'required|numeric',
                'location_id'      => 'required|numeric',
            ]);

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $shift = Shift::where([
            'shift_id' => $request->shift_id ,
            'location_id' => $request->location_id ,
        ])->first();
        if($shift){
            return redirect()->back()->with(['error' => __('Employee already has this shift before')]);
        }
        $shift = Shift::findorfail($id);
        $shift->update($request->all());
        return redirect()->back()->with(['success' => __('messages.Item was updated successfully')]);
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
        $shift = Shift::findorfail($id);
        $shift->delete();
        return redirect()->back()->with(['success' => __('messages.Item was deleted successfully')]);

    }
}
