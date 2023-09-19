<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{

    public function index()
    {
        if(auth()->user()->can('Manage Job Category'))
        {
            $categories = JobCategory::get();

            return view('jobCategory.index', compact('categories'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        return view('jobCategory.create');
    }


    public function store(Request $request)
    {
        if(auth()->user()->can('Create Job Category'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'title_ar' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jobCategory             = new JobCategory();
            $jobCategory->title      = $request->title;
            $jobCategory->title_ar      = $request->title_ar;
            $jobCategory->created_by = auth()->user()->creatorId();
            $jobCategory->save();

            return redirect()->back()->with('success', __('Job category  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(JobCategory $jobCategory)
    {
        //
    }


    public function edit(JobCategory $jobCategory)
    {
        return view('jobCategory.edit', compact('jobCategory'));
    }


    public function update(Request $request, JobCategory $jobCategory)
    {
        if(auth()->user()->can('Edit Job Category'))
        {

            $validator = \Validator::make(
                $request->all(), [
                                   'title' => 'required',
                                   'title_ar' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $jobCategory->title = $request->title;
            $jobCategory->title_ar = $request->title_ar;
            $jobCategory->save();

            return redirect()->back()->with('success', __('Job category  successfully updated.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function destroy(JobCategory $jobCategory)
    {
        if(auth()->user()->can('Delete Job Category'))
        {
            if($jobCategory->created_by == auth()->user()->creatorId())
            {
                $jobCategory->delete();

                return redirect()->back()->with('success', __('Job category successfully deleted.'));
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
