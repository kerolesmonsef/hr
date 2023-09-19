<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\EvaluationSection;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Builder;

class EvaluationService
{
    private EvaluationSectionService $evaluationSectionService;
    private QuestionService $questionService;

    public function __construct()
    {
        $this->evaluationSectionService = app(EvaluationSectionService::class);
        $this->questionService = app(QuestionService::class);
    }

    public function store(array $data, array $sections)
    {
        $parentEvaluation = $this->createParent($data, $sections);

        $employees = $this->getEmployeesFromIds($data);

        foreach ($employees as $employee) {
            $parentEvaluation->cloneToChild(['employee_id' => $employee->id]);
        }
    }

    public function update($evaluationId, array $data, array $sections)
    {
        /** @var Evaluation $parentEvaluation */
        $parentEvaluation = Evaluation::find($evaluationId);

        $parentEvaluation->update([
            'type' => $data['type'],
            'title' => $data['title'],
            'status' => 'pending',
            'start_date' => ($data['start_date']),
            'end_date' => ($data['end_date']),
        ]);

        $parentEvaluation->childs()->delete();

        $employees = $this->getEmployeesFromIds($data);

        $this->syncSections($parentEvaluation, $sections);

        foreach ($employees as $employee) {
            $parentEvaluation->cloneToChild(['employee_id' => $employee->id]);
        }

    }

    private function createParent(array $data, array $sections): Evaluation
    {
        $parent = Evaluation::query()->create([
            'created_by' => auth()->user()->creatorId(),
            'type' => $data['type'],
            'title' => $data['title'],
            'status' => 'pending',
            'start_date' => ($data['start_date']),
            'end_date' => ($data['end_date']),
        ]);

        $this->syncSections($parent, $sections);

        return $parent;
    }

    public function syncSections(Evaluation $evaluation, $sections)
    {
        $evaluation->sections()->delete();

        foreach ($sections as $sectionArray) {
            $section = $this->evaluationSectionService->store($sectionArray, $evaluation->id);

            foreach ($sectionArray['questions'] as $questionArray) {
                $this->questionService->store($questionArray, $section->id);
            }
        }
    }

    public function getEmployeeRate(Evaluation $evaluation, ?Employee $employee, $return = "rate")
    {

        if (!$employee) {
            return 0;
        }
        $evaluation->load("sections.questions.options");
        $questions = $evaluation->sections->pluck('questions')->flatten();

        $employee_points = EvaluationAnswer::query()
            ->whereIn('question_id', $questions->pluck('id'))
            ->where("employee_id", $employee->id)
            ->sum("points");

        if ($return == "points") {
            return $employee_points;
        }

        $points = $questions->reduce(function ($result, Question $question) {
            return $result + $question->getPoints();
        });

        if ($points == 0) {
            return 0;
        }
        return ($employee_points / $points) * 5;
    }

    private function getEmployeesFromIds(array $data)
    {
        $employee_ids = array_filter($data['employee_id'], function ($id) {
            return $id != "all";
        });

        if (empty($employee_ids)) {
            return Employee::all();
        } else {
            return Employee::query()->findMany($employee_ids);
        }


    }

    public function filter(Builder $evaluations)
    {
        if (request('search')) {
            $evaluations->where(function (Builder $q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                    ->orWhere('type', 'like', '%' . request('search') . '%')
                    ->orWhere('status', 'like', '%' . request('search') . '%');
             });
        }

        if (request('start_date')) {
            $evaluations->where('start_date', '>=', back_date(request('start_date')));
        }

        if (request('end_date')) {
            $evaluations->where('end_date', '<=', back_date(request('end_date')));
        }
    }
}
