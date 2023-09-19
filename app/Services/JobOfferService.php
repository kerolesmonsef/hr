<?php

namespace App\Services;

use App\Models\CompanyJobRequest;
use App\Models\JobOfferAnswer;
use App\Models\JobOfferQuestion;
use App\Models\JobOfferSection;
use App\Models\JobOfferUser;
use Illuminate\Database\Eloquent\Builder;

class JobOfferService
{
    private JobOfferSectionService $jobOfferSectionService;
    private JobOfferQuestionService $jobOfferQuestionService;

    public function __construct()
    {
        $this->jobOfferSectionService = app(JobOfferSectionService::class);
        $this->jobOfferQuestionService = app(JobOfferQuestionService::class);
    }

    public function store(array $data, array $sections)
    {

        $jobOffer = CompanyJobRequest::create($data);

        $this->storeSections($jobOffer, $sections);
    }

    public function update($jobOfferId, array $data, array $sections)
    {
        $data['start_date'] = back_date($data['start_date']);
        $data['end_date'] = back_date($data['end_date']);

        /** @var CompanyJobRequest $jobOffer */
        $jobOffer = CompanyJobRequest::find($jobOfferId);
        $jobOffer->update($data);

        if ($jobOffer->users()->count() > 0){
            return;
        }

        $jobOffer->sections()->delete();
        $this->storeSections($jobOffer, $sections);
    }

    private function storeSections(CompanyJobRequest $jobOffer, array $sections)
    {
        foreach ($sections as $sectionArray) {
            $section = $this->jobOfferSectionService->save($sectionArray, $jobOffer->id);

            foreach ($sectionArray['questions'] as $questionArray) {
                $this->jobOfferQuestionService->store($questionArray, $section->id);
            }
        }
    }


    public function getUserRate(JobOfferUser $user, $return = "rate")
    {
        $offer = $user->job_offer;
        $offer->load("sections.questions.options");
        $questions = $offer->sections->pluck('questions')->flatten();

        $employee_points = $user
            ->answers()
            ->sum("points");

        if ($return == "points") {
            return $employee_points;
        }

        $points = $questions->reduce(function ($result, JobOfferQuestion $question) {
            return $result + $question->getPoints();
        });

        if ($points == 0) {
            return 0;
        }
        return ($employee_points / $points) * 5;
    }

    public function filter(Builder $offers){
        if (request('search')) {
            $offers = $offers->where(function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%');
            });
        }

        $offers->when(request('start_date'),function ($q) {
            $q->where('start_date', '>=', request('start_date'));
        });

        $offers->when(request('end_date'),function ($q) {
            $q->where('end_date', '<=', request('end_date'));
        });

        return  $offers;
    }
}
