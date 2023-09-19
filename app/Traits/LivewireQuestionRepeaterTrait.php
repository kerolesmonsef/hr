<?php

namespace App\Traits;

trait LivewireQuestionRepeaterTrait
{
    public $sections = [];

    protected $casts = [
        'data.start_date' => 'date:Y-m-d',
        'data.end_date' => 'date:Y-m-d',
    ];
    public function addNewSection()
    {
//        dd("Dd");
        $nextOptionNumber = count($this->sections) + 1;

        $this->sections[] = [
            'title' => "section title $nextOptionNumber",
            'questions' => []
        ];
    }

    public function removeSection($sectionIndex)
    {
        unset($this->sections[$sectionIndex]);
    }

    public function appendQuestion($sectionIndex)
    {
        $this->sections[$sectionIndex]['questions'][] = [
            'type' => 'multi_select', // multi_select - single_select - short_text - paragraph
            'multi_select' => [],
            'content' => "this is question content",
            "points" => "12",
        ];
    }

    public function removeQuestion($sectionIndex, $questionIndex)
    {
        unset($this->sections[$sectionIndex]['questions'][$questionIndex]);
    }

    public function addQuestionOption($sectionIndex, $questionIndex)
    {
        $nextOptionNumber = count($this->sections[$sectionIndex]['questions'][$questionIndex]['multi_select']) + 1;

        $this->sections[$sectionIndex]['questions'][$questionIndex]['multi_select'][] = [
            'name' => "Option {$nextOptionNumber}",
            "point" => "0"
        ];
    }

    public function deleteQuestionOption($sectionIndex, $questionIndex, $optionIndex)
    {
        unset($this->sections[$sectionIndex]['questions'][$questionIndex]['multi_select'][$optionIndex]);
    }
}
