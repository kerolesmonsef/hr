<?php

namespace App\Http\Controllers;

use App\Exports\WorkFromHomeExport;
use App\Models\Employee;
use App\Models\Employee_shift;
use App\Models\User;
use App\Models\WorkFromHomeRequest;
use App\Services\WorkFromHomeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WorkFromHomeRequestController extends Controller
{
    private WorkFromHomeService $workFromHomeService;

    public function __construct()
    {
        $this->middleware('permission:WorkFromHome-List', ['only' => ['index']]);
        $this->middleware('permission:WorkFromHome-Create', ['only' => ['create','store']]);
        $this->middleware('permission:WorkFromHome-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:WorkFromHome-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:WorkFromHome-Export', ['only' => ['export']]);
        $this->middleware('permission:WorkFromHome-Print', ['only' => ['print']]);

        $this->workFromHomeService = app(WorkFromHomeService::class);
    }

    public function index(Request $request)
    {
        $requests = WorkFromHomeRequest::with('employee');

        $employees = Employee::where([
            'is_active' => 1,
        ])->get();

        $this->workFromHomeService->filter($requests);

        $requests = $requests->paginate(10);
        if ($request->ajax()) {
            $search = view('new-theme.requests.work-remotely.requests', compact("requests", 'employees'));
            $paginate = view('new-theme.requests.work-remotely.paginate', compact("requests"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        return view('new-theme.requests.work-remotely.index', compact('requests', 'employees'));
    }

    public function export()
    {
        return Excel::download(new WorkFromHomeExport, 'work-from-home-requests.xlsx');
    }

    public function print()
    {
        return (new WorkFromHomeExport())->view();
    }

    public function create()
    {
        $employees = Employee::where('created_by', auth()->user()->creatorId())->get();
        return view('new-theme.requests.work-remotely.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'reason' => 'nullable',
        ]);
        //$data['direct_manager'] = auth()->user()->employee->direct_manager;
        //$data['status'] = auth()->user()->employee->direct_manager == null ? 'approved' : 'pending';
        if (($data['status']) == 'approved') {
            $data['reject_reason'] = null;
        }
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        WorkFromHomeRequest::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('work-from-home.index');
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

    public function update(Request $request, WorkFromHomeRequest $work_from_home)
    {
        $data = $request->validate([
            'employee_id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'reason' => 'nullable',
            'reject_reason' => 'required_if:status,rejected',
        ]);
        //$data['direct_manager'] = auth()->user()->employee->direct_manager;
        //$data['status'] = auth()->user()->employee->direct_manager == null ? 'approved' : 'pending';
        if (($data['status']) == 'approved') {
            $data['reject_reason'] = null;
        }
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        $work_from_home->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return response()->json();
    }

    public function approve($id)
    {
        $row = WorkFromHomeRequest::findorfail($id);
        $row->update([
            'status' => 'approved',
        ]);
        flash()->addSuccess(__('Approved successfully'));
        return redirect()->back();
    }

    public function reject(Request $request, $id)
    {
        $data = $request->validate([
            'reject_reason' => 'required|string'
        ]);
        $row = WorkFromHomeRequest::findorfail($id);
        $row->update([
            'status' => 'rejected',
            'reject_reason' => $data['reject_reason'],
        ]);
        flash()->addSuccess(__('Rejected successfully'));
        return redirect()->back();
    }

    public function destroy(WorkFromHomeRequest $work_from_home)
    {
        $work_from_home->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('work-from-home.index');
    }

}
