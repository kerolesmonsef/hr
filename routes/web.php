<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\API\V1\NotificationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CompanyBreaksController;
use App\Http\Controllers\CompanyStructureController;
use App\Http\Controllers\DucumentUploadController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePermissionController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\JobOffer;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\JobOfferUserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanRequestController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\OtherPaymentController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OverTimeRequestController;
use App\Http\Controllers\PaySlipController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaturationDeductionController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\TerminateRequestController;
use App\Http\Controllers\VacanciesController;
use App\Http\Controllers\WorkFromHomeRequestController;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Salary_setting;
use App\Models\User;
use App\Models\Utility;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

route::get('testr', function(){
    dd(auth()->user()->creatorId());
});

route::get('change-leaves-date', function(){
   $leaves = Leave::get();
   foreach($leaves as $leave){
        $applied_on = Carbon::parse($leave->applied_on)->format('Y-m-d');
        $start_date = Carbon::parse($leave->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($leave->end_date)->format('Y-m-d');
        $leave->update([
            'start_date' =>  $start_date,
            'end_date' => $end_date,
            'applied_on' => $applied_on
        ]);
   }
   dd('success');

});
route::get('test-cron-end-work', function () {
    // /dd(Carbon::now() -> format('H:i a'));
    // $companies = User::where('type' , 'company')->get();
    // foreach($companies as $company){
    //     $setting = Utility::settings( $company -> id);
    //     //4:30   => 5:30 start sending notifications
    //     $end_time = Carbon::createFromFormat('H:i' , $setting['company_end_time'])->addMinutes(30);  //output => 05:30
    //     $start_time = Carbon::createFromFormat('H:i' , $setting['company_end_time'])->subMinutes(30);
    //     info($start_time);
    //     info($end_time);

    //     $salary_setting = Salary_setting::where('created_by' , $company -> id)->first();
    //     if(isset($salary_setting['week_vacations'])){
    //         $week_vacations = explode(',' ,  $salary_setting['week_vacations'] );
    //     }else{
    //         $week_vacations = [];
    //     }
    //     $holiday  = Holiday::where( 'created_by', '=', $company -> id )
    //                 ->where('date', date('Y-m-d'))
    //                 ->first();

    //     if( !in_array(Carbon::now()->format('l') , $week_vacations) &&  $holiday == null && Carbon::now()->gte($start_time) &&  Carbon::now()->lt($end_time)){

    //         $attend_today_employees = AttendanceEmployee::where(['created_by'  =>  $company -> id , 'clock_out' => null ])->whereDate('created_at' , date('Y-m-d'))
    //                                                     ->pluck('employee_id')
    //                                                     ->toarray();

    //         $not_attend_today = Employee::where(['created_by'  =>  $company -> id , 'is_active' => 1  ])
    //                                     ->whereIn('id' , $attend_today_employees)
    //                                     ->pluck('user_id')
    //                                     ->toarray();

    //         $not_attend_fcm_tokens = User::whereIn('id' , $not_attend_today )
    //                                     ->where('fcm_token' ,'!=', null)
    //                                     ->pluck('fcm_token')
    //                                     ->toarray();

    //         $result = pushNotification( __('End work') , __('We remind you to end work') .' '  .$setting['company_end_time'] , null ,  $not_attend_fcm_tokens);

    //     }
    // }
    // info('finished succeed');
    //send employee to end work
});

route::get('/test-cron-start-work', function () {
    $companies = User::where('type', 'company')->get();
    foreach ($companies as $company) {
        $setting = Utility::settings($company->id);
        $end_time = Carbon::createFromFormat('H:i', $setting['company_start_time'])->addMinutes(60);
        $start_time =  Carbon::createFromFormat('H:i', $setting['company_start_time']);
        info($start_time);
        info($end_time);
        $salary_setting = Salary_setting::where('created_by', $company->id)->first();
        if (isset($salary_setting['week_vacations'])) {
            $week_vacations = explode(',',  $salary_setting['week_vacations']);
        } else {
            $week_vacations = [];
        }
        $holiday  = Holiday::where('created_by', '=', $company->id)
            ->where('date', date('Y-m-d'))
            ->first();

        if (!in_array(Carbon::now()->format('l'), $week_vacations) &&  $holiday == null && Carbon::now()->gte($start_time) &&  Carbon::now()->lt($end_time)) {

            $attend_today_employees = AttendanceEmployee::where(['created_by'  =>  $company->id, 'clock_out' => null])->whereDate('created_at', date('Y-m-d'))
                ->pluck('employee_id')
                ->toarray();

            $not_attend_today = Employee::where(['created_by'  =>  $company->id, 'is_active' => 1])
                ->whereIn('id', $attend_today_employees)
                ->pluck('user_id')
                ->toarray();

            $not_attend_fcm_tokens = User::whereIn('id', $not_attend_today)
                ->where('fcm_token', '!=', null)
                ->pluck('fcm_token')
                ->toarray();

            $result = pushNotification(__('End work'), __('We remind you to start work') . ' '  . $setting['company_start_time'], null,  $not_attend_fcm_tokens);
        }
    }
    info('finished start work cron succeed');
});

Route::get('notify', function () {
    $token = "fOObyHIzz05hoKIWkf_mP2:APA91bEUBav5KrNlWSVYsdSROUxLygAI8c2JUtSYGcpe8yTTXoO19JMduf8vcEpAszc8beaCE83ZVHUWP1OLRsUYYK6SiClq3cUAe4XkLbFNNBOkWzdeKbzBojU6a0k6p5nDpbHvxlJw";
    $result = pushNotification('test', 'fdfd ', null, [$token]);
    dd($result);
});


Route::get('/', function () {
    return redirect('/login');
});

Route::get('convert-image', function () {
    compare_image(null, null);
});


Route::post('/employee-check-in', [EmployeeController::class, 'employee_check_in'])->name('employee-check-in');
Route::post('/employee-check-out', [EmployeeController::class, 'employee_check_out'])->name('employee-check-out');

Route::get('/companyStructures', [CompanyStructureController::class, 'companyStructure'])->name('companyStructureList');



Route::get('not-attend-employees', function () {

    $setting = Utility::settings(auth()->user()->creatorId());
    $start_time = Carbon::createFromFormat('H:i', $setting['company_start_time']);
    $end_time = Carbon::createFromFormat('H:i', $setting['company_end_time']);


    $salary_setting = Salary_setting::first();
    $week_vacations = explode(',',  $salary_setting->week_vacations);

    $holiday  = Holiday::where('date', date('Y-m-d'))->first();

    if (!in_array(Carbon::now()->format('l'), $week_vacations) &&  $holiday == null && Carbon::now()->gte($start_time) &&  Carbon::now()->lt($end_time)) {
        $attend_today_employees = AttendanceEmployee::whereDate('created_at', date('Y-m-d'))->pluck('employee_id')->toarray();
        $not_attend_today = Employee::where(['created_by'  =>  auth()->user()->creatorId(), 'is_active' => 1])->whereNotIn('id', $attend_today_employees)->pluck('user_id')->toarray();
        $not_attend_fcm_tokens = User::whereIn('id', $not_attend_today)->where('fcm_token', '!=', null)->pluck('fcm_token')->toarray();
        dd($not_attend_fcm_tokens);
    }
})->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/linkstorage', function () {
    $targetFolder = base_path() . '/storage/uploads';
    $linkFolder   = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
    return 'storage linked successfully';
});

