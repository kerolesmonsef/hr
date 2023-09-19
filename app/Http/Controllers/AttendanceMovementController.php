<?php

namespace App\Http\Controllers;

use App\Models\AttendanceMovement;
use Illuminate\Http\Request;

class AttendanceMovementController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Employee'))
        {
            $AttendanceMovements = AttendanceMovement::get();
            return view('attendancemovements.index', compact('AttendanceMovements'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Employee'))
        {
            return view('attendancemovements.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Employee'))
        {
            $validator = \Validator::make(
            $request->all(), [
                'start_movement_date' => 'required|date',
            ]);

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }

            $AttendanceMovements = AttendanceMovement::orderBy('id','DESC')->first();
            if($AttendanceMovements && $AttendanceMovements->status != 1)
            {
                return redirect()->back()->with('error', __('The current attendance movement must be closed first in order to be able to create a new one'));
            }

            $AttendanceMovement                          = new AttendanceMovement();
            $AttendanceMovement->start_movement_date     = $request->start_movement_date;
            $AttendanceMovement->end_movement_date       = \Carbon\Carbon::parse($request->start_movement_date)->addMonthNoOverflow()->subDay();
            $AttendanceMovement->created_by              = auth()->user()->creatorId();
            $AttendanceMovement->save();

            return redirect()->route('attendancemovement.index')->with('success', __('AttendanceMovement  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(AttendanceMovement $AttendanceMovement)
    {
        return redirect()->route('AttendanceMovement.index');
    }

    public function edit($AttendanceMovement)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            $AttendanceMovement = AttendanceMovement::where('id',$AttendanceMovement)->first();
            if($AttendanceMovement->created_by == auth()->user()->creatorId())
            {
                return view('attendancemovements.edit', compact('AttendanceMovement'));
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

    public function update(Request $request, $AttendanceMovement)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            $AttendanceMovement = AttendanceMovement::where('id',$AttendanceMovement)->first();
            if($AttendanceMovement->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                $request->all(), [
                    'start_movement_date' => 'required|date',
                ]);

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();
                    return redirect()->back()->with('error', $messages->first());
                }

                $AttendanceMovement->start_movement_date     = $request->start_movement_date;
                $AttendanceMovement->end_movement_date       = \Carbon\Carbon::parse($request->start_movement_date)->addMonthNoOverflow()->subDay();
                $AttendanceMovement->status                  = $request->status;
                $AttendanceMovement->save();

                return redirect()->route('attendancemovement.index')->with('success', __('AttendanceMovement successfully updated.'));
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

    public function destroy($AttendanceMovement)
    {
        if(auth()->user()->can('Delete Employee'))
        {
            $AttendanceMovement = AttendanceMovement::where('id',$AttendanceMovement)->first();
            if($AttendanceMovement->created_by == auth()->user()->creatorId())
            {
                $AttendanceMovement->delete();
                return redirect()->route('attendancemovement.index')->with('success', __('AttendanceMovement successfully deleted.'));
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
