<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Loan;
use App\Models\PaySlip;
use App\Services\BreakService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class BreakExport implements FromView
{
    /** @var Employee*/
    protected $employee;
    protected BreakService  $breakService;

    function __construct($employee) {
        $this->employee = $employee;
        $this->breakService = new BreakService();
    }

    public function view(): View
    {
        $employee = $this->employee;
        $breaks = $employee->employee_breaks()
            ->select("employee_breaks.*",DB::raw("TIMEDIFF(start_time, end_time) AS diff"));

        $this->breakService->filter($breaks);

        return view('new-theme.exports.employee.breaks', [
            'breaks' => $breaks->get()
        ]);
    }
}
