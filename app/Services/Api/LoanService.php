<?php

namespace App\Services\Api;

use App\Models\AttendanceMovement;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Loan;
use App\Models\LoanPending;
use App\Models\Utility;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class LoanService
{
    use  ApiResponser;
    public function storeLoan(Request $request) {
        $data = [];
        for($i = 0 ; $i < $request->month_nubmer ; $i++){
            $loan                     = [];
            $loan['employee_id']      = $request->employee_id;
            $loan['loan_option']      = $request->loan_option;
            $loan['title']            = $request->title;
            $loan['amount']           = $request->amount;
            $loan['discount_monthly'] = $request->discount_monthly;
            $loan['start_date']       = Carbon::parse($request->start_date)->addMonth($i)->format('Y-m-d');
            $loan['end_date']         = Carbon::parse($request->start_date)->addMonth($i + 1)->format('Y-m-d');
            $loan['reason']           = $request->reason;
            $loan['date']             = Carbon::parse($request->start_date)->addMonth($i)->format('Y-m-d');
            $loan['created_by']       = auth()->user()->creatorId();
            $loan['loan_pending_id']  = $request->loan_pending_id;
            array_push($data , $loan);
        }
        Loan::insert($data);
        return $this->success([] , 'success');
    }
}
