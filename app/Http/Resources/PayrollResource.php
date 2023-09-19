<?php

namespace App\Http\Resources;

use App\Models\Salary_setting;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class PayrollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $salarysetting = Salary_setting::query()->first();
        return [
            'employee_id' => $this->id,
            'employee_code' => auth()->user()->employeeIdFormat($this->employee_id),
            'employee_name' => $this->name,
            'job_title' => $this->employee($this->id) ? $this->employee($this->id)->jobtitle['name'] : '',
            'workdays' => $this->workdays($this->id),
            'salary_month' => $this->salary_month,
            'salary_month_date' => Carbon::createFromFormat('Y-m', $this->salary_month),
            'basic_salary' => $this->basic_salary,
            'allowance' => collect(json_decode($this->allowance))->sum('amount'),
            'overtime' => collect(json_decode($this->overtime))->sum('rate'),
            'commission' => collect(json_decode($this->commission))->sum('amount'),
            'other_payment' => collect(json_decode($this->other_payment))->sum('amount'),
            'TotalDue' => $this->getTotalDue($this->id),
            'insurance' => $this->insurance($this->id, 'employee'),
            'medical_insurance' => $this->medical_insurance($this->id, 'employee'),
            'absent' => $absent = (collect(json_decode($this->absence))->where('type', 'A')->sum('number_of_days') * $this->getEmployeeSalaryPerDay($this->id) * $salarysetting->absence_with_permission_discount) + (collect(json_decode($this->absence))->where('type', 'X')->sum('number_of_days') * ($this->getEmployeeSalaryPerDay($this->id) * $salarysetting->absence_without_permission_discount)),
            'absent_s' => $absent_s = (collect(json_decode($this->absence))->where('type', 'S')->sum('number_of_days') * $this->getEmployeeSalaryPerDay($this->id) * $salarysetting->sick_absence_discount),
            'total_absent' => $absent + $absent_s,
            'loan' => collect(json_decode($this->loan))->sum('amount'),
            'saturation_deduction' => collect(json_decode($this->saturation_deduction))->sum('amount'),
            'TotalDeduction' => $this->getTotalDeduction($this->id),
            'net_salary' => $this->getNetSalary($this->id),
            'is_salary_recieved' => $request->get("month") ? 1 : $this->is_recieved,
            'currency' => Setting::query()->where("name", "site_currency")->first()?->value ?? "EGP",
        ];
    }
}
