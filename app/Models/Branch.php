<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];
    public function manager(){
        return $this->belongsTo(Employee::class , 'employee_id');
    }
    public function employees(){
        return $this->belongsToMany(Employee::class , 'employee_branches');
    }

    public function getTranslatedNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->name_ar  : $this->name;
    }
    
}
