<?php

namespace App\Exports;

use App\Models\Employee_shift;
use App\Models\LoanPending;
use App\Services\LoanService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LoanRequestExport implements FromView
{
    private LoanService $loanService;

    public function __construct()
    {
        $this->loanService = new LoanService();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $loans = LoanPending::with("employee")->latest();
        $this->loanService->filter($loans);

        return view('new-theme.exports.loanrequest', [
            'loans' => $loans->get()
        ]);
    }
}
