<?php

namespace App\Services;

use App\Models\Question;
use App\Models\QuestionOption;

class QuestionService
{
    public function store(array $data, $section_id)
    {
        // short_text - paragraph
        if ($data['type'] == 'short_text' or $data['type'] == 'paragraph') {
            $point = $data['points'];
        } else {
            $point = 0;
        }

        $question  = Question::query()->create([
            'point' => $point,
            'evaluation_section_id' => $section_id,
            'title' => $data['content'],
            'created_by' => auth()->user()->creatorId(),
            'type'=> $data['type']
        ]);

        if ($data['type'] == 'multi_select' or $data['type'] == 'single_select'){
            foreach ($data['multi_select'] as $optionArray){
                QuestionOption::query()->create([
                    'question_id'=> $question->id,
                    'title'=> $optionArray['name'],
                    'point'=> $optionArray['point'],
                ]);
            }
        }


        return $question;
    }
}
