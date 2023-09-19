<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Controller;
use App\Http\Resources\MeetingResource;
use App\Mail\sendemail;
use App\Models\Employee;
use App\Models\Meeting;
use App\Models\MeetingEmployee;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class MettingController extends Controller
{

    use ApiResponser;

    public function index(Request $request)
    {
//        $current_employee = Employee::where('user_id', '=', auth()->user()->id)->first();
//        $meetings         = Meeting::orderBy('meetings.id', 'desc')->where('date','>=',date('Y-m-d'))
//        ->leftjoin('meeting_employees', 'meetings.id', '=', 'meeting_employees.meeting_id')
//        ->where('meeting_employees.employee_id', '=', $current_employee->id)
//        ->orWhere(function ($q) {
//            $q->where('meetings.department_id', '["0"]')
//                ->where('meetings.employee_id', '["0"]');
//        })->get();

        $meetings = auth()->user()->employee->meetings()
            ->with("employees.user")
            ->when($request->filled('search'), function ($q) {
                return $q->where('title', 'like', '%' . request('search') . '%');
            })->when($request->filled('date'), function ($q) {
                return $q->whereDate('date', Carbon::parse(request('date')));
            })->get();
        return $this->success(MeetingResource::collection($meetings), '');
    }

    public function accept($id)
    {
        $row = MeetingEmployee::where([
            'employee_id' => auth()->user()->employee->id,
            'meeting_id' => $id,
            'status' => 'pending'
        ])->firstorfail();

        $row->update([
            'status' => 'accepted',
        ]);
        return $this->success(null, __('Accepted successfully'), 200);
    }

    public function reject(Request $request, $id)
    {
        $data = $request->validate([
            'reject_reason' => 'required|string',
        ]);
        $row = MeetingEmployee::where([
            'employee_id' => auth()->user()->employee->id,
            'meeting_id' => $id,
            'status' => 'pending'
        ])->firstorfail();
        $row->update([
            'status' => 'rejected',
            'reject_Reason' => $data['reject_reason'],
        ]);
        return $this->success(null, __('Rejected successfully'), 200);
    }
}
