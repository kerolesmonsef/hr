<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
//    protected $fillable = [
//        'employee_id', 'document_id', 'document_value', 'created_by'
//    ];

    protected $guarded = [];

    public function getDocumentUrl()
    {
        return asset("storage/". $this->document_value);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
