<?php

namespace App\Http\Controllers;

use App\Exports\EmployeePermissionsExport;
use App\Exports\OverTimeExport;
use App\Exports\WorkFromHomeExport;
use App\Models\Employee;
use App\Models\Employee_shift;
use App\Models\Mission;
use App\Models\Overtime;
use App\Models\OverTimeRequest;
use App\Models\WorkFromHomeRequest;
use App\Services\OverTimeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OverTimeRequestController extends Controller
{
    private OverTimeService $overTimeService;

    
    public function __construct()
    {
        $this->middleware('permission:OverTime-List', ['only' => ['index']]);
        $this->middleware('permission:OverTime-Create', ['only' => ['create','store']]);
        $this->middleware('permission:OverTime-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:OverTime-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:OverTime-Export', ['only' => ['export']]);
        $this->middleware('permission:OverTime-Print', ['only' => ['print']]);

        $this->overTimeService = new OverTimeService();
    }

    public function export()
    {
        return Excel::download(new OverTimeExport, 'over-time-requests.xlsx');
    }

    public function print()
    {
        return (new OverTimeExport)->view();
    }

    public function index(Request $request)
    {
        $employees = Employee::where([
            'is_active' => 1,
        ])->get(['name','id','name_ar']);

        $overtimerequests = $this->overTimeService->filter(OverTimeRequest::with('employee:id,name,name_ar')->latest())->paginate(10);

        // $overtimerequests = $overtimerequests->paginate(10);
        if ($request->ajax()) {
            $search = view('new-theme.requests.overtime.overtime', compact("overtimerequests", 'employees'));
            $paginate = view('new-theme.requests.overtime.paginate', compact("overtimerequests"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.requests.overtime.index', compact('overtimerequests', 'employees'));
    }


    public function create()
    {
        $employees = Employee::get();
        return view('new-theme.requests.overtime.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'reason' => 'nullable',
            'start' => 'required|string',
            'end' => 'required|string',
        ]);
        //$data['direct_manager'] = auth()->user()->employee->direct_manager;
        //$data['status'] = auth()->user()->employee->direct_manager == null ? 'approved' : 'pending';
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        OverTimeRequest::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('over-time.index');
    }

    public function show(Employee_shift $Employee_shift)
    {
        //
    }

    public function edit($id)
    {
        $employees = Employee::where('created_by', auth()->user()->creatorId())->get();
        $work_from_request = WorkFromHomeRequest::find($id);
        return view('work_from_home_requests.edit', compact('work_from_request', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $over_time_request = OverTimeRequest::findOrfail($id);
        $data = $request->validate([
            'employee_id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'reason' => 'nullable',
            'start' => 'required',
            'end' => 'required',
            'admin_message' => 'required_if:status,==,rejected',
        ]);
        //$data['direct_manager'] = auth()->user()->employee->direct_manager;
        //$data['status'] = auth()->user()->employee->direct_manager == null ? 'approved' : 'pending';
        // if(($data['status']) == 'approved'){
        //     $data['reject_reason']=null;
        //}
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        $over_time_request->update($data);

        flash()->addSuccess(__('Updated successfully'));
        return response()->json();
    }

    public function approve($id)
    {
        $row = OverTimeRequest::findorfail($id);
        $row->update([
            'status' => 'approved',
        ]);
        flash()->addSuccess(__('Approved successfully'));
        return redirect()->back();
    }

    public function reject(Request $request, $id)
    {
        $row = OverTimeRequest::findorfail($id);
        $row->update([
            'status' => 'rejected',
            'admin_message' => $request->admin_message,
        ]);
        flash()->addSuccess(__('Rejected successfully'));
        return redirect()->back();
    }

    public function destroy(OverTimeRequest $overTime)
    {
        $overTime->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('over-time.index');
    }

}
