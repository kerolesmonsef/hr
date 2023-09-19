<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection|QuestionOption[] $options
 * @property mixed $point
 * @property mixed $type
 */
class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function evaluation_category()
    {
        return $this->belongsTo(EvaluationCategory::class);
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function getPoints()
    {
        if ($this->type == "short_text" or $this->type == "paragraph") {
            return $this->point;
        }
        return $this->options->pluck("point")->sum();
    }

    public function isTextType()
    {
        return $this->type == "paragraph" or $this->type == "short_text";
    }

    public function getEmployeePoint(Employee $employee)
    {
        return $employee->answers->where("question_id", $this->id)->sum("points");
    }
}
