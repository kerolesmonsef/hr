<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $date = ['deleted_at'];
    public function questions(){
        return $this->hasMany(Question::class);
    }
}
