<?php

namespace App\Http\Controllers;

use App\Exports\MeetingExport;
use App\Http\Requests\NewTheme\StoreMeetingRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Meeting;
use App\Models\MeetingEmployee;
use Illuminate\Http\Request;
use App\Models\Utility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MeetingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Meeting-List', ['only' => ['index']]);
        $this->middleware('permission:Meeting-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Meeting-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Meeting-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Meeting-Export', ['only' => ['export']]);
        $this->middleware('permission:Meeting-Print', ['only' => ['print']]);
    }


    public function index(Request $request)
    {
        $employees = Employee::get();

        $meetings = Meeting::select('date', 'title', 'id')
            ->when($request->filled('search'), function ($q) {
                $q->where('title', 'like', "%" . request('search') . "%");
            })->get();

        $incoming_meetings = $meetings->where('date', '>', now())->sortBy('date')->take(2);

        $imageSource = '/new-theme/icons/avatar.svg';
        $meetings = array_map(function ($meeting) use ($imageSource) {
            $meeting['image_url'] = $imageSource;
            return $meeting;
        }, $meetings->toArray());


        if ($request->ajax()) {
            $search = view('new-theme.meetings.meetings.calendar', compact("meetings"));
            return response()->json(['search' => $search->render()]);
        }


        return view('new-theme.meetings.meetings.index', compact('meetings', 'employees', 'incoming_meetings'));
        // return view('meeting.index', compact('meetings', 'employees'));

    }

    public function export()
    {
        return Excel::download(new MeetingExport(), 'meetings.xlsx');
    }

    public function print()
    {
        $meetings = Meeting::all();

        return view("new-theme.exports.meetings", compact('meetings'));
    }

    public function create()
    {
        if (auth()->user()->type == 'employee') {
            $employees = Employee::where('user_id', '!=', auth()->user()->id)->get()->pluck('name', 'id');
        } else {
            $branches = Branch::get();
            // $departments = Department::get();
            $employees = Employee::get()->pluck('name', 'id');
        }
        return view('new-theme.meetings.meetings.create', compact('employees', 'branches'));

        // return view('meeting.create', compact('employees', 'departments', 'branch'));

    }

    public function store(StoreMeetingRequest $request)
    {

        $data = $request->validated();
        $data['employee_id'] = json_encode($request->employee_id);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $request->date);
        $meeting = Meeting::create(array_merge($data, ['created_by' => auth()->user()->creatorId()]));


        // slack
        $setting = Utility::settings(auth()->user()->creatorId());
        $branch = Branch::find($request->branch_id);
        if (isset($setting['meeting_notification']) && $setting['meeting_notification'] == 1) {
            $msg = $request->title . ' ' . __("meeting created for") . ' ' . $branch->name . ' ' . ("from") . ' ' . $request->date . ' ' . ("at") . ' ' . $request->time . '.';
            Utility::send_slack_msg($msg);
        }

        // telegram
        $setting = Utility::settings(auth()->user()->creatorId());
        $branch = Branch::find($request->branch_id);
        if (isset($setting['telegram_meeting_notification']) && $setting['telegram_meeting_notification'] == 1) {
            $msg = $request->title . ' ' . __("meeting created for") . ' ' . $branch->name . ' ' . ("from") . ' ' . $request->date . ' ' . ("at") . ' ' . $request->time . '.';
            Utility::send_telegram_msg($msg);
        }

        if (in_array('0', $request->employee_id)) {
            $departmentEmployee = Employee::whereIn('department_id', $request->department_id)->get()->pluck('id');
            $departmentEmployee = $departmentEmployee;
        } else {

            $departmentEmployee = $request->employee_id;
        }
        foreach ($departmentEmployee as $employee) {
            $meetingEmployee = new MeetingEmployee();
            $meetingEmployee->meeting_id = $meeting->id;
            $meetingEmployee->employee_id = $employee;
            $meetingEmployee->created_by = auth()->user()->creatorId();
            $meetingEmployee->save();
        }
        return redirect()->route('meeting.index')->with('success', __('Meeting  successfully created.'));
    }

    public function destroy(Meeting $meeting)
    {
        if ($meeting->created_by == auth()->user()->creatorId()) {
            $meeting->delete();

            return redirect()->route('meeting.index')->with('success', __('Meeting successfully deleted.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }

    }

    public function getdepartment(Request $request)
    {
        if ($request->branch_id == 0) {
            $departments = Department::get()->pluck('name', 'id')->toArray();
        } else {
            $departments = Department::where('branch_id', $request->branch_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($departments);
    }

    public function getemployee(Request $request)
    {
        if (in_array('0', $request->department_id)) {
            $employees = Employee::get()->pluck('name', 'id')->toArray();
        } else {
            $employees = Employee::whereIn('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($employees);
    }
}
