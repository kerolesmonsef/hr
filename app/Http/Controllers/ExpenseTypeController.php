<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Expense Type'))
        {
            $expensetypes = ExpenseType::get();

            return view('expensetype.index', compact('expensetypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Expense Type'))
        {
            return view('expensetype.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Expense Type'))
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

            $expensetype             = new ExpenseType();
            $expensetype->name       = $request->name;
            $expensetype->created_by = auth()->user()->creatorId();
            $expensetype->save();

            return redirect()->route('expensetype.index')->with('success', __('ExpenseType  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(ExpenseType $expensetype)
    {
        return redirect()->route('expensetype.index');
    }

    public function edit(ExpenseType $expensetype)
    {
        if(auth()->user()->can('Edit Expense Type'))
        {
            if($expensetype->created_by == auth()->user()->creatorId())
            {

                return view('expensetype.edit', compact('expensetype'));
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

    public function update(Request $request, ExpenseType $expensetype)
    {
        if(auth()->user()->can('Edit Expense Type'))
        {
            if($expensetype->created_by == auth()->user()->creatorId())
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

                $expensetype->name = $request->name;
                $expensetype->save();

                return redirect()->route('expensetype.index')->with('success', __('ExpenseType successfully updated.'));
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

    public function destroy(ExpenseType $expensetype)
    {
        if(auth()->user()->can('Delete Expense Type'))
        {
            if($expensetype->created_by == auth()->user()->creatorId())
            {
                $expensetype->delete();

                return redirect()->route('expensetype.index')->with('success', __('ExpenseType successfully deleted.'));
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
