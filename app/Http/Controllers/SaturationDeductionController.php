<?php

namespace App\Http\Controllers;

use App\Exports\DeductionExport;
use App\Exports\SaturationdeductionExport;
use App\Models\DeductionOption;
use App\Models\Employee;
use App\Models\SaturationDeduction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SaturationDeductionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Saturationdeduction-List', ['only' => ['index']]);
        $this->middleware('permission:Saturationdeduction-Create', ['only' => ['saturationdeductionCreate','create','store']]);
        $this->middleware('permission:Saturationdeduction-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Saturationdeduction-Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Saturationdeduction-Print', ['only' => ['print']]);
    }
    
    public function index(Request $request)
    {
        $deductions        = SaturationDeduction::with('employee')->latest();
        $deduction_options = DeductionOption::get();

        if(request('search')){
            $deductions = $deductions->where(function($q){
                $start = back_date(request('start_date'));
                $end   = back_date(request('end_date'));

                $q->where('date' , 'like' , '%'.request('search').'%')
                  ->orwhere('date'  , 'like' , '%'.request('search').'%')
                  ->orwhereHas('employee' , function($q){
                        $q->where('name' , 'like' , '%' . request('search') . '%' )
                          ->orwhere('name_ar' , 'like' , '%' . request('search') . '%');
                });
            });
        }

        // if(request('start_date') && request('end_date')) {
        //     $start = back_date(request('start_date'));
        //     $end   = back_date(request('end_date'));
        //     $deductions->whereBetween("date", [$start, $end]);
        // }

        $deductions = $deductions->paginate(10);
        if($request->ajax()) {
            $search   = view('new-theme.employee.deduction.deduction', compact("deductions","deduction_options"));
            $paginate = view('new-theme.employee.deduction.paginate', compact("deductions"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        return view('new-theme.employee.deduction.index', compact('deductions','deduction_options'));
    }

    public function saturationdeductionCreate($id)
    {
        $employee          = Employee::find($id);
        $deduction_options = DeductionOption::get();
        return view('new-theme.payroll.saturation.create', compact('employee', 'deduction_options'));
    }

    public function create()
    {
        $employees = Employee::where('is_active',1)->get();
        $deduction_options = DeductionOption::get();
        return view('new-theme.payroll.saturation.create', compact( 'deduction_options','employees'));
    }

    public function store(Request $request)
    {
        \request()->validate([
            'employee_id'      => 'required',
            'deduction_option' => 'required',
            'title'            => 'required',
            'amount'           => 'required',
            'date'             => 'required',
            'percent'          => 'required',
       ]);

        $saturationdeduction                   = new SaturationDeduction;
        $saturationdeduction->employee_id      = $request->employee_id;
        $saturationdeduction->deduction_option = $request->deduction_option;
        $saturationdeduction->title            = $request->title;
        $saturationdeduction->amount           = $request->amount;
        $saturationdeduction->percent          = $request->percent;
        $saturationdeduction->date             = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $saturationdeduction->created_by       = auth()->user()->creatorId();
        $saturationdeduction->save();

        flash()->addSuccess(__('Added successfully'));
        return redirect()->back();
    }

    public function show(SaturationDeduction $saturationdeduction)
    {
       //
    }

    public function edit($saturationdeduction)
    {
        $saturationdeduction = SaturationDeduction::find($saturationdeduction);
        if($saturationdeduction->created_by == auth()->user()->creatorId())
        {
            $deduction_options = DeductionOption::get();
            return view('new-theme.payroll.saturation.edit', compact('saturationdeduction', 'deduction_options'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, SaturationDeduction $saturationdeduction)
    {
        if($saturationdeduction->created_by == auth()->user()->creatorId())
        {
            \request()->validate([
                'deduction_option' => 'required',
                'title'            => 'required',
                'amount'           => 'required',
                'date'             => 'required',
                'percent'          => 'sometimes',
           ]);

            $saturationdeduction->deduction_option = $request->deduction_option;
            $saturationdeduction->title            = $request->title;
            $saturationdeduction->amount           = $request->amount;
            $saturationdeduction->percent          = $request->percent;
            $saturationdeduction->date             = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
            $saturationdeduction->save();

            flash()->addSuccess(__('Updated successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function destroy(SaturationDeduction $saturationdeduction)
    {
        if($saturationdeduction->created_by == auth()->user()->creatorId())
        {
            $saturationdeduction->delete();
            flash()->addSuccess(__('Deleted successfully'));
            return redirect()->back();
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function calculate_deduction_percent(Request $request)
    {
        $employee        = Employee::where('id',$request->employee_id)->first();
        $salaryPerDay    = $employee->getSalaryPerDay($request->employee_id);
        $total_percent   = ($salaryPerDay * $request->percent) / 100 ;
        return round($total_percent);
    }

    public function export($id)
    {
        return Excel::download(new SaturationdeductionExport($id), 'saturationdeduction.xlsx');
    }

    public function deduction_export()
    {
        return Excel::download(new DeductionExport, 'Deduction.xlsx');
    }
}
