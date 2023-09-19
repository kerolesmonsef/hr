<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaySlip extends Model
{
    protected $guarded = [];

    public static function employee($id)
    {
        return Employee::find($id);
    }

    public function employees()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

    public static function insurance($id,$type)
    {
        $employee        = Employee::where('id', '=', $id)->first();
        $employee_salary = (!empty($employee->salary) ? $employee->salary : 0);

        //Insurances
        $allinsurances                = Allowance::where('employee_id', '=', $id)->get();
        $total_allowance_insurance    = 0;
        foreach ($allinsurances as $insurance) {
            if($insurance->allowance_options && $insurance->allowance_options->insurance_active == 1)
            {
                $total_allowance_insurance = $insurance->amount + $total_allowance_insurance;

            }
        }
        $employee_insurance_percentage = $employee->nationality_type == 1 ? Salary_setting::where('created_by',auth()->user()->id)->value('saudi_employee_insurance_percentage') : Salary_setting::where('created_by',auth()->user()->id)->value('Nonsaudi_employee_insurance_percentage');
        $company_insurance_percentage  = $employee->nationality_type == 1 ? Salary_setting::where('created_by',auth()->user()->id)->value('saudi_company_insurance_percentage')  : Salary_setting::where('created_by',auth()->user()->id)->value('Nonsaudi_company_insurance_percentage');
        $total_employee_insurance      = $total_allowance_insurance + $employee_salary;
        $final_employee_insurance      = $total_employee_insurance * ( ($type == 'employee' ? $employee_insurance_percentage : $company_insurance_percentage)  / 100);

        return $final_employee_insurance;
    }

    public static function medical_insurance($id,$type)
    {
        $employee                   = Employee::where('id', '=', $id)->first();
        $employee_medical_insurance = $employee->nationality_type == 1 ? Salary_setting::where('created_by',auth()->user()->creatorId())->value('saudi_employee_medical_insurance') : Salary_setting::where('created_by',auth()->user()->creatorId())->value('Nonsaudi_employee_medical_insurance');
        $company_medical_insurance  = $employee->nationality_type == 1 ? Salary_setting::where('created_by',auth()->user()->creatorId())->value('saudi_company_medical_insurance')  : Salary_setting::where('created_by',auth()->user()->creatorId())->value('Nonsaudi_company_medical_insurance');

        return $type == 'company' ?  $company_medical_insurance : $employee_medical_insurance;
    }

    public static function workdays($id)
    {
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $employee           = Employee::find($id);
        if($attendancemovement)
        {
            $start_movement_date    = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('Y-m-d');
            $start_movement_date    = $start_movement_date < date("Y-m-d",strtotime($employee->Join_date_gregorian)) ? date("Y-m-d",strtotime($employee->Join_date_gregorian)) : $start_movement_date;
            $end_movement_date      = \Carbon\Carbon::parse($attendancemovement->end_movement_date);
            $diffInDays             = $end_movement_date->diffInDays($start_movement_date)+1;
            $absences               = Absence::where('employee_id',$id)->where('type','!=','V')->whereBetween('start_date',[$start_movement_date,$end_movement_date])->sum('number_of_days');
            $workdays               = $diffInDays - $absences;
            return $workdays;
        }
    }

    public static function absenceLeaves($id)
    {
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $leaves             = Leave::where('employee_id', '=', $id)->where('status','approvedWithDeduction')
                                    ->when($attendancemovement, function ($q) use($attendancemovement) {
                                        return $q->where('start_date','>=',$attendancemovement->start_movement_date)->whereDate('end_date','<=',$attendancemovement->end_movement_date);
                                    })->get();
        $totalDeduction = 0;
        foreach($leaves as $leave){
            $totalDeduction += ($leave->deduction * Employee::getSalaryPerDay($id) / 100) *  $leave->total_leave_days ;
        }
        $leaves['totalDeduction'] = $totalDeduction;
        $leaves                   = json_encode($leaves);
        return $leaves;
    }

    public static function getWorkDaysValue($id){
        $employee            = Employee::find($id);
        $basicSalary         = !empty($employee->salary) ? $employee->salary : '0';
        $country             = Utility::settings()['country'];
        $attendancemovement  = AttendanceMovement::whereNull('status')->first();
        $monthDays           = $attendancemovement ? \Carbon\carbon::parse($attendancemovement->start_movement_date)->daysInMonth : 30;
        $totalDayRent        = $country == 'Egypt' ? ($basicSalary * 12) / 365 : $basicSalary / $monthDays;
        $P_Days              = self::workdays($id);
        $totlal_Rent         = $P_Days * $totalDayRent;
        return round($totlal_Rent);
    }

    public static function getEmployeeSalaryPerDay($id)
    {
        $employee = Employee::where('id',$id)->first();
        $salary   = $employee->getSalaryPerDay($id);
        return round($salary , 2);
    }

    public static function getTotalDue($id){
        $employee = Employee::findorfail($id);
        $attendancemovement  = AttendanceMovement::whereNull('status')->first();
        $start_movement_date = $attendancemovement ? \Carbon\carbon::parse($attendancemovement->start_movement_date) : '';
        $joined_Date         = \Carbon\carbon::parse($employee->Join_date_gregorian);
        if($start_movement_date < $joined_Date )
        {
            $basicSalary = self::getWorkDaysValue($employee->id);
        }else{
            $basicSalary = $employee->salary;
        }
        $total = $basicSalary + collect(json_decode($employee->allowance($employee->id)))->sum('amount') + collect(json_decode($employee->overtime($employee->id)))->sum('rate') +
        collect(json_decode($employee->other_payment($employee->id)))->sum('amount') + collect(json_decode($employee->commission($employee->id)))->sum('amount') ;

        return $total;
    }

    public static function getTotalDeduction($id){
        $employee = Employee::findorfail($id);
        $total = $employee->insurance($id,'employee') +
        $employee->medical_insurance($id,'employee') +
        (collect(json_decode($employee->absence($id)))->where('type','A')->sum('number_of_days') * self::getEmployeeSalaryPerDay($id) * Utility::salary_setting()->absence_with_permission_discount )
        + (collect(json_decode($employee->absence($id)))->where('type','X')->sum('number_of_days') * (self::getEmployeeSalaryPerDay($id) * Utility::salary_setting()->absence_without_permission_discount ) ) +
        ((collect(json_decode($employee->absence($id)))->where('type','S')->sum('number_of_days') * self::getEmployeeSalaryPerDay($id) * Utility::salary_setting()->sick_absence_discount)) +
        collect(json_decode($employee->loan($id)))->sum('amount') +
        collect(json_decode($employee->saturation_deduction($id)))->sum('amount')
        +number_format(json_decode($employee->absenceLeaves(($id)))->totalDeduction,2);
        return $total;
    }

    public function getNetSalary($id){
        $total    = $this->getTotalDue($id) - $this->getTotalDeduction($id);
        return $total;
    }
}
