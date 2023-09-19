<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeePermission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class ,'employee_id');
    }
    public function direct_manager(){
        return $this->belongsTo(Employee::class ,'direct_manager');
    }
    public function get_time_format(){
        return __('From') .' ' .  $this -> from . ' ' . __('To') .' '  . $this -> to ;
    }
}
