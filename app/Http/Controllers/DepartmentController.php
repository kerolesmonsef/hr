<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Department-List', ['only' => ['index']]);
        $this->middleware('permission:Department-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Department-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Department-Delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $departments = Department::query()
            ->where('created_by', '=', auth()->user()->creatorId())
            ->with('manager','branch')
            ->withCount("employeess");

        $employees = Employee::all();
        $branches = Branch::all();

        if (request()->ajax()) {
            if (request('search')) {

                $departments->where(function ($query) {
                     $query->where('name_ar', 'like', '%' . request('search') . '%');
                     $query->orWhere('name', 'like', '%' . request('search') . '%');
                });
            }

            $search = view('new-theme.settings.branch.departments_table', [
                'departments' => $departments->get(),
                'branches' => $branches,
                'employees'=> $employees
            ]);
            return response()->json(['search' => $search->render()]);
        }

        $departments = $departments->get(10);
        return view('new-theme.settings.branch.departments', compact('departments','employees','branches'));
    }

    public function create()
    {
        if(auth()->user()->can('Create Department'))
        {
            $branch    = Branch::get()->pluck('name', 'id');
            $employees = Employee::get()->pluck('name', 'id');
            return view('department.create', compact('branch','employees'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        $validator = \Validator::make(
        $request->all(),
        [
            //'employee_id' => 'required',
            'branch_id'   => 'required',
            'name'        => 'required|max:20',
            'name_ar'     => 'required|max:20',
        ]);

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            $key = array_keys($messages->getMessages())[0] ?? "";
            return redirect()->back()->with('error',$key ." ". $messages->first());
        }

        $department               = new Department();
        $department->employee_id  = $request->employee_id ?? null;
        $department->branch_id    = $request->branch_id;
        $department->name         = $request->name;
        $department->name_ar      = $request->name_ar;
        $department->created_by   = auth()->user()->creatorId();
        $department->save();

        return redirect()->route('department.index')->with('success', __('Department successfully created.'));

    }

    public function show(Department $department)
    {
        return redirect()->route('department.index');
    }

    public function edit(Department $department)
    {
        if(auth()->user()->can('Edit Department'))
        {
            if($department->created_by == auth()->user()->creatorId())
            {
                $branch    = Branch::get()->pluck('name', 'id');
                $employees = Employee::get()->pluck('name', 'id');
                return view('department.edit', compact('department', 'branch','employees'));
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

    public function update(Request $request, Department $department)
    {

            if(!$department->created_by != auth()->user()->creatorId()) {
                return redirect()->back()->with("error",__('Permission denied'));
            }
            $validator = \Validator::make(
            $request->all(),
            [
                //'employee_id' => 'required',
                'branch_id'   => 'required',
                'name'        => 'required|max:20',
                'name_ar'     => 'required|max:20',
            ]);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                $key = array_keys($messages->getMessages())[0] ?? "";
                return redirect()->back()->with('error',$key ." ". $messages->first());
            }

            $department->employee_id  = $request->employee_id ?? null;
            $department->branch_id    = $request->branch_id;
            $department->name         = $request->name;
            $department->name_ar      = $request->name_ar;
            $department->save();

            return redirect()->route('department.index')->with('success', __('Department successfully updated.'));


    }

    public function destroy(Department $department)
    {
        if($department->created_by != auth()->user()->creatorId()) {
            return redirect()->back()->with("error",__('Permission denied'));
        }
        $department->delete();
        return redirect()->route('department.index')->with('success', __('Department successfully deleted.'));
    }
}
