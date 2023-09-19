<?php

namespace App\Services\Api;

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
    public function storeLeave($data) {
            $leave_type = LeaveType::findorfail($data['leave_type_id']);
            $company_settings = Utility::settings();
            $start_time = $company_settings['company_start_time'];
            $attendanceMovement = AttendanceMovement::where('created_by' , auth()->user()->creatorId())->whereNull('status')->first();
            if($leave_type->maxDaysPerMonth != null && $attendanceMovement ){
                $startDate = Carbon::createFromFormat('Y-m-d',  $attendanceMovement->start_movement_date)->format('Y-m-d');
                $endDate = Carbon::createFromFormat('Y-m-d', $attendanceMovement->end_movement_date)->format('Y-m-d');
                $check_user_take_leave_in_this_month = Leave::where('employee_id',auth()->user()->id)->whereBetween('start_date', [$startDate, $endDate])->count();
                if( $check_user_take_leave_in_this_month >= $leave_type->maxDaysPerMonth ){
                    return $this->error('You cant take this leave more than  ' . $leave_type->maxDaysPerMonth . ' days in the same month' , 400);
                }
            }
            if(($leave_type->daysBeforeApply == null && !Carbon::parse($data['start_date'])->isToday())){
                return $this->error('You must request this leave on the same day' , 400);
            }

            if($leave_type->afterMaxHour != null && !Carbon::now()->lte( Carbon::parse(date('d-m-Y' . $start_time))->addHours($leave_type->afterMaxHour) /*Carbon::parse('today '.(9+$leave_type->afterMaxHour).'am')*/ ) ){
                return $this->error('You must request this leave before '.Carbon::parse(date('d-m-Y' . $start_time))->addHours($leave_type->afterMaxHour) , 400);
            }

            if($leave_type->daysBeforeApply != null && (Carbon::parse($data['start_date'])->lte(Carbon::today()) || Carbon::parse($data['start_date'])->diffInDays(Carbon::today()) < $leave_type->daysBeforeApply)){
                return $this->error('You must request this leave '.$leave_type->daysBeforeApply.' days in advance' , 400);
            }

            //اقصي عدد للاجازة في الشهر
            if(Carbon::parse($data['end_date'])->diffInDays($data['start_date'])+1 > $leave_type->maxDaysPerMonth && $leave_type->maxDaysPerMonth != null){
                return $this->error('Maximam days for this leave is '.$leave_type->maxDaysPerMonth .' days only', 400);
            }
            //اقصي عدد لايام الاجازة ف المرة الواحدة
            if(Carbon::parse($data['end_date'])->diffInDays($data['start_date']) +1 > $leave_type->maxDays && $leave_type->maxDays != null){
                return $this->error('Maximam days for this leave is '.$leave_type->maxDays .' days only', 400);
            }
            $data['employee_id']      = auth()->user()->employee->id;
            $data['applied_on']       = Carbon::now()->format('Y-m-d');
            $data['total_leave_days'] = Carbon::parse($data['end_date'])->diffInDays($data['start_date'])+1;
            $data['start_date']       = Carbon::createFromFormat('Y-m-d',  $data['start_date'])->format('Y-m-d');
            $data['end_date']         = Carbon::createFromFormat('Y-m-d',  $data['end_date'])->format('Y-m-d');
            $data['created_by']       = auth()->user()->creatorId();
            $data['ticket_flight_status']  =  $data['ticket_flight_status'] ?? null ;
            unset($data['type']);
            Leave::create($data);
            $notificationData = [
                'user_id' => auth()->user()->id,
                'type' => 'request_leave',
                'title' => 'New leave request',
                'title_ar' => 'طلب اجازة جديد',
                'body' => 'Employee , ' . auth()->user()->employee->name . ' requests new leave for ' . $data['total_leave_days'] . ' days start from ' . $data['start_date'] . ' and ends in ' . $data['end_date'] ,
                'body_ar' => '  قام الموظف ' . auth()->user()->employee->name_ar . ' بطلب اجازة جديد لمدة' . $data['total_leave_days']  . '   ايام حيث تبدا من  ' . $data['start_date'] . ' وتنتهي في ' . $data['end_date'] ,
                'created_by' => auth()->user()->employee->created_by,
                'for_admin' => 1,
                'redirect_url' => route('leaves.index'),
            ];
            store_notification($notificationData);
            return $this->success([] , 'success');
    }


}
