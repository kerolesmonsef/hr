<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property JobOfferQuestionOption[]|Collection $options
 */
class JobOfferQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function options(){
        return $this->hasMany(JobOfferQuestionOption::class);
    }

    public function isTextType(){
        return  $this->type == "paragraph" or $this->type == "short_text";
    }

    public function getPoints(){
        if ($this->type == "short_text" or $this->type == "paragraph"){
            return $this->point;
        }
        return $this->options->pluck("point")->sum();
    }

    public function getUserPoint(JobOfferUser $user){
        return $user->answers->where("job_offer_question_id", $this->id)->sum("points");
    }
}
