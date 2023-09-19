<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landfaq extends Model
{
    use HasFactory;
    protected $guarded = [];

    public $appends = ['quest','ans'];

    public function getQuestAttribute(){
        if(app()->isLocale('ar')){
            return $this->question_ar;
        }
        return $this->question;
    }
    public function getAnsAttribute(){
        if(app()->isLocale('ar')){
            return $this->answer_ar;
        }
        return $this->answer;
    }
}
