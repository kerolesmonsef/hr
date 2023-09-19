<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Employee;
use App\Mail\PromotionSend;
use App\Models\Promotion;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PromotionController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Promotion'))
        {
            if(auth()->user()->type == 'employee')
            {
                $emp        = Employee::where('user_id', '=', auth()->user()->id)->first();
                $promotions = Promotion::where('employee_id', '=', $emp->id)->get();
            }
            else
            {
                $promotions = Promotion::get();
            }

            return view('promotion.index', compact('promotions'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Promotion'))
        {
            $designations = Designation::get()->pluck('name', 'id');
            $employees    = Employee::get()->pluck('name', 'id');

            return view('promotion.create', compact('employees', 'designations'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Promotion'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'employee_id' => 'required',
                                   'designation_id' => 'required',
                                   'promotion_title' => 'required',
                                   'promotion_date' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $promotion                  = new Promotion();
            $promotion->employee_id     = $request->employee_id;
            $promotion->designation_id  = $request->designation_id;
            $promotion->promotion_title = $request->promotion_title;
            $promotion->promotion_title_ar = $request->promotion_title_ar;
            $promotion->promotion_date  = $request->promotion_date;
            $promotion->description     = $request->description;
            $promotion->description_ar     = $request->description_ar;
            $promotion->created_by      = auth()->user()->creatorId();
            $promotion->save();

            $setings = Utility::settings();
            if($setings['employee_promotion'] == 1)
            {
                $employee               = Employee::find($promotion->employee_id);
                $designation            = Designation::find($promotion->designation_id);
                $promotion->name        = $employee->name;
                $promotion->email       = $employee->email;
                $promotion->designation = $designation->name;

                try
                {
                    Mail::to($promotion->email)->send(new PromotionSend($promotion));
                }
                catch(\Exception $e)
                {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('promotion.index')->with('success', __('Promotion  successfully created.') . (isset($smtp_error) ? $smtp_error : ''));

            }

            return redirect()->route('promotion.index')->with('success', __('Promotion  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Promotion $promotion)
    {
        return redirect()->route('promotion.index');
    }

    public function edit(Promotion $promotion)
    {
        $designations = Designation::get()->pluck('name', 'id');
        $employees    = Employee::get()->pluck('name', 'id');
        if(auth()->user()->can('Edit Promotion'))
        {
            if($promotion->created_by == auth()->user()->creatorId())
            {
                return view('promotion.edit', compact('promotion', 'employees', 'designations'));
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

    public function update(Request $request, Promotion $promotion)
    {
        if(auth()->user()->can('Edit Promotion'))
        {
            if($promotion->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'employee_id' => 'required',
                                       'designation_id' => 'required',
                                       'promotion_title' => 'required',
                                       'promotion_date' => 'required',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $promotion->employee_id     = $request->employee_id;
                $promotion->designation_id  = $request->designation_id;
                $promotion->promotion_title = $request->promotion_title;
                $promotion->promotion_title_ar = $request->promotion_title_ar;
                $promotion->promotion_date  = $request->promotion_date;
                $promotion->description     = $request->description;
                $promotion->description_ar     = $request->description_ar;
                $promotion->save();

                return redirect()->route('promotion.index')->with('success', __('Promotion successfully updated.'));
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

    public function destroy(Promotion $promotion)
    {
        if(auth()->user()->can('Delete Promotion'))
        {
            if($promotion->created_by == auth()->user()->creatorId())
            {
                $promotion->delete();

                return redirect()->route('promotion.index')->with('success', __('Promotion successfully deleted.'));
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
