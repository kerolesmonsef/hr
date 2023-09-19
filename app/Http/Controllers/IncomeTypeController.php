<?php

namespace App\Http\Controllers;

use App\Models\IncomeType;
use Illuminate\Http\Request;

class IncomeTypeController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Income Type'))
        {
            $incometypes = IncomeType::get();

            return view('incometype.index', compact('incometypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Income Type'))
        {
            return view('incometype.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Income Type'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $incometype             = new IncomeType();
            $incometype->name       = $request->name;
            $incometype->created_by = auth()->user()->creatorId();
            $incometype->save();

            return redirect()->route('incometype.index')->with('success', __('IncomeType  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(IncomeType $incometype)
    {
        return redirect()->route('incometype.index');
    }

    public function edit(IncomeType $incometype)
    {
        if(auth()->user()->can('Edit Income Type'))
        {
            if($incometype->created_by == auth()->user()->creatorId())
            {

                return view('incometype.edit', compact('incometype'));
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

    public function update(Request $request, IncomeType $incometype)
    {
        if(auth()->user()->can('Edit Income Type'))
        {
            if($incometype->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',

                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $incometype->name = $request->name;
                $incometype->save();

                return redirect()->route('incometype.index')->with('success', __('IncomeType successfully updated.'));
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

    public function destroy(IncomeType $incometype)
    {
        if(auth()->user()->can('Delete Income Type'))
        {
            if($incometype->created_by == auth()->user()->creatorId())
            {
                $incometype->delete();

                return redirect()->route('incometype.index')->with('success', __('IncomeType successfully deleted.'));
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
