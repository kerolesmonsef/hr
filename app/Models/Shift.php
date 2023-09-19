<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function employees(){
        return $this->hasMany(User::class, 'employee_id');
    }

    public function place(){
        return $this->belongsTo(Place::class, 'location_id');
    }

    public function shift_parent(){
        return $this->belongsTo(EmployeeShift::class, 'shift_id');
    }

}
