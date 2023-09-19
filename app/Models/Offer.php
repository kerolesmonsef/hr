<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];

    public function getImageUrl(){
        if (!$this->photo){
            return asset("assets/img/default.png");
        }
        return asset("storage/{$this->photo}");
    }
}
