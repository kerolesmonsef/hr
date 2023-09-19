<?php

namespace App\Http\Controllers;

use App\Models\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Employee'))
        {
            $nationalities = Nationality::get();

            return view('nationality.index', compact('nationalities'));
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
            return view('nationality.create');
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
                                   'name' => 'required',
                                    'name_ar' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $nationality             = new Nationality();
            $nationality->name       = $request->name;
            $nationality->name_ar    = $request->name_ar;
            $nationality->created_by = auth()->user()->creatorId();
            $nationality->save();

            return redirect()->route('nationality.index')->with('success', __('nationality  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Nationality $nationality)
    {
        return redirect()->route('nationality.index');
    }

    public function edit(Nationality $nationality)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($nationality->created_by == auth()->user()->creatorId())
            {
                return view('nationality.edit', compact('nationality'));
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

    public function update(Request $request, Nationality $nationality)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($nationality->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',
                                       'name_ar' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $nationality->name    = $request->name;
                $nationality->name_ar = $request->name_ar;
                $nationality->save();

                return redirect()->route('nationality.index')->with('success', __('nationality successfully updated.'));
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

    public function destroy(Nationality $nationality)
    {
        if(auth()->user()->can('Delete Employee'))
        {
            if($nationality->created_by == auth()->user()->creatorId())
            {
                $nationality->delete();

                return redirect()->route('nationality.index')->with('success', __('nationality successfully deleted.'));
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
