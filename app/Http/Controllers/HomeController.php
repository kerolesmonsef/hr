<?php

namespace App\Http\Controllers;

use App\Models\AccountList;
use App\Models\Announcement;
use App\Models\AttendanceEmployee;
use App\Models\AttendanceMovement;
use App\Models\AllowanceOption;
use App\Models\Mission;
use App\Models\OverTimeRequest;
use App\Models\PaySlip;
use App\Models\Employee;
use App\Models\EmployeePermission;
use App\Models\Event;
use App\Models\LandingPageSection;
use App\Models\Leave;
use App\Models\LoanPending;
use App\Models\Meeting;
use App\Models\Order;
use App\Models\Payees;
use App\Models\Payer;
use App\Models\Plan;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Utility;
use App\Models\WorkFromHomeRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('permission:Dashboard-View', ['only' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function evaluation_test()
    {
        dd(request()->all());
    }

    public function index()
    {
        $user = auth()->user();
        $employees_count = Employee::where('is_active', 1)->count();
        $attendance_employees = AttendanceEmployee::whereDate('date', Carbon::today()->toDateString())->count();

        $leaves_today_count = Leave::whereDate('created_at', Carbon::today()->toDateString())->count();
        $permission_today_count = EmployeePermission::whereDate('created_at', Carbon::today()->toDateString())->count();
        $meetings = Meeting::whereDate('date', Carbon::today()->toDateString())->get();

        $currentMonth = request('month') ? Carbon::parse(request('month')) : Carbon::now();
        $employees_attendance = getCurrentMonthGroupBy(AttendanceEmployee::class,$currentMonth);
        $employees_leaves = getCurrentMonthGroupBy(Leave::class,$currentMonth);
        $employees_permissions = getCurrentMonthGroupBy(EmployeePermission::class,$currentMonth);




        $leaves = Leave::with('employee')->where([
            'status' => 'pending',
        ])->latest()->get();

        $leaves = $leaves->map(function ($item) {
            $item->modeltype = 'leave';
            return $item;
        });

        $permissions = EmployeePermission::with('employee')->where([
            'status' => 'pending',
        ])->latest()->get();

        $permissions = $permissions->map(function ($item) {
            $item->modeltype = 'permission';
            return $item;
        });

        $workfromhomerequests = WorkFromHomeRequest::with('employee')->where([
            'status' => 'pending',
        ])->latest()->get();

        $workfromhomerequests = $workfromhomerequests->map(function ($item) {
            $item->modeltype = 'work_from_home_request';
            return $item;
        });

        $loans = LoanPending::where([
            'status' => 'pending',
        ])->with('loan_option_item')->latest()->get();

        $loans = $loans->map(function ($item) {
            $item->modeltype = 'loan';
            return $item;
        });


        $misssions = Mission::with('employee')
            ->where("status", "pending")
            ->get();

        $misssions = $misssions->map(function ($item) {
            $item->modeltype = 'mission';
            return $item;
        });

        $over_time = OverTimeRequest::with('employee')
            ->where("status", "pending")
            ->get();
        $over_time = $over_time->map(function ($item) {
            $item->modeltype = 'over_time';
            return $item;
        });

        $total_requests = $leaves->concat($permissions);
        $total_requests = $total_requests->concat($loans);
        $total_requests = $total_requests->concat($workfromhomerequests);
        $total_requests = $total_requests->concat($misssions);
        $total_requests = $total_requests->concat($over_time);
        $total_requests = $total_requests->sortByDesc('created_at');
        return view('new-theme.dashboard.dashboard', compact('employees_count', 'attendance_employees', 'leaves_today_count', 'permission_today_count', 'meetings', 'employees_attendance', 'employees_leaves', 'employees_permissions', 'total_requests'))->with("success", "dd");
    }

    public function getOrderChart($arrParam)
    {
        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'week') {
                $previous_week = strtotime("-2 week +1 day");
                for ($i = 0; $i < 14; $i++) {
                    $arrDuration[date('Y-m-d', $previous_week)] = date('d-M', $previous_week);
                    $previous_week = strtotime(date('Y-m-d', $previous_week) . " +1 day");
                }
            }
        }
        $arrTask = [];
        $arrTask['label'] = [];
        $arrTask['data'] = [];
        foreach ($arrDuration as $date => $label) {
            $data = Order::select(\DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $arrTask['label'][] = $label;
            $arrTask['data'][] = $data->total;
        }
        return $arrTask;
    }

    public function about()
    {
        return view('landingpage.about');
    }

    public function solutions()
    {
        return view('landingpage.solutions');
    }

    public function pricing()
    {
        return view('landingpage.pricing');
    }
}
