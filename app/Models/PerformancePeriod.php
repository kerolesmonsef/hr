<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformancePeriod extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function factors(){
        return $this->hasMany(PerformanceFactor::class);
    }
}
