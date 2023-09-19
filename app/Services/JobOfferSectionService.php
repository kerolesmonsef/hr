<?php

namespace App\Services;

use App\Models\JobOfferSection;
use Illuminate\Database\Eloquent\Builder;

class JobOfferSectionService
{
    public function save(array $data, $jobOfferId)
    {
        return JobOfferSection::query()->create([
            'title' => $data['title'],
            'company_job_request_id'=> $jobOfferId
        ]);
    }


}
