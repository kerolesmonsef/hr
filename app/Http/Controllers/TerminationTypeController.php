<?php

namespace App\Http\Controllers;

use App\Models\TerminationType;
use Illuminate\Http\Request;

class TerminationTypeController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Termination Type'))
        {
            $terminationtypes = TerminationType::get();

            return view('terminationtype.index', compact('terminationtypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Termination Type'))
        {
            return view('terminationtype.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Termination Type'))
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

            $terminationtype             = new TerminationType();
            $terminationtype->name       = $request->name;
            $terminationtype->name_ar       = $request->name_ar;
            $terminationtype->created_by = auth()->user()->creatorId();
            $terminationtype->save();

            return redirect()->route('terminationtype.index')->with('success', __('TerminationType  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(TerminationType $terminationtype)
    {
        return redirect()->route('terminationtype.index');
    }

    public function edit(TerminationType $terminationtype)
    {
        if(auth()->user()->can('Edit Termination Type'))
        {
            if($terminationtype->created_by == auth()->user()->creatorId())
            {

                return view('terminationtype.edit', compact('terminationtype'));
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

    public function update(Request $request, TerminationType $terminationtype)
    {
        if(auth()->user()->can('Edit Termination Type'))
        {
            if($terminationtype->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required|max:20',
                                       'name_ar' => 'required|max:20',

                                   ]
                );

                $terminationtype->name = $request->name;
                $terminationtype->name_ar = $request->name_ar;
                $terminationtype->save();

                return redirect()->route('terminationtype.index')->with('success', __('TerminationType successfully updated.'));
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

    public function destroy(TerminationType $terminationtype)
    {
        if(auth()->user()->can('Delete Termination Type'))
        {
            if($terminationtype->created_by == auth()->user()->creatorId())
            {
                $terminationtype->delete();

                return redirect()->route('terminationtype.index')->with('success', __('TerminationType successfully deleted.'));
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
