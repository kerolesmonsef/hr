<?php

namespace App\Exports;

use App\Models\Loan;
use App\Models\PaySlip;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class payrollReportExport implements FromView
{
    protected $format_date;

    function __construct($format_date) {
        $this->format_date = $format_date;
    }

    public function view(): View
    {
        $formate_month_year    =  $this->format_date;

        return view('new-theme.exports.reports.payroll', [
            'payslips' =>   PaySlip::whereHas('employees' , function($q) use($formate_month_year) {
                $q->where('is_active',1)
                ->where('created_by',auth()->user()->creatorId());
            })->where('salary_month',$formate_month_year)->get()
        ]);
    }
}
