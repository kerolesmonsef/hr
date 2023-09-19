<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Api\StoreAttendance;
use App\Http\Requests\Api\StoreAttendanceClockIn;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\HolidayResource;
use App\Http\Resources\ManagerAttendanceResource as ResourcesManagerAttendanceResource;
use App\Http\Resources\ManagerHolidayResource;
use App\Mail\sendemail;
use App\Models\Absence;
use App\Models\AttendanceEmployee;
use App\Models\AttendanceMovement;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Mission;
use App\Models\Salary_setting;
use App\Models\Utility;
use App\Models\WorkFromHomeRequest;
use App\Traits\ApiResponser;
use Carbon\carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Validator;

class AttandanceController extends BaseController
{
    use ApiResponser;

    // public function delete_attendance(){
    //     $row = AttendanceEmployee::where('employee_id' , 96)  -> whereDate('created_at' , date('Y-m-d')) -> latest()->first();
    //     if($row){
    //         $row -> delete();
    //     }
    //     return $this->success([] , 'success');
    // }

    public function index(Request $request)
    {
        $currentAttendanceMovement = AttendanceMovement::whereNull('status')->first();
        $attendance = AttendanceResource::collection(AttendanceEmployee::where('employee_id', auth()->user()->employee->id)->orderBy('id', 'desc')->limit(30)->get())->toArray(request());
        $holidays   = HolidayResource::collection(Holiday::where('created_by', auth()->user()->company->id)->orderBy('id', 'desc')->limit(30)->get())->toArray(request());
        $absences   = Absence::where('employee_id', auth()->user()->employee->id)->orderBy('id', 'desc')->limit(30)->get();

        $absenceArr = [];
        $type = $status = '';
        foreach ($absences as $absence) {
            for ($i = 0; $i < $absence->number_of_days; $i++) {
                if ($absence->type == 'V') {
                    $status = 4;
                    $type   = 'vacation';
                } elseif ($absence->type == "A") {
                    $status = 1;
                    $type   = 'absent';
                } elseif ($absence->type == "X") {
                    $status = 2;
                    $type   = 'xabsent';
                } elseif ($absence->type == "S") {
                    $status = 3;
                    $type   = 'sick';
                }

                array_push($absenceArr, [
                    'date'            => Carbon::parse($absence->start_date)->addDay($i)->format('Y-m-d'),
                    'activity_status' => $status,
                    'title'           => $type,
                    'time_in'         => null,
                    'time_out'        => null,
                    'description'     => null,
                ]);
            }
        }

        $response  = array_merge($attendance, $absenceArr, $holidays);
        array_multisort(array_column($response, 'date'), SORT_DESC, $response);

        if ($request->date) {
            $response = array_filter(
                $response,
                function ($obj) use ($request) {
                    return $obj['date'] === $request->date;
                }
            );
            array_multisort(array_column($response, 'date'), SORT_DESC, $response);
        }

        return $this->success($response, '');
    }

    public function index2(Request $request)
    {
        $currentAttendanceMovement = AttendanceMovement::whereNull('status')->first();
        $attendance = ResourcesManagerAttendanceResource::collection(AttendanceEmployee::orderBy('id', 'desc')->limit(30)->get())->toArray(request());
        $holidays   = ManagerHolidayResource::collection(Holiday::where('created_by', auth()->user()->company->id)->orderBy('id', 'desc')->limit(30)->get())->toArray(request());
        $absences   = Absence::orderBy('id', 'desc')->limit(30)->get();

        $absenceArr = [];
        $type = $status = '';
        foreach ($absences as $absence) {
            for ($i = 0; $i < $absence->number_of_days; $i++) {
                if ($absence->type == 'V') {
                    $status = 4;
                    $type   = 'vacation';
                } elseif ($absence->type == "A") {
                    $status = 1;
                    $type   = 'absent';
                } elseif ($absence->type == "X") {
                    $status = 2;
                    $type   = 'xabsent';
                } elseif ($absence->type == "S") {
                    $status = 3;
                    $type   = 'sick';
                }

                array_push($absenceArr, [
                    'employee'        => $absence->employee ? $absence->employee->name : 'N/A',
                    'date'            => Carbon::parse($absence->start_date)->addDay($i)->format('Y-m-d'),
                    'activity_status' => $status,
                    'title'           => $type,
                    'time_in'         => null,
                    'time_out'        => null,
                    'description'     => null,
                ]);
            }
        }

        $response  = array_merge($attendance, $absenceArr, $holidays);
        array_multisort(array_column($response, 'date'), SORT_DESC, $response);

        if($request->date) {
            $response = array_filter(
                $response,
                function ($obj) use ($request) {
                    return $obj['date'] === $request->date;
                }
            );
            array_multisort(array_column($response, 'date'), SORT_DESC, $response);
        }

        return $this->success($response, '');
    }

