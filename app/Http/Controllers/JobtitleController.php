<?php

namespace App\Http\Controllers;

use App\Models\Jobtitle;
use Illuminate\Http\Request;

class JobtitleController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Employee'))
        {
            $jobtitles = Jobtitle::get();

            return view('jobtitle.index', compact('jobtitles'));
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
            return view('jobtitle.create');
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

            $jobtitle             = new Jobtitle();
            $jobtitle->name       = $request->name;
            $jobtitle->name_ar    = $request->name_ar;
            $jobtitle->created_by = auth()->user()->creatorId();
            $jobtitle->save();

            return redirect()->route('jobtitle.index')->with('success', __('jobtitle  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Jobtitle $jobtitle)
    {
        return redirect()->route('jobtitle.index');
    }

    public function edit(Jobtitle $jobtitle)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($jobtitle->created_by == auth()->user()->creatorId())
            {
                return view('jobtitle.edit', compact('jobtitle'));
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

    public function update(Request $request, Jobtitle $jobtitle)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($jobtitle->created_by == auth()->user()->creatorId())
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

                $jobtitle->name    = $request->name;
                $jobtitle->name_ar = $request->name_ar;
                $jobtitle->save();

                return redirect()->route('jobtitle.index')->with('success', __('jobtitle successfully updated.'));
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

    public function destroy(Jobtitle $jobtitle)
    {
        if(auth()->user()->can('Delete Employee'))
        {
            if($jobtitle->created_by == auth()->user()->creatorId())
            {
                $jobtitle->delete();

                return redirect()->route('jobtitle.index')->with('success', __('jobtitle successfully deleted.'));
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
