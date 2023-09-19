<?php

namespace App\Http\Controllers;

use App\Exports\EmployeePermissionsExport;
use App\Exports\MissionExport;
use App\Exports\WorkFromHomeExport;
use App\Models\Employee;
use App\Models\Employee_shift;
use App\Models\Mission;
use App\Models\WorkFromHomeRequest;
use App\Services\MissionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MissionController extends Controller
{
    private MissionService $missionService;

    public function __construct()
    {
        $this->middleware('permission:Mission-List', ['only' => ['index']]);
        $this->middleware('permission:Mission-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Mission-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Mission-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Mission-Export', ['only' => ['export']]);
        $this->middleware('permission:Mission-Print', ['only' => ['print']]);

        $this->missionService = app(MissionService::class);
    }

    public function index(Request $request)
    {
        $missions = Mission::with('employee')->latest();
        $employees = Employee::where([
            'is_active' => 1,
        ])->get();

        $this->missionService->filter($missions);

        $missions = $missions->paginate(10);

        if ($request->ajax()) {

            $search = view('new-theme.requests.missions.missions', compact("missions", 'employees'));
            $paginate = view('new-theme.requests.missions.paginate', compact("missions"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        return view('new-theme.requests.missions.index', compact('missions', 'employees'));
    }

    public function export()
    {
        return Excel::download(new MissionExport, 'missions.xlsx');
    }

    public function print()
    {
        return (new MissionExport())->view();
    }

    public function create()
    {
        $employees = Employee::where('created_by', auth()->user()->creatorId())->get();
        return view('new-theme.requests.missions.create', compact('employees'));
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
        Mission::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('mission.index');
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

    public function update(Request $request, Mission $mission)
    {
        $data = $request->validate([
            'employee_id' => 'required',
            'status' => 'required',
            'date' => 'required',
            'reason' => 'nullable',
            'start' => 'required',
            'end' => 'required',
        ]);
        //$data['direct_manager'] = auth()->user()->employee->direct_manager;
        //$data['status'] = auth()->user()->employee->direct_manager == null ? 'approved' : 'pending';
        // if(($data['status']) == 'approved'){
        //     $data['reject_reason']=null;
        // }
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        $mission->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return response()->json();
    }

    public function approve($id)
    {
        $row = Mission::findorfail($id);
        $row->update([
            'status' => 'approved',
        ]);
        flash()->addSuccess(__('Approved successfully'));
        return redirect()->back();
    }

    public function reject($id)
    {
        $row = Mission::findorfail($id);
        $row->update([
            'status' => 'rejected',
        ]);
        flash()->addSuccess(__('Rejected successfully'));
        return redirect()->back();
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('mission.index');
    }

}
