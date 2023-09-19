<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationAnswerRequest;
use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Services\EvaluationService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    use ApiResponser;

    private EvaluationService $evaluationService;
    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function index()
    {
        $evaluations = Evaluation::query()
            ->where("employee_id", auth()->user()->employee->id)
            ->get()
            ->map(function (Evaluation $evaluation) {
                $evaluation->rate = $this->evaluationService->getEmployeeRate($evaluation, auth()->user()->employee);
                $evaluation->status = ($evaluation->status == "pending" and $evaluation->end_date < now()) ? "ignored" : $evaluation->status;
                return $evaluation;
            });


        return $this->success($evaluations);
    }

    public function show_questions(Evaluation $evaluation)
    {
        abort_if($evaluation->employee_id != auth()->user()->employee->id, "403", "not your evaluation");

        $evaluation->load("parent.sections.questions.options");

        return $this->success($evaluation->parent->sections);
    }

    public function show_answers(Evaluation $evaluation)
    {
        abort_if($evaluation->employee_id != auth()->user()->employee->id, "403", "not your evaluation");

        $sections = $evaluation->load("parent.sections.questions.options")->parent->sections;
        $answers = $evaluation->employee->load(["answers" => function ($q) use ($evaluation) {
            $q->whereIn("evaluation_answers.evaluation_id", [$evaluation?->parent_id]);
        }])->answers;

        $total_questions_points = 0;
        $over_all_answer_points = 0;
        $sections->pluck("questions")->flatten()->each(function (Question $question) use ($answers, &$over_all_answer_points, &$total_questions_points) {
            $question->answer_points = 0;
            if ($question->isTextType()) {
                $question->answer = $answers->where("question_id", $question->id)->first()?->result;
                $question->answer_points = $question->point;
                $over_all_answer_points +=  $question->point;
                $total_questions_points += $question->point;
            } else {
                $question->options->each(function (QuestionOption $option) use ($question, $answers, &$over_all_answer_points, &$total_questions_points) {
                    if ($question->type == 'single_select') {
                        if ($option->point > $question->point) {
                            $question->point = $option->point;
                        }
                    } elseif ($question->type == 'multi_select') {
                        $question->point += $option->point;
                    }

                    $option->isSelected = (bool)$answers->where("question_id", $question->id)->where("result", $option->title)->first();

                    calculate_question_option_points($question,$option,$over_all_answer_points);
                });

                $total_questions_points  += $question->point;
            }
        });
        $response['sections'] = $sections;
        $response['over_all_answer_points'] = $over_all_answer_points;
        $response['rate'] = round( ($total_questions_points > 0 ? round($over_all_answer_points / $total_questions_points, 2) : 0 ) * 5 , 2);

        return $this->success($response);
    }

    public function answer_the_evaluation(Evaluation $evaluation, EvaluationAnswerRequest $request)
    {
        abort_if($evaluation->status == "completed", 403, "you finished it before");
        $employee_id = auth()->user()->employee->id;

        $answers = [];
        foreach ($request->questions as $questionArray) {
            /** @var Question $question */
            $question = Question::find($questionArray['id']);
            $points = 0;
            if ($question->isTextType()) {
                $answers[] = [
                    'employee_id' => $employee_id,
                    'evaluation_id' => $evaluation->parent->id,
                    'question_id' => $question->id,
                    'result' => $questionArray['answers'][0],
                    'points' => $points += $question->point,
                ];
            } else {
                foreach ($questionArray['answers'] as $answer) {
                    $answers[] = [
                        'employee_id' => $employee_id,
                        'evaluation_id' => $evaluation->parent->id,
                        'question_id' => $question->id,
                        'result' => $answer,
                        'points' => $points += ($question->options->first(fn (QuestionOption $option) => $option->title == $answer)?->point ?? 0),
                    ];
                }
            }
        }

        EvaluationAnswer::query()->insert($answers);

        $evaluation->update([
            'status' => 'completed',
            'is_completed' => '1',
        ]);

        return $this->success();
    }
}