    public function newindex(Request $request)
    {
        $absenceArr = [];
        $dates      = [];
        $weekendArr = [];
        $type       = '';
        $status     = 0;
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $salarysetting      = Salary_setting::first();
        $weekVacationArr    = explode(',', $salarysetting->week_vacations ?? '');
        if ($attendancemovement) {
            $carbonday      = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('d');
            $carbonmonth    = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('m');
            $carbonyear     = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('Y');
            $begin_of_month = now()->setDay($carbonday)->setMonth($carbonmonth)->setYear($carbonyear);
            $end_of_month   = $begin_of_month->clone()->addMonthNoOverflow()->subDay();

            for ($i = $begin_of_month; $i <= ($end_of_month); $i->addDay()) {
                $dates[] = $i->format('Y') . '-' . $i->format('m') . '-' . $i->format('d');
            }
        }

        $attendances = AttendanceEmployee::where('employee_id', auth()->user()->employee->id)->orderBy('id', 'desc')->whereIn('date', $dates)->pluck('date')->toArray();
        $holidays    = Holiday::where('created_by', auth()->user()->company->id)->whereIn('date', $dates)->orderBy('id', 'desc')->pluck('date')->toArray();
        $absences    = Absence::where('employee_id', auth()->user()->employee->id)
            ->where(function ($q) use ($dates) {
                $q->whereIn("start_date", $dates)->orWhereIn("end_date", $dates);
            })->get();

        $dates       = collect($dates)->map(function ($date) use ($type, $status, $attendances, $holidays, $absences) {
            $date = '2022-08-28';
            $absence = $absences->whereDate('start_date', '<=', $date)->whereDate('end_date', '>=', $date);
            if (\in_array($date, $attendances)) {
                $status = 0;
                $type   = 'Attend';
            } elseif (\in_array($date, $holidays)) {
                $status = 5;
                $type   = 'Holiday';
            } elseif ($absence) {
                for ($i = 0; $i < $absence->number_of_days; $i++) {
                    if ($absence->type == 'V') {
                        $status = 4;
                        $type   = 'vacation';
                    } elseif ($absence->type == "A") {
                        $status = 1;
                        $type   = 'absent with permission';
                    } elseif ($absence->type == "X") {
                        $status = 2;
                        $type   = 'absent with no permission';
                    } elseif ($absence->type == "S") {
                        $status = 3;
                        $type   = 'sick';
                    }
                }
            }
            return [
                'date'            => $date,
                "activity_status" => $status,
                'title'           => $type,
                'time_in'         => null,
                'time_out'        => null,
                'description'     => null,
            ];
        });

        return $this->success($dates, '');
    }

