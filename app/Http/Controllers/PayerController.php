<?php

namespace App\Http\Controllers;

use App\Models\Payer;
use Illuminate\Http\Request;

class PayerController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Payer'))
        {
            $payers = Payer::get();

            return view('payer.index', compact('payers'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Payer'))
        {
            return view('payer.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Payer'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'payer_name' => 'required',
                                   'contact_number' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $payer                 = new Payer();
            $payer->payer_name     = $request->payer_name;
            $payer->contact_number = $request->contact_number;
            $payer->created_by     = auth()->user()->creatorId();
            $payer->save();

            return redirect()->route('payer.index')->with('success', __('Payer  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(Payer $payer)
    {
        return redirect()->route('payer.index');
    }

    public function edit(Payer $payer)
    {
        if(auth()->user()->can('Edit Payer'))
        {
            if($payer->created_by == auth()->user()->creatorId())
            {
                return view('payer.edit', compact('payer'));
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

    public function update(Request $request, $payer)
    {
        $payer = Payer::find($payer);
        if(auth()->user()->can('Edit Payer'))
        {
            if($payer->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'payer_name' => 'required',
                                       'contact_number' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
                $payer->payer_name     = $request->payer_name;
                $payer->contact_number = $request->contact_number;
                $payer->save();

                return redirect()->route('payer.index')->with('success', __('Payer successfully updated.'));
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

    public function destroy(Payer $payer)
    {
        if(auth()->user()->can('Delete Payer'))
        {
            if($payer->created_by == auth()->user()->creatorId())
            {
                $payer->delete();

                return redirect()->route('payer.index')->with('success', __('Payer successfully deleted.'));
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
