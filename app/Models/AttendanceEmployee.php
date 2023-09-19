<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AttendanceEmployee extends Model
{
    use LogsActivity;

    protected $guarded = [];



    public function work_hours(){
        $work_hours = 'N/A';
        if($this -> clock_in && $this -> clock_out){
            $work_hours = Carbon::createFromFormat('H:i:s' , $this -> clock_out) -> diffInHours(Carbon::createFromFormat('H:i:s' , $this -> clock_in));
        }
        return $work_hours;
    }

    public function employees()
    {
        return $this->hasOne('App\Models\Employee', 'user_id', 'employee_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['clock_in', 'clock_out']);
        // Chain fluent methods for configuration options
    }

}
