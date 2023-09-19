<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Mail\ResignationSend;
use App\Models\Resignation;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ResignationController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Resignation'))
        {
            if(auth()->user()->type == 'employee')
            {
                $emp          = Employee::where('user_id', '=', auth()->user()->id)->first();
                $resignations = Resignation::where('employee_id', '=', $emp->id)->get();
            }
            else
            {
                $resignations = Resignation::get();
            }

            return view('resignation.index', compact('resignations'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Resignation'))
        {
            $employees = Employee::get()->pluck('name', 'id');

            return view('resignation.create', compact('employees'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Resignation'))
        {

            $validator = \Validator::make(
                $request->all(), [

                                   'notice_date' => 'required',
                                   'resignation_date' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $resignation = new Resignation();
            $user        = auth()->user();
            if($user->type == 'employee')
            {
                $employee                 = Employee::where('user_id', $user->id)->first();
                $resignation->employee_id = $employee->id;
            }
            else
            {
                $resignation->employee_id = $request->employee_id;
            }
            $resignation->notice_date      = $request->notice_date;
            $resignation->resignation_date = $request->resignation_date;
            $resignation->description      = $request->description;
            $resignation->description_ar      = $request->description_ar;
            $resignation->created_by       = auth()->user()->creatorId();

            $resignation->save();

            $setings = Utility::settings();
            if($setings['employee_resignation'] == 1)
            {
                $employee           = Employee::find($resignation->employee_id);
                $resignation->name  = $employee->name;
                $resignation->email = $employee->email;
                try
                {
                    Mail::to($resignation->email)->send(new ResignationSend($resignation));
                }
                catch(\Exception $e)
                {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }


                $user           = User::find($employee->created_by);
                $resignation->name  = $user->name;
                $resignation->email = $user->email;
                try
                {
                    Mail::to($resignation->email)->send(new ResignationSend($resignation));
                }
                catch(\Exception $e)
                {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('resignation.index')->with('success', __('Resignation  successfully created.') . (isset($smtp_error) ? $smtp_error : ''));

            }

            return redirect()->route('resignation.index')->with('success', __('Resignation  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Resignation $resignation)
    {
        return redirect()->route('resignation.index');
    }

    public function edit(Resignation $resignation)
    {
        if(auth()->user()->can('Edit Resignation'))
        {
            $employees = Employee::get()->pluck('name', 'id');
            if($resignation->created_by == auth()->user()->creatorId())
            {

                return view('resignation.edit', compact('resignation', 'employees'));
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

    public function update(Request $request, Resignation $resignation)
    {
        if(auth()->user()->can('Edit Resignation'))
        {
            if($resignation->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [

                                       'notice_date' => 'required',
                                       'resignation_date' => 'required',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                if(auth()->user()->type != 'employee')
                {
                    $resignation->employee_id = $request->employee_id;
                }


                $resignation->notice_date      = $request->notice_date;
                $resignation->resignation_date = $request->resignation_date;
                $resignation->description      = $request->description;
                $resignation->description_ar      = $request->description_ar;

                $resignation->save();

                return redirect()->route('resignation.index')->with('success', __('Resignation successfully updated.'));
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

    public function destroy(Resignation $resignation)
    {
        if(auth()->user()->can('Delete Resignation'))
        {
            if($resignation->created_by == auth()->user()->creatorId())
            {
                $resignation->delete();

                return redirect()->route('resignation.index')->with('success', __('Resignation successfully deleted.'));
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