Route::get('/optimize_clear', function () {
    $clearcache = Artisan::call('optimize:clear');
    echo "Cache cleared<br>";
});

Route::get('/timezone', function () {
    return company_setting()['timezone'] . '  - time : ' . date('H:i');
})->middleware(
    [
        'auth',
        'XSS',
    ]
)->name('timezone');

require __DIR__ . '/auth.php';

Route::get('/check', 'HomeController@check')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('/password/resets/{lang?}', 'Auth\LoginController@showLinkRequestForm')->name('change.langPass');

Route::get('/', 'HomeController@index')->name('home')->middleware(['XSS','auth']);
Route::get('/home', 'HomeController@index')->middleware(['XSS']);
Route::get('/about', 'HomeController@about')->name('about')->middleware(['XSS']);
Route::get('/solutions', 'HomeController@solutions')->name('solutions')->middleware(['XSS']);
Route::get('/pricing', 'HomeController@pricing')->name('pricing')->middleware(['XSS']);

//Route::get('/home', 'HomeController@index')->name('home')->middleware(
//    [
//        'auth',
//        'XSS',
//    ]
//);


Route::get('vacancies/{id}', [VacanciesController::class, 'show'])->name('vacancies.show');
Route::post('vacancies', [VacanciesController::class, 'store'])->name('vacancies.store');

Route::get('/home/getlanguvage', 'HomeController@getlanguvage')->name('home.getlanguvage');




//  ---------------------------------------------------


Route::view("employees", 'new-theme.employee.index');
Route::view("employees/add", 'new-theme.employee.create');


Route::view("employees/shifts", 'new-theme.employee.shifts.index');
// Route::view("employees/shifts/add", 'new-theme.employee.shifts.add');

// Route::view("employees/attendance", 'new-theme.employee.attendance');

// Route::view("employees/permissions", 'new-theme.employee.permissions.index');
// Route::view("employees/permissions/add", 'new-theme.employee.permissions.create');


// Route::view("employees/vacations", 'new-theme.employee.vacations.index');


Route::view("payrolls", 'new-theme.payroll.index');
Route::view("payrolls/details", 'new-theme.payroll.details');

Route::view("payrolls/allowance/add", 'new-theme.payrolls.allowance.add');
Route::view("payrolls/commission/add", 'new-theme.payrolls.commission.add');
Route::view("payrolls/commission/add", 'new-theme.payrolls.commission.add');
Route::view("payrolls/loan/add", 'new-theme.payrolls.loan.add');
Route::view("payrolls/saturation/add", 'new-theme.payrolls.saturation.add');
Route::view("payrolls/overtime/add", 'new-theme.payrolls.overtime.add');
Route::view("payrolls/absences/add", 'new-theme.payrolls.absences.add');

//badr
Route::view("performance-indicator/add", 'new-theme.settings.performance-s.add');
//badr




// 12 mar
Route::view("employees/vacations/add", 'new-theme.employee.vacations.create');

Route::view("employees/personal", 'new-theme.employee.employee.personal');




Route::view("employees/loan", 'new-theme.employee.loan.index');
Route::view("employees/loan/add", 'new-theme.employee.loan.add');



// Route::view("assets/index", 'new-theme.assets.index');
// Route::view("assets/add", 'new-theme.assets.add');


Route::view("reports/index", 'new-theme.reports.index');
Route::view("reports/vacations", 'new-theme.reports.vacations');
Route::view("reports/emails", 'new-theme.reports.emails');
Route::view("reports/payroll", 'new-theme.reports.payroll');



// 14 mar

Route::view("document-ibrary/index", 'new-theme.document-ibrary.index');
Route::view("document-ibrary/add", 'new-theme.document-ibrary.add');

// Route::view("meetings/index", 'new-theme.meetings.meetings.index');
// Route::view("meetings/add", 'new-theme.meetings.meetings.create');


// Route::view("meetings/events/index", 'new-theme.meetings.events.index');
// Route::view("meetings/events/create", 'new-theme.meetings.events.create');

// 15 mar

Route::view("employees/deduction", 'new-theme.employee.deduction.index');
Route::view("employees/deduction/add", 'new-theme.employee.deduction.add');




Route::view("structure-list", 'new-theme.structure-list.index');

//

// Route::view("settings/roles", 'new-theme.settings.roles.index');
// Route::view("settings/roles/add", 'new-theme.settings.roles.add');

// 16 mar
Route::view("settings/branch", 'new-theme.settings.branch.index');
Route::view("settings/attendance", 'new-theme.settings.attendance.index');
Route::view("settings/performance", 'new-theme.settings.performance.index');
Route::view("settings/salary", 'new-theme.settings.salary.index');
Route::view("settings/insurance-companies", 'new-theme.settings.insurance-companies.indinsurance-companiesex');


Route::post('create_evaluation', "HomeController@evaluation_test")->name('create.submit');

Route::view("employees/evaluations", 'new-theme.employee.evaluations.index');
Route::view("employees/evaluations/add", 'new-theme.employee.evaluations.create');
Route::view("employees/evaluations/view", 'new-theme.employee.evaluations.view');
Route::view("employees/evaluations/performance-add", 'new-theme.employee.evaluations.performance-add');


