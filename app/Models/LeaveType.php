<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $guarded = [];
    public $appends = ['requestTitle'];
    public function childs(){
        return $this->hasMany(LeaveType::class,'parent')->where('created_by' , auth()->user()->creatorId());
    }
    public function parent()
    {
        return $this->belongsTo(LeaveType::class, 'parent');
    }
    public function getRequestTitleAttribute()
    {
        if (app()->isLocale('ar')) {
            return $this->title_ar;
        }
        return $this->title;
    }
}
