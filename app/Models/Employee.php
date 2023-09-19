<?php

namespace App\Models;

use App\Models\pivot\EmployeeTasks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property User $user
 * @property Collection|Meeting[] $meetings
 */
class Employee extends Model
{
    protected $guarded = ['id'];

    public function finger_print_locations()
    {
        return $this->hasMany(EmployeeFingerPrintLocations::class);
    }

    public function syncFingerPrint($locations)
    {
        $locations = array_values($locations);
        $data = [];
        foreach ($locations as $location) {
            $lat_long = explode(",", $location['lat_long']);
            $data[] = [
                'employee_id' => $this->id,
                'title' => $location['name'],
                'lat' => $lat_long[0],
                'long' => $lat_long[1],
            ];
        }


        $this->finger_print_locations()->delete();
        EmployeeFingerPrintLocations::query()->insert($data);
    }

    public function workfromhomerequests()
    {
        return $this->hasMany(WorkFromHomeRequest::class);
    }

    public function answers()
    {
        return $this->hasMany(EvaluationAnswer::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public $attribute = ['employeeName'];

    public function getEmployeeNameAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->name_ar;
        }
        return $this->name;
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function evaluation_results()
    {
        return $this->hasMany(EvaluationResult::class);
    }

    public function getCurrentYearLeaves($year)
    {
        //get leaves in this year between the start date and after on year
        // $start_join_date = $this->Join_date_gregorian ? Carbon::createFromFormat('Y-m-d', $this->Join_date_gregorian)->format(date('Y') . '-m-d') : Carbon::createFromFormat('Y-m-d', now());
        // $after_one_year  = Carbon::createFromFormat('Y-m-d', $start_join_date)->addYear()->format('Y-m-d');
        $leaves = Leave::where('employee_id', $this->id)->whereYear('created_at', '=', $year)->get();
        return $leaves;
    }

    public function ducument_uploads()
    {
        return $this->hasMany(DucumentUpload::class, 'employee_id');
    }


    public function documents()
    {
        return $this->hasMany('App\Models\EmployeeDocument', 'employee_id', 'employee_id')->get();
    }

    public function salary_type()
    {
        return $this->hasOne('App\Models\PayslipType', 'id', 'salary_type')->pluck('name')->first();
    }

    public function get_net_salary()
    {
        $employee = Employee::where('id', '=', $this->id)->first();
        $employee_salary = (!empty($employee->salary) ? $employee->salary : 0);

        //allowance
        $allowances = Allowance::where('employee_id', '=', $this->id)->get();
        $total_allowance = 0;
        foreach ($allowances as $allowance) {
            $total_allowance = $allowance->amount + $total_allowance;
        }

        //Insurances
        $allinsurances = Allowance::where('employee_id', '=', $this->id)->get();
        $total_allowance_insurance = 0;
        foreach ($allinsurances as $insurance) {
            if ($insurance->allowance_options && $insurance->allowance_options->insurance_active == 1) {
                $total_allowance_insurance = $insurance->amount + $total_allowance_insurance;
            }
        }
        $employee_insurance_percentage = $employee->nationality_type == 1 ? Salary_setting::value('saudi_employee_insurance_percentage') : Salary_setting::value('Nonsaudi_employee_insurance_percentage');
        $total_employee_insurance = $total_allowance_insurance + $employee_salary;
        $final_employee_insurance = $total_employee_insurance * ($employee_insurance_percentage / 100);

        //commission
        $commissions = Commission::where('employee_id', '=', $this->id)->get();
        $total_commission = 0;
        $totalSalary = $employee_salary + $total_allowance;
        foreach ($commissions as $commission) {
            $commission->amount = $commission->type == '$' ? $commission->amount : $totalSalary * ($commission->amount) / 100;
            $total_commission = $commission->amount + $total_commission;
        }

        //Loan
        $loans = Loan::where('employee_id', '=', $this->id)->get();
        $total_loan = 0;
        foreach ($loans as $loan) {
            $total_loan = $loan->amount + $total_loan;
        }

        //Saturation Deduction
        $saturation_deductions = SaturationDeduction::where('employee_id', '=', $this->id)->get();
        $total_saturation_deduction = 0;
        foreach ($saturation_deductions as $saturation_deduction) {
            $total_saturation_deduction = $saturation_deduction->amount + $total_saturation_deduction;
        }

        //$total_saturation_deduction = $total_saturation_deduction + $final_employee_insurance;

        //OtherPayment
        $other_payments = OtherPayment::where('employee_id', '=', $this->id)->get();
        $total_other_payment = 0;
        foreach ($other_payments as $other_payment) {
            $total_other_payment = $other_payment->amount + $total_other_payment;
        }

        //Overtime
        $over_times = Overtime::where('employee_id', '=', $this->id)->get();
        $total_over_time = 0;
        foreach ($over_times as $over_time) {
            $total_work = $over_time->number_of_days * $over_time->hours;
            $amount = $total_work * $over_time->rate;
            $total_over_time = $amount + $total_over_time;
        }


        //Net Salary Calculate
        $advance_salary = $total_allowance + $total_commission - $total_loan - $total_saturation_deduction + $total_other_payment + $total_over_time;
        $net_salary = (!empty($employee->salary) ? $employee->salary : 0) + $advance_salary;
        return $net_salary;
    }

    public function get_totalsalary()
    {
        $employee = Employee::where('id', '=', $this->id)->first();
        $employee_salary = (!empty($employee->salary) ? $employee->salary : 0);

        $allowances = Allowance::where('employee_id', '=', $this->id)->get();
        $total_allowance = 0;
        foreach ($allowances as $allowance) {
            $total_allowance = $allowance->amount + $total_allowance;
        }

        $totalSalary = $employee_salary + $total_allowance;

        return $totalSalary;
    }

    public static function allowance($id)
    {
        //allowance
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $allowances = Allowance::where('employee_id', '=', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
        $total_allowance = 0;
        foreach ($allowances as $allowance) {
            $total_allowance = $allowance->amount + $total_allowance;
        }

        $allowance_json = json_encode($allowances);

        return $allowance_json;
    }

    public static function insurance($id, $type)
    {
        $employee = Employee::where('id', '=', $id)->first();
        $employee_salary = (!empty($employee->salary) ? $employee->salary : 0);

        //Insurances
        $allinsurances = Allowance::where('employee_id', '=', $id)->get();
        $total_allowance_insurance = 0;
        foreach ($allinsurances as $insurance) {
            if ($insurance->allowance_options && $insurance->allowance_options->insurance_active == 1) {
                $total_allowance_insurance = $insurance->amount + $total_allowance_insurance;
            }
        }

        $employee_insurance_percentage = $employee->nationality_type == 1 ? Salary_setting::where('created_by', auth()->user()->id)->value('saudi_employee_insurance_percentage') : Salary_setting::where('created_by', auth()->user()->id)->value('Nonsaudi_employee_insurance_percentage');
        $company_insurance_percentage = $employee->nationality_type == 1 ? Salary_setting::where('created_by', auth()->user()->id)->value('saudi_company_insurance_percentage') : Salary_setting::where('created_by', auth()->user()->id)->value('Nonsaudi_company_insurance_percentage');
        $total_employee_insurance = $total_allowance_insurance + $employee_salary;
        $final_employee_insurance = $total_employee_insurance * (($type == 'employee' ? $employee_insurance_percentage : $company_insurance_percentage) / 100);

        return $final_employee_insurance;
    }

    public static function medical_insurance($id, $type)
    {
        $employee = Employee::where('id', '=', $id)->first();
        $employee_medical_insurance = $employee->nationality_type == 1 ? Salary_setting::value('saudi_employee_medical_insurance') : Salary_setting::value('Nonsaudi_employee_medical_insurance');
        $company_medical_insurance = $employee->nationality_type == 1 ? Salary_setting::value('saudi_company_medical_insurance') : Salary_setting::value('Nonsaudi_company_medical_insurance');

        return $type == 'company' ? $company_medical_insurance : $employee_medical_insurance;
    }

    public static function commission($id)
    {
        //commission
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $employee = Employee::where('id', '=', $id)->first();
        $commissions = Commission::where('employee_id', '=', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
        $total_commission = 0;
        $totalSalary = $employee->get_totalsalary();
        foreach ($commissions as $commission) {
            $commission->amount = $commission->type == '$' ? $commission->amount : $totalSalary * ($commission->amount) / 100;
            $total_commission = $commission->amount + $total_commission;
        }
        $commission_json = json_encode($commissions);

        return $commission_json;
    }

    public static function get_total_commission($id)
    {
        $employee = Employee::where('id', '=', $id)->first();

        //commission
        $commissions = Commission::where('employee_id', '=', $id)->get();
        $total_commission = 0;
        $totalSalary = $employee->get_totalsalary();
        foreach ($commissions as $commission) {
            $commission->amount = $commission->type == '$' ? $commission->amount : $totalSalary * ($commission->amount) / 100;
            $total_commission = $commission->amount + $total_commission;
        }
        return $total_commission;
    }

    public static function loan($id)
    {
        //Loan
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $loans = Loan::where('employee_id', '=', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
        $total_loan = 0;
        foreach ($loans as $loan) {
            $total_loan = $loan->amount + $total_loan;
        }
        $loan_json = json_encode($loans);

        return $loan_json;
    }

    public static function saturation_deduction($id)
    {
        //Saturation Deduction
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $saturation_deductions = SaturationDeduction::where('employee_id', '=', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
        $total_saturation_deduction = 0;
        foreach ($saturation_deductions as $saturation_deduction) {
            $total_saturation_deduction = $saturation_deduction->amount + $total_saturation_deduction;
        }
        $saturation_deduction_json = json_encode($saturation_deductions);

        return $saturation_deduction_json;
    }

    public static function other_payment($id)
    {
        //OtherPayment
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $other_payments = OtherPayment::where('employee_id', '=', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
        $total_other_payment = 0;
        foreach ($other_payments as $other_payment) {
            $total_other_payment = $other_payment->amount + $total_other_payment;
        }
        $other_payment_json = json_encode($other_payments);

        return $other_payment_json;
    }

    public static function overtime($id)
    {
        //Overtime
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $over_times = Overtime::where('employee_id', '=', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();

        $total_over_time = 0;
        foreach ($over_times as $over_time) {
            $total_work = $over_time->number_of_days * $over_time->hours;
            $amount = $total_work * $over_time->rate;
            $total_over_time = $amount + $total_over_time;
        }
        $over_time_json = json_encode($over_times);

        return $over_time_json;
    }

    public static function workdays($id)
    {
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $employee = Employee::find($id);
        if ($attendancemovement) {
            $start_movement_date = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('Y-m-d');
            $start_movement_date = $start_movement_date < date("Y-m-d", strtotime($employee->Join_date_gregorian)) ? date("Y-m-d", strtotime($employee->Join_date_gregorian)) : $start_movement_date;
            $end_movement_date = \Carbon\Carbon::parse($attendancemovement->end_movement_date);
            $diffInDays = $end_movement_date->diffInDays($start_movement_date) + 1;
            $absences = Absence::where('employee_id', $id)->where('type', '!=', 'V')->whereBetween('start_date', [$start_movement_date, $end_movement_date])->sum('number_of_days');
            $workdays = $diffInDays - $absences;
            return $workdays;
        }
    }

    public static function absence($id)
    {
        //absence
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $absences = Absence::where('employee_id', '=', $id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereDate('start_date', '>=', $attendancemovement->start_movement_date)->whereDate('end_date', '<=', $attendancemovement->end_movement_date);
            })->get();

        $absences = json_encode($absences);
        return $absences;
    }

    public static function absenceLeaves($id)
    {
        //leaves
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $leaves = Leave::where('employee_id', '=', $id)->where('status', 'approvedWithDeduction')
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereDate('start_date', '>=', $attendancemovement->start_movement_date)->whereDate('end_date', '<=', $attendancemovement->end_movement_date);
            })->get();
        $totalDeduction = 0;
        foreach ($leaves as $leave) {
            $totalDeduction += ($leave->deduction * self::getSalaryPerDay($id) / 100) * $leave->total_leave_days;
        }
        $leaves['totalDeduction'] = $totalDeduction;
        $leaves = json_encode($leaves);
        return $leaves;
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'employee_id');
    }

    public function absenceCount()
    {
        //absence
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $absences = Absence::where('employee_id', '=', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(created_at)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
        return $absences;
    }


    public function employee_breaks()
    {
        return $this->hasMany(EmployeeBreak::class);
    }

    public static function employee_id()
    {
        $employee = Employee::latest()->first();
        return !empty($employee) ? $employee->id + 1 : 1;
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'employee_branches');
    }

    public function branch()
    {
        return $this->hasOne('App\Models\Branch', 'id', 'branch_id');
    }

    public function directManager()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'direct_manager');
    }

    public function subEmployees(): HasMany
    {
        return $this->hasMany(Employee::class, 'direct_manager', 'id');
    }

    public function isManager(): bool
    {
        return $this->subEmployees()->count() > 0;
    }

    public function get_leave_credit($nowdate = null)
    {
        $country = Utility::settings()['country'];
        $price_for_day = $this->getSalaryPerDay($this->id);
        $leaves_days_count = Leave::where(['created_by' => auth()->user()->creatorId(), 'employee_id' => $this->id])->whereIn('status', ['approved', 'approvedWithDeduction'])->sum('total_leave_days');
        $data = [];
        if ($country == 'Egypt') {
            $data['work_days'] = round($this->annual_leave_entitlement - $leaves_days_count, 2);
            $data['cost'] = round(($this->annual_leave_entitlement - $leaves_days_count) * $price_for_day, 2);
            return $data;
        }
        //النظام السعودي
        $start_join_date = Carbon::createFromFormat('Y-m-d', $this->Join_date_gregorian);
        if (!$nowdate) {
            $now_date = Carbon::now();
        } else {
            $now_date = Carbon::createFromFormat('Y-m-d', $nowdate);
        }
        $work_days = $start_join_date->diffInDays($now_date);

        $work_days = $work_days - $leaves_days_count;

        $work_days = $work_days * 0.0822222222;

        $work_days_price = $work_days * $price_for_day;

        $data = [
            'work_days' => round($work_days, 2),
            'cost' => round($work_days_price, 2)
        ];

        return $data;
    }

    public function phone()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'phone');
    }

    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    public function designation()
    {
        return $this->hasOne('App\Models\Designation', 'id', 'designation_id');
    }

    public function salaryType()
    {
        return $this->hasOne('App\Models\PayslipType', 'id', 'salary_type');
    }

    public function employee_shifts()
    {
        return $this->hasMany(Shift::class, 'employee_id');
    }

    public function employee_deduction()
    {
        return $this->hasMany(SaturationDeduction::class, 'employee_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function paySlip()
    {
        return $this->hasOne('App\Models\PaySlip', 'id', 'employee_id');
    }

    public function present_status($employee_id, $data)
    {
        return AttendanceEmployee::where('employee_id', $employee_id)->where('date', $data)->first();
    }

    public static function employee_name($name)
    {
        $employee = Employee::where('id', $name)->first();
        if (!empty($employee)) {
            return $employee->name;
        }
    }

    public static function login_user($name)
    {
        $user = User::where('id', $name)->first();
        return $user->name;
    }

    public static function employee_salary($salary)
    {
        $employee = Employee::where("salary", $salary)->first();
        if ($employee->salary == '0' || $employee->salary == '0.0') {
            return "-";
        } else {
            return $employee->salary;
        }
    }

    public function nationality()
    {
        return $this->hasOne('App\Models\Nationality', 'id', 'nationality_id');
    }

    public function jobtitle()
    {
        return $this->hasOne('App\Models\Jobtitle', 'id', 'jobtitle_id');
    }

    public function jobtype()
    {
        return $this->hasOne('App\Models\Jobtype', 'id', 'work_time');
    }

    public function shifts()
    {
        return $this->hasOne('App\Models\Employee_shift', 'id', 'shift');
    }

    public function locations()
    {
        return $this->hasOne('App\Models\Place', 'id', 'location');
    }

    public function permissions(){
        return $this->hasMany(EmployeePermission::class);
    }




    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function empAllowance()
    {
        return $this->hasMany('App\Models\Allowance');
    }

    public static function getSalaryPerDay($id)
    {
        $basicSalary = Employee::where('id', $id)->value('salary');
        $country = Utility::settings()['country'];
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $monthDays = $attendancemovement ? \Carbon\carbon::parse($attendancemovement->start_movement_date)->daysInMonth : 30;
        $SalaryPerDay = 0;
        if ($basicSalary) {
            $SalaryPerDay = $country == 'Egypt' ? ($basicSalary * 12) / 365 : $basicSalary / $monthDays;
        }
        return $SalaryPerDay;
    }

    public function getSalaryPerHour($id)
    {
        $salaryPerHour = $this->getSalaryPerDay($id) / 8;
        return $salaryPerHour * Utility::salary_setting()->overtime_rate;
    }

    private function convertTimeToMinutes(string $time): int
    {
        $timesplit = explode(':', $time);
        $min = ($timesplit[0] * 60) + ($timesplit[1]) + ($timesplit[2] > 30 ? 1 : 0);
        return $min;
    }

    public function getEmployeeDelays($start, $end, $month = null, $year = null)
    {
        $attendancemovement = AttendanceMovement::
        when($month, function ($q) use ($month) {
            return $q->whereMonth('end_movement_date', $month);
        })->when($year, function ($q) use ($year) {
            return $q->whereYear('end_movement_date', $year);
        })->whereNull('status')->first();

        $employee_delays = AttendanceEmployee::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->pluck('late')->toArray();


        $delays = array_filter($employee_delays, function ($v) use ($start, $end) {
            $v = self::convertTimeToMinutes($v);
            if ($end) {
                if ($v >= $start && $v <= $end) {
                    return $v;
                }
            } else {
                if ($v >= $start) {
                    return $v;
                }
            }
        }, ARRAY_FILTER_USE_BOTH);

        return count($delays);
    }

    public function sumDateWithSecondes()
    {
        return AttendanceEmployee::select([DB::raw('SEC_TO_TIME(TIME_TO_SEC( SUM( `late` ))) as late_sum')])
            ->where('employee_id', $this->id)
            ->first()->late_sum;
    }

    public function getEmployeeOverTimes($start, $end)
    {
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $employee_overtimes = AttendanceEmployee::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->pluck('overtime')->toArray();
        $overtimes = array_filter($employee_overtimes, function ($v) use ($start, $end) {
            $v = $v ? $v : '00:00:00';
            $v = self::convertTimeToMinutes($v);
            if ($end) {
                if ($v >= $start && $v <= $end) {
                    return $v;
                }
            } else {
                if ($v >= $start) {
                    return $v;
                }
            }
        }, ARRAY_FILTER_USE_BOTH);

        return count($overtimes);
    }

    public function attendance()
    {
        return $this->hasMany('App\Models\AttendanceEmployee');
    }

    public function haveAttendanceToday()
    {
        return $this->attendance()->whereDate('date', date('Y-m-d'))->first();
    }

    public function employee_allowances()
    {
        $attendancemovement = $this->user->CurrentAttendanceMovement();
        return Allowance::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
    }

    public function employee_commissions()
    {
        $attendancemovement = $this->user->CurrentAttendanceMovement();
        return Commission::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
    }

    public function employee_loans()
    {
        $attendancemovement = $this->user->CurrentAttendanceMovement();
        return Loan::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
    }

    public function employee_deductions()
    {
        $attendancemovement = $this->user->CurrentAttendanceMovement();
        return SaturationDeduction::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
    }

    public function employee_otherPayment()
    {
        $attendancemovement = $this->user->CurrentAttendanceMovement();
        return OtherPayment::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
    }

    public function employee_overtimes()
    {
        $attendancemovement = $this->user->CurrentAttendanceMovement();
        return Overtime::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
    }

    public function employee_absence()
    {
        $attendancemovement = $this->user->CurrentAttendanceMovement();
        return Absence::where('employee_id', $this->id)
            ->when($attendancemovement, function ($q) use ($attendancemovement) {
                return $q->whereDate('start_date', '>=', $attendancemovement->start_movement_date)->whereDate('end_date', '<=', $attendancemovement->end_movement_date);
            })->with('leave.leaveType')->get();
    }


    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'employee_tasks', 'employee_id', 'task_id')->withTimestamps()->using(EmployeeTasks::class);
    }

    public function meetings(): BelongsToMany
    {
        return $this->belongsToMany(Meeting::class, 'meeting_employees');
    }

    public function qualification()
    {
        return $this->hasOne(Qualification::class);
    }


}
