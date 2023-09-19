<?php

namespace App\Http\Controllers;

use App\Exports\EmployeePermissionsExport;
use App\Http\Requests\NewTheme\StoreEmployeePermission;
use App\Http\Requests\NewTheme\UpdateEmployeePermission;
use App\Models\Employee;
use App\Models\EmployeePermission;
use App\Models\InsuranceCompany;
use App\Models\Jobtitle;
use App\Services\EmployeePermissionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class EmployeePermissionController extends Controller
{
    private EmployeePermissionService $permissionService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:EmployeePermission-List', ['only' => ['index']]);
        $this->middleware('permission:EmployeePermission-Create', ['only' => ['create','store']]);
        $this->middleware('permission:EmployeePermission-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:EmployeePermission-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:EmployeePermission-Export', ['only' => ['export']]);
        $this->permissionService  = app(EmployeePermissionService::class);
    }


    public function index(Request $request)
    {
        $permissions = EmployeePermission::with('employee.jobtitle','direct_manager');
        $employees = Employee::where([
            'is_active'     => 1,
            ])->get();

        $this->permissionService->filter($permissions);

        $permissions = $permissions->paginate(10);
        if($request->ajax()) {
            $search   = view('new-theme.employee.permissions.permissions', compact("permissions",'employees'));
            $paginate = view('new-theme.employee.permissions.paginate', compact("permissions"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.employee.permissions.index',compact('permissions','employees'));
    }

    public function export()
    {
        return Excel::download(new EmployeePermissionsExport, 'permissions.xlsx');
    }

    public function print(){
        return app(EmployeePermissionsExport::class)->view();
    }


    public function approve($id){
       $permission = EmployeePermission::findorfail($id);
       $permission -> update([
            'status' => 'approved',
       ]);
       return redirect()->back()->with(['success' => __('Item approved successfully')]);
    }

    public function reject(Request $request , $id){
        $data = $request->validate([
            'admin_message' => 'required',
        ]);
        $permission = EmployeePermission::findorfail($id);
        $permission -> update([
                'status' => 'rejected',
                'admin_message'=>$data['admin_message'],
        ]);
        return redirect()->back()->with(['success' => __('Rejected successfully')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where([
            'is_active'     => 1,
         ])->get();

        return view('new-theme.employee.permissions.create' , compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeePermission $request)
    {
        $data = $request -> validated();
        $employee = Employee::findorfail($data['employee_id']);
        $data['direct_manager'] = $employee -> direct_manager;
        $data['created_by'] = auth()->user()->creatorId();
        $data['date'] = Carbon::createFromFormat('d/m/Y' , $data['date']) -> format('Y-m-d');
        $data['from'] = Carbon::createFromFormat('H:i' , $data['from']) -> format('h:i a') ;
        $data['to'] = Carbon::createFromFormat('H:i' , $data['to']) -> format('h:i a') ;
        EmployeePermission::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('employee-permissions.index');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeePermission $request, $id)
    {
        $data = $request -> validated();
        $data['date'] = Carbon::createFromFormat('d/m/Y' , $data['date']) -> format('Y-m-d');
        $permission = EmployeePermission::findorfail($id);
        $data['from'] = Carbon::createFromFormat('H:i' , $data['from']) -> format('h:i a') ;
        $data['to'] = Carbon::createFromFormat('H:i' , $data['to']) -> format('h:i a') ;
        $permission -> update($data);
        flash()->addSuccess(__('Updated successfully'));
        return redirect()->route('employee-permissions.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = EmployeePermission::findorfail($id);
        $row-> delete();
        flash()->addSuccess(__('Deleted successfully'));
        return redirect()->route('employee-permissions.index');
    }
}
