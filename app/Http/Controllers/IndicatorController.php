<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Competencies;
use App\Models\Designation;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Indicator;
use App\Models\Performance_Type;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{

    public function index()
    {
        if (auth()->user()->can('Manage Indicator')) {
            $user = auth()->user();
            if ($user->type == 'employee') {
                $employee = Employee::where('user_id', $user->id)->first();

                $indicators = Indicator::where('branch', $employee->branch_id)->where('department', $employee->department_id)->where('designation', $employee->designation_id)->get();
            } else {
                $indicators = Indicator::get();
            }

            return view('indicator.index', compact('indicators'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        if (auth()->user()->can('Create Indicator')) {
            $performance_types = Performance_Type::get();
            $brances     = Branch::get()->pluck('name', 'id');
            $departments = Department::get()->pluck('name', 'id');
            $departments->prepend('Select Department', '');
            $degisnation = Designation::get()->pluck('name', 'id');

            return view('indicator.create', compact('performance_types', 'brances', 'departments', 'degisnation'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        if (auth()->user()->can('Create Indicator')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'department' => 'required',
                    'designation' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $indicator              = new Indicator();
            $indicator->branch      = $request->branch;
            $indicator->department  = $request->department;
            $indicator->designation = $request->designation;
            $indicator->rating      = json_encode($request->rating, true);

            if (auth()->user()->type == 'company') {
                $indicator->created_user = auth()->user()->creatorId();
            } else {
                $indicator->created_user = auth()->user()->id;
            }

            $indicator->created_by = auth()->user()->creatorId();
            $indicator->save();

            return redirect()->route('indicator.index')->with('success', __('Indicator successfully created.'));
        }
    }

    public function show(Indicator $indicator)
    {
        $ratings = json_decode($indicator->rating, true);
        $performance_types = Performance_Type::get();
        // $technicals      = Competencies::where('type', 'technical')->get();
        // $organizationals = Competencies::where('type', 'organizational')->get();
        // $behaviourals = Competencies::where('type', 'behavioural')->get();

        return view('indicator.show', compact('indicator', 'ratings', 'performance_types'));
    }


    public function edit(Indicator $indicator)
    {
        if (auth()->user()->can('Edit Indicator')) {
            $performance_types = Performance_Type::get();
            $brances     = Branch::get()->pluck('name', 'id');
            $departments = Department::get()->pluck('name', 'id');
            $departments->prepend('Select Department', '');
            $degisnation = Designation::get()->pluck('name', 'id');

            $ratings = json_decode($indicator->rating, true);

            return view('indicator.edit', compact('performance_types', 'brances', 'departments', 'indicator', 'ratings', 'degisnation'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function update(Request $request, Indicator $indicator)
    {
        if (auth()->user()->can('Edit Indicator')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'department' => 'required',
                    'designation' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $indicator->branch      = $request->branch;
            $indicator->department  = $request->department;
            $indicator->designation = $request->designation;
            $indicator->rating = json_encode($request->rating, true);
            $indicator->save();

            return redirect()->route('indicator.index')->with('success', __('Indicator successfully updated.'));
        }
    }


    public function destroy(Indicator $indicator)
    {
        if (auth()->user()->can('Delete Indicator')) {
            if ($indicator->created_by == auth()->user()->creatorId()) {
                $indicator->delete();

                return redirect()->route('indicator.index')->with('success', __('Indicator successfully deleted.'));
            } else {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
}
