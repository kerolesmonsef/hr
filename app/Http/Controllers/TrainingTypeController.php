<?php

namespace App\Http\Controllers;

use App\Models\TrainingType;
use Illuminate\Http\Request;

class TrainingTypeController extends Controller
{

    public function index()
    {
        if(auth()->user()->can('Manage Training Type'))
        {
            $trainingtypes = TrainingType::get();

            return view('trainingtype.index', compact('trainingtypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        if(auth()->user()->can('Create Training Type'))
        {
            return view('trainingtype.create');
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        if(auth()->user()->can('Create Training Type'))
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

            $trainingtype             = new TrainingType();
            $trainingtype->name       = $request->name;
            $trainingtype->name_ar       = $request->name_ar;
            $trainingtype->created_by = auth()->user()->creatorId();
            $trainingtype->save();

            return redirect()->route('trainingtype.index')->with('success', __('TrainingType  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function show(TrainingType $trainingType)
    {
        //
    }


    public function edit($id)
    {

        if(auth()->user()->can('Edit Training Type'))
        {
            $trainingType = TrainingType::find($id);
            if($trainingType->created_by == auth()->user()->creatorId())
            {

                return view('trainingtype.edit', compact('trainingType'));
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


    public function update(Request $request, $id)
    {
        if(auth()->user()->can('Edit Training Type'))
        {
            $trainingType = TrainingType::find($id);
            if($trainingType->created_by == auth()->user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'name' => 'required',
                                       'name_ar' => 'required',

                                   ]
                );

                $trainingType->name = $request->name;
                $trainingType->name_ar = $request->name_ar;
                $trainingType->save();

                return redirect()->route('trainingtype.index')->with('success', __('TrainingType successfully updated.'));
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


    public function destroy($id)
    {
        if(auth()->user()->can('Delete Training Type'))
        {

            $trainingType = TrainingType::find($id);
            if($trainingType->created_by == auth()->user()->creatorId())
            {
                $trainingType->delete();

                return redirect()->route('trainingtype.index')->with('success', __('TrainingType successfully deleted.'));
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
