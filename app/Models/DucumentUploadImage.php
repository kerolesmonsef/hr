<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DucumentUploadImage extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function ducumentupload(){
        return $this->hasMany(DucumentUpload::class ,'ducument_upload_id');
    }


}
