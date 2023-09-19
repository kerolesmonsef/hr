<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\PaySlip;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeeVacationExport implements FromView
{
    protected $employee;

    function __construct($employee) {
        $this->employee = $employee;
    }

    public function view(): View
    {
        $employee = $this->employee;
        return view('new-theme.exports.employee.vacations', [
            'employee' => $employee
        ]);
    }
}
