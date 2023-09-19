<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBreak extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function company_break(){
        return $this->belongsTo(CompanyBreak::class , 'break_id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class , 'employee_id');
    }
}
