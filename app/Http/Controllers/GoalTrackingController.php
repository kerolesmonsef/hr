<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\GoalTracking;
use App\Models\GoalType;
use Illuminate\Http\Request;

class GoalTrackingController extends Controller
{

    public function index()
    {
        if(auth()->user()->can('Manage Goal Tracking'))
        {
            $user = auth()->user();
            if($user->type == 'employee')
            {
                $employee      = Employee::where('user_id', $user->id)->first();
                $goalTrackings = GoalTracking::where('branch', $employee->branch_id)->get();
            }
            else
            {
                $goalTrackings = GoalTracking::get();
            }

            return view('goaltracking.index', compact('goalTrackings'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        if(auth()->user()->can('Create Goal Tracking'))
        {

            $brances = Branch::get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');
            $goalTypes = GoalType::get()->pluck('name', 'id');
            $goalTypes->prepend('Select Goal Type', '');

            return view('goaltracking.create', compact('brances', 'goalTypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        if(auth()->user()->can('Create Goal Tracking'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'goal_type' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'subject' => 'required',
                                   'subject_ar' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $goalTracking                     = new GoalTracking();
            $goalTracking->branch             = $request->branch;
            $goalTracking->goal_type          = $request->goal_type;
            $goalTracking->start_date         = $request->start_date;
            $goalTracking->end_date           = $request->end_date;
            $goalTracking->subject            = $request->subject;
            $goalTracking->subject_ar            = $request->subject_ar;
            $goalTracking->target_achievement = $request->target_achievement;
            $goalTracking->description        = $request->description;
            $goalTracking->description_ar        = $request->description_ar;
            $goalTracking->created_by         = auth()->user()->creatorId();
            $goalTracking->save();

            return redirect()->route('goaltracking.index')->with('success', __('Goal tracking successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function show(GoalTracking $goalTracking)
    {
        //
    }


    public function edit($id)
    {
        if(auth()->user()->can('Edit Goal Tracking'))
        {
            $goalTracking = GoalTracking::find($id);
            $brances      = Branch::get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');
            $goalTypes = GoalType::get()->pluck('name', 'id');
            $goalTypes->prepend('Select Goal Type', '');

            $status = GoalTracking::$status;

            return view('goaltracking.edit', compact('brances', 'goalTypes', 'goalTracking', 'status'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {


        if(auth()->user()->can('Edit Goal Tracking'))
        {
            $goalTracking = GoalTracking::find($id);
            $validator    = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'goal_type' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'subject' => 'required',
                                   'subject_ar' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $goalTracking->branch             = $request->branch;
            $goalTracking->goal_type          = $request->goal_type;
            $goalTracking->start_date         = $request->start_date;
            $goalTracking->end_date           = $request->end_date;
            $goalTracking->subject            = $request->subject;
            $goalTracking->subject_ar            = $request->subject_ar;
            $goalTracking->target_achievement = $request->target_achievement;
            $goalTracking->status             = $request->status;
            $goalTracking->progress           = $request->progress;
            $goalTracking->description        = $request->description;
            $goalTracking->description_ar        = $request->description_ar;
            $goalTracking->rating        = $request->rating;
            $goalTracking->save();

            return redirect()->route('goaltracking.index')->with('success', __('Goal tracking successfully updated.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function destroy($id)
    {

        if(auth()->user()->can('Delete Goal Tracking'))
        {
            $goalTracking = GoalTracking::find($id);
            if($goalTracking->created_by == auth()->user()->creatorId())
            {
                $goalTracking->delete();

                return redirect()->route('goaltracking.index')->with('success', __('GoalTracking successfully deleted.'));
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
}
