<?php

namespace App\Exports;

use App\Models\AttendanceEmployee;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TotalAttendanceExport implements FromView
{
    private AttendanceService $service;

    public function __construct()
    {
        $this->service = app(AttendanceService::class);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $attendances = AttendanceEmployee::with('employee.jobtitle')
            ->latest();


        $attendances = $this->service->filter($attendances);

        return view('new-theme.exports.total_attendance', [
            'attendances' => $attendances->get(),
        ]);
    }
}
