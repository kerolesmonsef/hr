<?php

namespace App\Http\Controllers;

use App\Exports\ShiftExport;
use App\Http\Requests\NewTheme\StoreShift;
use App\Http\Requests\NewTheme\UpdateShift;
use App\Models\Employee_shift;
use App\Models\EmployeeShift;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ShiftController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Shift-List', ['only' => ['index']]);
        $this->middleware('permission:Shift-Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Shift-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Shift-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Shift-Export', ['only' => ['export']]);
        $this->middleware('permission:Shift-Print', ['only' => ['print']]);
    }

    public function export()
    {
        return Excel::download(new ShiftExport, 'shifts.xlsx');
    }

    public function print()
    {
        return (new ShiftExport())->view();
    }

    public function index(Request $request)
    {
        $shifts = Employee_shift::where([
            'created_by' => auth()->user()->creatorId(),
        ])->with('employees')
            ->latest();
        if (request('search')) {
            $shifts = $shifts->where(function ($q) {
                $q->where('name_ar', 'like', '%' . request('search') . '%')
                    ->orWhere('name', 'like', '%' . request('search') . '%');
            });
        }
        $shifts = $shifts->paginate(10);
        if ($request->ajax()) {
            $search = view('new-theme.employee.shifts.shifts', compact("shifts"));
            $paginate = view('new-theme.employee.shifts.paginate', compact("shifts"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.employee.shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('new-theme.employee.shifts.create');
    }

    public function store(StoreShift $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->user()->creatorId();
        $shift = EmployeeShift::create($data);
        flash()->addSuccess(__('Added successfully'));
        return redirect()->route('employee-shifts.index');
    }

    public function show(Employee_shift $Employee_shift)
    {
        //
    }

    public function update(UpdateShift $request, $id)
    {
        $data = $request->validated();
        $shift = EmployeeShift::findorfail($id);
        $shift->update($data);
        flash()->addSuccess(__('Updated successfully'));
        return redirect()->route('employee-shifts.index');
    }

    public function destroy($Employee_shift_id)
    {
        if (auth()->user()->can('Delete Employee')) {
            $Employee_shift = Employee_shift::find($Employee_shift_id);
            if ($Employee_shift->created_by == auth()->user()->creatorId()) {
                $Employee_shift->delete();
                return redirect()->route('employee-shifts.index')->with('success', __('Employee_shift successfully deleted.'));
            } else {
                flash()->addError(__('Permission denied'));
                return redirect()->back();
            }
        } else {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }


}
