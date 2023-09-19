<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveResource;
use App\Http\Requests\UpdateLeaveResource;
use App\Models\LeaveType;
use App\Models\RequestType;
use Illuminate\Http\Request;

class RequestTypeController extends Controller
{
    public function index()
    {
        if(request()->has('id')){
            $requestTypes = LeaveType::where('parent' , request()->get('id'))->where('created_by' , auth()->user()->creatorId())->get();
            $parent = LeaveType::findOrfail(request()->get('id'));
            return view('request_types.index', compact('requestTypes','parent'));
        }

        if(auth()->user()->can('Manage Employee'))
        {
            $requestTypes = LeaveType::where('parent' , null )->get();
            return view('request_types.index', compact('requestTypes'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function create()
    {
        if(auth()->user()->can('Create Employee'))
        {
            $id = request()->get('id');
            return view('request_types.create' , compact('id'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(StoreLeaveResource $request)
    {

        if(auth()->user()->can('Create Employee'))
        {
            $data = $request->validated();
            $data['created_by'] = auth()->user()->creatorId();
            LeaveType::create($data);
            return redirect()->route('request_types.index',['id' => $data['parent']])->with('success', __('messages.Item was added successfully'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show(LeaveType $RequestType)
    {
        return redirect()->route('request_types.index' , compact($RequestType->childs));
    }

    public function edit(LeaveType $RequestType)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            return view('request_types.edit', compact('RequestType'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(UpdateLeaveResource $request, LeaveType $RequestType)
    {
        if(auth()->user()->can('Edit Employee'))
        {
            if($RequestType->created_by == auth()->user()->creatorId())
            {
                $data = $request->validated();
                $RequestType->update($data);
                return redirect()->route('request_types.index',['id' => $data['parent']])->with('success', __('messages.Item was updated successfully'));
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

    public function destroy(LeaveType $RequestType)
    {
        if(auth()->user()->can('Delete Employee'))
        {
            $id = $RequestType->parent;
            $RequestType->delete();
            return redirect()->route('request_types.index',['id' => $id])->with('success', __('RequestType successfully deleted.'));




        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }
}
