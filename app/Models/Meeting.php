<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meeting extends Model
{
    protected $guarded = [];


    protected $dates = [
        'date',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'meeting_employees')->withTimestamps();
    }

    public function meeting_employees()
    {
        return $this->hasMany(MeetingEmployee::class);
    }

    public function current_employee(){
        return $this->hasOne(MeetingEmployee::class)->where('employee_id', auth()->user()->employee->id);
    }
}
