<?php

namespace App\Exports;

use App\Models\EmployeePermission;
use App\Models\WorkFromHomeRequest;
use App\Services\WorkFromHomeService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class WorkFromHomeExport implements FromView
{
    private WorkFromHomeService $workFromHomeService;
    public function __construct()
    {
        $this->workFromHomeService = app(WorkFromHomeService::class);
    }

    public function view(): View
    {
        $workfromhomerequests = WorkFromHomeRequest::query();

        $this->workFromHomeService->filter($workfromhomerequests);

        return view('new-theme.exports.workfromhomerequests', [
            'requests' =>  $workfromhomerequests->get()
        ]);
    }
}
