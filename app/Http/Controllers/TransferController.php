<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Mail\TransferSend;
use App\Models\Transfer;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TransferController extends Controller
{

    public function index()
    {
        if(auth()->user()->can('Manage Transfer'))
        {
            if(auth()->user()->type == 'employee')
            {
                $emp       = Employee::where('user_id', '=', auth()->user()->id)->first();
                $transfers = Transfer::where('employee_id', '=', $emp->id)->get();
            }
            else
            {
                $transfers = Transfer::get();
            }

            return view('transfer.index', compact('transfers'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Transfer'))
        {
            $departments = Department::get()->pluck('name', 'id');
            $branches    = Branch::get()->pluck('name', 'id');
            $employees   = Employee::get()->pluck('name', 'id');

            return view('transfer.create', compact('employees', 'departments', 'branches'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(auth()->user()->can('Create Transfer'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'employee_id' => 'required',
                                   'branch_id' => 'required',
                                   'department_id' => 'required',
                                   'transfer_date' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $transfer                = new Transfer();
            $transfer->employee_id   = $request->employee_id;
            $transfer->branch_id     = $request->branch_id;
            $transfer->department_id = $request->department_id;
            $transfer->transfer_date = $request->transfer_date;
            $transfer->description   = $request->description;
            $transfer->description_ar   = $request->description_ar;
            $transfer->created_by    = auth()->user()->creatorId();
            $transfer->save();

            $setings = Utility::settings();
            if($setings['employee_transfer'] == 1)
            {
                $employee             = Employee::find($transfer->employee_id);
                $branch               = Branch::find($transfer->branch_id);
                $department           = Department::find($transfer->department_id);
                $transfer->name       = $employee->name;
                $transfer->email      = $employee->email;
                $transfer->branch     = $branch->name;
                $transfer->department = $department->name;
                try
                {
                    Mail::to($transfer->email)->send(new TransferSend($transfer));
                }
                catch(\Exception $e)
                {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('transfer.index')->with('success', __('Transfer  successfully created.') . (isset($smtp_error) ? $smtp_error : ''));
            }

            return redirect()->route('transfer.index')->with('success', __('Transfer  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Transfer $transfer)
    {
        return redirect()->route('transfer.index');
    }

    public function edit(Transfer $transfer)
    {
        if(auth()->user()->can('Edit Transfer'))
        {
            $departments = Department::get()->pluck('name', 'id');
            $branches    = Branch::get()->pluck('name', 'id');
            $employees   = Employee::get()->pluck('name', 'id');
            if($transfer->created_by == auth()->user()->creatorId())
            {
                return view('transfer.edit', compact('transfer', 'employees', 'departments', 'branches'));
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

    public function update(Request $request, Transfer $transfer)
    {
        if(auth()->user()->can('Edit Transfer'))
        {
            if($transfer->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'employee_id' => 'required',
                                       'branch_id' => 'required',
                                       'department_id' => 'required',
                                       'transfer_date' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $transfer->employee_id   = $request->employee_id;
                $transfer->branch_id     = $request->branch_id;
                $transfer->department_id = $request->department_id;
                $transfer->transfer_date = $request->transfer_date;
                $transfer->description   = $request->description;
                $transfer->description_ar   = $request->description_ar;
                $transfer->save();

                return redirect()->route('transfer.index')->with('success', __('Transfer successfully updated.'));
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

    public function destroy(Transfer $transfer)
    {
        if(auth()->user()->can('Delete Transfer'))
        {
            if($transfer->created_by == auth()->user()->creatorId())
            {
                $transfer->delete();

                return redirect()->route('transfer.index')->with('success', __('Transfer successfully deleted.'));
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
