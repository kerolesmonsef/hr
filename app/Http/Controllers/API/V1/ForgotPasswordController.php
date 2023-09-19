<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\BaseController as BaseController;
use App\Http\Resources\EmployeeResource;
use App\Mail\sendemail;
use App\Models\Setting;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\SslCertificate\SslCertificate;
use Validator;


class ForgotPasswordController extends BaseController
{

    public function forgetpassword(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'email'           => 'required|email',
        ],
        [
            'email.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'البريد الإلكترونى مطلوب',
        ]);

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->handleError($validator->errors()->first(),$data);
        }

        $existedemail = User::where('email',$request->email)->first();
        if($existedemail)
        {
            $randomCode = rand(1111,9999);
            $existedemail->update(['forgetcode'=> $randomCode]);

            \Mail::to($request->email)->send(new \App\Mail\forgotpassword($randomCode));

            $accessdata  =  new \stdClass();
            $accessdata->code = $randomCode;
            $message     = $locale == 'en' ?  'Verification code has been sent successfully' : 'تم إرسال كود التحقق بنجاح ';
            return $this->handleResponse($accessdata, $message);
        }
        else
        {
            $accessdata  =  new \stdClass();
            $message     = $locale == 'en' ?  'The email is not registered with us' : 'البريد الإلكترونى غير مسجل لدينا';
            return $this->handleError($message,$accessdata);
        }

    }

    public function activcode(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'email'           => 'required',
            'code'            => 'required',
        ],
        [
            'email.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال  مطلوب',
            'code.required'        => $locale == 'en' ?  'The :attribute field is required.' : 'كود التحقق مطلوب',
        ]);

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->handleError($validator->errors()->first(),$data);
        }

        $user           = User::where('email',$request->email)->first();
        if($user->forgetcode != $request->code)
        {
            $accessdata              =  new \stdClass();
            $message                 = $locale == 'en' ?  'Incorrect Activation Code' : 'كود التحقق غير صحيح';
            return $this->handleError($message,$accessdata);
        }

        $user->update(['forgetcode' => null]);

        $accessdata              =  new \stdClass();
        $message                 = $locale == 'en' ?  'Correct Activation Code ' : 'كود التحقق صحيح';
        return $this->handleResponse($accessdata, $message);
    }

    public function rechangepass(Request $request)
    {
        $locale    = $request->header('Accept-Language');
        $validator = Validator::make($request->all(),[
            'email'           => 'required',
            'password'        => 'required|min:8',
        ],
        [
            'email.required'       => $locale == 'en' ?  'The :attribute field is required.' : 'رقم الجوال  مطلوب',
            'password.required'    => $locale == 'en' ?  'The :attribute field is required.' : 'كلمة المرور  مطلوب',
            'password.min'         => $locale == 'en' ?   'The :attribute must be at least :min characters.' : 'كلمة المرور لا تقل عن 8 حروف',
        ]);

        if($validator->fails())
        {
            $data =  new \stdClass();
            return $this->handleError($validator->errors()->first(),$data);
        }

        $user           = User::where('email',$request->email)->first();
        $user->password = Hash::make($request['password']);
        $user->save();

        $token = $user->createToken('MyApp')->plainTextToken;
        $message                 = $locale == 'en' ?  'Password Changed And Login Successfully' : 'تم تغيير كلمة المرور وتسجيل الدخول بنجاح';
        return $this->handleResponse([
            'employee' => new EmployeeResource($user->employee),
            'token' => $token,
        ], $message);
    }

}
