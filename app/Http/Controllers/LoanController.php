<?php

namespace App\Http\Controllers;

use App\Exports\LoanExport;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\LoanOption;
use App\Models\LoanPending;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LoanController extends Controller
{

    public function index(){
       //
    }

    public function loanCreate($id)
    {
        $employee       = Employee::find($id);
        $loan_options   = LoanOption::get();
        return view('new-theme.payroll.loan.create', compact('employee','loan_options'));
    }

    public function get_monthly_loan(Request $request){
        $data   = $request->all();
        $amount = $data['amount'];
        $month_number = $data['month_number'];

        $discount_monthly = $amount / $month_number;
        $data = [
            'discount_monthly' => $discount_monthly,
            'month_nubmer' => $data['month_number'],
            'amount' => $data['amount'],
        ];
        return $data;
    }


    public function store(Request $request)
    {
        \request()->validate([
            'employee_id'      => 'required',
            'loan_option'      => 'required',
            'title'            => 'required',
            'amount'           => 'required',
            'discount_monthly' => 'required',
            'start_date'       => 'required',
            'reason'           => 'required',
            'month_nubmer'     => 'required',
       ]);

        $data = [];
        $loan_pending = LoanPending::create([
            'title'        => $request->title,
            'start_date'   => Carbon::createFromFormat('d/m/Y' , $request->start_date)->format('Y-m-d'),
            'amount'       => $request->amount ,
            'month_nubmer' => $request->month_nubmer,
            'reason'       => $request->reason,
            'created_by'   => auth()->user()->creatorId(),
            'employee_id'  => $request->employee_id,
            'status'       => 'approved',
            'loan_option'  => $request->loan_option
        ]);

        for($i = 0 ; $i < $request->month_nubmer ; $i++){
            $loan                     = [];
            $loan['employee_id']      = $request->employee_id;
            $loan['loan_option']      = $request->loan_option;
            $loan['title']            = $request->title;
            $loan['amount']           = $request->amount;
            $loan['discount_monthly'] = $request->discount_monthly;
            $loan['start_date']       = Carbon::createFromFormat('d/m/Y' , $request->start_date)->addMonth($i)->format('Y-m-d');
            $loan['end_date']         = Carbon::createFromFormat('d/m/Y' , $request->start_date)->addMonth($i + 1)->format('Y-m-d');
            $loan['reason']           = $request->reason;
            $loan['date']             = Carbon::createFromFormat('d/m/Y' , $request->start_date)->addMonth($i)->format('Y-m-d');
            $loan['created_by']       = auth()->user()->creatorId();
            $loan['loan_pending_id']  = $loan_pending -> id;
            array_push($data , $loan);
        }

        Loan::insert($data);

        flash()->addSuccess(__('Added successfully'));
        return redirect()->back();
    }

    public function show(Loan $loan)
    {
        //
    }

    public function edit($loan)
    {
        $loan = Loan::find($loan);
        if($loan->created_by == auth()->user()->creatorId())
        {
            $loan_options = LoanOption::get();
            return view('new-theme.payroll.loan.edit', compact('loan', 'loan_options'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Loan $loan)
    {
        if($loan->created_by == auth()->user()->creatorId())
        {
            \request()->validate([
                'loan_option'      => 'required',
                'title'            => 'required',
                'discount_monthly' => 'required',
                'start_date'       => 'required',
                'reason'           => 'required',
           ]);

            $loan->loan_option           = $request->loan_option;
            $loan->title                 = $request->title;
            $loan->discount_monthly      = $request->discount_monthly;
            $loan->start_date            = Carbon::createFromFormat('d/m/Y' , $request->start_date)->format('Y-m-d');
            $loan->reason                = $request->reason;
            $loan->date                  = Carbon::createFromFormat('d/m/Y' , $request->start_date)->format('Y-m-d');
            $loan->save();

            flash()->addSuccess(__('Updated successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Loan $loan)
    {
        if($loan->created_by == auth()->user()->creatorId())
        {
            $loan->delete();
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
        return Excel::download(new LoanExport($id), 'loan.xlsx');
    }
}
