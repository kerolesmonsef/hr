<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\AnnouncementEmployee;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Announcement'))
        {

            if(auth()->user()->type == 'employee')
            {
                $current_employee = Employee::where('user_id', '=', auth()->user()->id)->first();
                $announcements    = Announcement::orderBy('announcements.id', 'desc')->leftjoin('announcement_employees', 'announcements.id', '=', 'announcement_employees.announcement_id')->where('announcement_employees.employee_id', '=', $current_employee->id)->orWhere(
                    function ($q){
                        $q->where('announcements.department_id', '["0"]')->where('announcements.employee_id', '["0"]');
                    }
                )->get();
            }
            else
            {
                $current_employee = Employee::where('user_id', '=', auth()->user()->id)->first();
                $announcements    = Announcement::get();
            }

            return view('announcement.index', compact('announcements', 'current_employee'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Announcement'))
        {

            $employees = Employee::get()->pluck('name', 'id');
            $employees->prepend('All', 0);

            // $branch = Branch::get()->pluck('name', 'id');
            // $branch->prepend('All', 0);

            // $departments = Department::get()->pluck('name', 'id');
            // $departments->prepend('All', 0);

            // $employees   = Employee::get()->pluck('name', 'id');
            $branch      = Branch::get();
            $departments = Department::get();

            return view('announcement.create', compact('employees', 'branch', 'departments'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Announcement'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'start_date' => 'required',
                                   'end_date' => 'required',
                                   'branch_id' => 'required',
                                   'department_id' => 'required',
                                   'employee_id' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            // ha bole emp all secect kariye ne to badha ne msg javo joi ee batvu singe kai rite jay ch ee
            // aa single set karelo hato

            $announcement                = new Announcement();
            $announcement->title         = $request->title;
            $announcement->start_date    = $request->start_date;
            $announcement->end_date      = $request->end_date;
            $announcement->branch_id     = $request->branch_id ;
            $announcement->department_id = implode("," , $request->department_id);
            $announcement->employee_id   = implode("," , $request->employee_id);
            // $announcement->department_id = json_encode($request->department_id);
            // $announcement->employee_id   = json_encode($request->employee_id);
            $announcement->description   = $request->description;
            $announcement->created_by    = auth()->user()->creatorId();
            $announcement->save();

            // slack
            $setting = Utility::settings(auth()->user()->creatorId());
            $branch = Branch ::find($request->branch_id);
            if(isset($setting['Announcement_notification']) && $setting['Announcement_notification'] ==1){
                $msg = $request->title.' '. __("announcement created for branch").' '.$branch->name.' '. __("from").' '.$request->start_date.' '. __("to").' '.$request->end_date.'.';
                Utility::send_slack_msg($msg);
            }

            // telegram
            $setting = Utility::settings(auth()->user()->creatorId());
            $branch = Branch ::find($request->branch_id);
            if(isset($setting['telegram_Announcement_notification']) && $setting['telegram_Announcement_notification'] ==1){
                $msg = $request->title.' '. __("announcement created for branch"). ' ' .$branch->name. ' '. __("from"). ' '.$request->start_date. ' '. __("to"). ' ' .$request->end_date.'.';
                Utility::send_telegram_msg($msg);
            }
             // twilio
              $setting = Utility::settings(auth()->user()->creatorId());
              $branch = Branch ::find($request->branch_id);
              $departments = Department::where('branch_id' , $request->branch_id)->first();
              $employees = Employee::where('branch_id' , $request->branch_id)->first();

            if(isset($setting['twilio_announcement_notification']) && $setting['twilio_announcement_notification'] ==1) {
                $employeess= Employee::whereIn('branch_id' , $request->employee_id)->get();
                foreach ($employeess as $key => $employee) {
                    $msg = $request->title.' '. __("announcement created for branch"). ' ' .$branch->name. ' '. __("from"). ' '.$request->start_date. ' '. __("to"). ' ' .$request->end_date.'.';
                    Utility::send_twilio_msg($employee->phone,$msg);
                }
            }

            if(in_array('0', $request->employee_id))
            {
                $departmentEmployee = Employee::whereIn('department_id', $request->department_id)->get()->pluck('id');
                $departmentEmployee = $departmentEmployee;

            }
            else
            {
                $departmentEmployee = $request->employee_id;
            }
            foreach($departmentEmployee as $employee)
            {
                $announcementEmployee                  = new AnnouncementEmployee();
                $announcementEmployee->announcement_id = $announcement->id;
                $announcementEmployee->employee_id     = $employee;
                $announcementEmployee->created_by      = auth()->user()->creatorId();

                $announcementEmployee->save();
            }

            return redirect()->route('announcement.index')->with('success', __('Announcement  successfully created.'));
        }

        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Announcement $announcement)
    {
        return redirect()->route('announcement.index');
    }

    public function edit($announcement)
    {
        if(auth()->user()->can('Edit Announcement'))
        {
            $announcement = Announcement::find($announcement);
            if($announcement->created_by == auth()->user()->creatorId())
            {
                $branch      = Branch::get()->pluck('name', 'id');
                $departments = Department::get()->pluck('name', 'id');

                return view('announcement.edit', compact('announcement', 'branch', 'departments'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Announcement $announcement)
    {
        if(auth()->user()->can('Edit Announcement'))
        {
            if($announcement->created_by == auth()->user()->creatorId())
            {

                $validator = \Validator::make(
                    $request->all(), [
                                       'title' => 'required',
                                       'start_date' => 'required',
                                       'end_date' => 'required',
                                       'branch_id' => 'required',
                                       'department_id' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $announcement->title         = $request->title;
                $announcement->start_date    = $request->start_date;
                $announcement->end_date      = $request->end_date;
                $announcement->branch_id     = $request->branch_id;
                $announcement->department_id = $request->department_id;
                $announcement->description   = $request->description;
                $announcement->save();

                return redirect()->route('announcement.index')->with('success', __('Announcement successfully updated.'));
            }
            else
            {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Announcement $announcement)
    {
        if(auth()->user()->can('Delete Announcement'))
        {
            if($announcement->created_by == auth()->user()->creatorId())
            {
                $announcement->delete();

                return redirect()->route('announcement.index')->with('success', __('Announcement successfully deleted.'));
            }
            else
            {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function getdepartment(Request $request)
    {

        if($request->branch_id == 0)
        {
            $departments = Department::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $departments = Department::where('branch_id', $request->branch_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($departments);
    }

    public function getemployee(Request $request)
    {
        if(in_array('0', $request->department_id))
        {
            $employees = Employee::get()->pluck('name', 'id')->toArray();
        }
        else
        {
            $employees = Employee::whereIn('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();
        }

        return response()->json($employees);
    }
}
