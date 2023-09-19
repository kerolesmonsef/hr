<?php

namespace App\Exports;

use App\Models\Leave;
use App\Services\LeaveService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class VacationsExport implements FromView
{
    private LeaveService $leaveservice;


    public function __construct()
    {
        $this->leaveservice = app(LeaveService::class);
    }




    public function view(): View
    {
        $vacations = Leave::where([
        ])->with('leaveType' , 'employee')->latest();

        $this->leaveservice->filter($vacations);

        return view('new-theme.exports.vacations', [
            'vacations' =>  $vacations->get(),
        ]);
    }

}
