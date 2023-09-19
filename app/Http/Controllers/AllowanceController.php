<?php

namespace App\Http\Controllers;

use App\Exports\AllowanceExport;
use App\Models\Allowance;
use App\Models\AllowanceOption;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AllowanceController extends Controller
{

    public function allowanceCreate($id)
    {
        $allowance_options = AllowanceOption::get();
        $employee          = Employee::find($id);
        return view('new-theme.payroll.allowance.create', compact('employee', 'allowance_options'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'employee_id'      => 'required',
            'allowance_option' => 'required',
            'title'            => 'required',
            'date'             => 'required',
            'amount'           => 'required',
        ]);

        $allowance                   = new Allowance();
        $allowance->employee_id      = $request->employee_id;
        $allowance->allowance_option = $request->allowance_option;
        $allowance->title            = $request->title;
        $allowance->amount           = $request->amount;
        $allowance->date             = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $allowance->created_by       = auth()->user()->creatorId();
        $allowance->save();

        flash()->addSuccess(__('Added successfully'));
        return redirect()->back();
    }

    public function show(Allowance $allowance)
    {
        return redirect()->route('allowance.index');
    }

    public function edit($allowance)
    {
        $allowance = Allowance::find($allowance);
        if($allowance->created_by == auth()->user()->creatorId())
        {
            $allowance_options = AllowanceOption::get();
            return view('new-theme.payroll.allowance.edit', compact('allowance', 'allowance_options'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Allowance $allowance)
    {
        if($allowance->created_by == auth()->user()->creatorId())
        {
            \request()->validate([
                'allowance_option' => 'required',
                'title'            => 'required',
                'date'             => 'required',
                'amount'           => 'required',
            ]);

            $allowance->allowance_option = $request->allowance_option;
            $allowance->title            = $request->title;
            $allowance->amount           = $request->amount;
            $allowance->date             = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $allowance->save();

            flash()->addSuccess(__('Updated successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Allowance $allowance)
    {
        if($allowance->created_by == auth()->user()->creatorId())
        {
            $allowance->delete();
            flash()->addSuccess(__('Deleted successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function export($id)
    {
        return Excel::download(new AllowanceExport($id), 'allowance.xlsx');
    }
}