    public function indexx(Request $request)
    {
        $absenceArr = [];
        $dates      = [];
        $weekendArr = [];
        $type = $status = '';
        $attendancemovement = AttendanceMovement::whereNull('status')->first();
        $salarysetting      = Salary_setting::first();
        $weekVacationArr    = explode(',', $salarysetting->week_vacations ?? '');
        if ($attendancemovement) {
            $carbonday            = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('d');
            $carbonmonth          = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('m');
            $carbonyear           = \Carbon\Carbon::parse($attendancemovement->start_movement_date)->format('Y');

            $begin_of_month = now()->setDay($carbonday)->setMonth($carbonmonth)->setYear($carbonyear);
            $end_of_month   = $begin_of_month->clone()->addMonthNoOverflow()->subDay();

            for ($i = $begin_of_month; $i <= ($end_of_month); $i->addDay()) {
                $dates[] = $i->format('Y') . '-' . $i->format('m') . '-' . $i->format('d');
            }
        }
        $attendance = AttendanceResource::collection(AttendanceEmployee::where('employee_id', auth()->user()->employee->id)->orderBy('id', 'desc')->whereIn('date', $dates)->get())->toArray(request());
        $holidays   = HolidayResource::collection(Holiday::where('created_by', auth()->user()->company->id)->orderBy('id', 'desc')->limit(30)->get())->toArray(request());

        $abs = Absence::where("emp")
            ->where(function ($q) use ($dates) {
                $q->whereIn("startDate", $dates)->orWhereIn("endDates", $dates);
            })->get();

        collect($dates)->map(function ($date_i, $abs) {
            return [
                'date' => $date_i,
                "activity_status" => $abs->where("start_date", $date_i)->orWhere("end_date", $date_i)->first() != null,
            ];
        });

        foreach ($dates as $date) {
            $dt                 = Carbon::parse($date)->format('l');
            if (\in_array($dt, $weekVacationArr)) {
                array_push($weekendArr, [
                    'date'            => Carbon::parse($date)->format('Y-m-d'),
                    'activity_status' => 6,
                    'title'           => 'Weekend',
                    'time_in'         => null,
                    'time_out'        => null,
                    'description'     => null,
                ]);
            }

            $absences   = Absence::where('employee_id', auth()->user()->employee->id)
                ->whereDate('start_date', '<=', $date)
                ->whereDate('end_date', '>=', $date)
                ->orderBy('id', 'desc')->first();

            foreach ($absences as $absence) {
                for ($i = 0; $i < $absence->number_of_days; $i++) {
                    if ($absence->type == 'V') {
                        $status = 4;
                        $type   = 'vacation';
                    } elseif ($absence->type == "A") {
                        $status = 1;
                        $type   = 'absent with permission';
                    } elseif ($absence->type == "X") {
                        $status = 2;
                        $type   = 'absent with no permission';
                    } elseif ($absence->type == "S") {
                        $status = 3;
                        $type   = 'sick';
                    }

                    array_push($absenceArr, [
                        'date'            => Carbon::parse($absence->start_date)->addDay($i)->format('Y-m-d'),
                        'activity_status' => $status,
                        'title'           => $type,
                        'time_in'         => null,
                        'time_out'        => null,
                        'description'     => null,
                    ]);
                }
            }
        }

        $response  = array_merge($attendance, $absenceArr, $holidays, $weekendArr);
        array_multisort(array_column($response, 'date'), SORT_DESC, $response);

        if ($request->date) {
            $response = array_filter(
                $response,
                function ($obj) use ($request) {
                    return $obj['date'] === $request->date;
                }
            );
            array_multisort(array_column($response, 'date'), SORT_DESC, $response);
        }

        return $this->success($response, '');
    }

