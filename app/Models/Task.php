<?php

namespace App\Models;

use App\Models\pivot\EmployeeTasks;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'start_date',
        'due_date'
    ];

    const STATUS_TODO = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_COMPLETED = 3;

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($task) {
            $maxPriority = static::where('status',$task->status)->max('priority');
            $task->priority = $maxPriority ? $maxPriority + 1 : 0;
        });
    }



    public static function getStatuses()
    {
        return [
            self::STATUS_TODO,
            self::STATUS_IN_PROGRESS,
            self::STATUS_COMPLETED,
        ];
    }
    public function getTaskStatusLabelAttribute()
    {
        $status = [
            1   => 'danger',
            2   => 'pending',
            3   => 'success',
        ];
        return array_key_exists($this->status,$status) ? $status[$this->status]  :'';

    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_tasks')->withTimestamps()->using(EmployeeTasks::class);
    }


    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class,'created_by')->withDefault();
    }

    public function getNonJoinedMembers()
    {
        $task_users_ids = $this->employees->pluck('id');

        return Employee::whereNotIn('id',$task_users_ids)->pluck('name','id');
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(TaskActivityLog::class);
    }

    // public function getDueDateStringAttribute()
    // {
    //     if ($this->due_date  > $this->start_date) {
    //         $diff_days = now()->diffInDays($this->due_date);
    //         return __('Due In :') .  trans_choice('due_days', $diff_days);
    //     } else {
    //         $diff_days = $this->due_date->diffInDays(now());
    //         return  trans_choice('due_days', $diff_days) . __('Ago');
    //     }
    // }

    public function getDaysUntilDueAttribute()
    {
        $start_date = new DateTime($this->start_date);
        $due_date = new DateTime($this->due_date);
        $today = new DateTime();

        $interval = $today->diff($due_date);

        if ($today < $due_date) {
            return    trans_choice('due_days', $interval->days);
        } else {
            return trans_choice('due_days', $interval->days) . ' ' . trans_choice('Ago', $interval->days);
        }
    }
}
