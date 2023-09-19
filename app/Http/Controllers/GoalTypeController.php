<?php

namespace App\Http\Controllers;

use App\Models\GoalType;
use Illuminate\Http\Request;

class GoalTypeController extends Controller
{

    public function index()
    {
        if(auth()->user()->can('Manage Goal Type'))
        {
            $goaltypes = GoalType::get();

            return view('goaltype.index', compact('goaltypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        if(auth()->user()->can('Create Goal Type'))
        {
            return view('goaltype.create');
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        if(auth()->user()->can('Create Goal Type'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'name_ar' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $goaltype             = new GoalType();
            $goaltype->name       = $request->name;
            $goaltype->name_ar       = $request->name_ar;
            $goaltype->created_by = auth()->user()->creatorId();
            $goaltype->save();

            return redirect()->route('goaltype.index')->with('success', __('GoalType  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function show(GoalType $goalType)
    {
        //
    }


    public function edit($id)
    {

        if(auth()->user()->can('Edit Goal Type'))
        {
            $goalType = GoalType::find($id);

            return view('goaltype.edit', compact('goalType'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        if(auth()->user()->can('Edit Goal Type'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'name_ar' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $goalType       = GoalType::find($id);
            $goalType->name = $request->name;
            $goalType->name_ar = $request->name_ar;
            $goalType->save();

            return redirect()->route('goaltype.index')->with('success', __('GoalType  successfully updated.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        if(auth()->user()->can('Delete Goal Type'))
        {
            $goalType = GoalType::find($id);
            if($goalType->created_by == auth()->user()->creatorId())
            {
                $goalType->delete();

                return redirect()->route('goaltype.index')->with('success', __('GoalType successfully deleted.'));
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
