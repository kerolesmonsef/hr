<?php

namespace App\Http\Controllers;

use App\Models\Workunit;
use Illuminate\Http\Request;

class WorkUnitController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Employee'))
        {
            $workunits = Workunit::get();
            return view('workunits.index', compact('workunits'));
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
            return view('workunits.create');
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
                        ]);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $workunit             = new Workunit();
            $workunit->name       = $request->name;
            $workunit->name_ar    = $request->name_ar;
            $workunit->created_by = auth()->user()->creatorId();
            $workunit->save();

            return redirect()->route('workunits.index')->with('success', __('WorkUnit  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Workunit $Workunit)
    {
        //
    }

    public function edit($workunit_id)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            $Workunit = Workunit::find($workunit_id);
            if($Workunit->created_by == auth()->user()->creatorId())
            {
                return view('workunits.edit', compact('Workunit'));
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

    public function update(Request $request, $workunit_id)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            $Workunit = Workunit::find($workunit_id);
            if($Workunit->created_by == auth()->user()->creatorId())
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

                $Workunit->name    = $request->name;
                $Workunit->name_ar = $request->name_ar;
                $Workunit->save();

                return redirect()->route('workunits.index')->with('success', __('Workunit successfully updated.'));
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

    public function destroy($labor_company_id)
    {
        if(auth()->user()->can('Delete Employee'))
        {
            $Workunit = Workunit::find($labor_company_id);
            if($Workunit->created_by == auth()->user()->creatorId())
            {
                $Workunit->delete();
                return redirect()->route('workunits.index')->with('success', __('Workunit successfully deleted.'));
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
