<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'employee_id');
    }
}
