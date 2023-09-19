<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function ducument_uploads(){
        return $this->hasMany(DucumentUpload::class , 'document_id');
    }

    public function documentType(){
        return $this->hasOne(DocumentType::class,'id','document_type');
    }

    public function employeeDocument(){
        return $this->hasOne(EmployeeDocument::class,'id','document_type');
    }

    public function employeeDocuments(){
        return $this->hasMany(EmployeeDocument::class,'document_id','id');
    }
}
