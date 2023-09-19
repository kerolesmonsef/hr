<?php

namespace App\Http\Controllers;

use App\Exports\OvertimesExport;
use App\Models\Employee;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OvertimeController extends Controller
{
    public function index(){
        //
    }


    public function overtimeCreate($id)
    {
        $employee = Employee::find($id);
        return view('new-theme.payroll.overtime.create', compact('employee'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'employee_id' => 'required',
            'title'       => 'required',
            'date'        => 'required',
            'hours'       => 'required',
            'rate'        => 'required',
        ]);

        $overtime                 = new Overtime();
        $overtime->employee_id    = $request->employee_id;
        $overtime->title          = $request->title;
        $overtime->number_of_days = $request->number_of_days ?? 0;
        $overtime->hours          = $request->hours;
        $overtime->rate           = $request->rate;
        $overtime->date           = Carbon::createFromFormat('d/m/Y' , $request->date)->format('Y-m-d');;
        $overtime->created_by     = auth()->user()->creatorId();
        $overtime->save();

        flash()->addSuccess(__('Added successfully'));
        return redirect()->back();
    }

    public function show(Overtime $overtime)
    {
        //
    }

    public function edit($overtime)
    {
        $overtime = Overtime::find($overtime);
        if($overtime->created_by == auth()->user()->creatorId())
        {
            return view('new-theme.payroll.overtime.edit', compact('overtime'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, $overtime)
    {
        $overtime = Overtime::find($overtime);
        if($overtime->created_by == auth()->user()->creatorId())
        {
            \request()->validate([
                'title' => 'required',
                'date'  => 'required',
                'hours' => 'required',
                'rate'  => 'required',
            ]);

            $overtime->title          = $request->title;
            $overtime->number_of_days = $request->number_of_days ?? 0;
            $overtime->hours          = $request->hours;
            $overtime->rate           = $request->rate;
            $overtime->date           = Carbon::createFromFormat('d/m/Y' , $request->date)->format('Y-m-d');
            $overtime->save();

            flash()->addSuccess(__('Updated successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Overtime $overtime)
    {
        if($overtime->created_by == auth()->user()->creatorId())
        {
            $overtime->delete();
            flash()->addSuccess(__('Deleted successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function calculateOvertime(Request $request)
    {
        $employee   = Employee::where('id',$request->employee_id)->first();
        $total_rate = $employee->getSalaryPerHour($request->employee_id) * $request->hours;
        return round($total_rate);
    }

    public function export($id)
    {
        return Excel::download(new OvertimesExport($id), 'overtimes.xlsx');
    }
}
