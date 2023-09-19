<?php

namespace App\Http\Livewire;

use App\Models\CompanyJobRequest;
use App\Models\JobOfferQuestion;
use App\Models\JobOfferQuestionOption;
use App\Models\JobOfferSection;
use App\Services\JobOfferService;
use App\Traits\LivewireQuestionRepeaterTrait;
use Livewire\Component;
use Livewire\WithFileUploads;
use function Livewire\str;

class JobOfferForm extends Component
{
    use LivewireQuestionRepeaterTrait, WithFileUploads;

    private JobOfferService $jobOfferService;

    public $jobOfferId = '';

    public $data = [
        'title' => '',
        'job_type' => '',
        'experience' => '',
        'career_level' => '',
        'education_level' => '',
        'salary' => '',
        'job_description' => '',
        'job_requirement' => '',
        'start_date' => '',
        'end_date' => '',
        'positions_count' => '1',
        'location' => '',
        'status'    => '',
    ];

    public function mount($offer)
    {

        if ($offer instanceof CompanyJobRequest) {
            $this->initForUpdate($offer);
        }
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->jobOfferService = app(JobOfferService::class);
    }

    public function render()
    {
        return view('livewire.job-offer-form');
    }

    public function storeJobOffer()
    {

        $this->validate([
            'data.start_date' => ['required'],
            'data.end_date' => ['required'],
        ]);

        $this->jobOfferService->store($this->data, $this->sections);
        return redirect()->route("job-offers.index")->with("success", __("job offer created successfully"));
    }

    public function updateJobOffer()
    {
        $this->jobOfferService->update($this->jobOfferId, $this->data, $this->sections);

        return redirect()->route("job-offers.edit", $this->jobOfferId)->with("success", __("job offer updated successfully"));
    }

    private function initForUpdate(CompanyJobRequest $offer)
    {
        $this->jobOfferId = (string)$offer->id;
        $this->data = [
            'title' => $offer->title,
            'job_type' => $offer->job_type,
            'experience' => $offer->experience,
            'career_level' => $offer->career_level,
            'education_level' => $offer->education_level,
            'salary' => $offer->salary,
            'job_description' => $offer->job_description,
            'job_requirement' => $offer->job_requirement ?? '',
            'start_date' => $offer->start_date,
            'end_date' => $offer->end_date,
            'location' => $offer->location ?? "",
            'status'    => $offer->status ?? "",
            'positions_count' => (string)$offer->positions_count,
        ];


        $offer->load("sections.questions.options");

        $this->sections = $offer->sections->map(function (JobOfferSection $section) {
            return [
                'title' => $section->title,
                'questions' => $section->questions->map(function (JobOfferQuestion $question) {
                    return [
                        'points' => (string)$question->point,
                        'content' => $question->title ?? '',
                        'type' => $question->type ?? 'multi_select',
                        'multi_select' => $question->options->map(function (JobOfferQuestionOption $option) {
                            return [
                                'name' => $option->title ?? '',
                                "point" => (string)$option->point
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ];
        })->toArray();

    }
}
