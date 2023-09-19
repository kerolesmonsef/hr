<?php

namespace App\Services;

use App\Models\AttendanceMovement;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Models\Utility;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\Builder;

class LeaveService
{
    use  ApiResponser;
    public function storeLeave($data)
    {
        $leave_type       = LeaveType::findorfail($data['leave_type_id']);
        $company_settings = Utility::settings();
        $start_time       = $company_settings['company_start_time'];

        if($leave_type->maxDaysPerMonth != null) {
            $attendanceMovement = AttendanceMovement::whereNull('status')->firstorfail();
            $startDate = Carbon::createFromFormat('Y-m-d',  $attendanceMovement->start_movement_date)->format('Y-m-d');
            $endDate = Carbon::createFromFormat('Y-m-d', $attendanceMovement->end_movement_date)->format('Y-m-d');
            $check_user_take_leave_in_this_month = Leave::where(['employee_id' =>  $data['employee_id'] , 'leave_type_id' => $data['leave_type_id']])->whereIn('status' , ['approved' , 'approvedWithDeduction'])->whereBetween('start_date', [$startDate, $endDate])->count();
            if ($check_user_take_leave_in_this_month >= $leave_type->maxDaysPerMonth) {
                return redirect()->back()->with('error', 'You cant take this leave more than  ' . $leave_type->maxDaysPerMonth . ' days in the same month');
            }
        }

        if (($leave_type->daysBeforeApply == null && !Carbon::parse($data['start_date'])->isToday())) {
            return redirect()->back()->with('error','You must request this leave on the same day');
        }

        if ($leave_type->afterMaxHour != null && !Carbon::now()->lte(Carbon::parse(date('d-m-Y' . $start_time))->addHours($leave_type->afterMaxHour) /*Carbon::parse('today '.(9+$leave_type->afterMaxHour).'am')*/)) {
            return redirect()->back()->with('error','You must request this leave before ' . Carbon::parse(date('d-m-Y' . $start_time))->addHours($leave_type->afterMaxHour));
        }

        if ($leave_type->daysBeforeApply != null && (Carbon::parse($data['start_date'])->lte(Carbon::today()) || Carbon::parse($data['start_date'])->diffInDays(Carbon::today()) < $leave_type->daysBeforeApply)) {
            return redirect()->back()->with('error','You must request this leave ' . $leave_type->daysBeforeApply . ' days in advance');
        }

        //اقصي عدد للاجازة في الشهر
        if (Carbon::parse($data['end_date'])->diffInDays($data['start_date']) + 1 > $leave_type->maxDaysPerMonth && $leave_type->maxDaysPerMonth != null) {
            return redirect()->back()->with('error','Maximam days for this leave is ' . $leave_type->maxDaysPerMonth . ' days only');
        }

        //اقصي عدد لايام الاجازة ف المرة الواحدة
        if (Carbon::parse($data['end_date'])->diffInDays($data['start_date']) + 1 > $leave_type->maxDays && $leave_type->maxDays != null) {
            return redirect()->back()->with('error','Maximam days for this leave is ' . $leave_type->maxDays . ' days only');
        }

        $data['employee_id']      = $data['employee_id'];
        $data['applied_on']       = Carbon::now()->format('Y-m-d');
        $data['total_leave_days'] = Carbon::parse($data['end_date'])->diffInDays($data['start_date']) + 1;
        $data['start_date']       = Carbon::createFromFormat('Y-m-d',  $data['start_date']);
        $data['end_date']         = Carbon::createFromFormat('Y-m-d',  $data['end_date']);
        $data['created_by']       = auth()->user()->creatorId();
        unset($data['type']);
        Leave::create($data);
        return redirect()->back()->with('success', __('Leave  successfully created.'));
    }

    public function filter(Builder $vacations){
        if(request('search') and request('search') != 'undefined'){
            $vacations = $vacations->where(function($q){
                $q->orwhereHas('employee' , function($q){
                    $q->where('name' , 'like' , '%' . request('search') . '%' )
                        ->orwhere('name_ar' , 'like' , '%' . request('search') . '%');
                });
            });
        }

        if (request('employee_id')) {
            $vacations = $vacations->where('employee_id', request('employee_id'));
        }

        $vacations->when(request('start_date') and request('start_date') != 'undefined', function ($q){
            $q->where('start_date','>=',request('start_date'));
        })->when(request('end_date') and request('end_date') != 'undefined', function ($q){
            $q->where('start_date','<=',request('end_date'));
        });

        return $vacations;
    }
}
