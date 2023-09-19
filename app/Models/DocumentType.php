<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    protected $table    = 'document_types';
    protected $fillable = [
        'name',
        'name_ar',
    ];

    public function documents(){
        return $this->HasMany(Document::class,'document_type');
    }

}
