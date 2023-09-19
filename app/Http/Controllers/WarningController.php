<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Mail\WarningSend;
use App\Models\Utility;
use App\Models\Warning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WarningController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Warning'))
        {
            if(auth()->user()->type == 'employee')
            {
                $emp      = Employee::where('user_id', '=', auth()->user()->id)->first();
                $warnings = Warning::where('warning_by', '=', $emp->id)->get();
            }
            else
            {
                $warnings = Warning::get();
            }

            return view('warning.index', compact('warnings'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Warning'))
        {
            if(auth()->user()->type == 'employee')
            {
                $user             = auth()->user();
                $current_employee = Employee::where('user_id', $user->id)->get()->pluck('name', 'id');
                $employees        = Employee::where('user_id', '!=', $user->id)->get()->pluck('name', 'id');
            }
            else
            {
                $user             = auth()->user();
                $current_employee = Employee::where('user_id', $user->id)->get()->pluck('name', 'id');
                $employees        = Employee::get()->pluck('name', 'id');
            }

            return view('warning.create', compact('employees', 'current_employee'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Warning'))
        {
            if(auth()->user()->type != 'employee')
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'warning_by' => 'required',
                                   ]
                );
            }

            $validator = \Validator::make(
                $request->all(), [
                                   'warning_to' => 'required',
                                   'subject' => 'required',
                                   'subject_ar' => 'required',
                                   'warning_date' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $warning = new Warning();
            if(auth()->user()->type == 'employee')
            {
                $emp                 = Employee::where('user_id', '=', auth()->user()->id)->first();
                $warning->warning_by = $emp->id;
            }
            else
            {
                $warning->warning_by = $request->warning_by;
            }
            $warning->warning_to   = $request->warning_to;
            $warning->subject      = $request->subject;
            $warning->subject_ar      = $request->subject_ar;
            $warning->warning_date = $request->warning_date;
            $warning->description  = $request->description;
            $warning->description_ar  = $request->description_ar;
            $warning->created_by   = auth()->user()->creatorId();
            $warning->save();

            $setings = Utility::settings();
            if($setings['employee_warning'] == 1)
            {
                $employee       = Employee::find($warning->warning_to);
                $warning->name  = $employee->name;
                $warning->email = $employee->email;
                try
                {
                    Mail::to($warning->email)->send(new WarningSend($warning));
                }
                catch(\Exception $e)
                {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('warning.index')->with('success', __('Warning  successfully created.') . (isset($smtp_error) ? $smtp_error : ''));

            }

            return redirect()->route('warning.index')->with('success', __('Warning  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Warning $warning)
    {
        return redirect()->route('warning.index');
    }

    public function edit(Warning $warning)
    {

        if(auth()->user()->can('Edit Warning'))
        {
            if(auth()->user()->type == 'employee')
            {
                $user             = auth()->user();
                $current_employee = Employee::where('user_id', $user->id)->get()->pluck('name', 'id');
                $employees        = Employee::where('user_id', '!=', $user->id)->get()->pluck('name', 'id');
            }
            else
            {
                $user             = auth()->user();
                $current_employee = Employee::where('user_id', $user->id)->get()->pluck('name', 'id');
                $employees        = Employee::get()->pluck('name', 'id');
            }
            if($warning->created_by == auth()->user()->creatorId())
            {
                return view('warning.edit', compact('warning', 'employees', 'current_employee'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Warning $warning)
    {
        if(auth()->user()->can('Edit Warning'))
        {
            if($warning->created_by == auth()->user()->creatorId())
            {
                if(auth()->user()->type != 'employee')
                {
                    $validator = \Validator::make(
                        $request->all(), [
                                           'warning_by' => 'required',
                                       ]
                    );
                }

                $validator = \Validator::make(
                    $request->all(), [
                                       'warning_to' => 'required',
                                       'subject' => 'required',
                                       'subject_ar' => 'required',
                                       'warning_date' => 'required',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                if(auth()->user()->type == 'employee')
                {
                    $emp                 = Employee::where('user_id', '=', auth()->user()->id)->first();
                    $warning->warning_by = $emp->id;
                }
                else
                {
                    $warning->warning_by = $request->warning_by;
                }

                $warning->warning_to   = $request->warning_to;
                $warning->subject      = $request->subject;
                $warning->subject_ar      = $request->subject_ar;
                $warning->warning_date = $request->warning_date;
                $warning->description  = $request->description;
                $warning->description_ar  = $request->description_ar;
                $warning->save();

                return redirect()->route('warning.index')->with('success', __('Warning successfully updated.'));
            }
            else
            {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Warning $warning)
    {
        if(auth()->user()->can('Delete Warning'))
        {
            if($warning->created_by == auth()->user()->creatorId())
            {
                $warning->delete();

                return redirect()->route('warning.index')->with('success', __('Warning successfully deleted.'));
            }
            else
            {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
}
