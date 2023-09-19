<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection|EvaluationSection[] $sections
 * @property Employee $employee
 * @property mixed $employee_id
 * @property Evaluation $parent
 * @method static find($evaluationId)
 */
class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function childs()
    {
        return $this->hasMany(Evaluation::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Evaluation::class, 'parent_id', 'id');
    }

    public function done_childs()
    {
        return $this->childs()->where("laravel_reserved_1.is_completed", "1");
    }


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }



    public function sections(){
        return $this->hasMany(EvaluationSection::class);
    }


    public function get_status()
    {
        $now = Carbon::now()->format('Y-m-d');
        $start_date = $this->start_date;
        $end_date = $this->end_date;

        if ($now >= $start_date && $now <= $end_date) {
            return [
                'status' => __('Active'),
                'class' => 'success'
            ];
        } elseif ($now > $end_date) {
            return [
                'status' => __('Expired'),
                'class' => 'danger'
            ];
        } else {
            return [
                'status' => __('Pending'),
                'class' => 'pending'
            ];
        }

    }

    public function cloneToChild($newAttributes = [])
    {
        $newEvaluation = $this->newInstance();

        $attributes = $this->getAttributes();
        unset($attributes[$this->getKeyName()]);
        $newEvaluation->fill($attributes);
        $newEvaluation->parent_id = $this->id;
        foreach ($newAttributes as $key => $value) {
            $newEvaluation->$key = $value;
        }
        return $newEvaluation->save();
    }


}
