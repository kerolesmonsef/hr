<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ValidateBreak;
use App\Http\Requests\Api\ValidateStartBreak;
use App\Http\Resources\BreakResource;
use App\Models\CompanyBreak;
use App\Models\EmployeeBreak;
use App\Traits\ApiResponser;
use Carbon\Carbon;

class CompanyBreaks extends Controller
{
    use ApiResponser;
    public function index()
    {
        $breaks = CompanyBreak::where('created_by' , auth()->user()->creatorId())->get();
        return $this->success( BreakResource::collection($breaks) ,'breaks' );
    }
    
    public function check_status(){
        $employee_break = EmployeeBreak::where(['employee_id' =>  auth()->user()->employee->id])->whereNull('end_time')->whereDate('created_at', Carbon::today())->first();
        if($employee_break != null){
            return $this->success(new BreakResource($employee_break));
        }
        return $this->success([]);
    }

    public function start_break(ValidateBreak $request){
        $data              = $request->validated();
        $break             = CompanyBreak::findorfail($data['break_id']);
        $time_now          = Carbon::parse(Carbon::now()->format('Y/m/d h:i a'));
        $start_break_time  = Carbon::createFromFormat('h:i a' , $break->start_time);
        $end_break_time    = Carbon::createFromFormat('h:i a' , $break->end_time);
        $employee_break    = EmployeeBreak::where(['employee_id' =>  auth()->user()->employee->id, 'break_id'  => $data['break_id'] ])->whereDate('created_at', Carbon::today())->first();
        $companySetting    = company_setting()->toArray(request());

        $ipaddess     = $companySetting['ip_address'] ? json_decode($companySetting['ip_address']) : [];
        $ipaddess_new = [];
        foreach($ipaddess as $ip){
            array_push($ipaddess_new,substr($ip->value,0,-3));
        }
        $bssid    = substr($request->header('ip'),0,-3);
        if($ipaddess && !in_array($bssid , $ipaddess_new))
        {
            return $this->error(__('messages.connectwithcompanyrouter'), 200);
        }
        if($time_now->gte($start_break_time) && $time_now->lt( $end_break_time) && $employee_break == null){
            //break_trarted successfully
            EmployeeBreak::create([
                'employee_id' => auth()->user()->employee->id,
                'break_id' => $data['break_id'],
                'start_time' => Carbon::now()->format('h:i a'),
                'created_by' => auth()->user()->creatorId(),
            ]);
            return $this->success([] , __('Break started'));
        }
        return $this->error(__('You cant start your break time now !') , 422);
    }
    public function end_break(ValidateBreak $request){
        $data = $request->validated();
        $break = CompanyBreak::findorfail($data['break_id']);
        $time_now = Carbon::parse(Carbon::now()->format('Y/m/d h:i a'));
        $start_break_time = Carbon::createFromFormat('h:i a' , $break->start_time);
        $end_break_time = Carbon::createFromFormat('h:i a' , $break->end_time);
        $companySetting    = company_setting()->toArray(request());

        $ipaddess     = $companySetting['ip_address'] ? json_decode($companySetting['ip_address']) : [];
        $ipaddess_new = [];

        foreach($ipaddess as $ip){
            array_push($ipaddess_new,substr($ip->value,0,-3));
        }

        $bssid    = substr($request->header('ip'),0,-3);

        if($ipaddess && !in_array($bssid , $ipaddess_new))
        {
            return $this->error(__('messages.connectwithcompanyrouter'), 200);
        }

        //break_trarted successfully
        $employee_break = EmployeeBreak::where(['employee_id' =>  auth()->user()->employee->id, 'break_id'  => $data['break_id'] ])->whereNull('end_time')->whereDate('created_at', Carbon::today())->first();
        if(!$employee_break){
            return $this->error(__('You cant end your break time now !') , 422);
        }
        $employee_break->update([
            'end_time' => Carbon::now()->format('h:i a'),
        ]);
        return $this->success([] , __('Break ended') );
    }
}
