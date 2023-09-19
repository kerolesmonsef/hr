<?php

namespace App\Http\Controllers;

use App\Models\PayrollSetting;
use App\Models\Salary_setting;
use Illuminate\Http\Request;

class PayrollSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:PayrollSetting-List', ['only' => ['index','store']]);
    }

    public function index()
    {
        $payroll_settings = PayrollSetting::where('created_by',auth()->user()->creatorId())->get();
        return view('new-theme.settings.salary.payroll_settings', compact('payroll_settings'));
    }


    public function store(Request $request)
    {
        $payroll_settings = PayrollSetting::where('created_by',auth()->user()->creatorId())->get();
        foreach($payroll_settings as $payroll_setting) {
            $payroll_setting->payroll_dispaly = $request->has('payroll_dispaly.' . $payroll_setting->id);
            $payroll_setting->save();
        }

        return redirect()->back()->with('success', __('successfully updated.'));
    }
}
