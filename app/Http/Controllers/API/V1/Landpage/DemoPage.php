<?php
namespace App\Http\Controllers\API\V1\Landpage;
use App\Http\Controllers\Controller;
use App\Mail\DemoLandPage;
use App\Models\Plan;
use App\Models\Salary_setting;
use App\Models\User;
use App\Models\Utility;
use App\Services\DemoPageService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DemoPage extends Controller
{
    use ApiResponser;
    protected DemoPageService  $demopageservice;
    public function __construct(DemoPageService $demopageservice)
    {
        $this->demopageservice = $demopageservice;
    }
    public function index(){
        return $this->demopageservice->getData();
    }
    public function request_demo(Request $request){

        $num = $request->country_code == '966' ?  9 : 10;
        $numplus = $num + 1;

        request()->validate([
            'name'                => 'required',
            'company_name'        => 'required',
            'number_of_employees' => 'required|numeric|min:0',
            'email'               => 'required|email|unique:users',
            'phone'               => "required|regex:/^([0-9\s\-\+\(\)]*)$/|unique:users|between:$num,$numplus",
            'password'            => 'required|min:6',
            'country_code'        => 'required|string',
            'job_title'           => 'required|string',
            'activity_type'       => 'required|string',
            'have_hr'             => 'required|in:0,1',
            'work_email'          => 'required|email',
        ]);
        $user = User::create(
        [
            'name'                => $request['name'],
            'company_name'        => $request['company_name'],
            'phone'               => $request['country_code'] . $request['phone'],
            'number_of_employees' => $request['number_of_employees'],
            'email'               => $request['email'],
            'password'            =>  $request['password'] ? Hash::make($request['password']) : Hash::make('1234'),
            'type'                => 'company',
            'request_type'        => 'request',
            'plan'                => $plan = Plan::where('price', '<=', 0)->first()->id,
            'lang'                => !empty($default_language) ? $default_language->value : '',
            'created_by'          => 1,
            'job_title'           => $request['job_title'],
            'activity_type'       => $request['activity_type'],
            'have_hr'             => $request['have_hr'],
            'work_email'          => $request['work_email'],
        ]);
        $user->assignRole('Company');
        $input               = $request->all();
        $input['created_by'] = $user->id;
        Salary_setting::create($input);
        Utility::jobStage($user->id);
       // $role_r = Role::findById(2 ,'web');
       try {
            Mail::to('marketing@mwardi.com')->send(new DemoLandPage($request->all()));
        } catch (\Exception $e) {
           $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
       }
        return $this->success('','Your Demo Request Received Successfully');
    }
}
