<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Tasks;
use App\Models\Branch;
use App\Models\Utility;
use App\Models\Employee;
use App\Models\Projects;
use App\Models\Department;
use App\Exports\EventExport;
use App\Helpers\FileHelper;
use App\Imports\EventImport;
use Illuminate\Http\Request;
use App\Models\EventEmployee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\NewTheme\StoreEventRequest;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Event-List', ['only' => ['index']]);
        $this->middleware('permission:Event-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Event-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Event-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Event-Export', ['only' => ['export']]);
        $this->middleware('permission:Event-Print', ['only' => ['print']]);
    }


    public function index(Request $request)
    {
        $events = Event::query()->when($request->filled('search'), function ($q) {
            $q->where('title', 'like', "%" . request('search') . "%");
        })->get(['start_date', 'title', 'end_time', 'start_time', 'id']);
        $incoming_events = $events->where('start_date', '>', now())->sortBy('start_date')->take(2);

        $events = $events->map(function ($event) {
            $event['start'] = $event['start_date']->format('Y-m-d');
            return $event;
        })->toArray();

        return view('new-theme.meetings.events.index', compact('events', 'incoming_events'));
    }

    public function create()
    {
        $employees = Employee::get()->pluck('name', 'id');
        // $branch      = Branch::get();
        // $departments = Department::get();

        return view('new-theme.meetings.events.create', compact('employees'));
    }

    public function store(StoreEventRequest $request)
    {

        $data = $request->validated();
        $dates = explode(" to ", $request->get('end_date'));

        $start_date = $dates[0] ?? now()->format('Y-m-d');
        $end_date = $dates[1] ?? now()->format('Y-m-d');
        $data['created_by'] = auth()->user()->creatorId();
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['photo'] = FileHelper::upload_file('event', $request->file('photo'));
        Event::create($data);

        // //  slack
        // $setting = Utility::settings(auth()->user()->creatorId());
        // $branch = Branch::find($request->branch_id);
        // if (isset($setting['event_notification']) && $setting['event_notification'] == 1) {
        //     $msg = $request->title . ' ' . __("for branch") . ' ' . $branch->name . ' ' . ("from") . ' ' . $request->start_date . ' ' . __("to") . ' ' . $request->end_date . '.';
        //     Utility::send_slack_msg($msg);
        // }

        // //telegram
        // $setting = Utility::settings(auth()->user()->creatorId());
        // $branch = Branch::find($request->branch_id);
        // if (isset($setting['telegram_ticket_notification']) && $setting['telegram_ticket_notification'] == 1) {
        //     $msg = $request->title . ' ' . __("for branch") . ' ' . $branch->name . ' ' . ("from") . ' ' . $request->start_date . ' ' . __("to") . ' ' . $request->end_date . '.';
        //     Utility::send_telegram_msg($msg);
        // }


        // //twilio
        // $setting = Utility::settings(auth()->user()->creatorId());
        // $branch = Branch::find($request->branch_id);
        // $departments = Department::where('branch_id', $request->branch_id)->first();
        // $employee = Employee::where('branch_id', $request->branch_id)->first();

        // if (isset($setting['twilio_event_notification']) && $setting['twilio_event_notification'] == 1) {
        //     $employeess = Employee::whereIn('branch_id', $request->employee_id)->get();
        //     foreach ($employeess as $key => $employee) {
        //         $msg = $request->title . ' ' . __("for branch") . ' ' . $branch->name . ' ' . ("from") . ' ' . $request->start_date . ' ' . __("to") . ' ' . $request->end_date . '.';
        //         Utility::send_twilio_msg($employee->phone, $msg);
        //     }
        // }


        // if (in_array('0', $request->employee_id)) {
        //     $departmentEmployee = Employee::whereIn('department_id', $request->department_id)->get()->pluck('id');
        //     $departmentEmployee = $departmentEmployee;
        // } else {
        //     $departmentEmployee = $request->employee_id;
        // }
        // foreach ($departmentEmployee as $employee) {
        //     $eventEmployee              = new EventEmployee();
        //     $eventEmployee->event_id    = $event->id;
        //     $eventEmployee->employee_id = $employee;
        //     $eventEmployee->created_by  = auth()->user()->creatorId();
        //     $eventEmployee->save();
        // }

        return redirect()->route('event.index')->with('success', __('Event  successfully created.'));
    }

    public function show(Event $event)
    {
        return redirect()->route('event.index');
    }

    public function edit($event)
    {

        if (auth()->user()->can('Edit Event')) {
            $event = Event::find($event);
            if ($event->created_by == auth()->user()->creatorId()) {
                $employees = Employee::get()->pluck('name', 'id');

                return view('event.edit', compact('event', 'employees'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Event $event)
    {
        if (auth()->user()->can('Edit Event')) {
            if ($event->created_by == auth()->user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'title' => 'required',
                        'title_ar' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'color' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $event->title = $request->title;
                $event->title_ar = $request->title_ar;
                $event->start_date = $request->start_date;
                $event->end_date = $request->end_date;
                $event->time = $request->time;
                $event->color = $request->color;
                $event->description = $request->description;
                $event->description_ar = $request->description_ar;
                $event->save();

                return redirect()->route('event.index')->with('success', __('Event successfully updated.'));
            } else {
                flash()->addError(__('Permission denied'));
                return redirect()->back();
            }
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Event $event)
    {

        if ($event->created_by == auth()->user()->creatorId()) {
            $event->delete();

            return redirect()->route('event.index')->with('success', __('Event successfully deleted.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }

    }

    public function export()
    {
        $name = 'event' . date('Y-m-d i:h:s');
        $data = Excel::download(new EventExport(), $name . '.xlsx');
        if (ob_get_contents()) ob_end_clean();
        return $data;
    }

    public function print()
    {
        $events = Event::all();

        return view("new-theme.exports.events", compact('events'));
    }

    public function importFile()
    {
        return view('event.import');
    }

    public function import(Request $request)
    {
        // dd('here');
        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $events = (new EventImport())->toArray(request()->file('file'))[0];
        // dd($events);
        $totalEvents = count($events) - 1;
        $errorArray = [];

        for ($i = 1; $i <= count($events) - 1; $i++) {

            $event = $events[$i];
            // dd($event[2]);
            $eventsByTitle = Event::where('title', $event[2])->first();

            if (!empty($eventsByTitle)) {
                $eventData = $eventsByTitle;
            } else {
                $eventData = new Event();
            }

            $eventData->branch_id = $event[0];
            $eventData->department_id = $event[1];
            $eventData->employee_id = '["0"]';
            $eventData->title = $event[2];
            $eventData->start_date = $event[3];
            $eventData->end_date = $event[4];
            $eventData->color = $event[5];
            $eventData->description = $event[6];
            $eventData->created_by = $event[7];

            if (empty($eventData)) {
                $errorArray[] = $eventData;
            } else {
                $eventData->save();
            }
        }

        $errorRecord = [];
        if (empty($errorArray)) {
            $data['status'] = 'success';
            $data['msg'] = __('Record successfully imported');
        } else {
            $data['status'] = 'error';
            $data['msg'] = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalEvents . ' ' . 'record');


            foreach ($errorArray as $errorData) {

                $errorRecord[] = implode(',', $errorData);
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
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
