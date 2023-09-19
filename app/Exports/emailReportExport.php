<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\PaySlip;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class emailReportExport implements FromView
{
    function __construct() {
    }

    public function view(): View
    {
        return view('new-theme.exports.reports.email', [
            'employeesEmails' =>  Employee::where([
                'created_by'  =>  auth()->user()->creatorId(),
                'is_active'   => 1,
            ])->get()
        ]);
    }
}
