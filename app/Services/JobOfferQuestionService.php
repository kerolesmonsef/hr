<?php

namespace App\Services;

use App\Models\JobOfferQuestion;
use App\Models\JobOfferQuestionOption;

class JobOfferQuestionService
{
    public function store(array $data, $section_id)
    {
        // short_text - paragraph
        if ($data['type'] == 'short_text' or $data['type'] == 'paragraph') {
            $point = $data['points'];
        } else {
            $point = 0;
        }

        $question  = JobOfferQuestion::query()->create([
            'point' => $point,
            'job_offer_section_id' => $section_id,
            'title' => $data['content'],
            'type'=> $data['type']
        ]);

        if ($data['type'] == 'multi_select' or $data['type'] == 'single_select'){
            foreach ($data['multi_select'] as $optionArray){
                JobOfferQuestionOption::query()->create([
                    'job_offer_question_id'=> $question->id,
                    'title'=> $optionArray['name'],
                    'point'=> $optionArray['point'],
                ]);
            }
        }


        return $question;
    }
}
