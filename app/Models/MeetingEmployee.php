<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MeetingEmployee extends Model
{
    protected $guarded = [];

    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class)->withDefault();
    }

}
