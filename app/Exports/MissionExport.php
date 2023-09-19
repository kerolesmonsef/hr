<?php

namespace App\Exports;

use App\Models\EmployeePermission;
use App\Models\Mission;
use App\Models\WorkFromHomeRequest;
use App\Services\MissionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class MissionExport implements FromView
{
    private MissionService  $missionService;
    public function __construct()
    {
        $this->missionService = app(MissionService::class);
    }

    public function view(): View
    {
        $missions = Mission::with('employee.jobtitle')->latest();
        $this->missionService->filter($missions);

        return view('new-theme.exports.mission', [
            'requests' =>  $missions->get(),
        ]);
    }
}
