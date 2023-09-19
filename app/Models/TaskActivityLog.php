<?php
namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskActivityLog extends Pivot
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'task_activity_logs';
    public $incrementing = false;


    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'employee_id')->withDefault();
    }

}
