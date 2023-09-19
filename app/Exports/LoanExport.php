<?php

namespace App\Exports;

use App\Models\Loan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class LoanExport implements FromView
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {
        $attendancemovement = auth()->user()->CurrentAttendanceMovement();
        return view('new-theme.exports.loan', [
            'loans' =>   Loan::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get()
        ]);
    }
}
