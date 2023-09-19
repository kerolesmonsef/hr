<?php

namespace App\Exports;

use App\Models\EmployeePermission;
use App\Services\EmployeePermissionService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class EmployeePermissionsExport implements FromView
{
    private EmployeePermissionService $permissionService;
    public function __construct()
    {
        $this->permissionService = app(EmployeePermissionService::class);
    }

    public function view(): View
    {
        $permissions =  EmployeePermission::with('employee.jobtitle','direct_manager');

        $this->permissionService->filter($permissions);

        return view('new-theme.exports.permissions', [
            'permissions' => $permissions->get()
        ]);
    }
}
