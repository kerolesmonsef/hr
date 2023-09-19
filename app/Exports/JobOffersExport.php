<?php

namespace App\Exports;

use App\Models\CompanyJobRequest;
use App\Services\JobOfferService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class JobOffersExport implements FromView
{
    private JobOfferService $jobOfferService;
    public function __construct()
    {
        $this->jobOfferService = app(JobOfferService::class);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $offers = CompanyJobRequest::where([
        ])->with('job_requests')
            ->latest();

        $this->jobOfferService->filter($offers);

        return view('new-theme.exports.joboffers', [
            'offers' => $offers->get()
        ]);
    }
}
