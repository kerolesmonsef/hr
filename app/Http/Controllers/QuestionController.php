<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateQuestion;
use App\Models\Evaluation;
use App\Models\EvaluationCategory;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with('evaluation_category')->get();
        return view('questions.index', compact('questions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $evaluation_categories = EvaluationCategory::get();
        return view('questions.create' , compact('evaluation_categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make(
        $request->all(),
        [
            'title' => ['required' , 'string' , 'max:191'],
            'title_ar' => ['required' , 'string' ,'max:191'],
            'evaluation_category_id' => ['required' , 'numeric'],
            'type' => 'required|in:choice,text'
        ]);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $data = $validator->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $data['type'] = $data['type'] ?? 'choice';
        $question = Question::create($data);
        return redirect()->route('question.index')->with('success', __('Question added successfully'));;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question)
    {
        $question = Question::findorfail($question);
        $evaluation_categories = EvaluationCategory::get();
        if($question->created_by == auth()->user()->creatorId())
        {
            return view('questions.edit', compact('question','evaluation_categories'));
        }
        return response()->json(['error' => __('Permission denied.')], 401);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = \Validator::make(
            $request->all(),
            [
                'title' => ['required' , 'string' , 'max:191'],
                'title_ar' => ['required' , 'string' ,'max:191'],
                'evaluation_category_id' => ['required' , 'numeric'],
                'type' => 'required|in:choice,text'
        ]);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $data = $validator->validated();
        $data['type'] = $data['type'] ?? 'choice';
        $question = Question::findorfail($id);
        $question->update($data);
        return redirect()->route('question.index')->with('success', __('Question updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $question = Question::findorfail($id);
        if($question->created_by == auth()->user()->creatorId())
        {
            $question->delete();
            return redirect()->route('question.index')->with('success', __('Question deleted successfully'));;
        }
        return response()->json(['error' => __('Permission denied.')], 401);
    }
}
