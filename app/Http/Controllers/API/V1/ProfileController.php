<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ValidateFacePrint;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\AnalyticsResource;
use App\Http\Resources\AssetResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\FinancialResource;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\PersonalResource;
use App\Http\Resources\ProfileResource;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\User;
use App\Traits\ApiResponser;
use Hash;
use Illuminate\Http\Request;
use Validator;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\V1\User
 */
class ProfileController extends Controller
{
    use ApiResponser;

    public function upload_face_print(ValidateFacePrint $request)
    {
        $employee = auth()->user()->employee;
        // if($employee -> login_image != null ){
        //     return $this->error(__('messages. You uploaded image print before'), 200);
        // }
        $imagename = $request->file('image')->store('faceprint');
        $employee->update([
            'login_image' => $imagename
        ]);
        return $this->success('', __('messages.data_updated'));
    }

    public function index(Request $request)
    {
        return $this->success( new EmployeeResource(auth()->user()->employee), __('messages.data_updated'));
    }


    public function update_picture(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'profile' => 'sometimes:nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 404);
            }

            if ($request->has('profile')) {
                $image_name = auth()->id() . '_profile' . time() . '.' . request()->profile->getClientOriginalExtension();
                $request->profile->move(public_path('storage/uploads/'), $image_name);
                auth()->user()->update([
                    'avatar' => 'uploads/' . $image_name
                ]);
            } else {
                auth()->user()->update([
                    'avatar' => ''
                ]);
            }

            return $this->success([
                'employee' => new EmployeeResource(auth()->user()->employee),
            ], __('messages.data_updated'));

        } catch (\Exception $ex) {
            dd($ex);
            return $this->success('', __('messages.data_updated'));
        }
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Invalid Data',
                'errors' => [$validator->errors()->first()]], 200);
        }
        $user = auth()->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return $this->error(__('messages.error_password'), 200);
        };
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        return $this->success('', __('messages.data_updated'));
    }

    public function personal_data()
    {
        return $this->success(new PersonalResource(auth()->user()->employee), '');
    }

    public function financial_data()
    {
        return $this->success(new FinancialResource(auth()->user()->employee), '');
    }

    public function assets(Request $request)
    {

        $assets = Asset::where('employee_id', auth()->user()->employee->id)
            ->when($request->filled('search'), function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%');
            })->get();
        return $this->success(AssetResource::collection($assets), '');
    }

    public function organization_data()
    {
        return $this->success(new OrganizationResource(auth()->user()->employee->load('department')), '');
    }
    public function analytics_data()
    {
        return $this->success(new AnalyticsResource(auth()->user()->employee), '');
    }
    public function update(ProfileRequest $request)
    {
//        auth()->user()->employee->update([
//            'name' => $request->name,
//            'gender' => $request->gender,
//            'dob' => $request->dob,
//            'phone' => $request->phone,
//            'address' => $request->address,
//            'email' => $request->email,
//            'nationality_id' => $request->nationality_id,
//            'religion' => $request->religion,
//            'social_status' => $request->social_status,
//        ]);

        dd();

    }
}
