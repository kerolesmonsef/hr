<?php

namespace App\Exports;

use App\Models\Employee_shift;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ShiftExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('new-theme.exports.shifts', [
            'shifts' =>   Employee_shift::with('employees')->latest()->get()
        ]);
    }
}
