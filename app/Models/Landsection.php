<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landsection extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $appends = ['title' ,'description'];
    public function getTitleAttribute(){
        if(app()->isLocale('ar')){
            return $this->titleAr;
        }
        return $this->titleEn;
    }
    public function getDescriptionAttribute(){
        if(app()->isLocale('ar')){
            return $this->descriptionAr;
        }
        return $this->descriptionEn;
    }
    public function getMetaTitleAttribute(){
        if(app()->isLocale('ar')){
            return $this->metaTitleAr;
        }
        return $this->metaTitleEn;
    }
    public function getMetaDescriptionAttribute(){
        if(app()->isLocale('ar')){
            return $this->metaDescriptionAr;
        }
        return $this->metaDescriptionEn;
    }
    public function getMetakeyAttribute(){
        if(app()->isLocale('ar')){
            return $this->metakeyAr;
        }
        return $this->metakeyEn;
    }
    public function getMetaTagAttribute(){
        if(app()->isLocale('ar')){
            return $this->metaTagAr;
        }
        return $this->metaTagEn;
    }
}
