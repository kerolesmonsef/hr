<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\MeetingResource;
use App\Http\Resources\NewResource;
use App\Http\Resources\OfferResource;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Models\EmployeeBreak;
use App\Models\Event;
use App\Models\Meeting;
use App\Models\News;
use App\Models\Offer;
use App\Models\PaySlip;
use App\Models\Salary_setting;
use App\Models\Task;
use App\Traits\ApiResponser;
use Carbon\carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use mysql_xdevapi\Collection;


/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\V1\Employee
 */
class HomeController extends Controller
{
    use ApiResponser;

    public function readslate()
    {
        $employee = Employee::where('user_id', auth()->id())->first();
        $employee->update(['read_slate' => 1]);
        return $this->success([], '');
    }

    public function index(Request $request)
    {
        $employee = Employee::with(['tasks', 'meetings'])->where('user_id', auth()->id())->first();

        $tasks_status = $this->getTasksStatus($employee);

        $meetings = $this->getHomeMeetings($employee, $request);

        $events = $this->getHomeEvents($request);

        $news = $this->getHomeNews($request);

        $offers = $this->getHomeOffers($request);

        if ($request->fcm_token != $employee->fcm_token) {
            $employee->update(['fcm_token' => $request->fcm_token]);
        }


        return $this->success([
            'task_status' => $tasks_status,
            'meetings' => $meetings,
            'events' => $events,
            'news' => $news,
            'offers' => $offers
        ], '');


        $last_pay_slip = PaySlip::where('employee_id', auth()->user()->employee->id)->latest()->first();

        $companySetting = company_setting()->toArray(request());

        $start_from = \Carbon\carbon::parse($companySetting['start_time'])->subMinutes($companySetting['grace_period_before'])->format('H:i');
        $start_to = \Carbon\carbon::parse($companySetting['start_time'])->addMinutes($companySetting['grace_period'])->format('H:i');
        $end_from = \Carbon\carbon::parse($companySetting['end_time'])->subMinutes($companySetting['grace_period_end_before'])->format('H:i');
        $end_to = \Carbon\carbon::parse($companySetting['end_time'])->addMinutes($companySetting['grace_period_end_after'])->format('H:i');
        $endTime = \Carbon\carbon::parse($companySetting['end_time'])->format('H:i');
        $currentTime = \Carbon\carbon::now()->format('H:i');
        $dailyAttendance = AttendanceEmployee::where('employee_id', auth()->user()->employee->id)->whereDate('date', \Carbon\carbon::today())->first();
        $setting = Salary_setting::first() ?? [];
        $workdaysArr = explode(',', $setting->week_vacations);
        $todayName = Carbon::today()->format('l');
        $holidays = [];
        $employeevacation = [];
        $attendStatus = 0;

        $check = false;
        if (in_array($todayName, $workdaysArr)) {
            $attendStatus = 7;
        } elseif (in_array(date('Y-m-d'), $holidays)) {
            $attendStatus = 8;
        } elseif ($employeevacation) {
            $attendStatus = 6;
        } elseif (!$dailyAttendance && $currentTime < $start_from) {
            $attendStatus = 0;
        } elseif (!$dailyAttendance && $currentTime >= $start_from && $currentTime <= $start_to) {
            $attendStatus = 1;
        } elseif (!$dailyAttendance && $currentTime > $start_to) {
            $attendStatus = 2;
        } elseif (!$dailyAttendance && $currentTime >= $endTime) {
            $attendStatus = 5;
        } elseif ($dailyAttendance && $dailyAttendance->clock_in && !$dailyAttendance->clock_out && $currentTime < $endTime) {
            $attendStatus = 3;
        } elseif (!$dailyAttendance->clock_out && $currentTime >= $endTime) {
            $attendStatus = 4;
            $check = true;
        } elseif (!$dailyAttendance && $currentTime > $endTime) {
            $attendStatus = 5;
        } elseif ($dailyAttendance && $dailyAttendance->clock_in && $dailyAttendance->clock_out) {
            if ($dailyAttendance->date == date('Y-m-d')) {
                $attendStatus = 5;
                $check = true;
            }
        }
        $checkedTime = $dailyAttendance ? $dailyAttendance->clock_in : now();
        $employee_break = EmployeeBreak::where(['employee_id' => auth()->user()->employee->id])->whereNull('end_time')->whereDate('created_at', Carbon::today())->with('company_break')->first();
        $break_status = 0;
        $break = null;
        if ($employee_break != null && Carbon::now()->lt(Carbon::parse($employee_break->company_break->end_time))) {
            $break_status = 1;
            $break = Carbon::now()->diffInSeconds(Carbon::parse($employee_break->company_break->end_time));
        } elseif ($employee_break != null && Carbon::now()->gt(Carbon::parse($employee_break->company_break->end_time))) {
            $break_status = 1;
            $break = Carbon::now()->diffInSeconds(Carbon::parse($employee_break->company_break->end_time)) * -1;
        }
        return $this->success([
            'checkin_time' => $dailyAttendance ? $dailyAttendance->clock_in : Null,
            'checkout_time' => $dailyAttendance ? $dailyAttendance->clock_out : Null,
            'total_rest' => $dailyAttendance && $dailyAttendance->clock_out ?
                Carbon::parse($dailyAttendance->clock_in)->diffInSeconds(Carbon::parse($dailyAttendance->clock_out)) :
                Carbon::parse(now())->diffInSeconds(Carbon::parse($checkedTime)),
            'attend_status' => $attendStatus,
            'notification_count' => 0,
            'break_status' => $break_status,
            'break' => $break,
            'upload_face_image' => $employee->login_image != null ? 1 : 0,
            'company_require_face_print' => 0,
            'is_recieved_salary' => $last_pay_slip != null ? $last_pay_slip->is_recieved : 1,
            'recieved_salary_date' => $last_pay_slip != null ? $last_pay_slip->salary_month : null,
            'read_slate_status' => $employee->read_slate,
            'company_start_from' => $start_from,
            'company_start_to' => $start_to,
            'company_end_from' => $end_from,
            'company_end_to' => $end_to,
        ], '');
    }


