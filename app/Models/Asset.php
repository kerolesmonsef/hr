<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'purchase_date',
        'supported_date',
        'amount',
        'description',
        'created_by',
        'serial_number',
        'status',
        'type',
        'employee_id'
    ];


    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class,'employee_id')->withDefault();
    }
}
