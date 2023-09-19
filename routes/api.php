<?php

use API\TicketController;
use App\Http\Controllers\API\HolidayController;
use App\Http\Controllers\API\RequestTypeController;
use App\Http\Controllers\API\V1\AttandanceController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\CompanyBreaks;
use App\Http\Controllers\API\V1\DocumentController;
use App\Http\Controllers\API\V1\EmployeeController;
use App\Http\Controllers\API\V1\EmployeeLeaveController;
use App\Http\Controllers\API\V1\EmployeePermissionController;
use App\Http\Controllers\API\V1\EvaluationController;
use App\Http\Controllers\API\V1\EventController;
use App\Http\Controllers\API\V1\ForgotPasswordController;
use App\Http\Controllers\API\V1\HomeController;
use App\Http\Controllers\API\V1\LoanController;
use App\Http\Controllers\API\V1\MangerController;
use App\Http\Controllers\API\V1\Manager\LeavesController;
use App\Http\Controllers\API\V1\Manager\LoanController as ManagerLoanController;
use App\Http\Controllers\API\V1\Manager\MissionController;
use App\Http\Controllers\API\V1\Manager\OvertimeController;
use App\Http\Controllers\API\V1\Manager\PermissionController;
use App\Http\Controllers\API\V1\Manager\RequestManagerController;
use App\Http\Controllers\API\V1\Manager\WorkRemotelyController;
use App\Http\Controllers\API\V1\MettingController;
use App\Http\Controllers\API\V1\NotificationController;
use App\Http\Controllers\API\V1\PayrollController;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\RequestController;
use App\Http\Controllers\API\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

route::post('start-work', function (Request $request) {

    //stored image
    $imagePath1 = storage_path('faceprint/aO8cgUUbXbHJCc5AeAl3XAHD9LLUZWZRRPYowuGZ.jpg');
    $image1_64 = base64_encode(file_get_contents($imagePath1));
    //stored image

    //image sent by api
    $image2_64 = base64_encode(file_get_contents($request->file('image')));
    //image sent by api

    // if(isset($data['image'])){
    //     $image =  $request->file('image')->store('faceprint');
    //     $data['image'] = $image;
    // }

    $result = compare_image($image1_64, $image2_64);
    dd($result);

});

Route::middleware('auth:sanctum')->get('v1/user', function (Request $request) {
    return $request->user();
});

