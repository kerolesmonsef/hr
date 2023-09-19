<?php

namespace App\Exports;

use App\Models\SaturationDeduction;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class DeductionExport implements FromView
{

    function __construct()
    {

    }

    public function view(): View
    {
        return view('new-theme.exports.deductions', [
            'deductions' =>   SaturationDeduction::with('employee')->get()
        ]);
    }
}
