<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDucumentUpload extends Model
{
    protected $guarded = [];
    public function category(){
        return $this->belongsTo(CompanyDucumentUploadCategory::class , 'category_id');
    }
}