// Route::post('/employee_attandance', 'API\AttandanceController@store');
// Route::post('/employee_attandance/{id}', 'API\AttandanceController@update');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'v1/employee'], function () {
    Route::get('test-notification/{token}', function ($token) {
        // $companies = User::where('type' , 'company') ->   with('employees') -> get();
        // $currentDate = date('Y-m-d');
        // foreach( $companies as $company){
        //     $notClockIn    = AttendanceEmployee::where('date', '=', $currentDate)->get()->pluck('employee_id');
        //     $employees_ids = $company->employees()->whereNotIn('id', $notClockIn)->pluck('user_id')->toarray();
        //     $users = User::whereIn('id' , $employees_ids )->pluck('fcm_token')->toarray();
        //     if($company->id == 22)
        //     {
        //         return response($users);
        //     }
        // }
        // return response( $companies );
        $result = pushNotification('test title', 'test notification', null, [$token]);
        dd($result);
    });
    // Route::post('login', [AuthController::class, 'login']);

    //route::get('delete-attendance' , [AttandanceController::class , 'delete_attendance']);

    Route::post('forgetpassword', [ForgotPasswordController::class, 'forgetpassword']);
    Route::post('activcode', [ForgotPasswordController::class, 'activcode']);
    Route::post('rechangepass', [ForgotPasswordController::class, 'rechangepass']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('profile', [ProfileController::class, 'index']);
        Route::put('profile/update', [ProfileController::class, 'update']);
        Route::post('update_picture', [ProfileController::class, 'update_picture']);
        Route::post('upload_face_print', [ProfileController::class, 'upload_face_print']);
        Route::post('reset_password', [ProfileController::class, 'reset']);
        Route::get('personal', [ProfileController::class, 'personal_data']);
        Route::get('financial', [ProfileController::class, 'financial_data']);
        Route::get('assets', [ProfileController::class, 'assets']);
        Route::get('organization', [ProfileController::class, 'organization_data']);
        Route::get('analytics', [ProfileController::class, 'analytics_data']);
        Route::get('home', [HomeController::class, 'index']);

        Route::get('news', "\App\Http\Controllers\API\V1\NewsController");

        Route::get('offers_categories', "\App\Http\Controllers\API\V1\OfferCategoryController");
        Route::get('offers', "\App\Http\Controllers\API\V1\OffersController");

        Route::post('read-slate', [HomeController::class, 'readslate']);
        Route::get('attendance', [AttandanceController::class, 'index']);
        Route::post('start_work', [AttandanceController::class, 'start_work']);
        Route::post('end_work', [AttandanceController::class, 'end_work']);
        Route::get('meetings', [MettingController::class, 'index']);
        Route::get('meetings/accept/{id}', [MettingController::class, 'accept']);
        Route::post('meetings/reject/{id}', [MettingController::class, 'reject']);

        Route::get('events', [EventController::class, 'index']);
        Route::get('note_event', [EventController::class, 'noted']);
        Route::get('financial', [ProfileController::class, 'financial_data']);
        Route::get('organization', [ProfileController::class, 'organization_data']);
        Route::get('analytics', [ProfileController::class, 'analytics_data']);
        Route::get('home', [HomeController::class, 'index']);
        Route::post('read-slate', [HomeController::class, 'readslate']);
        Route::get('attendance', [AttandanceController::class, 'index']);
        Route::post('start_work', [AttandanceController::class, 'start_work']);
        Route::post('end_work', [AttandanceController::class, 'end_work']);
        Route::get('meetings', [MettingController::class, 'index']);
        Route::get('events', [EventController::class, 'index']);
        Route::get('events/join/{id}', [EventController::class, 'join']);
        Route::get('events/unjoin/{id}', [EventController::class, 'unjoin']);
        Route::get('note_event', [EventController::class, 'noted']);
        //        Route::resource('ticket' , TicketController::class);
        Route::get('payroll', [PayrollController::class, 'index']);
        Route::get('documents', [DocumentController::class, 'index']);
        Route::get('notifications', [NotificationController::class, 'index']);
        Route::post('on-off-notifications', [NotificationController::class, 'on_off_notifications']);

        Route::get('breaks', [CompanyBreaks::class, 'index']);
        Route::post('breaks/start', [CompanyBreaks::class, 'start_break']);
        Route::post('breaks/end', [CompanyBreaks::class, 'end_break']);
        Route::get('breaks/status', [CompanyBreaks::class, 'check_status']);
        Route::get('salary_recieved', [EmployeeController::class, 'salary_recieved']);
        Route::group(['prefix' => 'request-type'], function () {
            Route::get('/', [RequestController::class, 'index']);
        });
        Route::get('/request-history', [RequestController::class, 'getLeaves']);
        Route::group(['prefix' => 'manager'], function () {

            Route::get('requests',[RequestManagerController::class, 'index']);

            Route::get('leaves/accept/{id}',[LeavesController::class, 'accept']);
            Route::post('leaves/reject/{id}',[LeavesController::class, 'reject']);

            Route::get('mission/accept/{id}',[MissionController::class, 'accept']);
            Route::post('mission/reject/{id}',[MissionController::class, 'reject']);

            Route::get('permission/accept/{id}',[PermissionController::class, 'accept']);
            Route::post('permission/reject/{id}',[PermissionController::class, 'reject']);

            Route::get('work-remotely/accept/{id}',[WorkRemotelyController::class, 'accept']);
            Route::post('work-remotely/reject/{id}',[WorkRemotelyController::class, 'reject']);


            Route::get('overtime/accept/{id}',[OvertimeController::class, 'accept']);
            Route::post('overtime/reject/{id}',[OvertimeController::class, 'reject']);

            Route::get('loan/accept/{id}',[ManagerLoanController::class, 'accept']);
            Route::post('loan/reject/{id}',[ManagerLoanController::class, 'reject']);

        });
        Route::group(['prefix' => 'leave'], function () {
            Route::post('store', [RequestController::class, 'store']);
        });

        Route::group(['prefix' => 'permission'], function () {
            Route::post('store', [RequestController::class, 'store_permission']);
        });

        Route::group(['prefix' => 'work-from-home'], function () {
            Route::post('store', [RequestController::class, 'store_work_from_home']);
        });

        Route::post("store_mission_request", [RequestController::class, 'store_mission_request']);
        Route::post("store_over_time_request", [RequestController::class, 'store_over_time_request']);

        Route::group(['prefix' => 'loan'], function () {
            Route::post('store', [LoanController::class, 'store']);
            Route::get('/', [LoanController::class, 'index']);
            Route::get('get-options', [LoanController::class, 'get_options']);
        });

        Route::get('tasks',[TaskController::class,'index']);
        Route::post('tasks/update-board',[TaskController::class,'updateTaskBoard']);
        Route::get('tasks/{id}',[TaskController::class,'show']);
        Route::get('task-activity-logs/{id}',[TaskController::class,'activityLogs']);

        Route::get("evaluations", [EvaluationController::class, 'index']);
        Route::get("evaluations/{evaluation}/questions", [EvaluationController::class, 'show_questions']);
        Route::post("evaluations/{evaluation}/answer_the_evaluation", [EvaluationController::class, 'answer_the_evaluation']);
        Route::post("evaluations/{evaluation}/show_answers", [EvaluationController::class, 'show_answers']);

        Route::get('permissions', [EmployeePermissionController::class, 'index']);
        Route::get('leaves', [EmployeeLeaveController::class, 'index']);
        Route::get('loans', [LoanController::class, 'index']);
    });
});

Route::group(['prefix' => 'v1/manager'], function () {
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('attendance' , [AttandanceController::class , 'index2']);
        Route::get('tasks' , [TaskController::class , 'MangerTasks']);

        Route::post('tasks/store' , [TaskController::class , 'store']);
        Route::put('tasks/update/{id}' , [TaskController::class , 'update']);
        Route::delete('tasks/destroy/{task}' , [TaskController::class , 'destroy']);

        // Route::apiResource('tasks' , TaskController::class);

        Route::get('sub-employees' , [MangerController::class , 'getSubEmployees']);
    });
});
