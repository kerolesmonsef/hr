<?php

namespace App\Http\Controllers;

use App\Models\JobStage;
use Illuminate\Http\Request;

class JobStageController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Job Stage'))
        {
            $stages = JobStage::orderBy('order', 'asc')->get();

            return view('jobStage.index', compact('stages'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function create()
    {
        return view('jobStage.create');
    }


    public function store(Request $request)
    {
        if(auth()->user()->can('Create Job Stage'))
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

            $jobStage             = new JobStage();
            $jobStage->title      = $request->title;
            $jobStage->title_ar      = $request->title_ar;
            $jobStage->created_by = auth()->user()->creatorId();
            $jobStage->save();

            return redirect()->back()->with('success', __('Job stage  successfully created.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function show(JobStage $jobStage)
    {
        //
    }


    public function edit(JobStage $jobStage)
    {
        return view('jobStage.edit', compact('jobStage'));
    }


    public function update(Request $request, JobStage $jobStage)
    {
        if(auth()->user()->can('Edit Job Stage'))
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


            $jobStage->title      = $request->title;
            $jobStage->title_ar      = $request->title_ar;
            $jobStage->created_by = auth()->user()->creatorId();
            $jobStage->save();

            return redirect()->back()->with('success', __('Job stage  successfully updated.'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


    public function destroy(JobStage $jobStage)
    {
        if(auth()->user()->can('Delete Job Stage'))
        {
            if($jobStage->created_by == auth()->user()->creatorId())
            {
                $jobStage->delete();

                return redirect()->back()->with('success', __('Job stage successfully deleted.'));
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

    public function order(Request $request)
    {
        $post = $request->all();
        foreach($post['order'] as $key => $item)
        {
            $stage        = JobStage::where('id', '=', $item)->first();
            $stage->order = $key;
            $stage->save();
        }
    }
}
