<?php

namespace App\Exports;

use App\Models\Loan;
use App\Models\Performance;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class PerformanceExport implements FromView
{

    function __construct() {

    }

    public function view(): View
    {
        return view('new-theme.exports.performance', [
            'performances' =>   Performance::with('employee')->get()
        ]);
    }
}
