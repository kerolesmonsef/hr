<?php

namespace App\Http\Controllers;

use App\Models\Jobtype;
use Illuminate\Http\Request;

class JobtypeController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Employee'))
        {
            $jobtypes = Jobtype::get();
            return view('jobtypes.index', compact('jobtypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Employee'))
        {
            return view('jobtypes.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Employee'))
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

            $Jobtype             = new Jobtype();
            $Jobtype->name       = $request->name;
            $Jobtype->name_ar    = $request->name_ar;
            $Jobtype->created_by = auth()->user()->creatorId();
            $Jobtype->save();

            return redirect()->route('jobtypes.index')->with('success', __('Jobtype  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Jobtype $Jobtype)
    {
        return redirect()->route('jobtypes.index');
    }

    public function edit(Jobtype $Jobtype)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($Jobtype->created_by == auth()->user()->creatorId())
            {
                return view('jobtypes.edit', compact('Jobtype'));
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

    public function update(Request $request, Jobtype $Jobtype)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($Jobtype->created_by == auth()->user()->creatorId())
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

                $Jobtype->name    = $request->name;
                $Jobtype->name_ar = $request->name_ar;
                $Jobtype->save();

                return redirect()->route('jobtypes.index')->with('success', __('Jobtype successfully updated.'));
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

    public function destroy(Jobtype $Jobtype)
    {
        if(auth()->user()->can('Delete Employee'))
        {
            if($Jobtype->created_by == auth()->user()->creatorId())
            {
                $Jobtype->delete();

                return redirect()->route('jobtypes.index')->with('success', __('Jobtype successfully deleted.'));
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