    public function start_work(StoreAttendanceClockIn $request)
    {

        $employee  = Employee::with('finger_print_locations')->where('user_id', auth()->id())->first();
        if ($employee->haveAttendanceToday()) {
            return $this->error(__('messages.youStartWorkBefore'), 200);
        }

        $companySetting     = company_setting()->toArray(request());
        $hour_now = Carbon::now()->format('H:i');
        $start_from         = Carbon::parse($companySetting['start_time'])->subMinutes($companySetting['grace_period_before'])->format('H:i');
        $start_to           = Carbon::parse($companySetting['start_time'])->addMinutes($companySetting['grace_period'])->format('H:i');
        if($hour_now <  $start_from){
            return $this->error(__('You cant start work before '.  $start_from ), 200);
        }
        if($hour_now >  $start_to && !$request -> delay_reason){
            return $this->error(__('delay_reason field is required ' ), 200);
        }

        //start logic
        $locaion_status = 1;
        $router_status = 0;
        $locations = $employee -> finger_print_locations;
        if($locaion_status == 1){
            $work_from_home_request = WorkFromHomeRequest::where([
                'employee_id'=>$employee -> id ,
                'date'=>Carbon::now()->format('Y-m-d')
            ])->first();

            $mission = Mission::where([
                'employee_id'=>$employee -> id ,
                'date'=>Carbon::now()->format('Y-m-d')
            ])->first();

            if( $employee -> fingerprint_out_campany == 1 && count($locations) > 0){
                $bool = false;
                foreach($locations as $location){
                    $distance = get_distance_between_two_points($location -> lat , $location -> long ,  $request -> lat , $request -> lon);
                    if($distance < 1){
                       $bool = true;
                       break;
                    }
                }
            }else{
                if( $employee -> skip_start_work_location == 0 ){
                    $distance = get_distance_between_two_points($request -> lat , $request -> lon ,  $companySetting['lat'] , $companySetting['lon']);
                    if($distance >  1 && !$work_from_home_request){
                        return $this->error(__('You are not in the company'), 200);
                    }
                }
            }
        }
        if($router_status == 1){
            //Router settting
                 // if(time() < strtotime($companySetting['start_time'] . " -" . $companySetting['grace_period_before'] . "minutes")) {
                //     return $this->error(__('messages.youAreTooEarly') . date('h:i a', strtotime($companySetting['start_time'])), 200);
                // }

                // if(time() > strtotime($companySetting['start_time'] . " +" . $companySetting['grace_period'] . "minutes")) {
                //     return $this->error(__('messages.youAreTooLate'), 200);
                // }

                // $ipaddess     = $companySetting['ip_address'] ? json_decode($companySetting['ip_address']) : [];
                // $ipaddess_new = [];

                // foreach ($ipaddess as $ip) {
                //     array_push($ipaddess_new, substr($ip->value, 0, -3));
                // }

                // $bssid    = substr($request->header('ip'), 0, -3);
                // if ($ipaddess && !in_array($bssid, $ipaddess_new)) {
                //     return $this->error(__('messages.connectwithcompanyrouter'), 200);
                // }
        }





        $company_grace_period   = Utility::getValByName('company_grace_period');
        $startTime              = \Carbon\Carbon::parse(Utility::getValByName('company_start_time'))->addMinutes($company_grace_period);
        $in                     = date("H:i:s", strtotime(date('H:i:s')));


        if (strtotime($in) > strtotime($startTime)) {
            $totalLateSeconds = strtotime($in) - strtotime($startTime);
            $hours  = floor($totalLateSeconds / 3600);
            $mins   = floor($totalLateSeconds / 60 % 60);
            $secs   = floor($totalLateSeconds % 60);
            $late1  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        } else {
            $late1 = "00:00:00";
        }
        $newattandance = AttendanceEmployee::create([
            'employee_id'      => $employee->id,
            'status'           => 'Present',
            'date'             => date('Y-m-d'),
            'clock_in'         => date('H:i:s'),
            'lat'              => $request['lat'],
            'lon'              => $request['lon'],
            'in_company_range' => 1,
            'late'             => $late1,
            'total_rest'       => '00:00:00',
            'delay_reason'     => $request->delay_reason ?? null,
            'created_by'       => auth()->user()->creatorId(),
            'image_clock_in'   => $image,
        ]);
        $data  = app(HomeController::class)->index($request);
        $data->message =  __('messages.startWork');
        return $data;
    }

