<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Employee;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Employee'))
        {
            $lang          = app()->getLocale() == 'ar' ? '_ar' : '';
            $notifications = Notification::where('user_id', '=', auth()->user()->id)->get();
            Notification::where('user_id', '=', auth()->user()->id)->update(['read' => 1]);
            return view('notification.index', compact('notifications','lang'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Branch $branch)
    {
        //
    }

    public function edit(Branch $branch)
    {
        //
    }

    public function update(Request $request, Branch $branch)
    {
        //
    }

    public function destroy(Notification $notification)
    {
        if(auth()->user()->can('Manage Employee'))
        {
            if($notification->user_id == auth()->user()->id)
            {
                $notification->delete();
                return redirect()->route('notifications.index')->with('success', __('Employee successfully deleted.'));
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