//

// Route::view("tasks/index", 'new-theme.tasks.index');
//Route::view("tasks/grid", 'new-theme.tasks.grid');

// Route::view("tasks/create", 'new-theme.tasks.create');

//


Route::view("offers/index", 'new-theme.offers.index');
Route::view("offers/add", 'new-theme.offers.create');

Route::view("news/index", 'new-theme.news.index');
Route::view("news/add", 'new-theme.news.create');

// 29 mar
Route::view("requests/work-remotely", 'new-theme.requests.work-remotely.index');
Route::view("requests/work-remotely/create", 'new-theme.requests.work-remotely.create');

Route::view("requests/missions", 'new-theme.requests.missions.index');
Route::view("requests/missions/create", 'new-theme.requests.missions.create');

//Route::view("requests/overtime", 'new-theme.requests.overtime.index');
Route::view("requests/overtime/create", 'new-theme.requests.overtime.create');

//--settings
Route::view("settings/contract-templates", 'new-theme.settings.contract-templates.index');
Route::view("settings/contract-templates/create", 'new-theme.settings.contract-templates.create');

//-----------------------------------------------------
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::resource('settings', 'SettingsController');
        Route::post('email-settings', 'SettingsController@saveEmailSettings')->name('email.settings');
        Route::post('company-settings', 'SettingsController@saveCompanySettings')->name('company.settings');
        Route::post('payment-settings', 'SettingsController@savePaymentSettings')->name('payment.settings');
        Route::post('system-settings', 'SettingsController@saveSystemSettings')->name('system.settings');
        Route::get('company-setting', 'SettingsController@companyIndex')->name('company.setting');
        Route::get('company-email-setting/{name}', 'SettingsController@updateEmailStatus')->name('company.email.setting');
        Route::post('pusher-settings', 'SettingsController@savePusherSettings')->name('pusher.settings');
        Route::post('business-setting', 'SettingsController@saveBusinessSettings')->name('business.setting');

        Route::post('zoom-settings', 'SettingsController@zoomSetting')->name('zoom.settings');

        Route::get('test-mail', 'SettingsController@testMail')->name('test.mail');
        Route::post('test-mail', 'SettingsController@testSendMail')->name('test.send.mail');

        Route::get('create/ip', 'SettingsController@createIp')->name('create.ip');
        Route::post('create/ip', 'SettingsController@storeIp')->name('store.ip');
        Route::get('edit/ip/{id}', 'SettingsController@editIp')->name('edit.ip');
        Route::post('edit/ip/{id}', 'SettingsController@updateIp')->name('update.ip');
        Route::delete('destroy/ip/{id}', 'SettingsController@destroyIp')->name('destroy.ip');
    }
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {

        Route::get('/orders', 'StripePaymentController@index')->name('order.index');
        Route::get('/stripe/{code}', 'StripePaymentController@stripe')->name('stripe');
        Route::get('/stripe_request/{code}', 'StripePaymentController@stripe_request')->name('stripe_request');
        Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post');
    }
);

Route::get(
    '/test',
    [
        'as' => 'test.email',
        'uses' => 'SettingsController@testEmail',
    ]
)->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('/test/send', ['as' => 'test.email.send', 'uses' => 'SettingsController@testEmailSend',])->middleware(['auth', 'XSS',]);
// End

Route::get('job-offers/export', [JobOfferController::class, 'export'])->name('job-offers.export');
Route::get('job-offers/print', [JobOfferController::class, 'print'])->name('job-offers.print');
Route::resource('job-offers', 'JobOfferController')->middleware(['auth', 'XSS',]);
Route::get("job-offer-user/{user_id}",[JobOfferUserController::class,'show'])->name("job-offer-user.show");
Route::put("job-offer-user/{user_id}",[JobOfferUserController::class,'update'])->name("job-offer-user.update");

