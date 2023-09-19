<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\AwardType;
use App\Models\Employee;
use App\Mail\AwardSend;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AwardController extends Controller
{
    public function index()
    {
       // Utility::send_twilio_msg('+916351717430','HELLO');
        $usr = auth()->user();
        if ($usr->can('Manage Award')) {
            $employees  = Employee::get();
            $awardtypes = AwardType::get();

            if (auth()->user()->type == 'employee') {
                $emp    = Employee::where('user_id', '=', auth()->user()->id)->first();
                $awards = Award::where('employee_id', '=', $emp->id)->get();
            } else {
                $awards = Award::get();
            }

            return view('award.index', compact('awards', 'employees', 'awardtypes'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if (auth()->user()->can('Create Award')) {
            $employees  = Employee::get()->pluck('name', 'id');
            $awardtypes = AwardType::get()->pluck('name', 'id');

            return view('award.create', compact('employees', 'awardtypes'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if (auth()->user()->can('Create Award')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'employee_id' => 'required',
                    'award_type' => 'required',
                    'date' => 'required',
                    'gift' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $award              = new Award();
            $award->employee_id = $request->employee_id;
            $award->award_type  = $request->award_type;
            $award->date        = $request->date;
            $award->gift        = $request->gift;
            $award->description = $request->description;
            $award->description_ar = $request->description_ar;
            $award->created_by  = auth()->user()->creatorId();
            $award->save();

            //slack
            $setting = Utility::settings(auth()->user()->creatorId());
            $awardtype = AwardType::find($request->award_type);
            $emp = Employee::find($request->employee_id);
            if (isset($setting['award_notificaation']) && $setting['award_notificaation'] == 1) {
                $msg = $awardtype->name . ' ' . __("created for") . ' ' . $emp->name . ' ' . __("from") . ' ' . $request->date . '.';
                Utility::send_slack_msg($msg);
            }

            //telegram
            $setting = Utility::settings(auth()->user()->creatorId());
            $awardtype = AwardType::find($request->award_type);
            $emp = Employee::find($request->employee_id);
            if (isset($setting['telegram_award_notification']) && $setting['telegram_award_notification'] == 1) {
                $msg = $awardtype->name . ' ' . __("created for") . ' ' . $emp->name . ' ' . __("from") . ' ' . $request->date . '.';
                Utility::send_telegram_msg($msg);
            }

            // twilio
            $setting = Utility::settings(auth()->user()->creatorId());
            $awardtype = AwardType::find($request->award_type);
            $emp = Employee::find($request->employee_id);
            if (isset($setting['twilio_award_notification']) && $setting['twilio_award_notification'] == 1) {
                $msg = $awardtype->name . ' ' . __("created for") . ' ' . $emp->name . ' ' . __("from") . ' ' . $request->date . '.';
                Utility::send_twilio_msg($emp->phone,$msg);
            }

            $setings = Utility::settings();
            if ($setings['award_create'] == 1) {
                $employee     = Employee::find($award->employee_id);
                $award->name  = $employee->name;
                $award->email = $employee->email;
                try {
                    Mail::to($award->email)->send(new AwardSend($award));
                } catch (\Exception $e) {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('award.index')->with('success', __('Award  successfully created.') . (isset($smtp_error) ? $smtp_error : ''));
            }

            return redirect()->route('award.index')->with('success', __('Award  successfully created.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Award $award)
    {
        return redirect()->route('award.index');
    }

    public function edit(Award $award)
    {
        if (auth()->user()->can('Edit Award')) {
            if ($award->created_by == auth()->user()->creatorId()) {
                $employees  = Employee::get()->pluck('name', 'id');
                $awardtypes = AwardType::get()->pluck('name', 'id');

                return view('award.edit', compact('award', 'awardtypes', 'employees'));
            } else {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Award $award)
    {
        if (auth()->user()->can('Edit Award')) {
            if ($award->created_by == auth()->user()->creatorId()) {
                $validator = \Validator::make(
                    $request->all(),
                    [
                        'employee_id' => 'required',
                        'award_type' => 'required',
                        'date' => 'required',
                        'gift' => 'required',
                    ]
                );

                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $award->employee_id = $request->employee_id;
                $award->award_type  = $request->award_type;
                $award->date        = $request->date;
                $award->gift        = $request->gift;
                $award->description = $request->description;
                $award->description_ar = $request->description_ar;
                $award->save();

                return redirect()->route('award.index')->with('success', __('Award successfully updated.'));
            } else {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Award $award)
    {
        if (auth()->user()->can('Delete Award')) {
            if ($award->created_by == auth()->user()->creatorId()) {
                $award->delete();

                return redirect()->route('award.index')->with('success', __('Award successfully deleted.'));
            } else {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
}
