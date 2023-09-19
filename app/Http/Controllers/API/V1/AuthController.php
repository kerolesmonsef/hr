<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Controller;
use App\Http\Resources\EmployeeResource;
use App\Mail\sendemail;
use App\Models\Companyslate;
use App\Models\Employee;
use App\Models\FCMToken;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {
        /** @var array $validatedData */
        $validatedData = $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
            'device_id' => 'required|string',
            'fcm_token' => 'nullable|string',
        ]);

        /** @var User|Null $user */
        $user = User::where('email', $validatedData['email'])->first();
        // dd($validatedData);
        /** @var Employee|Null $check */
        $check = User::findByDeviceID($validatedData['device_id']);

        if ($user && $user->is_active == 0) {
            return $this->error(__('messages.credential'), 200);
        }

        if (!$user or !Hash::check($validatedData['password'], $user->password)) {
            return $this->error(__('messages.credential'), 200);
        }

        // if ($check and $check->id != $employee->id) {
        //     return $this->error(__('messages.deviceUsedBefore'), 401);
        // }

        if ($user && !$user->user_status) {
            return $this->error(__('messages.suspended'), 200);
        }

        // if ($employee->device_id and $employee->device_id != $validatedData['device_id']) {
        //     return $this->error(__('messages.device_id'), 401);
        // }

        if ($user && !$user->device_id) {
            $user->device_id = $validatedData['device_id'];
            $user->save();
        }

        if (request()->filled('token')) {
            $user->fcm()->delete();

            $user->fcm()->create([
                'employee_id' => $user->id,
                'company_id' => $user->created_by,
                'token' => $validatedData['fcm_token'] ?? '',
            ]);

            $user->update(['fcm_token' => $validatedData['fcm_token']]);
        }
        /** @var string $token */
        $token = $user->createToken('MyApp')->plainTextToken;

        $lang = $request->header('Accept-Language') == 'ar' ? '_ar' : '';
        $companyslate = Companyslate::where('created_by', $user->creatorId())->first();
        $url = $companyslate ? asset(\Storage::url($companyslate['file' . $lang])) : null;
        $weekVacations = \DB::table('salary_settings')->where('created_by', $user->creatorId())->first();

        return $this->success([
            'access_token' => $token,
            'domain' => url('/'),
//            'user' => new EmployeeResource($user->employee),
        ]);



    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        $token = FCMToken::where('employee_id', auth()->id())->first();
        $token->update([
            'token' => ''
        ]);
        return $this->success([], __('messages.logout'));
    }
}
