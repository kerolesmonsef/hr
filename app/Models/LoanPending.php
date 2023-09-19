<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPending extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function loan_option_item(){
        return $this -> belongsTo(LoanOption::class , 'loan_option');
    }

}
