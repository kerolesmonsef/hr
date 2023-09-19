<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\Setting;
use App\Models\Utility;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:AttendanceSetting-List', ['only' => ['index','update']]);
    }


    public function index()
    {
        $setting = company_setting();
        return view('new-theme.settings.attendance.index', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'company_start_time' => ['required', 'string'],
            'company_end_time' => ['required', 'string'],
            'company_grace_period' => ['required', 'string'],
            'company_grace_period_befor' => ['required', 'string'],
            'company_grace_period_end_before' => ['required', 'string'],
            'company_grace_period_end_after' => ['required', 'string'],
            'break_start_time' => ['required', 'string'],
            'break_end_time' => ['required', 'string'],
            'work_hours' => ['required', 'string'],
            'week_vacations' => ['required', 'array'],
            'ip_address' => ['required_if:required_ip_address,==,on'],
            'permissions_monthly_limit' => ['required', 'string'],
            'time_zone' => ['required', 'string'],
            'lat' => ['required', 'string'],
            'lon' => ['required', 'string'],
        ]);
        //    $data['ip_address'] = implode(',' ,  $data['ip_address']);
        $data['week_vacations'] = implode(',',  $data['week_vacations']);
        foreach ($data as $key => $row) {
            $datarow = Setting::where('created_by', $id)->where('name', $key)->first();
            if ($datarow) {
                $datarow->update([
                    'name' => $key,
                    'value' => $row,
                    'created_by' => auth()->user()->creatorId(),
                ]);
                continue;
            }
            Setting::create([
                'name' => $key,
                'value' => $row,
                'created_by' => auth()->user()->creatorId(),
            ]);
        }
        flash()->addSuccess(__('Updated successfully'));
        return redirect()->back();
    }
}
