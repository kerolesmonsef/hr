<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:VacationSetting-List', ['only' => ['index']]);
        $this->middleware('permission:VacationSetting-Create', ['only' => ['store']]);
        $this->middleware('permission:VacationSetting-Edit', ['only' => ['update']]);
        $this->middleware('permission:VacationSetting-Delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $parent_leave = LeaveType::with('childs')->where([
            'created_by' => auth()->user()->creatorId(),
            'type' => 'leave',
            'parent' => null,
        ])->first();
        $childs = $parent_leave->childs()->paginate(10);
        return view('new-theme.settings.attendance.edit-vacation', compact('parent_leave', 'childs'));
    }

    public function store(Request $request)
    {
        $parent=LeaveType::where(['parent'=>null,'type'=>'leave'])->firstorfail();
        $data = $request->validateWithBag('store',[
            'title'=>['required','string'],
            'title_ar'=>['required','string'],
            'maxDays'=>['required','numeric','min:0'],
            'maxDaysPerMonth'=>['required','string','numeric','min:0'],
            'afterMaxHour'=>['required','string','numeric','min:0'],
            'daysBeforeApply'=>['required','string','numeric','min:0'],
            'deduction'=>['required','string','numeric','min:0'],
        ]);
        $data['created_by'] = auth()->user()->creatorId();
        $data['parent'] = $parent->id;
        LeaveType::create($data);
        flash()->addSuccess(__('Added successfully'));
        return response()->json();
    }

    public function update(Request $request, LeaveType $leavetype)
    {
        $data = $request->validate([
            'title'=>['required','string'],
            'title_ar'=>['required','string'],
            'maxDays'=>['required','numeric','min:0'],
            'maxDaysPerMonth'=>['required','string','numeric','min:0'],
            'afterMaxHour'=>['required','string','numeric','min:0'],
            'daysBeforeApply'=>['required','string','numeric','min:0'],
            'deduction'=>['required','string','numeric','min:0'],
        ]);
        $leavetype->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return response()->json();

    }

    public function destroy(LeaveType $leavetype)
    {
        $leavetype->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->back();
    }
}
