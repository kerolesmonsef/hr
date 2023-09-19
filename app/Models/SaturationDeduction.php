<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaturationDeduction extends Model
{
    protected $fillable = [
        'employee_id',
        'deduction_option',
        'title',
        'amount',
        'percent',
        'created_by',
    ];

    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id')->where('is_active',1);
    }

    public function deduction_option()
    {
        return $this->hasOne('App\Models\DeductionOption', 'id', 'deduction_option')->first();
    }
}
