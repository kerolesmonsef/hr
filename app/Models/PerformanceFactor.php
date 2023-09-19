<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceFactor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function performanceperiod(){
        return $this->belongsTo(PerformancePeriod::class , 'performance_period_id');
    }
}
