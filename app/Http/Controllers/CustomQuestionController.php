<?php

namespace App\Http\Controllers;

use App\Models\CustomQuestion;
use Illuminate\Http\Request;

class CustomQuestionController extends Controller
{

    public function index()
    {
        if(auth()->user()->can('Manage Custom Question'))
        {
            $questions = CustomQuestion::get();
            return view('customQuestion.index', compact('questions'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        $is_required = CustomQuestion::$is_required;

        return view('customQuestion.create', compact('is_required'));
    }

    public function store(Request $request)
    {
        if(auth()->user()->can('Create Custom Question'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'question' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $question              = new CustomQuestion();
            $question->question    = $request->question;
            $question->is_required = $request->is_required;
            $question->created_by  = auth()->user()->creatorId();
            $question->save();

            return redirect()->back()->with('success', __('Question successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(CustomQuestion $customQuestion)
    {
        //
    }

    public function edit(CustomQuestion $customQuestion)
    {
        $is_required = CustomQuestion::$is_required;
        return view('customQuestion.edit', compact('customQuestion','is_required'));
    }

    public function update(Request $request, CustomQuestion $customQuestion)
    {
        if(auth()->user()->can('Edit Custom Question'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'question' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $customQuestion->question    = $request->question;
            $customQuestion->is_required = $request->is_required;
            $customQuestion->save();

            return redirect()->back()->with('success', __('Question successfully updated.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(CustomQuestion $customQuestion)
    {
        if(auth()->user()->can('Delete Custom Question'))
        {
            $customQuestion->delete();

            return redirect()->back()->with('success', __('Question successfully deleted.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
}
