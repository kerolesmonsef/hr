<?php

namespace App\Exports;

use App\Models\Loan;
use App\Models\PaySlip;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class PaySlipExport implements FromView
{
    protected $month;
    protected $year;

    function __construct($month,$year) {
        $this->month = $month;
        $this->year  = $year;
    }

    public function view(): View
    {
        $currentAttendance     = auth()->user()->CurrentAttendanceMovement();
        $month                 = $currentAttendance ? Carbon::parse($currentAttendance->end_movement_date)->format('m') : date('m');
        $year                  = $currentAttendance ? Carbon::parse($currentAttendance->end_movement_date)->format('Y') : date('m');
        $formate_month_year    = request('datePicker') ? request('datePicker') : $year.'-'.$month;
        $type                  = '0,1';

        $employee_payroll  = PaySlip::whereHas('employees' , function($q) use($type) {
            $q->where('is_active',1)
            ->whereIn('contract_type',explode(',',$type))
            ->where('created_by',auth()->user()->creatorId())
            ->when(request('department'), function ($q) {
                return $q->where('department_id',request('department'));
            });
        })->where('salary_month',$formate_month_year);
        
        return view('new-theme.exports.payslip', [
            'employee_payroll' =>   $employee_payroll->get(),
        ]);
    }
}
