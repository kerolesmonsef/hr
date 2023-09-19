<?php

namespace App\Http\Controllers;

use App\Exports\OtherpaymentsExport;
use App\Models\Employee;
use App\Models\OtherPayment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OtherPaymentController extends Controller
{
    public function otherpaymentCreate($id)
    {
        $employee = Employee::find($id);
        return view('new-theme.payroll.otherPayments.create', compact('employee'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'employee_id' => 'required',
            'title'       => 'required',
            'date'        => 'required',
            'amount'      => 'required',
        ]);

        $otherpayment              = new OtherPayment();
        $otherpayment->employee_id = $request->employee_id;
        $otherpayment->title       = $request->title;
        $otherpayment->amount      = $request->amount;
        $otherpayment->date        = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');;
        $otherpayment->created_by  = auth()->user()->creatorId();
        $otherpayment->save();

        flash()->addSuccess(__('Added successfully'));
        return redirect()->back();
    }

    public function show(OtherPayment $otherpayment)
    {
        return redirect()->route('commision.index');
    }

    public function edit($otherpayment)
    {
        $otherpayment = OtherPayment::find($otherpayment);
        if($otherpayment->created_by == auth()->user()->creatorId())
        {
            return view('new-theme.payroll.otherPayments.edit', compact('otherpayment'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, OtherPayment $otherpayment)
    {
        if($otherpayment->created_by == auth()->user()->creatorId())
        {
           \request()->validate([
                'title'  => 'required',
                'date'   => 'required',
                'amount' => 'required',
           ]);

            $otherpayment->title  = $request->title;
            $otherpayment->amount = $request->amount;
            $otherpayment->date   = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $otherpayment->save();

            flash()->addSuccess(__('Updated successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(OtherPayment $otherpayment)
    {
        if($otherpayment->created_by == auth()->user()->creatorId())
        {
            $otherpayment->delete();
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
        return Excel::download(new OtherpaymentsExport($id), 'otherPayments.xlsx');
    }
}
