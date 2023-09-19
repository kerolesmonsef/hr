<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landfeature extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function plan(){
        return $this->belongsTo(Landplan::class ,'landplan_id');
    }
    public $appends = ['description'];
    public function getDescriptionAttribute(){
        if(app()->isLocale('ar')){
            return $this->descriptionAr;
        }
        return $this->descriptionEn;
    }
}
