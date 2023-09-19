<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Branch-List', ['only' => ['index']]);
        $this->middleware('permission:Branch-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Branch-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Branch-Delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $branches = Branch::query()
            ->where('created_by', '=', auth()->user()->creatorId())
            ->with('manager')
            ->withCount("employees");
        $employees = Employee::all();

        if (request()->ajax()) {
            if (request('search')) {
                $branches->where('name', 'like', '%' . request('search') . '%');
            }

            $search = view('new-theme.settings.branch.branches_table', [
                'branches' => $branches->get(),
                'employees' => $branches->get(),
            ]);
            return response()->json(['search' => $search->render()]);
        }

        $branches = $branches->get();
        //return response($branches);
        return view('new-theme.settings.branch.branches', compact('branches', 'employees'));

    }

    public function create()
    {

        $employees = Employee::get()->pluck('name', 'id');
        return view('branch.create', compact('employees'));

    }

    public function store(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'name_ar' => 'required',
            ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            $key = array_keys($messages->getMessages())[0] ?? "";
            return redirect()->back()->with('error', $key . " " . $messages->first());
        }

        $branch = new Branch();
        $branch->employee_id = $request->employee_id ?? null;
        $branch->name = $request->name;
        $branch->name_ar = $request->name_ar;
        $branch->lat = $request->lat;
        $branch->lon = $request->lon;
        $branch->created_by = auth()->user()->creatorId();
        $branch->save();
        return redirect()->route('branch.index')->with('success', __('Branch successfully created.'));

    }

    public function show(Branch $branch)
    {
        return redirect()->route('branch.index');
    }

    public function edit(Branch $branch)
    {
        if (auth()->user()->can('Edit Branch')) {
            if ($branch->created_by == auth()->user()->creatorId()) {
                $employees = Employee::get()->pluck('name', 'id');
                return view('branch.edit', compact('branch', 'employees'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Branch $branch)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'name_ar' => 'required',
                'employee_id' => ['required']
            ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            $key = array_keys($messages->getMessages())[0] ?? "";
            return redirect()->back()->with('error', $key . " " . $messages->first());
        }

        $branch->employee_id = $request->employee_id ?? null;
        $branch->name = $request->name;
        $branch->name_ar = $request->name_ar;
        $branch->lat = $request->lat;
        $branch->lon = $request->lon;
        $branch->save();

        return back()->with('success', __('Branch successfully updated.'));
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('branch.index')->with('success', __('Branch successfully deleted.'));

    }

    public function getdepartment(Request $request)
    {
        if ($request->branch_id == 0) {
            $departments = Department::get()->pluck('name', 'id')->toArray();
        } else {
            $departments = Department::where('branch_id', $request->branch_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($departments);
    }

    public function getemployee(Request $request)
    {
        if (in_array('0', $request->department_id)) {
            $employees = Employee::get()->pluck('name', 'id')->toArray();
        } else {
            $employees = Employee::whereIn('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($employees);
    }
}
