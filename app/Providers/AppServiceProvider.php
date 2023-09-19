<?php

namespace App\Providers;


use App\Models\Deposit;
use App\Models\Employee;
use App\Models\User;
use App\Models\Expense;
use App\Models\Department;
use App\Models\Announcement;
use App\Models\Meeting;
use App\Models\Event;
use App\Models\PaySlip;
use App\Models\Notification;
use App\Models\AttendanceEmployee;
use App\Models\AttendanceMovement;
use App\Models\AllowanceOption;
use App\Models\EmployeeContracts;
use App\Models\Companyslate;
use App\Models\Salary_setting;
use App\Models\Utility;
use Illuminate\Support\Facades\Response;
use Schema;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::enableForeignKeyConstraints();

        //compose all the views....
        view()->composer('*', function ($view)
        {
            if(\Auth::check())
            {
                $currentLang  = app()->getLocale();
                view()->share('currentLang',$currentLang);
                $lang         = $currentLang == 'ar' ? '_ar' : '';
                $depts        = array();
                $empcount     = array();
                $companyEmployeesCount = array();
                $departments  = Department::get();
                foreach($departments as $key => $dept)
                {
                    array_push($depts,
                        $dept['name'.$lang]
                    );

                    array_push($empcount,
                        Employee::where('department_id',$dept->id)->count()
                    );
                }

                $depts    = json_encode($depts);
                $empcount = json_encode($empcount);
                view()->share('depts', $depts);
                view()->share('empcount', $empcount);
                view()->share('lang', $lang);

                $companies = User::where('type','company')->get();
                foreach($companies as $company){
                    array_push($companyEmployeesCount,
                    Employee::where('created_by', $company->id)->count()
                    );
                }

                $companies    = json_encode($companies->pluck('name'));
                $companyEmployeesCount = json_encode($companyEmployeesCount);

                view()->share('companies', $companies);
                view()->share('companyEmployeesCount', $companyEmployeesCount);


                // $expenseCount = $incomeCount = 0;
                // for($i = 0; $i < 6; $i++)
                // {
                //     $month = date('m', strtotime("-$i month"));
                //     $year  = date('Y', strtotime("-$i month"));

                //     $depositFilter = Deposit::whereMonth('date', $month)->whereYear('date', $year)->get();

                //     $depositTotal = 0;
                //     foreach($depositFilter as $deposit)
                //     {
                //         $depositTotal += $deposit->amount;
                //     }

                //     $incomeData[] = $depositTotal;
                //     $incomeCount  += $depositTotal;


                //     $expenseFilter = Expense::whereMonth('date', $month)->whereYear('date', $year)->get();
                //     $expenseTotal  = 0;
                //     foreach($expenseFilter as $expense)
                //     {
                //         $expenseTotal += $expense->amount;
                //     }
                //     $expenseData[] = $expenseTotal;
                //     $expenseCount  += $expenseTotal;
                // }

                // $pieChartData = [$expenseCount == 0 ? 1 : $expenseCount,$incomeCount == 0 ? 1 : $incomeCount];
                // view()->share('pieChartData', $pieChartData);

                $today = date('Y-m-d');
                $month = date('m');

                $Announcements = Announcement::where('created_by', auth()->user()->creatorId())
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)->get();
                view()->share('Announcements', $Announcements);

                $meetings = Meeting::where('created_by', auth()->user()->creatorId())
                ->whereDate('date', $today)->get();
                view()->share('meetings', $meetings);

                $events = Event::where('created_by', auth()->user()->creatorId())
                ->whereDate('start_date', '<=', $today)
                ->whereDate('end_date', '>=', $today)->get();
                view()->share('events', $events);

                $salarysetting = Salary_setting::where('created_by',auth()->user()->creatorId())->first();
                view()->share('salarysetting', $salarysetting);

                // timesheet
                $attendanceEmployee = AttendanceEmployee::where('date', $today)->where('status','Present')->pluck('employee_id')->toArray();
                $totalemployees     = Employee::where('is_active',1)->get();

                $joinedEmployees   = Employee::whereMonth('Join_date_gregorian', $month)->count();
                $offboardEmployees = EmployeeContracts::whereMonth('contract_enddate', $month)->count();

                view()->share('attendanceEmployee', $attendanceEmployee);
                view()->share('totalemployees', $totalemployees);
                view()->share('joinedEmployees', $joinedEmployees);
                view()->share('offboardEmployees', $offboardEmployees);

                $myNotifications = Notification::where('user_id',auth()->user()->id)->where('read',0)->get();
                view()->share('myNotifications', $myNotifications);

                $companyslate = Companyslate::where('created_by',auth()->user()->creatorId())->first();
                view()->share('companyslate', $companyslate);

                $settings = Utility::settings();
                view()->share('settings', $settings);

            }
        });

        $this->macroApiResponse();
    }

    /**
     * @return void
     */
    public function macroApiResponse(): void
    {
        Response::macro("success", function (array $extra = []) {
            return response()->json(array_merge([
                'status' => 'success',
            ], $extra), 200);
        });

        Response::macro("fail", function (array $extra = [], int $code = 400) {
            return response()->json(array_merge([
                'status' => 'fail',
            ], $extra), $code);
        });
    }
}
