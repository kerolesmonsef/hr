<?php

namespace App\Exports;

use App\Models\Evaluation;
use App\Models\LoanPending;
use App\Services\EvaluationService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class EvaluationExport implements FromView
{
    private EvaluationService $evaluationService;

    public function __construct()
    {
        $this->evaluationService = new EvaluationService();
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $evaluations = Evaluation::query()
            ->whereNull('parent_id')
            ->with('childs.employee')
            ->withCount('childs', 'done_childs');

        $this->evaluationService->filter($evaluations);

        return view('new-theme.exports.evaluations_print', [
            'evaluations' => $evaluations->get()
        ]);
    }
}
