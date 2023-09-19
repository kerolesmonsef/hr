<?php

namespace App\Exports;

use App\Models\Absence;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeesExport implements FromView
{
    function __construct() {
    }

    public function view(): View
    {
        return view('new-theme.exports.employees', [
            'employees' =>   Employee::where('is_active', 1)->get()
        ]);
    }
}
