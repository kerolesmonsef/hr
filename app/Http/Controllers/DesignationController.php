<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {

        if(auth()->user()->can('Manage Designation'))
        {
            $designations = Designation::get();

            return view('designation.index', compact('designations'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Designation'))
        {
            $departments = Department::get();
            $departments = $departments->pluck('name', 'id');

            return view('designation.create', compact('departments'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(auth()->user()->can('Create Designation'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'department_id' => 'nullable',
                                   'name' => 'required|max:20',
                                   'name_ar' => 'required|max:20',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $designation                = new Designation();
            $designation->department_id = $request->department_id ?? null;
            $designation->name          = $request->name;
            $designation->name_ar          = $request->name_ar;
            $designation->created_by    = auth()->user()->creatorId();

            $designation->save();

            return redirect()->route('designation.index')->with('success', __('Designation  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Designation $designation)
    {
        return redirect()->route('designation.index');
    }

    public function edit(Designation $designation)
    {

        if(auth()->user()->can('Edit Designation'))
        {
            if($designation->created_by == auth()->user()->creatorId())
            {
                $departments = Department::where('id', $designation->department_id)->first();
                $departments = $departments->pluck('name', 'id');

                return view('designation.edit', compact('designation', 'departments'));
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

    public function update(Request $request, Designation $designation)
    {
        if(auth()->user()->can('Edit Designation'))
        {
            if($designation->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'department_id' => 'nullable',
                                       'name' => 'required|max:20',
                                       'name_ar' => 'required|max:20',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $designation->name          = $request->name;
                $designation->name_ar          = $request->name_ar;
                $designation->department_id = $request->department_id ?? null ;
                $designation->save();

                return redirect()->route('designation.index')->with('success', __('Designation  successfully updated.'));
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

    public function destroy(Designation $designation)
    {
        if(auth()->user()->can('Delete Designation'))
        {
            if($designation->created_by == auth()->user()->creatorId())
            {
                $designation->delete();

                return redirect()->route('designation.index')->with('success', __('Designation successfully deleted.'));
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
