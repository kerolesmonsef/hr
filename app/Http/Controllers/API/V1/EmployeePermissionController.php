<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveHistoryResource;
use App\Models\EmployeePermission;

class EmployeePermissionController extends Controller
{
    public function index(){
        $permissions = EmployeePermission::where('employee_id', auth()->user()->employee->id)->latest()->get();
        $permissions = $permissions->map(function ($item) {
            $item->modeltype = 'permission';
            return $item;
        });
        return $this->success(LeaveHistoryResource::collection($permissions), __('Requests'));
    }
}