    public function getTasksStatus(Employee $employee): array
    {
        $tasks = $employee->tasks;
        $tasks_total_count = $tasks->count();

        $boards = [];
        foreach (Task::getStatuses() as $status) {
            $current_status_count = $tasks->where('status', $status)->count();
            $boards[] = [
                'title' => __('task_status_' . $status),
                'id'    => $status,
                'tasks_count' => $current_status_count,
                'precentage' => $tasks_total_count == 0 ? 0 : ($current_status_count * 100) / $tasks_total_count,
            ];
        }

        return $boards;
    }

    public function getHomeMeetings(Employee $employee, Request $request): JsonResource
    {
        $meetings = $employee->meetings->when($request->filled('meetings_limit'), function ($q) {
            return $q->take(request('meetings_limit'));
        })->where('date', '>', now());
        return MeetingResource::collection($meetings);
    }


    public function getHomeEvents(Request $request): JsonResource
    {
        $events = Event::where('start_date', '>', now())->when($request->filled('events_limit'), function ($q) {
            return $q->take(request('events_limit'));
        })->orderBy('start_date')->get();
        return EventResource::collection($events);
    }


    public function getHomeNews(Request $request): JsonResource
    {
        $news = News::latest()->when($request->filled('news_limit'), function ($q) {
            return $q->take(request('news_limit'));
        })->get();
        return NewResource::collection($news);
    }


    public function getHomeOffers(Request $request): JsonResource
    {
        $offers = Offer::latest()->when($request->filled('offers_limit'), function ($q) {
            return $q->take(request('offers_limit'));
        })->get();
        return OfferResource::collection($offers);
    }


}
