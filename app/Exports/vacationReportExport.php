<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Loan;
use App\Models\PaySlip;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class vacationReportExport implements FromView
{
    function __construct() {
    }

    public function view(): View
    {
        $years        = Leave::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('created_at','desc')->pluck('year');
        $years        = empty($years->toArray()) ? collect(['0' => date('Y') , '1' => '2022']) : $years ;
        
        return view('new-theme.exports.reports.vacation', [
            'employees'    =>  Employee::where(['created_by'  => auth()->user()->creatorId(),'is_active'   => 1,])->get(),
            'leaveTypes'   => LeaveType::whereNotNull('parent')->where('created_by' , auth()->user()->creatorId())->get(),
            'currentYear'  => request('dateYear') ? request('dateYear') : $years->first()
        ]);
    }
}
