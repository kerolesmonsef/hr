<?php

namespace App\Http\Controllers\API\V1\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StorePermission;
use App\Http\Requests\API\StoreRequest;
use App\Http\Requests\API\StoreWorkFromHome;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\LeaveHistoryResource;
use App\Http\Resources\manager_requests\AttendanceResource as Manager_requestsAttendanceResource;
use App\Http\Resources\manager_requests\LeaveResource;
use App\Http\Resources\manager_requests\LoanResource;
use App\Http\Resources\manager_requests\MissionResource;
use App\Http\Resources\manager_requests\OvertimeResource;
use App\Http\Resources\manager_requests\PermissionResource;
use App\Http\Resources\manager_requests\WorkFromHomeResource;
use App\Http\Resources\ParentRequestResource;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Models\EmployeePermission;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\LoanPending;
use App\Models\Mission;
use App\Models\Overtime;
use App\Models\OverTimeRequest;
use App\Models\WorkFromHomeRequest;
use App\Services\Api\LeaveService;
use Carbon\Carbon;

class RequestManagerController extends Controller
{
    public function index(){

       $employee = auth()->user()->employee;

        if(!$employee->isManager()){
                return $this->error(__('You are not a manager'),403 , null);
        }

        $leaves = Leave::with(['leaveType','employee'])->where([
                    'direct_manager'=>$employee->id,
                    'status'=>'pending',
        ])->latest()->get();

        $permissions = EmployeePermission::with(['employee'])->where([
                'direct_manager'=>$employee->id,
                'status'=>'pending',
        ])->latest()->get();

        $loans = LoanPending::with(['loan_option_item'])->where([
                'direct_manager'=>$employee->id,
                'status'=>'pending',
        ])->latest()->get();

        $workfromhomerequests = WorkFromHomeRequest::with(['employee'])->where([
            'direct_manager'=>$employee->id,
            'status'=>'pending',
        ])->latest()->get();

        $overtimes = OverTimeRequest::with(['employee'])->where([
            'direct_manager'=>$employee->id,
            'status'=>'pending',
        ])->latest()->get();

        $missions = Mission::with(['employee'])->where([
            'direct_manager'=>$employee->id,
            'status'=>'pending',
        ])->latest()->get();

        $attendances = AttendanceEmployee::with('employee')->latest()->take(10)->get();

        $array_data = [
            'attendances' => [
                'rows' => AttendanceResource::collection($attendances),
                'count' => $attendances->count(),
            ],
            'missions' => [
                'rows' => MissionResource::collection($missions),
                'count' => $attendances->count(),
            ],
            'leaves' =>  [
                'rows' => LeaveResource::collection($leaves),
                'count' => $leaves->count(),
            ],
            'workfromhomerequests' =>  [
                'rows' => WorkFromHomeResource::collection($workfromhomerequests),
                'count' => $workfromhomerequests->count(),
            ],
            'loans' =>  [
                'rows' => LoanResource::collection($loans),
                'count' => $loans->count(),
            ],
            'permissions' =>  [
                'rows' => PermissionResource::collection($permissions),
                'count' => $permissions->count(),
            ],
            'overtimes' =>  [
                'rows' => OvertimeResource::collection($overtimes),
                'count' => $overtimes->count(),
            ]
        ];
        return $this->success($array_data,__('Requests'));
    }
}
