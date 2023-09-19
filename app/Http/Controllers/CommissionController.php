<?php

namespace App\Http\Controllers;

use App\Exports\CommissionExport;
use App\Models\Commission;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CommissionController extends Controller
{
    public function commissionCreate($id)
    {
        $employee = Employee::find($id);
        return view('new-theme.payroll.commission.create', compact('employee'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'employee_id' => 'required',
            'title'       => 'required',
            'date'        => 'required',
            'amount'      => 'required',
       ]);

        $amount = $request->percentage ? ($request->close_deal_amount * $request->percentage) / 100 : $request->amount;

        $commission                     = new Commission();
        $commission->employee_id        = $request->employee_id;
        $commission->title              = $request->title;
        $commission->type               = $request->type;
        $commission->amount             = $amount;
        $commission->percentage         = $request->percentage;
        $commission->close_deal_amount  = $request->close_deal_amount;
        $commission->date               = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $commission->created_by         = auth()->user()->creatorId();
        $commission->save();

        flash()->addSuccess(__('Added successfully'));
        return redirect()->back();
    }

    public function show(Commission $commission)
    {
        //
    }

    public function edit($commission)
    {
        $commission = Commission::find($commission);
        if($commission->created_by == auth()->user()->creatorId())
        {
            return view('new-theme.payroll.commission.edit', compact('commission'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Commission $commission)
    {
        if($commission->created_by == auth()->user()->creatorId())
        {
            \request()->validate([
                'title'       => 'required',
                'date'        => 'required',
                'amount'      => 'required',
           ]);

            $amount = $request->percentage ? ($request->close_deal_amount * $request->percentage) / 100 : $request->amount;

            $commission->title              = $request->title;
            $commission->type               = $request->type;
            $commission->amount             = $amount;
            $commission->percentage         = $request->percentage;
            $commission->close_deal_amount  = $request->close_deal_amount;
            $commission->date               = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date);
            $commission->save();

            flash()->addSuccess(__('Updated successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Commission $commission)
    {
        if($commission->created_by == auth()->user()->creatorId())
        {
            $commission->delete();
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
        return Excel::download(new CommissionExport($id), 'commission.xlsx');
    }
}