    public function end_work(StoreAttendanceClockIn $request)
    {
        $employee          = Employee::with('finger_print_locations') -> where('user_id', auth()->id())->first();

        $work_from_home_request = WorkFromHomeRequest::where([
            'employee_id'  => $employee -> id ,
            'date' =>  Carbon::now()->format('Y-m-d')
        ])->first();

        $company_require_face_print = 0;
        $image = null;
        $locations = $employee -> finger_print_locations;

        //image verification
        if($company_require_face_print == 1){

            if( ! $employee -> login_image){
                return $this->error(__('messages.Upload your face image first'), 200);
            }

            //stored image
            try{
                $imagePath1 = storage_path($employee -> login_image);
            }catch(Exception $x){
                return $this->error(__('messages.Image print not found'), 200);
            }
            $image1_64 = base64_encode(file_get_contents($imagePath1));
            //stored image

            //image sent by api
            $image2_64 = base64_encode(file_get_contents($request->file('image')));
            //image sent by api

            $result = compare_image($image1_64, $image2_64);
            if($result == 0){
                return $this->error(__('messages.The face print does not match'), 200);
            }

            $image =  $request->file('image')->store('attendance_face_print');
        }

        //image verification
        $companySetting    = company_setting()->toArray(request());
        $hour_now = Carbon::now()->format('H:i');
        $end_from         = \Carbon\carbon::parse($companySetting['end_time'])->subMinutes($companySetting['grace_period_end_before'])->format('H:i');
        $end_to           = \Carbon\carbon::parse($companySetting['end_time'])->addMinutes($companySetting['grace_period_end_after'])->format('H:i');
        $attendance        = $employee->haveAttendanceToday();

        $endTime           = \Carbon\Carbon::parse(Utility::getValByName('company_end_time'));
        $out               = date("H:i:s", strtotime(date('H:i:s')));

        if(!$attendance){
            return $this->error(__('messages.notStartWorkToday'), 200);
        }

        // if($hour_now <  $end_from && !$request -> urgent_end_reason ){
        //     //early leave
        //     return $this->error(__('urgent_end_reason field is required') , 422);
        // }

        // if($hour_now > $end_to ){
        //     return $this->error(__('You cant end work after '.  $end_to ), 200);
        // }

        if( $employee -> fingerprint_out_campany == 1 && count($locations) > 0){
            $bool = false;
            foreach($locations as $location){
                $distance = get_distance_between_two_points($location -> lat , $location -> long ,  $request -> lat , $request -> lon);
                if($distance < 1 ){
                   $bool = true;
                   break;
                }
            }
        }else{

            if( $employee -> skip_start_work_location == 0){
                $distance = get_distance_between_two_points($request -> lat , $request -> lon ,  $companySetting['lat'] , $companySetting['lon']);
                if($distance >  1 && !$work_from_home_request ){
                    return $this->error(__('You are not in the company'), 200);
                }
            }

            //router setting

             // $ipaddess     = $companySetting['ip_address'] ? json_decode($companySetting['ip_address']) : [];
            // $ipaddess_new = [];

            // foreach ($ipaddess as $ip) {
            //     array_push($ipaddess_new, substr($ip->value, 0, -3));
            // }

            // $bssid    = substr($request->header('ip'), 0, -3);

            // if ($ipaddess && !in_array($bssid, $ipaddess_new)) {
            //     return $this->error(__('messages.connectwithcompanyrouter'), 200);
            // }

        }

        if ($attendance && $attendance->clock_out) {
            return $this->error(__('messages.youEndYourWorkBefore'), 200);
        }

        if (strtotime($out) < strtotime('8:00')) {
            $totalOvertimeSeconds = strtotime('8:00') - strtotime($out);

            $hours                = floor($totalOvertimeSeconds / 3600);
            $mins                 = floor($totalOvertimeSeconds / 60 % 60);
            $secs                 = floor($totalOvertimeSeconds % 60);
            $late2                = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        } else {
            $late2 = "00:00:00";
        }

        $late1 = $attendance ? strtotime($attendance->late) : strtotime("00:00:00");
        $late2 = strtotime($late2);

        $late  = \Carbon\Carbon::parse(($late1 + $late2))->format("H:i:s");

        //early Leaving
        $totalEarlyLeavingSeconds = strtotime($endTime) - strtotime($out);
        $hours                    = floor($totalEarlyLeavingSeconds / 3600);
        $mins                     = floor($totalEarlyLeavingSeconds / 60 % 60);
        $secs                     = floor($totalEarlyLeavingSeconds % 60);
        $earlyLeaving             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

        if ($out > strtotime('8:00')) {
            //Overtime
            $totalOvertimeSeconds = strtotime($out) - strtotime('8:00');
            $hours                = floor($totalOvertimeSeconds / 3600);
            $mins                 = floor($totalOvertimeSeconds / 60 % 60);
            $secs                 = floor($totalOvertimeSeconds % 60);
            $overtime             = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
        } else {
            $overtime = '00:00:00';
        }

        if ($attendance) {
            $attendance->update([
                'clock_out'             => $out,
                'late'                  => $late,
                'early_leaving'         => ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00',
                'overtime'              => $overtime,
                'urgent_end_reason'     => $request->urgent_end_reason ?? null ,
                'image_clock_out'       => $image,
            ]);
        } else {
            $newattandance = AttendanceEmployee::create([
                'employee_id'       => $employee->id,
                'status'            => 'Present',
                'date'              => date('Y-m-d'),
                'clock_in'          => null,
                'clock_out'         => $out,
                'lat'               => $request['lat'],
                'lon'               => $request['lon'],
                'in_company_range'  => 1,
                'late'              => $late1,
                'total_rest'        => '00:00:00',
                'delay_reason'      => $request->delay_reason,
                'early_leaving'     => ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00',
                'overtime'          => $overtime,
                'urgent_end_reason' => $request->urgent_end_reason ?? null ,
                'created_by'        => auth()->user()->creatorId(),
                'image_clock_out' => $image,
            ]);
        }

        $data  = app(HomeController::class)->index($request);
        $data->message =  __('messages.startWork');
        return $data;
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
