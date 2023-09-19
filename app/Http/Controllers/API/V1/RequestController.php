<?php

namespace App\Http\Controllers\API\V1;

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

class RequestController extends Controller
{
    protected LeaveService $leaveservice;

    public function __construct(LeaveService $leaveservice)
    {
        $this->leaveservice = $leaveservice;
    }



    public function getLeaves()
    {
        $leaves = Leave::where('employee_id', auth()->user()->employee->id)->latest()->get();
        $leaves = $leaves->map(function ($item) {
            $item->modeltype = 'leave';
            return $item;
        });

        $permissions = EmployeePermission::where('employee_id', auth()->user()->employee->id)->latest()->get();
        $permissions = $permissions->map(function ($item) {
            $item->modeltype = 'permission';
            return $item;
        });

        $workfromhomerequests = WorkFromHomeRequest::where('employee_id', auth()->user()->employee->id)->latest()->get();
        $workfromhomerequests = $workfromhomerequests->map(function ($item) {
            $item->modeltype = 'work_from_home_request';
            return $item;
        });

        $loans = LoanPending::where('employee_id', auth()->user()->employee->id)->with('loan_option_item')->latest()->get();
        $loans = $loans->map(function ($item) {
            $item->modeltype = 'loan';
            return $item;
        });

        $data = $leaves->concat($permissions);
        $data = $data->concat($loans);
        $data = $data->concat($workfromhomerequests);

        $data = $data->sortByDesc('created_at');

        if ($data == null) {
            return $this->success([], __('No data found !'));
        }

        return $this->success(LeaveHistoryResource::collection($data), __('Requests'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if ($data['type'] == 'leave') {
            return $this->leaveservice->storeLeave($data);
        }
    }

    public function index()
    {
        $types = LeaveType::where('parent', null)
            ->with('childs')
            ->get();
        // return response()->json([
        //     'types'=> $types,
        // ]);
        return $this->success(ParentRequestResource::collection($types), 'Main request types');
    }

    public function store_permission(StorePermission $request)
    {
        $data = $request->validated();
        $employee = auth()->user()->employee;
        $data ['employee_id'] = $employee->id;
        $data['created_by'] = auth()->user()->creatorId();
        $data['direct_manager'] = $employee->direct_manager;
        $data['from'] = $data['start'];
        $data['to'] = $data['end'];
        EmployeePermission::create($data);
        return $this->success([], 'success');
    }

    public function store_work_from_home(StoreWorkFromHome $request)
    {
        $data = $request->validated();
        $employee = auth()->user()->employee;
        $data ['employee_id'] = auth()->user()->employee->id;
        $data['created_by'] = auth()->user()->creatorId();
        $data['direct_manager'] = $employee->direct_manager;
        if (Carbon::now()->format('Y-m-d') > (Carbon::createFromFormat('Y-m-d', $data['date'])->format('Y-m-d'))) {
            return $this->error(__('Date must be greater than or equal ' . Carbon::now()->format('Y-m-d')), 422);
        }
        $row = WorkFromHomeRequest::where([
            'date' => Carbon::createFromFormat('Y-m-d', $data['date'])->format('Y-m-d'),
            'employee_id' => $data ['employee_id'],
        ])->first(); //check if user has request before on the same day
        if ($row) {
            return $this->error(__('You have request to work from home on the same day !'), 422);
        }
        WorkFromHomeRequest::create($data);
        return $this->success([], 'success');
    }

    public function get_permissions()
    {
        $rows = EmployeePermission::where('employee_id', auth()->user()->employee->id)->latest()->get();
        return $this->success($rows, 'success');
    }

    public function store_mission_request()
    {
        $data = request()->validate([
            'date' => ['required', 'string', 'date_format:Y-m-d'],
            'start' => ['required'],
            'end' => ['required'],
            'reason' => ['required', 'string'],
        ]);
        $data['employee_id'] = auth()->id();
        $data['start']= Carbon::parse($data['start'])->format('H:i:s') ;
        $data['end']= Carbon::parse($data['end'])->format('H:i:s') ;
        Mission::create($data);
        return $this->success([], 'success');
    }


    public function store_over_time_request()
    {
        $data = request()->validate([
            'date' => ['required', 'string', 'date_format:Y-m-d'],
            'start' => ['required'],
            'end' => ['required'],
            'reason' => ['nullable', 'string'],
        ]);

        $data['employee_id'] = auth()->user()->employee->id;
        $data['start']= Carbon::parse($data['start'])->format('H:i:s') ;
        $data['end']= Carbon::parse($data['end'])->format('H:i:s') ;

        OverTimeRequest::create($data);
        return $this->success([], 'success');
    }
}
