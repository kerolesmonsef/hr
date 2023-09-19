<?php

namespace App\Console\Commands;

use App\Models\AttendanceEmployee;
use App\Models\CompanyBreak;
use App\Models\Employee;
use App\Models\EmployeeBreak;
use App\Models\Holiday;
use App\Models\Salary_setting;
use App\Models\User;
use App\Models\Utility;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderEmployeeEndWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:employeeendwork';
    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // $breaks = CompanyBreak::get();
        // // $companies = User::where('type' , 'company') ->   with('employees') -> get();
        // // info( $companies->employees );
        // foreach($breaks as $break){
        //     $time_now          = Carbon::parse(Carbon::now()->format('Y/m/d h:i a'));
        //     $start_break_time  = Carbon::createFromFormat('h:i a' , $break->start_time);
        //     $end_break_time    = Carbon::createFromFormat('h:i a' , $break->end_time);
        //     if($time_now->gte($start_break_time) && $time_now->lt( $end_break_time) && $time_now->diffInMinutes($end_break_time) <= 5 ){
        //         $employee_ids = EmployeeBreak::where(['break_id'  => $break->id ])->whereNull('end_time')->whereDate('created_at', Carbon::today())->pluck('employee_id')->toArray();
        //         $user_ids = Employee::whereIn('id' , $employee_ids )->pluck('user_id')->toArray();
        //         $fcm_tokens = User::whereIn('id' , $user_ids )->pluck('fcm_token')->toArray();
        //         $result = pushNotification( __('Break reminder') , __('We remind you of the end time of the break') . $break->end_time , null , $fcm_tokens);
        //         info($result);
        //     }
        // }
        //send employee to end work
        $companies = User::where('type' , 'company')->get();
        foreach($companies as $company){
            $setting = Utility::settings( $company -> id);
            //4:30   => 5:30 start sending notifications
            $end_time = Carbon::createFromFormat('H:i' , $setting['company_end_time'])->addMinutes(60);  //output => 05:30
            $start_time = Carbon::createFromFormat('H:i' , $setting['company_end_time']);
            $salary_setting = Salary_setting::where('created_by' , $company -> id)->first();
            if(isset($salary_setting['week_vacations'])){
                $week_vacations = explode(',' ,  $salary_setting['week_vacations'] );
            }else{
                $week_vacations = [];
            }
            $holiday  = Holiday::where( 'created_by', '=', $company -> id )
                        ->where('date', date('Y-m-d'))
                        ->first();

            if( !in_array(Carbon::now()->format('l') , $week_vacations) &&  $holiday == null && Carbon::now()->gte($start_time) &&  Carbon::now()->lt($end_time)){

                $attend_today_employees = AttendanceEmployee::where(['created_by'  =>  $company -> id , 'clock_out' => null ])->whereDate('created_at' , date('Y-m-d'))
                                                            ->pluck('employee_id')
                                                            ->toarray();

                $not_attend_today = Employee::where(['created_by'  =>  $company -> id , 'is_active' => 1  ])
                                            ->whereIn('id' , $attend_today_employees)
                                            ->pluck('user_id')
                                            ->toarray();
                $not_attend_fcm_tokens = User::whereIn('id' , $not_attend_today )
                                            ->where('fcm_token' ,'!=', null)
                                            ->pluck('fcm_token')
                                            ->toarray();
                $result = pushNotification( __('End work') , __('We remind you to end work') .' '  .Carbon::now() -> format('H:i a') , null ,  $not_attend_fcm_tokens);
            }
        }
        info('finished end work cron succeed');
        //send employee to end work
    }
}
