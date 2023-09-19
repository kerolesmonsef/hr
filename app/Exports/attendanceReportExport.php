<?php

namespace App\Exports;

use App\Models\Absence;
use App\Models\AttendanceEmployee;
use App\Models\AttendanceMovement;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeePermission;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Loan;
use App\Models\PaySlip;
use App\Models\Salary_setting;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class attendanceReportExport implements FromView
{
    protected $format_date;
    protected $employee;

    function __construct($format_date, $employee)
    {
        $this->format_date = $format_date;
        $this->employee = $employee;
    }

    public function view(): View
    {

        return view('new-theme.exports.reports.attendance', self::attendance());
    }

    public function attendance()
    {
        $employee = $this->employee;
        $employees = Employee::select('id', 'name', 'name_ar')->where('is_active', 1)->where('created_by', auth()->user()->creatorId())
            ->when($employee, function ($q) use ($employee) {
                return $q->where('id', $employee);
            })
            ->when(request('department'), function ($q) {
                return $q->where('department_id', request('department'));
            })->when(request('search'), function ($q) {
                return $q->where('name', 'like', '%' . request('search') . '%')
                    ->orwhere('name_ar', 'like', '%' . request('search') . '%');
            })->get();

        $lang = app()->getLocale() == 'ar' ? '_ar' : '';
        $attendanceStatus = [];
        $dates = $days = [];

        $format_date = $this->format_date;

        $currentAttendance = AttendanceMovement::whereMonth('start_movement_date', explode('-', $format_date)[1])->whereYear('start_movement_date', explode('-', $format_date)[0])->where('created_by', auth()->user()->creatorId())->first();

        $carbonday = $currentAttendance ? \Carbon\Carbon::parse($currentAttendance->start_movement_date)->format('d') : date('d');
        $carbonmonth = $currentAttendance ? \Carbon\Carbon::parse($currentAttendance->start_movement_date)->format('m') : date('m');
        $carbonyear = $currentAttendance ? \Carbon\Carbon::parse($currentAttendance->start_movement_date)->format('Y') : date('Y');

        $begin_of_month = now()->setDay($carbonday)->setMonth($carbonmonth)->setYear($carbonyear);
        $end_of_month = $begin_of_month->clone()->addMonthNoOverflow()->subDay();

        for ($i = $begin_of_month; $i <= ($end_of_month); $i->addDay()) {
            $date = $i->format('Y') . '/' . $i->format('m') . '/' . $i->format('d');
            $dates[] = $date;
        }

        $employeesAttendance = [];
        $totalPresent = $totalLeave  = $totalVacation = $totalSick = $totalX = 0;
        $ovetimeHours = $overtimeMins = $earlyleaveHours = $earlyleaveMins = $lateHours = $lateMins = 0;

        foreach ($employees as $id => $employee) {
            $attendances['id'] = $employee->id;
            $attendances['name'] = $employee['name' . $lang];

            foreach ($dates as $date) {
                $dt = Carbon::parse($date);
                $employeeAttendance = AttendanceEmployee::where('employee_id', $employee->id)->where('date', $date)->first();

                if (!empty($employeeAttendance) && $employeeAttendance->status == 'Present') {
                    $attendanceStatus[$date . '-' . $dt->format('l')] = 'P';


                } else {
                    $attendanceStatus[$date . '-' . $dt->format('l')] = '';
                }
            }

            $absences = $currentAttendance ? Absence::where('employee_id', $employee->id)->whereBetween('start_date', [$currentAttendance->start_movement_date, $currentAttendance->end_movement_date])->get() : [];
            $absenceStatus = [];

            if ($absences) {
                foreach ($absences as $absence) {
                    $datesArr = [];
                    for ($i = 1; $i <= $absence->number_of_days; $i++) {
                        $startDate = Carbon::parse($absence->start_date);
                        array_push($datesArr, $startDate->addDays($i)->subDays(1)->format('Y/m/d'));

                        foreach ($datesArr as $singleDate) {
                            $singledt = Carbon::parse($singleDate);
                            if ($absence->type == 'A') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'A';
                                $totalLeave += 1;
                            } elseif ($absence->type == 'V') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'V';
                                $totalVacation += 1;
                            } elseif ($absence->type == 'S') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'S';
                                $totalSick += 1;
                            } elseif ($absence->type == 'X') {
                                $absenceStatus[$singleDate . '-' . $singledt->format('l')] = 'X';
                                $totalX += 1;
                            }
                        }
                    }
                }
            }

            $attendances['status'] = array_merge($attendanceStatus, $absenceStatus) ?? [];
            $employeesAttendance[] = $attendances;
        }

        $setting = Salary_setting::where('created_by', auth()->user()->id)->first() ?? [];
        $holidays = Holiday::where('created_by', auth()->user()->id)->pluck('date')->toarray();

        $result = [];
        $result['employeesAttendance'] = $employeesAttendance;
        $result['setting'] = $setting;
        $result['holidays'] = $holidays;

        return $result;
    }
}
