<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractTemplate extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getTemplateForEmployee(Employee $employee){
        $template    = $this->template;
        $originalArr = ['{employee_Name}' , '{Nationality}' , '{Salary}' , '{Qualifications}' , '{Id_Number}' , '{job_title}' , '{Join_Date}' , '{Branch}' , '{Department}'];
        $replacedArr = [$employee->name,$employee->nationality->name,$employee->salary,'',$employee->national_id,$employee->jobtitle->name,$employee->Join_date_gregorian,$employee->branch->name,$employee->department->name];

        return str_replace($originalArr,$replacedArr,$template);
    }
}
