<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyDucumentUploadCategory extends Model
{
    use HasFactory ,SoftDeletes;
    protected $guarded = [];
    protected $date = ['deleted_at'];
    public function documents()
    {
        return $this->hasMany(CompanyDucumentUpload::class,'category_id');
    }

    public function storeRequestedDocuments(){

        dd(request()->all());
        foreach (request('documents',[]) as $document) {
            $name = FileHelper::upload_file('documents', $document);
            CompanyDucumentUpload::create([
                'document' => $name,
                'name' => $document->getClientOriginalName(),
                'description' => $document->getClientOriginalName(),
                'created_by' => auth()->user()->creatorId(),
                'category_id' => $this->id
            ]);
        }
    }
}
