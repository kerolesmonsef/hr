<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }
    
    public function leave(){
        return $this->belongsTo(Leave::class , 'leave_id');
    }
}
