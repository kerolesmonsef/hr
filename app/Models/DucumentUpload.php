<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DucumentUpload extends Model
{
    protected $guarded = [];
    public function ducument(){
        return $this->belongsTo(Document::class ,'document_id');
    }
    public function ducumentuploadimages(){
        return $this->hasMany(DucumentUploadImage::class ,'ducument_upload_id');
    }


}
