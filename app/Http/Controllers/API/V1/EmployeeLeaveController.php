<?php

namespace App\Http\Controllers\API\V1;


use App\Http\Controllers\Controller;
use App\Http\Resources\LeaveHistoryResource;
use App\Models\Leave;

class EmployeeLeaveController extends Controller
{
    public function index(){
        $leaves = Leave::where('employee_id', auth()->user()->employee->id)->latest()->get();
        $leaves = $leaves->map(function ($item) {
            $item->modeltype = 'leave';
            return $item;
        });
        return $this->success(LeaveHistoryResource::collection($leaves), __('Requests'));
    }
}
