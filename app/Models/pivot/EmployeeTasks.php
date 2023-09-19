<?php

namespace App\Models\pivot;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EmployeeTasks extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $table = 'employee_tasks';

}
