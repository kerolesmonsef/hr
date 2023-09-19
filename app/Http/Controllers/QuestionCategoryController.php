<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateQuestion;
use App\Models\Evaluation;
use App\Models\EvaluationCategory;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $categories = EvaluationCategory::with('questions')->get();
            return view('questions_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = \Validator::make(
        $request->all(),
        [
            'title' => ['required' , 'string' , 'max:191'],
            'title_ar' => ['required' , 'string' ,'max:191'],
        ]);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $data = $validator->validated();
        $data['created_by'] = auth()->user()->creatorId();
        EvaluationCategory::create($data);
        return redirect()->route('question_category.index')->with('success', __('messages.Item was added successfully'));;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::where(['evaluation_category_id' =>  $id , 'created_by' => auth()->user()->creatorId()])->with('evaluation_category')->latest()->get();
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = EvaluationCategory::findorfail($id);
        if($cat->created_by == auth()->user()->creatorId())
        {
            return view('questions_category.edit', compact('cat'));
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
        ]);
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $data = $validator->validated();
        $cat = EvaluationCategory::findorfail($id);
        $cat->update($data);
        return redirect()->route('question_category.index')->with('success', __('messages.Item was updated successfully'));
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
        $cat = EvaluationCategory::findorfail($id);
        if($cat->created_by == auth()->user()->creatorId())
        {
            $cat->delete();
            return redirect()->route('question_category.index')->with('success', __('messages.Item was deleted successfully'));;
        }
        return response()->json(['error' => __('Permission denied.')], 401);
    }
}