Route::resource('question', 'QuestionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('question_category', 'QuestionCategoryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('performance/export', [PerformanceController::class, 'export'])->name('performance.export');
Route::get('performance/print', [PerformanceController::class, 'print'])->name('performance.print');

Route::get('breaks/{employee_id}/export', [CompanyBreaksController::class, 'export'])->name('breaks.export');
Route::get('breaks/{employee_id}/print', [CompanyBreaksController::class, 'print'])->name('breaks.print');

Route::get('employeevacations/export', [EmployeeController::class, 'vacation_export'])->name('vacation.export');


Route::get("evaluation/export",[EvaluationController::class,'export'])->name("evaluation.export");
Route::get("evaluation/print",[EvaluationController::class,'print'])->name("evaluation.print");
Route::resource('evaluation', 'EvaluationController')->middleware(['auth', 'XSS',]);
Route::resource('performance', 'PerformanceController')->middleware(['auth', 'XSS',]);



Route::get('performance_create_ajax','PerformanceController@create_ajax')->name('performance.create_ajax')->middleware(['auth','XSS']);

Route::post('submit-evaluation-answers', [EvaluationController::class, 'submit_evaluation_answers'])->name('submit-evaluation-answers');
Route::get('evaluation/hr/{id}', [EvaluationController::class, 'hr_evaluation_form'])->name('hr_evaluation_form');
Route::get('evaluation/technical/{id}', [EvaluationController::class, 'technical_evaluation_form'])->name('technical_evaluation_form');
Route::get('evaluation/overall/{id}', [EvaluationController::class, 'overall_evaluation_form'])->name('overall_evaluation_form');


Route::post('employee/json', 'EmployeeController@json')->name('employee.json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('branch/employee/json', 'EmployeeController@employeeJson')->name('branch.employee.json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('employee-profile', 'EmployeeController@profile')->name('employee.profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('show-employee-profile/{id}', 'EmployeeController@profileShow')->name('show.employee.profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::get('show-employee-tracking/{id}/{date}', 'EmployeeController@showtracking')->name('show.employee.tracking')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('lastlogin', 'EmployeeController@lastLogin')->name('lastlogin')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('employee/export', [EmployeeController::class, 'export'])->name('employee.export');

Route::resource('employee', 'EmployeeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('employee-finger-print', 'EmployeeFingerPrintController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('employee/update_fingerprint_location', [EmployeeController::class, 'update_fingerprint_location'])->name('update_fingerprint_location');
Route::resource('company-breaks', 'CompanyBreaksController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('emlpoyee/terminate/{employee}', [EmployeeController::class, 'terminate'])->name('terminate_employee');
Route::get('emlpoyee/terminate/contract/reciept', [EmployeeController::class, 'leaves_termination_reciept'])->name('leaves_terminate_employee');
Route::get('emlpoyee/terminate/leaves/reciept', [EmployeeController::class, 'leaves_termination_reciept'])->name('contract_terminate_employee');



Route::resource('notifications', 'NotificationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('notifications', [NotificationController::class, 'read_notifications'])->name('read-notifications');





Route::resource('designation', 'DesignationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);




Route::resource('place', 'PlaceController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('companystructure', 'CompanyStructureController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('assign_employee', 'CompanyStructureController@assign')->name('companystructure.assign')->middleware(['XSS']);

Route::get('companytree/{id}', 'CompanyStructureController@index2')->name('companytree')->middleware(['XSS']);

Route::resource('jobtitle', 'JobtitleController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('category', 'CategoryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('labor_companies', 'LaborCountryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('workunits', 'WorkUnitController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('employee-shifts/export', [ShiftController::class, 'export'])->name('employee-shifts.export');
Route::get('employee-shifts/print', [ShiftController::class, 'print'])->name('employee-shifts.print');

Route::resource('employee-shifts', 'ShiftController')->middleware(['auth', 'XSS',]);
Route::prefix("employees")->group(function (){
    Route::resource('attendance', 'AttendanceController')->middleware(['auth', 'XSS',]);
    Route::resource('saturationdeduction', 'SaturationDeductionController')->middleware(['auth', 'XSS']);
});



Route::resource('jobtypes', 'JobtypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('banks', 'BankController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('request_types', 'RequestTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('offers', 'OfferController')->middleware(['auth', 'XSS']);
Route::resource('news', 'NewsController')->middleware(['auth', 'XSS']);
Route::group(['prefix' => 'settings-s'], function () {
    Route::resource('user', 'UserController')->middleware(['auth','XSS',]);
    Route::resource('insurance-companies', 'InsuranceCompanyController')->middleware(['auth' , 'XSS']);
    Route::resource('branch', 'BranchController')->middleware(['auth', 'XSS']);
    Route::resource('department', 'DepartmentController')->middleware(['auth','XSS',]);
    Route::resource('salary_setting', 'SallerySettingController')->middleware(['auth', 'XSS']);
    Route::resource('paysliptype', 'PayslipTypeController')->middleware(['auth', 'XSS']);
    Route::resource('leavetype', 'LeaveTypeController')->middleware(['auth','XSS',]);
    Route::resource('allowanceoption', 'AllowanceOptionController')->middleware(['auth', 'XSS']);
    Route::resource('awardtype', 'AwardTypeController')->middleware(['auth', 'XSS',]);
    Route::resource('deductionoption', 'DeductionOptionController')->middleware(['auth', 'XSS']);
    Route::resource('loanoption', 'LoanOptionController')->middleware(['auth', 'XSS',]);
    Route::resource('paymenttype', 'PaymentTypeController')->middleware(['auth', 'XSS',]);
    
    Route::resource('payroll_setting', 'PayrollSettingController')->middleware(['auth', 'XSS',]);
    Route::resource('contract-templates', 'ContractTemplatesController')->middleware(['auth', 'XSS',]);
    Route::get('contract-templates/{id}/print', "ContractTemplatesController@print")->name("contract-templates.print");

    Route::resource('roles', 'RoleController')->middleware( [ 'auth', 'XSS', ] );
    Route::resource('s-attendance', 'SettingAttendanceController')->middleware( [ 'auth', 'XSS', ] );
    Route::resource('assets-types', 'AssetsTypeController')->middleware(['auth','XSS',]);
    Route::resource('PerformanceFactor', 'PerformanceFactorController')->middleware(['auth','XSS',]);
    Route::resource('PerformancePeriod', 'PerformancePeriodController')->middleware(['auth','XSS',]);
    Route::resource('document', 'DocumentController')->middleware(['auth','XSS',]);
});

/*employee permissions*/
Route::get('employee-permissions/approve/{employee_permission}', [EmployeePermissionController::class, 'approve'])->name('employee-permissions.approve');
Route::any('employee-permissions/reject/{employee_permission}', [EmployeePermissionController::class, 'reject'])->name('employee-permissions.reject');
Route::get('employee-permissions/export', [EmployeePermissionController::class, 'export'])->name('employee_permissions.export');
Route::get('employee-permissions/print', [EmployeePermissionController::class, 'print'])->name('employee_permissions.print');

Route::get('work-from-home/export', [WorkFromHomeRequestController::class, 'export'])->name('work-from-home.export');
Route::get('work-from-home/print', [WorkFromHomeRequestController::class, 'print'])->name('work-from-home.print');
Route::match(['get','post'],'work-from-home/approve/{id}', [WorkFromHomeRequestController::class, 'approve'])->name('work-from-home.approve');
Route::match(['get','post'],'work-from-home/reject/{id}', [WorkFromHomeRequestController::class, 'reject'])->name('work-from-home.reject');

Route::get('mission/approve/{id}', [MissionController::class, 'approve'])->name('mission.approve');
Route::get('mission/reject/{id}', [MissionController::class, 'reject'])->name('mission.reject');

Route::get('over-time/accept/{id}', [OverTimeRequestController::class, 'approve'])->name('over-time.accept');
Route::any('over-time/reject/{id}', [OverTimeRequestController::class, 'reject'])->name('over-time.reject');
Route::get('over-time/export', [OverTimeRequestController::class, 'export'])->name('over-time.export');
Route::get('over-time/print', [OverTimeRequestController::class, 'print'])->name('over-time.print');
Route::get("mission/export",[MissionController::class,'export']) ->name('mission.export');
Route::get("mission/print",[MissionController::class,'print']) ->name('mission.print');

Route::prefix('requests')->group(function (){
    Route::resource('employee-permissions', 'EmployeePermissionController')->middleware(['auth', 'XSS']);
    Route::resource('loan-requests', 'LoanRequestController')->middleware(['auth', 'XSS']);
    Route::resource('vacations', 'LeavesController')->middleware(['auth', 'XSS']);
    Route::resource('work-from-home', 'WorkFromHomeRequestController')->middleware(['auth','XSS',]);
    Route::resource('mission', 'MissionController')->middleware(['auth','XSS',]);

    Route::resource('over-time','OverTimeRequestController')->middleware(['auth','XSS',]);
});
/*employee permissions*/


Route::resource('salary_component_type', 'SalaryComponentTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('attendancemovement', 'AttendanceMovementController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('nationality', 'NationalityController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('Holiday_type', 'HolidayTypesController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('award', 'AwardController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('termination', 'TerminationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('terminationtype', 'TerminationTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('announcement/getdepartment', 'AnnouncementController@getdepartment')->name('announcement.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('announcement/getemployee', 'AnnouncementController@getemployee')->name('announcement.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('announcement', 'AnnouncementController')->middleware(
    [
        'auth',
        'XSS',
    ]
);




Route::get('holiday/calender', 'HolidayController@calender')->name('holiday.calender')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('holiday', 'HolidayController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('employee/salary/{eid}', 'SetSalaryController@employeeBasicSalary')->name('employee.basic.salary')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('allowances/create/{eid}', 'AllowanceController@allowanceCreate')->name('allowances.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('commissions/create/{eid}', 'CommissionController@commissionCreate')->name('commissions.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('loans/create/{eid}', 'LoanController@loanCreate')->name('loans.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('saturationdeductions/create/{eid}', 'SaturationDeductionController@saturationdeductionCreate')->name('saturationdeductions.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('otherpayments/create/{eid}', 'OtherPaymentController@otherpaymentCreate')->name('otherpayments.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('overtimes/create/{eid}', 'OvertimeController@overtimeCreate')->name('overtimes.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('overtimes/calculate_rate', 'OvertimeController@calculateOvertime')->name('overtimes.calculateOvertime')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('saturationdeductions/calculate_deduction_percent', 'SaturationDeductionController@calculate_deduction_percent')->name('saturationdeductions.calculate_deduction_percent')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('absences/create/{eid}', 'AbsenceController@absenceCreate')->name('absences.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);



//payslip



Route::get('allowance/export/{id}', [AllowanceController::class, 'export'])->name('allowance.export');

Route::resource('allowance', 'AllowanceController')->middleware(['auth', 'XSS']);

Route::get('commission/export/{id}', [CommissionController::class, 'export'])->name('commission.export');

Route::resource('commission', 'CommissionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('loan/export/{id}', [LoanController::class, 'export'])->name('loan.export');

Route::resource('loan', 'LoanController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::match(['get','post'],'loan-requests/approve/{id}', [LoanRequestController::class, 'approve'])->name('loan-requests.approve');
Route::match(['get','post'],'loan-requests/reject/{id}', [LoanRequestController::class, 'reject'])->name('loan-requests.reject');
Route::get('loan-requests/export', [LoanRequestController::class, 'export'])->name('loan-requests.export');
Route::get('loan-requests/print', [LoanRequestController::class, 'print'])->name('loan-requests.print');

Route::post('loan-requests/{loan_request}/approve', [LoanRequestController::class, 'approve'])->name('loan_requests.approve');
Route::any('loan-requests/{loan_request}/reject', [LoanRequestController::class, 'reject'])->name('loan_requests.reject');

Route::POST('/get-monthly-loan', [LoanController::class, 'get_monthly_loan'])->middleware(
    [
        'auth',
        'XSS',
    ]
)->name('loan.get_monthly_loan');

Route::POST('/all-loans/{status}', [LoanController::class, 'all_loans'])->middleware(
    [
        'auth',
        'XSS',
    ]
)->name('loan.all_loans');

Route::get('saturationdeduction/export/{id}', [SaturationDeductionController::class, 'export'])->name('saturationdeduction.export');

Route::get('deduction/export', [SaturationDeductionController::class, 'deduction_export'])->name('deduction.export');


Route::get('otherpayment/export/{id}', [OtherPaymentController::class, 'export'])->name('otherpayment.export');

Route::resource('otherpayment', 'OtherPaymentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('overtime/export/{id}', [OvertimeController::class, 'export'])->name('overtime.export');

Route::resource('overtime', 'OvertimeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('absence/export/{id}', [AbsenceController::class, 'export'])->name('absence.export');

Route::resource('absence', 'AbsenceController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('vehicle', 'VehicleController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('followers', 'FollowerController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('qualifications', 'QualificationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('contracts', 'ContractController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('event/getdepartment', 'EventController@getdepartment')->name('event.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('event/getemployee', 'EventController@getemployee')->name('event.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('event', 'EventController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('shifts', 'ShiftsController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('tasks/grid', 'TaskController@kanban')->middleware(
    [
        'auth',
        'XSS',
    ]
)->name('get.tasks.grid');

Route::resource('tasks', 'TaskController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('import/event/file', 'EventController@importFile')->name('event.file.import');
Route::post('import/event', 'EventController@import')->name('event.import');
Route::get('export/event', 'EventController@export')->name('event.export');
Route::get('print/event', 'EventController@print')->name('event.print');

Route::post('meeting/getdepartment', 'MeetingController@getdepartment')->name('meeting.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('meeting/getemployee', 'MeetingController@getemployee')->name('meeting.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('meeting/export','MeetingController@export')->name('meeting.export');
Route::get('meeting/print','MeetingController@print')->name('meeting.print');
Route::resource('meeting', 'MeetingController')->middleware(
    [
        'auth',
        'XSS',
    ]
)->except(['edit','update','show']);

Route::post('employee/update/sallary/{id}', 'SetSalaryController@employeeUpdateSalary')->name('employee.salary.update')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('salary/employeeSalary', 'SetSalaryController@employeeSalary')->name('employeesalary')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('setsalary', 'SetSalaryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);




Route::get('payslip/paysalary/{id}/{date}', 'PaySlipController@paysalary')->name('payslip.paysalary')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/bulk_pay_create/{date}', 'PaySlipController@bulk_pay_create')->name('payslip.bulk_pay_create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('payslip/bulkpayment/{date}', 'PaySlipController@bulkpayment')->name('payslip.bulkpayment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('payslip/search_json', 'PaySlipController@search_json')->name('payslip.search_json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/employeepayslip', 'PaySlipController@employeepayslip')->name('payslip.employeepayslip')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/showemployee/{id}', 'PaySlipController@showemployee')->name('payslip.showemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/editemployee/{id}', 'PaySlipController@editemployee')->name('payslip.editemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('payslip/editemployee/{id}', 'PaySlipController@updateEmployee')->name('payslip.updateemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/pdf/{id}/{m}', 'PaySlipController@pdf')->name('payslip.pdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/Payrollpdf/{m}/{y}/{type}', 'PaySlipController@Payrollpdf')->name('payslip.Payrollpdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/Payrollbarpdf/{m}/{y}/{type}', 'PaySlipController@Payrollbarpdf')->name('payslip.Payrollbarpdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/employeePayrollbarpdf/{id}/{m}/{y}', 'PaySlipController@employeePayrollbarpdf')->name('payslip.employeePayrollbarpdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/exportExcel/{m}/{y}', 'PaySlipController@exportExcel')->name('payslip.exportExcel')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/payslipPdf/{id}', 'PaySlipController@payslipPdf')->name('payslip.payslipPdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/send/{id}/{m}', 'PaySlipController@send')->name('payslip.send')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/delete/{id}', 'PaySlipController@destroy')->name('payslip.delete')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payroll/export/{m}/{y}', [PaySlipController::class, 'export'])->name('payroll.export');

Route::resource('payslip', 'PaySlipController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('resignation', 'ResignationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('travel', 'TravelController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('promotion', 'PromotionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('transfer', 'TransferController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('complaint', 'ComplaintController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('warning', 'WarningController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('profile', 'UserController@profile')->name('profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('setting', 'UserController@account_setting')->name('account_setting')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('edit-profile', 'UserController@editprofile')->name('update.account')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('accountlist', 'AccountListController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('accountbalance', 'AccountListController@account_balance')->name('accountbalance')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('leave/{id}/action', 'LeaveController@action')->name('leave.action')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('leave/changeaction', 'LeaveController@changeaction')->name('leave.changeaction')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('leave/jsoncount', 'LeaveController@jsoncount')->name('leave.jsoncount')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('leave', 'LeaveController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::any('vacations/approve/{id}', [LeavesController::class, 'approve'])->name('vacations.approve');
Route::any('vacations/reject/{id}', [LeavesController::class, 'reject'])->name('vacations.reject');
Route::get('vacations/export', [LeavesController::class, 'export'])->name('vacations.export');
Route::get('vacations/print', [LeavesController::class, 'print'])->name('vacations.print');




Route::get('employee_requests/{id}/action', 'EmployeeRequestController@action')->name('employee_requests.action')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('employee_requests/changeaction', 'EmployeeRequestController@changeaction')->name('employee_requests.changeaction')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('employee_requests/jsoncount', 'EmployeeRequestController@jsoncount')->name('employee_requests.jsoncount')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('employee_requests', 'EmployeeRequestController')->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::get('ticket/{id}/reply', 'TicketController@reply')->name('ticket.reply')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('ticket/changereply', 'TicketController@changereply')->name('ticket.changereply')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('ticket', 'TicketController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('attendanceemployee/bulkattendance', 'AttendanceEmployeeController@bulkAttendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('attendanceemployee/bulkattendance', 'AttendanceEmployeeController@bulkAttendanceData')->name('attendanceemployee.bulkattendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('attendanceemployee/addnote/{id}', 'AttendanceEmployeeController@add_note')->name('attendanceemployee.add_note')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('attendanceemployee/attendance', 'AttendanceEmployeeController@attendance')->name('attendanceemployee.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('attendanceemployee', 'AttendanceEmployeeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('attendance/export', [AttendanceController::class, 'export'])->name('attendance.export');
Route::get('attendance/print', [AttendanceController::class, 'print'])->name('attendance.print');

Route::resource('timesheet', 'TimeSheetController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('expensetype', 'ExpenseTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('incometype', 'IncomeTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('payees', 'PayeesController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('payer', 'PayerController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('deposit', 'DepositController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('expense', 'ExpenseController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('transferbalance', 'TransferBalanceController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ],
    function () {
        Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
        Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
        Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
        Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');
        Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy');
    }
);
Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language');
Route::get("change-language", "LanguageController@changeLanquage")->name("change.language_")->middleware("auth");

Route::resource('permissions', 'PermissionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('user/{id}/plan', 'UserController@upgradePlan')->name('plan.upgrade')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('user/{id}/plan/{pid}', 'UserController@activePlan')->name('plan.active')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('plans', 'PlanController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('/plan_request/{code}', 'PlanController@plan_request')->name('plan_request')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('plan_requests', 'PlanRequestController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('/plan_requests/update/{id}', 'PlanRequestController@update')->name('plan_request.update')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('change-password', 'UserController@updatePassword')->name('update.password')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('coupons', 'CouponController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('account-assets', 'AssetController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('document-upload', 'DucumentUploadController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('company-documents', 'CompanyDucumentUploadController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('library/export', [LibraryController::class, 'export'])->name('library.export');
Route::resource('library', 'LibraryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('document-upload/employee/report', [DucumentUploadController::class, 'report'])->name('document-upload.report');
Route::get('document-upload-image/delete/{documentuploadimage}', [DucumentUploadController::class, 'delete_image'])->name('document-upload-image.delete');



Route::resource('company-document-upload', 'CompanyDucumentUploadController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('indicator', 'IndicatorController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('appraisal', 'AppraisalController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('goaltype', 'GoalTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('goaltracking', 'GoalTrackingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('company-policy', 'CompanyPolicyController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('trainingtype', 'TrainingTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('trainer', 'TrainerController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('training/status', 'TrainingController@updateStatus')->name('training.status')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('training', 'TrainingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('plan-pay-with-paypal', 'PaypalController@planPayWithPaypal')->name('plan.pay.with.paypal')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('{id}/plan-get-payment-status', 'PaypalController@planGetPaymentStatus')->name('plan.get.payment.status')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get(
    '/apply-coupon',
    [
        'as' => 'apply.coupon',
        'uses' => 'CouponController@applyCoupon',
    ]
)->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('report/payroll/export/{format_date}', [ReportController::class, 'payroll_export'])->name('payrollreport.export');
Route::get('report/email/export', [ReportController::class, 'email_export'])->name('emailreport.export');
Route::get('report/vacation/export', [ReportController::class, 'vacation_export'])->name('vacationreport.export');
Route::get('report/attendance/export/{format_date}', [ReportController::class, 'attendance_export'])->name('attendancereport.export');
Route::get('report/attendance/print/{format_date}', [ReportController::class, 'print'])->name('attendancereport.print');

Route::group(['middleware' => ['auth', 'XSS'], 'prefix' => 'report'], function () {
    Route::get('/employee-with-emails', [ReportController::class, 'employee_with_emails'])->name('report.employee_with_emails');
    Route::get('/employee-with-salaries', [ReportController::class, 'employee_with_salaries'])->name('report.employee_with_salaries');
    Route::get('/employee-with-leaves', [ReportController::class, 'employee_with_leaves'])->name('report.employee_with_leaves');
});


Route::get('report/income-expense', 'ReportController@incomeVsExpense')->name('report.income-expense')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/leave', 'ReportController@leave')->name('report.leave')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('employee/{id}/leave/{status}/{type}/{month}/{year}', 'ReportController@employeeLeave')->name('report.employee.leave')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/account-statement', 'ReportController@accountStatement')->name('report.account.statement')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/payroll', 'ReportController@payroll')->name('report.payroll')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/monthly/attendance', 'ReportController@monthlyAttendance')->name('report.monthly.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('report/attendance/{month}/{branch}/{department}', 'ReportController@exportCsv')->name('report.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('report/timesheet', 'ReportController@timesheet')->name('report.timesheet')->middleware(
    [
        'auth',
        'XSS',
    ]
);


//------------------------------------  Recurtment --------------------------------

Route::resource('job-category', 'JobCategoryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('job-stage', 'JobStageController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-stage/order', 'JobStageController@order')->name('job.stage.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('job', 'JobController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('career/{id}/{lang}', 'JobController@career')->name('career');
Route::get('job/requirement/{code}/{lang}', 'JobController@jobRequirement')->name('job.requirement');
Route::get('job/apply/{code}/{lang}', 'JobController@jobApply')->name('job.apply');
Route::post('job/apply/data/{code}', 'JobController@jobApplyData')->name('job.apply.data');


Route::get('job-application/candidate', 'JobApplicationController@candidate')->name('job.application.candidate')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('job-application', 'JobApplicationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('job-application/order', 'JobApplicationController@order')->name('job.application.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/{id}/rating', 'JobApplicationController@rating')->name('job.application.rating')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-application/{id}/archive', 'JobApplicationController@archive')->name('job.application.archive')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('job-application/{id}/skill/store', 'JobApplicationController@addSkill')->name('job.application.skill.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/{id}/note/store', 'JobApplicationController@addNote')->name('job.application.note.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-application/{id}/note/destroy', 'JobApplicationController@destroyNote')->name('job.application.note.destroy')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/getByJob', 'JobApplicationController@getByJob')->name('get.job.application')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('job-onboard', 'JobApplicationController@jobOnBoard')->name('job.on.board')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('job-onboard/create/{id}', 'JobApplicationController@jobBoardCreate')->name('job.on.board.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/store/{id}', 'JobApplicationController@jobBoardStore')->name('job.on.board.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('job-onboard/edit/{id}', 'JobApplicationController@jobBoardEdit')->name('job.on.board.edit')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/update/{id}', 'JobApplicationController@jobBoardUpdate')->name('job.on.board.update')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-onboard/delete/{id}', 'JobApplicationController@jobBoardDelete')->name('job.on.board.delete')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('job-onboard/convert/{id}', 'JobApplicationController@jobBoardConvert')->name('job.on.board.convert')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/convert/{id}', 'JobApplicationController@jobBoardConvertData')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::post('job-application/stage/change', 'JobApplicationController@stageChange')->name('job.application.stage.change')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('custom-question', 'CustomQuestionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('interview-schedule', 'InterviewScheduleController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('interview-schedule/create/{id?}', 'InterviewScheduleController@create')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('follower/create/{eid}', 'FollowerController@FollowerCreate')->name('followers.add')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('qualifications/create/{eid}', 'QualificationController@qualificationcreate')->name('qualifications.add')->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::get('contract/create/{eid}', 'ContractController@contractCreate')->name('contracts.add')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('probation_periods/{id}', 'EmployeeController@addprobation_periods')->name('probation_periods.add')->middleware(
    [
        'auth',
        'XSS',
    ]
);


//================================= Custom Landing Page ====================================//

Route::get('/landingpage', 'LandingPageSectionController@index')->name('custom_landing_page.index')->middleware(['auth', 'XSS']);
Route::get('/LandingPage/show/{id}', 'LandingPageSectionController@show');
Route::post('/LandingPage/setConetent', 'LandingPageSectionController@setConetent')->middleware(['auth', 'XSS']);
Route::get('/get_landing_page_section/{name}', function ($name) {
    $plans = DB::table('plans')->get();

    return view('custom_landing_page.' . $name, compact('plans'));
});
Route::post('/LandingPage/removeSection/{id}', 'LandingPageSectionController@removeSection')->middleware(['auth', 'XSS']);
Route::post('/LandingPage/setOrder', 'LandingPageSectionController@setOrder')->middleware(['auth', 'XSS']);
Route::post('/LandingPage/copySection', 'LandingPageSectionController@copySection')->middleware(['auth', 'XSS']);


//================================= Payment Gateways  ====================================//

Route::post('/plan-pay-with-paystack', ['as' => 'plan.pay.with.paystack', 'uses' => 'PaystackPaymentController@planPayWithPaystack'])->middleware(['auth', 'XSS']);
Route::get('/plan/paystack/{pay_id}/{plan_id}', ['as' => 'plan.paystack', 'uses' => 'PaystackPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-flaterwave', ['as' => 'plan.pay.with.flaterwave', 'uses' => 'FlutterwavePaymentController@planPayWithFlutterwave'])->middleware(['auth', 'XSS']);
Route::get('/plan/flaterwave/{txref}/{plan_id}', ['as' => 'plan.flaterwave', 'uses' => 'FlutterwavePaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-razorpay', ['as' => 'plan.pay.with.razorpay', 'uses' => 'RazorpayPaymentController@planPayWithRazorpay'])->middleware(['auth', 'XSS']);
Route::get('/plan/razorpay/{txref}/{plan_id}', ['as' => 'plan.razorpay', 'uses' => 'RazorpayPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-paytm', ['as' => 'plan.pay.with.paytm', 'uses' => 'PaytmPaymentController@planPayWithPaytm'])->middleware(['auth', 'XSS']);
Route::post('/plan/paytm/{plan}', ['as' => 'plan.paytm', 'uses' => 'PaytmPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mercado', ['as' => 'plan.pay.with.mercado', 'uses' => 'MercadoPaymentController@planPayWithMercado'])->middleware(['auth', 'XSS']);
Route::post('/plan/mercado', ['as' => 'plan.mercado', 'uses' => 'MercadoPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mollie', ['as' => 'plan.pay.with.mollie', 'uses' => 'MolliePaymentController@planPayWithMollie'])->middleware(['auth', 'XSS']);
Route::get('/plan/mollie/{plan}', ['as' => 'plan.mollie', 'uses' => 'MolliePaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-skrill', ['as' => 'plan.pay.with.skrill', 'uses' => 'SkrillPaymentController@planPayWithSkrill'])->middleware(['auth', 'XSS']);
Route::get('/plan/skrill/{plan}', ['as' => 'plan.skrill', 'uses' => 'SkrillPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-coingate', ['as' => 'plan.pay.with.coingate', 'uses' => 'CoingatePaymentController@planPayWithCoingate'])->middleware(['auth', 'XSS']);
Route::get('/plan/coingate/{plan}', ['as' => 'plan.coingate', 'uses' => 'CoingatePaymentController@getPaymentStatus']);


Route::resource('competencies', 'CompetenciesController')->middleware(
    [
        'auth',
        'XSS',
    ]
)->except(['create', 'edit']);

Route::resource('performanceType', 'PerformanceTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('terminate-request', 'TerminateRequestController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('terminate-request/get-leave-information', [TerminateRequestController::class, 'get_leave_information'])->middleware(
    [
        'auth',
        'XSS',
    ]
)->name('terminate-request.get_leave_information');
//employee Import & Export
Route::get('import/employee/file', 'EmployeeController@importFile')->name('employee.file.import');
Route::post('import/employee', 'EmployeeController@import')->name('employee.import');
Route::get('export/employee', 'EmployeeController@export')->name('employee.export');
Route::get('employee/{employee}/edit/financial', 'EmployeeController@editFinancial')->name('employee.editFinancial');
Route::get('employee/{employee}/edit/documents', 'EmployeeController@editDocuments')->name('employee.editDocuments');

Route::put('employee/{employee}/update/documents', 'EmployeeController@updateDocuments')->name('employee.updateDocuments');

Route::get('employee/{employee}/edit/breaks', 'EmployeeController@breaks')->name('employee.breaks');
Route::get('employee/{employee}/edit/assets', 'EmployeeController@assets')->name('employee.assets');
Route::get('employee/{employee}/edit/vacations', 'EmployeeController@vacations')->name('employee.vacations');
Route::get('employee/{employee}/edit/attendance', 'EmployeeController@attendance')->name('employee.attendance');
Route::get('employee/{employee}/edit/contract', 'EmployeeController@contract')->name('employee.contract');
Route::get('employee/{employee}/print_contract', 'EmployeeController@print_contract')->name('employee.print_contract');



// Timesheet Import & Export

Route::get('import/timesheet/file', 'TimeSheetController@importFile')->name('timesheet.file.import');
Route::post('import/timesheet', 'TimeSheetController@import')->name('timesheet.import');
Route::get('export/timesheet', 'TimeSheetController@export')->name('timesheet.export');


// Attendance Import

Route::get('import/attendance/file', 'ReportController@importFile')->name('attendance.file.import');
Route::post('import/attendance', 'ReportController@importMonthlyAttendance')->name('attendance.import');

//leave export
Route::get('export/leave', 'LeaveController@export')->name('leave.export');

//deposite Export
Route::get('export/deposite', 'DepositController@export')->name('deposite.export');

//expense Export
Route::get('export/expense', 'ExpenseController@export')->name('expense.export');

//Transfer Balance Export
Route::get('export/transfer-balance', 'TransferBalanceController@export')->name('transfer_balance.export');

//Training Import & Export
Route::get('export/training', 'TrainingController@export')->name('training.export');

//Trainer Export
Route::get('export/trainer', 'TrainerController@export')->name('trainer.export');
Route::get('import/training/file', 'TrainerController@importFile')->name('trainer.file.import');
Route::post('import/training', 'TrainerController@import')->name('trainer.import');

//Holiday Export & Import
Route::get('export/holidays', 'HolidayController@export')->name('holidays.export');
Route::get('import/holidays/file', 'HolidayController@importFile')->name('holidays.file.import');
Route::post('import/holidays', 'HolidayController@import')->name('holidays.import');

//Asset Import & Export
Route::get('export/assets', 'AssetController@export')->name('assets.export');
Route::get('import/assets/file', 'AssetController@importFile')->name('assets.file.import');
Route::post('import/assets', 'AssetController@import')->name('assets.import');

//zoom meeting
Route::any('zoommeeting/calendar', 'ZoomMeetingController@calender')->name('zoom_meeting.calender')->middleware(['auth', 'XSS']);
Route::resource('zoom-meeting', 'ZoomMeetingController')->middleware(['auth', 'XSS']);

//slack
Route::post('setting/slack', 'SettingsController@slack')->name('slack.setting');

//telegram
Route::post('setting/telegram', 'SettingsController@telegram')->name('telegram.setting');

//Company Slate
Route::post('setting/slate', 'SettingsController@companyslate')->name('slate.setting');
Route::post('user/companyslateAccept', 'SettingsController@companyslateAccept')->name('companyslate.accept');

//twilio
Route::post('setting/twilio', 'SettingsController@twilio')->name('twilio.setting');

// recaptcha
Route::post('/recaptcha-settings', ['as' => 'recaptcha.settings.store', 'uses' => 'SettingsController@recaptchaSettingStore'])->middleware(['auth', 'XSS']);

Route::get("/g/job-offers",[JobOfferController::class,'guest_index'])->name("job-offer.guest.index");
Route::get("g/job-offers/{code}",[JobOfferController::class,'guest_show'])->name("job-offer.guest.show");
Route::post("g/job-offers/{code}",[JobOfferController::class,'guest_answer'])->name("job-offer.guest.answer");
