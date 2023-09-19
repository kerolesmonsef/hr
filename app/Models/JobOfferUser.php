<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOfferUser extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getCvUrl()
    {
        return asset("storage/$this->cv");
    }

    public function job_offer()
    {
        return $this->belongsTo(CompanyJobRequest::class, 'company_job_request_id');
    }

    public function answers()
    {
        return $this->hasMany(JobOfferAnswer::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
}
