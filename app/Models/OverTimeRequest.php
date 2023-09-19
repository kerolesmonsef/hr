<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverTimeRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_date'    => 'date_format:h:i a'
    ];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function get_time_format()
    {
        return __('From') . ' ' . $this->start . ' ' . __('To') . ' ' . $this->end;
    }
}
