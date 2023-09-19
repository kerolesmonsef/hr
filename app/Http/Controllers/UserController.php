<?php

namespace App\Http\Controllers;

use File;
use App\Models\Employee;
use App\Mail\UserCreate;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Plan;
use App\Models\User;
use App\Models\Utility;
use App\Models\Salary_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Users-List', ['only' => ['index']]);
        $this->middleware('permission:Users-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Users-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Users-Delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        $user  = auth()->user();
        $users = User::where('user_status',1)->when(request('search'), function ($q) {
            return $q->where('name' , 'like' , '%' . request('search') . '%' );
        })->orderBy('id','desc')->paginate(10);

        $roles = Role::get();
        if($request->ajax()) {
            $search             = view('new-theme.settings.user.users', compact("users"));
            $paginate           = view('new-theme.settings.user.paginate', compact("users"));
            return response()->json(['search' => $search->render() , 'paginate' => $paginate->render()]);
        }

        return view('new-theme.settings.user.index', compact('users','roles'));
    }

    public function create()
    {
        $user  = auth()->user();
        $roles = Role::get();
        return view('new-theme.settings.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'name'     => 'required',
            'role'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create(
        [
            'name'       => $request['name'],
            'email'      => $request['email'],
            'password'   => Hash::make($request['password']),
            'type'       => Role::find($request['role']) ?? 'admin',
        ]);

        $user->assignRole($request['role']);
        return redirect()->route('user.index')->with('success', __('User successfully created.') . (isset($smtp_error) ? $smtp_error : ''));
    }
    
    public function edit($id)
    {
        $user  = User::find($id);
        $emp   = Employee::where('user_id', '=', $user->id)->first();
        $roles = Role::get();
        return view('new-theme.settings.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        \request()->validate([
            'name'     => 'required',
            'role'     => 'required',
            'password' => 'nullable|min:6',
            'email'    => 'required|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);

        $user->update(
            [
                'name'       => $request['name'],
                'email'      => $request['email'],
                'password'   => $request['password'] ? Hash::make($request['password']) : $user->password,
                'type'       => Role::find($request['role'])->name ?? 'admin',
            ]);

        $user->assignRole($request['role']);

        return redirect()->route('user.index')->with('success', 'User successfully updated.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Deleted successfully');
    }

    public function profile()
    {
        $userDetail = auth()->user();
        return view('user.profile')->with('userDetail', $userDetail);
    }

    public function editprofile(Request $request)
    {
        $userDetail = auth()->user();
        $user       = User::findOrFail($userDetail['id']);

        $request->validate(
            [
                'name' => 'required|max:120',
                'email' => 'required|email|unique:users,email,' . $userDetail['id'],
                'profile' => 'image|mimes:jpeg,png,jpg,svg|max:3072',
            ]
        );


        if($request->hasFile('profile'))
        {
            $filenameWithExt = $request->file('profile')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('profile')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $dir             = storage_path('uploads/avatar/');
            $image_path      = $dir . $userDetail['avatar'];

            if(File::exists($image_path))
            {
                File::delete($image_path);
            }
            if(!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }
            $path = $request->file('profile')->storeAs('uploads/avatar/', $fileNameToStore);

        }

        if(!empty($request->profile))
        {
            $user['avatar'] = $fileNameToStore;
        }
        $user['name']  = $request['name'];
        $user['email'] = $request['email'];
        $user->save();

        if(auth()->user()->type == 'employee')
        {
            $employee        = Employee::where('user_id', $user->id)->first();
            $employee->email = $request['email'];
            $employee->save();
        }

        return redirect()->back()->with(
            'success', __('messages.data_updated')
        );
    }

    public function account_setting()
    {
        $userDetail = auth()->user();
        return view('user.setting')->with('userDetail', $userDetail);
    }

    public function updatePassword(Request $request)
    {
        if(\Auth::Check())
        {
            $request->validate(
                [
                    'current_password' => 'required',
                    'new_password'     => 'required|min:6',
                    'confirm_password' => 'required|same:new_password',
                ]
            );

            $objUser          = auth()->user();
            $request_data     = $request->All();
            $current_password = $objUser->password;
            if(Hash::check($request_data['current_password'], $current_password))
            {
                $user_id            = auth()->user()->id;
                $obj_user           = User::find($user_id);
                $obj_user->password = Hash::make($request_data['new_password']);;
                $obj_user->save();

                return redirect()->back()->with('success', __('messages.data_updated'));
            }
            else
            {
                return redirect()->back()->with('error', __('messages.Please enter correct current password.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong.'));
        }
    }

    public function upgradePlan($user_id)
    {
        $user = User::find($user_id);

        $plans = Plan::get();

        return view('user.plan', compact('user', 'plans'));
    }

    public function activePlan($user_id, $plan_id)
    {

        $user       = User::find($user_id);
        $assignPlan = $user->assignPlan($plan_id);
        $plan       = Plan::find($plan_id);
        if($assignPlan['is_success'] == true && !empty($plan))
        {
            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            Order::create(
                [
                    'order_id' => $orderID,
                    'name' => null,
                    'card_number' => null,
                    'card_exp_month' => null,
                    'card_exp_year' => null,
                    'plan_name' => $plan->name,
                    'plan_id' => $plan->id,
                    'price' => $plan->price,
                    'price_currency' => !empty(env('CURRENCY')) ? env('CURRENCY') : '$',
                    'txn_id' => '',
                    'payment_status' => 'succeeded',
                    'receipt' => null,
                    'user_id' => $user->id,
                ]
            );

            return redirect()->back()->with('success', 'Plan successfully upgraded.');
        }
        else
        {
            return redirect()->back()->with('error', 'Plan fail to upgrade.');
        }

    }

    public function notificationSeen($user_id)
    {
        Notification::where('user_id', '=', $user_id)->update(['is_read' => 1]);

        return response()->json(['is_success' => true], 200);
    }
}
