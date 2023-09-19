<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Mail\TicketSend;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('Manage Ticket')) {
            $user = auth()->user();
            if($user->type == 'employee') {
                $tickets = Ticket::where('employee_id', '=', auth()->user()->id)->orWhere('ticket_created', auth()->user()->id)->get();
            } else {
                $tickets = Ticket::select('tickets.*')->join('users', 'tickets.created_by', '=', 'users.id')->where('users.created_by', '=', auth()->user()->creatorId())->orWhere('tickets.created_by', auth()->user()->creatorId())->get();
            }

            return view('ticket.index', compact('tickets'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if (auth()->user()->can('Create Ticket')) {
            $employees = User::where('type', '=', 'employee')->get()->pluck('name', 'id');

            return view('ticket.create', compact('employees'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->can('Create Ticket')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'priority' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $rand          = date('hms');
            $ticket        = new Ticket();
            $ticket->title = $request->title;
            $ticket->title_ar = $request->title_ar;
            if (auth()->user()->type == "employee") {
                $ticket->employee_id = auth()->user()->id;
            } else {
                $ticket->employee_id = $request->employee_id;
            }

            $ticket->priority    = $request->priority;
            $ticket->end_date    = $request->end_date;
            $ticket->ticket_code = $rand;
            $ticket->description = $request->description;
            $ticket->description_ar = $request->description_ar;

            $ticket->ticket_created = auth()->user()->id;
            $ticket->created_by     = auth()->user()->creatorId();
            $ticket->status         = 'open';
            $ticket->save();

            //slack
            $setting = Utility::settings(auth()->user()->creatorId());
            $emp = User::where('id', $request->employee_id)->first();
            if (isset($setting['ticket_notification']) && $setting['ticket_notification'] == 1) {
                $msg = ("New Support ticket created of") . ' ' . $request->priority . ' ' . __("priority for") . ' ' . $emp->name . ' ';
                Utility::send_slack_msg($msg);
            }

            //telegram
            $setting = Utility::settings(auth()->user()->creatorId());
            $emp = User::where('id', $request->employee_id)->first();
            if (isset($setting['telegram_ticket_notification']) && $setting['telegram_ticket_notification'] == 1) {
                $msg = ("New Support ticket created of") . ' ' . $request->priority . ' ' . __("priority for") . ' ' . $emp->name . ' ';
                Utility::send_telegram_msg($msg);
            }

             // twilio
             $setting = Utility::settings(auth()->user()->creatorId());
             $emp = Employee::where('id', $request->employee_id = auth()->user()->id)->first();
             if (isset($setting['twilio_ticket_notification']) && $setting['twilio_ticket_notification'] == 1) {
                 $msg = ("New Support ticket created of") . ' ' . $request->priority . ' ' . __("priority for") . ' ' . $emp->name . ' ';
                 Utility::send_twilio_msg($emp->phone,$msg);
             }




            $setings = Utility::settings();
            if ($setings['ticket_create'] == 1) {
                $employee      = Employee::where('user_id', '=', $ticket->employee_id)->first();
                $ticket->name  = $employee->name;
                $ticket->email = $employee->email;
                try {
                    Mail::to($ticket->email)->send(new TicketSend($ticket));
                } catch (\Exception $e) {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('ticket.index')->with('success', __('Ticket  successfully created.') . (isset($smtp_error) ? $smtp_error : ''));
            }

            return redirect()->route('ticket.index')->with('success', __('Ticket successfully created.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Ticket $ticket)
    {
        return redirect()->route('ticket.index');
    }

    public function edit($ticket)
    {
        $ticket = Ticket::find($ticket);
        if (auth()->user()->can('Edit Ticket')) {
            $employees = User::where('type', '=', 'employee')->get()->pluck('name', 'id');

            return view('ticket.edit', compact('ticket', 'employees'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function update(Request $request, $ticket)
    {

        $ticket = Ticket::find($ticket);
        if (auth()->user()->can('Edit Ticket')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'priority' => 'required',
                    'end_date' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $ticket->title = $request->title;
            $ticket->title_ar = $request->title_ar;
            if (auth()->user()->type == "employee") {
                $ticket->employee_id = auth()->user()->id;
            } else {
                $ticket->employee_id = $request->employee_id;
            }
            $ticket->priority    = $request->priority;
            $ticket->end_date    = $request->end_date;
            $ticket->description = $request->description;
            $ticket->description_ar = $request->description_ar;
            $ticket->status      = $request->status;
            $ticket->save();

            return redirect()->route('ticket.index', compact('ticket'))->with('success', __('Ticket successfully updated.'));
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(Ticket $ticket)
    {
        if (auth()->user()->can('Delete Ticket')) {
            if($ticket->created_by == auth()->user()->creatorId()) {
                $ticket->delete();
                $ticketId = TicketReply::select('id')->where('ticket_id', $ticket->id)->get()->pluck('id');
                TicketReply::whereIn('id', $ticketId)->delete();

                return redirect()->route('ticket.index')->with('success', __('Ticket successfully deleted.'));
            } else {
                flash()->addError(__('Permission denied'));
            return redirect()->back();
            }
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function reply($ticket)
    {
        $ticketreply = TicketReply::where('ticket_id', '=', $ticket)->orderBy('id', 'DESC')->get();
        $ticket      = Ticket::find($ticket);
        if (auth()->user()->type == 'employee') {
            $ticketreplyRead = TicketReply::where('ticket_id', $ticket->id)->where('created_by', '!=', auth()->user()->id)->update(['is_read' => '1']);
        } else {
            $ticketreplyRead = TicketReply::where('ticket_id', $ticket->id)->where('created_by', '!=', auth()->user()->creatorId())->update(['is_read' => '1']);
        }


        return view('ticket.reply', compact('ticket', 'ticketreply'));
    }

    public function changereply(Request $request)
    {

        $validator = \Validator::make(
            $request->all(),
            [
                'description' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $ticket = Ticket::find($request->ticket_id);

        $ticket_reply              = new TicketReply();
        $ticket_reply->ticket_id   = $request->ticket_id;
        $ticket_reply->employee_id = $ticket->employee_id;
        $ticket_reply->description = $request->description;
        if (auth()->user()->type == 'employee') {
            $ticket_reply->created_by = auth()->user()->id;
        } else {
            $ticket_reply->created_by = auth()->user()->creatorId();
        }

        $ticket_reply->save();

        return redirect()->route('ticket.reply', $ticket_reply->ticket_id)->with('success', __('Ticket Reply successfully Send.'));
    }
}
