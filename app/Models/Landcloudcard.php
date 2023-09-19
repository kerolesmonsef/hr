<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landcloudcard extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $appends = ['description'];

    public function getDescriptionAttribute(){
        if(app()->isLocale('ar')){
            return $this->descriptionAr;
        }
        return $this->descriptionEn;
    }


}
