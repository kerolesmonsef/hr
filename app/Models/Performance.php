<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;
    protected $table   = 'performance';
    protected $guarded = [];

    public function details(){
        return $this->hasMany(PerformanceDetails::class);
    }

    public function performance_period(){
        return $this->hasOne(PerformancePeriod::class,'id','performance_period_id');
    }

    public function employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}
