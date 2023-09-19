<?php

namespace App\Http\Controllers;

use App\Exports\TotalAttendanceExport;
use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\IpRestrict;
use App\Models\User;
use App\Models\Utility;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Attendance-List', ['only' => ['index']]);
        $this->middleware('permission:Attendance-Export', ['only' => ['export']]);
        $this->middleware('permission:Attendance-Print', ['only' => ['print']]);
    }


    public function export(){
        return Excel::download(new TotalAttendanceExport, 'total_attendance.xlsx');
    }

    public function print(){
        /** @var AttendanceService $service */
        $service = app(AttendanceService::class);

        $attendances = AttendanceEmployee::with('employee.jobtitle')
            ->latest();

        $attendances = $service->filter($attendances);

        return view('new-theme.exports.total_attendance', [
            'attendances' => $attendances->get(),
        ]);
    }

    public function index(Request $request)
    {
        /** @var AttendanceService $service */
        $service = app(AttendanceService::class);
        $graph_year = Carbon::now()->format('Y');
        if(request('year')){
            $graph_year = request('year');
        }

        $attendances = AttendanceEmployee::where([
            'created_by' => auth()->user()->creatorId(),
        ])->with('employee.jobtitle')
        ->latest();

        $graph_attendance_arr  =  graph_attendance_data($graph_year);
        $graph_permission_arr  =  graph_permission_data($graph_year);
        $graph_leave_arr       =  graph_leave_data($graph_year);

        $attendances =   $service->filter($attendances)->paginate(10);

        if($request->ajax()) {
            $search   = view('new-theme.employee.attendance.attendance', compact("attendances"));
            $paginate = view('new-theme.employee.attendance.paginate', compact("attendances"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        return view('new-theme.employee.attendance.index' , compact('attendances', 'graph_year','graph_attendance_arr','graph_permission_arr','graph_leave_arr'));
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
