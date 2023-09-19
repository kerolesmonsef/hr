<?php

namespace App\Exports;

use App\Models\Absence;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class AbsencesExport implements FromView
{
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {
        $attendancemovement = auth()->user()->CurrentAttendanceMovement();
        return view('new-theme.exports.absences', [
            'absences' =>   Absence::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereDate('start_date','>=',$attendancemovement->start_movement_date)->whereDate('end_date','<=',$attendancemovement->end_movement_date);
            })->with('leave.leaveType')->get()
        ]);
    }
}
