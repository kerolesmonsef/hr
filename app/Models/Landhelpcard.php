<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landhelpcard extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $appends = ['description','title'];

    public function getDescriptionAttribute(){
        if(app()->isLocale('ar')){
            return $this->descriptionAr;
        }
        return $this->descriptionEn;
    }
    public function getTitleAttribute(){
        if(app()->isLocale('ar')){
            return $this->titleAr;
        }
        return $this->titleEn;
    }
}
