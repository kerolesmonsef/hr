<?php

namespace App\Http\Controllers;

use App\Models\Payees;
use Illuminate\Http\Request;

class PayeesController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Payee'))
        {
            $payees = Payees::get();

            return view('payees.index', compact('payees'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Payee'))
        {
            return view('payees.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Payee'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'payee_name' => 'required',
                                   'contact_number' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $payee                 = new Payees();
            $payee->payee_name     = $request->payee_name;
            $payee->contact_number = $request->contact_number;
            $payee->created_by     = auth()->user()->creatorId();
            $payee->save();

            return redirect()->route('payees.index')->with('success', __('Payees  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Payees $payee)
    {
        return redirect()->route('payees.index');
    }

    public function edit(Payees $payee)
    {
        if(auth()->user()->can('Edit Payee'))
        {
            if($payee->created_by == auth()->user()->creatorId())
            {
                return view('payees.edit', compact('payee'));
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

    public function update(Request $request, $payee)
    {
        $payee = Payees::find($payee);
        if(auth()->user()->can('Edit Payee'))
        {
            if($payee->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'payee_name' => 'required',
                                       'contact_number' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $payee->payee_name     = $request->payee_name;
                $payee->contact_number = $request->contact_number;
                $payee->save();

                return redirect()->route('payees.index')->with('success', __('Payees successfully updated.'));
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

    public function destroy(Payees $payee)
    {
        if(auth()->user()->can('Delete Payee'))
        {
            if($payee->created_by == auth()->user()->creatorId())
            {
                $payee->delete();

                return redirect()->route('payees.index')->with('success', __('Payees successfully deleted.'));
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
