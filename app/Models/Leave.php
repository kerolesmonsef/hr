<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{

    protected $guarded = [];

    public function absence(){
        return $this->belongsTo(Absence::class , 'leave_id');
    }

    public function leaveType()
    {
        return $this->hasOne('App\Models\LeaveType', 'id', 'leave_type_id');
    }

    public function replacement_employee()
    {
        return $this->belongsTo(Employee::class, 'replacement_employee_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class , 'employee_id');
    }

    public function employees()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

}
