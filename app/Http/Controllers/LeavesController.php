<?php

namespace App\Http\Controllers;

use App\Exports\EmployeePermissionsExport;
use App\Exports\VacationsExport;
use App\Http\Requests\ApproveLeave;
use App\Http\Requests\NewTheme\StoreVacation;
use App\Http\Requests\RejectLeave;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeavesType;
use App\Models\LeaveType;
use App\Http\Requests\StoreLeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\LeaveService;
use App\Services\LeaveUpdateService;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class LeavesController extends Controller
{
    protected LeaveService  $leaveservice;
    protected LeaveUpdateService  $leaveupdateservice;
    public function __construct(LeaveService $leaveservice , LeaveUpdateService $leaveupdateservice)
    {
        $this->leaveservice       = $leaveservice;
        $this->leaveupdateservice = $leaveupdateservice;

        $this->middleware('permission:Vacation-List', ['only' => ['index']]);
        $this->middleware('permission:Vacation-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Vacation-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Vacation-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Vacation-Export', ['only' => ['export']]);
        $this->middleware('permission:Vacation-Print', ['only' => ['print']]);
    }



    public function export(){

        return Excel::download(new VacationsExport, 'vacations.xlsx');
    }

    public function print(){
        return (new VacationsExport())->view();
    }

    public function index(Request $request)
    {
        $vacations = Leave::query()
        ->with('leaveType' , 'employee','replacement_employee')
            ->latest();

        $employees = Employee::where([
         'is_active'     => 1,
        ])->get();

        $leave_type = LeaveType::where([
            'parent'      => null,
            'type'        => 'leave'
        ]) -> with('childs') -> first();

        $this->leaveservice->filter($vacations);

        $vacations = $vacations->paginate(10);
        if($request->ajax()) {
            $search   = view('new-theme.employee.vacations.vacations', compact("vacations" , 'employees' ,'leave_type'));
            $paginate = view('new-theme.employee.vacations.paginate', compact("vacations"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.employee.vacations.index', compact('vacations' ,'employees','leave_type'));
    }

    public function approve(ApproveLeave $request, $id){
         $data = $request->validated();
         $leave = Leave::with('employee')->findOrfail($id);
         //$leave->employee->update([
           //  'annual_leave_entitlement' => $leave->employee->annual_leave_entitlement - $leave->total_leave_days,
        // ]);
        //  $data['direct_manager'] = auth()->user()->employee->direct_manager;
        //  $data['status'] = 'pending';
        //  if( auth()->user()->employee->direct_manager == null ){
        //      if(isset($data['deduction'])){
        //          $data['status'] = 'approvedWithDeduction';
        //      }else{
        //          $data['status'] = 'approved';
        //      }
        //  }
        if(isset($data['deduction']) && $data['deduction'] != '' ){
            $data['status'] = 'approvedWithDeduction';
        }else{
            $data['status'] = 'approved';
        }
         $leave->update([
             'status' => $data['status'],
             'deduction' => isset($data['deduction']) ? $data['deduction']  : 0,
             'ticket_flight_status' =>  $data['ticket_flight_status'] ?? null,
             'direct_manager' => $data['direct_manager'] ?? null,
             'status' => $data['status'],
             'admin_message' => $data['admin_message'] ?? null,
         ]);
//         flash()->addSuccess('fdlfdlfdlf');
         return redirect()->back()->with(['success' => __('Approved successfully')]);
     }
     public function reject(RejectLeave $request, $id){
         $data = $request->validated();
          $leave = Leave::findOrfail($id);
          $leave->update([
              'status' => 'rejected',
              'admin_message' => $data['admin_message'] ?? null,
          ]);
          return redirect()->back()->with(['success' =>  __('Rejected successfully')]);
     }

    public function create(Request $request)
    {
        $leave_type = LeaveType::where([
            'parent'      => null,
            'type'        => 'leave'
        ])->with('childs')->first();

        $employees = Employee::where([
            'is_active'     => 1,
            ])->get();

        return view('new-theme.employee.vacations.create',compact('employees','leave_type'));
    }

    public function store(StoreVacation $request)
    {
        $data = $request->validated();
        [$start_date , $end_date] = explode('to' , $data['start_date']);
        $data['created_by'] = auth() -> user() -> creatorId();
        $data['start_date'] =  $start_date;
        $data['end_date'] =  $end_date ;
        $data['applied_on'] = Carbon::createFromFormat('d/m/Y' ,  $data['applied_on'] ) -> format('Y-m-d');
        Leave::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('vacations.index');
    }

    public function update(StoreVacation $request,$id)
    {
        $data = $request->validated();
        $vacation = Leave::findorfail($id);
        $data['start_date'] = Carbon::createFromFormat('d/m/Y' ,  $data['start_date'] ) -> format('Y-m-d');
        $data['end_date'] = Carbon::createFromFormat('d/m/Y' ,  $data['end_date'] ) -> format('Y-m-d');
        $data['applied_on'] = Carbon::createFromFormat('d/m/Y' ,  $data['applied_on'] ) -> format('Y-m-d');
        $vacation->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return redirect()->route('vacations.index');
    }

    public function destroy(Request $request, $id)
    {

            $leave = Leave::findorfail($id);

            $leave->delete();
            return redirect()->back()->with('success', __('Leave successfully deleted.'));

    }
}
