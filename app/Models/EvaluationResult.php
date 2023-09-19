<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationResult extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
    }
}
