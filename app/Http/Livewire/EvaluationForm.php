<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationSection;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Services\EvaluationService;
use App\Traits\LivewireQuestionRepeaterTrait;
use Carbon\Carbon;
use Livewire\Component;

class EvaluationForm extends Component
{
    use LivewireQuestionRepeaterTrait;

    public $evaluationId = '';
    private EvaluationService $evaluationService;


    public $data = [
        'title' => '',
        'employee_id' => ['all'],
        'start_date' => '',
        'end_date' => '',
        'type' => 'yearly'
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->evaluationService = app(EvaluationService::class);
    }

    public function mount($evaluation)
    {
        if ($evaluation instanceof Evaluation) {
            $this->initForUpdate($evaluation);
        }
    }

    public function render()
    {

        return view('livewire.evaluation-form', [
            'employees' => Employee::all(),
        ]);
    }

    private function validateEvaluation(){
        $this->validate([
            'data.title' => ['required'],
            'data.end_date' => ['required'],
            'data.start_date' => ['required'],
            'data.employee_id' => ['required'],
            'data.employee_id.*' => ['required'],
        ]);
    }

    public function storeEvaluation()
    {
        $this->validateEvaluation();

        $this->evaluationService->store($this->data, $this->sections);

        return redirect()->route("evaluation.index")->with("success", __("evaluation created successfully"));
    }

    public function updateEvaluation()
    {
        $this->validateEvaluation();

        $this->evaluationService->update($this->evaluationId,$this->data, $this->sections);

        return redirect()
            ->route("evaluation.edit",$this->evaluationId)
            ->with("success", __("evaluation updated successfully"));
    }

    public function initForUpdate(Evaluation $evaluation)
    {
        $this->evaluationId = (string)$evaluation->id;

        $this->data = [
            'title' => $evaluation->title ?? "",
            'employee_id' => $evaluation->childs->pluck('employee_id')->map(fn($e) => (string)$e)->toArray(),
            'start_date' => (new Carbon($evaluation->start_date))->format("Y-m-d"),
            'end_date' => (new Carbon($evaluation->end_date))->format("Y-m-d"),
            'type' => $evaluation->type
        ];


        $this->sections = $evaluation->sections->map(function (EvaluationSection $section) {
            return [
                'title' => $section->title,
                'questions'=> $section->questions->map(function (Question $question){
                    return [
                        'points' => (string)$question->point,
                        'content' => $question->title ?? '',
                        'type' => $question->type ?? 'multi_select',
                        'multi_select' => $question->options->map(function (QuestionOption $option) {
                            return [
                                'name' => $option->title ?? '',
                                "point" => (string)$option->point
                            ];
                        })->toArray(),
                    ];
                })->toArray()
            ];
        })->toArray();
    }
}
