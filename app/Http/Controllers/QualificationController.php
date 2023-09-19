<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Qualification;
use App\Models\Nationality;
use File;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function index()
    {
        //
    }

    public function qualificationcreate($id)
    {

        $employee          = Employee::find($id);
        $lang              = app()->getLocale() == 'ar' ? '_ar' : '';
        $nationalities     = [];
        return view('qualifications.create', compact('employee','nationalities','lang'));
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Employee'))
        {
            $validator = \Validator::make(
                $request->all(),
                [
                    'employee_id'      => 'required',
                    'major'            => 'required',
                    'degree'           => 'required',
                    'graduation_date'  => 'required',
                    'study_length'     => 'required',
                    'institute_name'   => 'required',
                    'location'         => 'required',
                ]);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $input                = $request->all();
            $input['created_by']  = auth()->user()->creatorId();
            $Qualification        = Qualification::create($input);

            return redirect()->back()->with('success', __('qualification successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function edit($Qualification)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            $lang              = app()->getLocale() == 'ar' ? '_ar' : '';
            $nationalities     = Nationality::get()->pluck('name'.$lang, 'id');
            $qualification     = Qualification::find($Qualification);
            if($qualification->created_by == auth()->user()->creatorId())
            {
                return view('qualifications.edit', compact('qualification','nationalities','lang'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, $Qualification)
    {
        $Qualification = Qualification::find($Qualification);
        if(auth()->user()->can('Edit Employee'))
        {
            if($Qualification->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                $request->all(),
                [
                    'major'            => 'required',
                    'degree'           => 'required',
                    'graduation_date'  => 'required',
                    'study_length'     => 'required',
                    'institute_name'   => 'required',
                    'location'         => 'required',
                ]);

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $input             = $request->all();
                $Qualification     = $Qualification->update($input);

                return redirect()->back()->with('success', __('qualification successfully updated.'));
            }
            else
            {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Request $request , $Qualification)
    {
        $Qualification = Qualification::find($Qualification);
        if($Qualification->created_by == auth()->user()->creatorId())
        {
            $Qualification->delete();
            return redirect()->back()->with('success', __('qualification successfully deleted.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
}
