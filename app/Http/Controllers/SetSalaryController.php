<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AllowanceOption;
use App\Models\Commission;
use App\Models\DeductionOption;
use App\Models\Employee;
use App\Models\AttendanceMovement;
use App\Models\Loan;
use App\Models\LoanOption;
use App\Models\OtherPayment;
use App\Models\Overtime;
use App\Models\Absence;
use App\Models\PayslipType;
use App\Models\SaturationDeduction;
use App\Models\AttendanceEmployee;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use DB;

class SetSalaryController extends Controller
{
    public function index()
    {
        if(auth()->user()->can('Manage Set Salary'))
        {
            $employees = Employee::where(
                [
                    'created_by' => auth()->user()->creatorId(),
                ]
            )->get();

            return view('setsalary.index', compact('employees'));
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function edit($id)
    {

        if(auth()->user()->can('Edit Set Salary'))
        {

            $payslip_type      = PayslipType::get()->pluck('name', 'id');
            $allowance_options = AllowanceOption::get()->pluck('name', 'id');
            $loan_options      = LoanOption::get()->pluck('name', 'id');
            $deduction_options = DeductionOption::get()->pluck('name', 'id');
            if(auth()->user()->type == 'employee')
            {
                $currentEmployee      = Employee::where('user_id', '=', auth()->user()->id)->first();
                $allowances           = Allowance::where('employee_id', $currentEmployee->id)->get();
                $commissions          = Commission::where('employee_id', $currentEmployee->id)->get();
                $loans                = Loan::where('employee_id', $currentEmployee->id)->get();
                $saturationdeductions = SaturationDeduction::where('employee_id', $currentEmployee->id)->get();
                $otherpayments        = OtherPayment::where('employee_id', $currentEmployee->id)->get();
                $overtimes            = Overtime::where('employee_id', $currentEmployee->id)->get();
                $employee             = Employee::where('user_id', '=', auth()->user()->id)->first();

                return view('setsalary.employee_salary', compact('employee', 'payslip_type', 'allowance_options', 'commissions', 'loan_options', 'overtimes', 'otherpayments', 'saturationdeductions', 'loans', 'deduction_options', 'allowances'));

            }
            else
            {
                $allowances           = Allowance::where('employee_id', $id)->get();
                $commissions          = Commission::where('employee_id', $id)->get();
                $loans                = Loan::where('employee_id', $id)->get();
                $saturationdeductions = SaturationDeduction::where('employee_id', $id)->get();
                $otherpayments        = OtherPayment::where('employee_id', $id)->get();
                $overtimes            = Overtime::where('employee_id', $id)->get();
                $employee             = Employee::find($id);

                return view('setsalary.edit', compact('employee', 'payslip_type', 'allowance_options', 'commissions', 'loan_options', 'overtimes', 'otherpayments', 'saturationdeductions', 'loans', 'deduction_options', 'allowances'));
            }
        }
        else
        {
            flash()->addError(__('Permission denied'));
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $payslip_type         = PayslipType::get()->pluck('name', 'id');
        $allowance_options    = AllowanceOption::get()->pluck('name', 'id');
        $loan_options         = LoanOption::get()->pluck('name', 'id');
        $deduction_options    = DeductionOption::get()->pluck('name', 'id');
        $attendancemovement   = AttendanceMovement::whereNull('status')->first();

        if(auth()->user()->type == 'employee')
        {
            $currentEmployee      = Employee::where('user_id', '=', auth()->user()->id)->first();
            $allowances           = Allowance::where('employee_id', $currentEmployee->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $commissions          = Commission::where('employee_id', $currentEmployee->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $loans                = Loan::where('employee_id', $currentEmployee->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $saturationdeductions = SaturationDeduction::where('employee_id', $currentEmployee->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $otherpayments        = OtherPayment::where('employee_id', $currentEmployee->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $overtimes            = Overtime::where('employee_id', $currentEmployee->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $absences             = Absence::where('employee_id', $currentEmployee->id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereDate('start_date','>=',$attendancemovement->start_movement_date)->whereDate('end_date','<=',$attendancemovement->end_movement_date);
            })->with('leave.leaveType')->get();
            $employee             = Employee::where('user_id', '=', auth()->user()->id)->first();
            return view('setsalary.employee_salary', compact('employee', 'payslip_type','absences','allowance_options', 'commissions', 'loan_options', 'overtimes', 'otherpayments', 'saturationdeductions', 'loans', 'deduction_options', 'allowances'));
        }
        else
        {
            $allowances           = Allowance::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $commissions          = Commission::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $loans                = Loan::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $saturationdeductions = SaturationDeduction::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $otherpayments        = OtherPayment::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $overtimes            = Overtime::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereBetween(DB::raw('DATE(date)'), [$attendancemovement->start_movement_date, $attendancemovement->end_movement_date]);
            })->get();
            $absences             = Absence::where('employee_id', $id)
            ->when($attendancemovement, function ($q) use($attendancemovement) {
                return $q->whereDate('start_date','>=',$attendancemovement->start_movement_date)->whereDate('end_date','<=',$attendancemovement->end_movement_date);
            })->with('leave.leaveType')->get();
            $employee             = Employee::find($id);
            return view('setsalary.employee_salary', compact('employee','absences','payslip_type', 'allowance_options', 'commissions', 'loan_options', 'overtimes', 'otherpayments', 'saturationdeductions', 'loans', 'deduction_options', 'allowances'));
        }
    }

    public function employeeUpdateSalary(Request $request, $id)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'salary_type' => 'required',
                               'salary' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $employee = Employee::findOrFail($id);
        $input    = $request->all();
        $employee->fill($input)->save();

        return redirect()->back()->with('success', 'Employee Salary Updated.');
    }

    public function employeeSalary()
    {
        if(auth()->user()->type == "employee")
        {
            $employees = Employee::where('user_id', auth()->user()->id)->get();

            return view('setsalary.index', compact('employees'));
        }
    }

    public function employeeBasicSalary($id)
    {

        $payslip_type = PayslipType::get()->pluck('name', 'id');
        $employee     = Employee::find($id);

        return view('setsalary.basic_salary', compact('employee', 'payslip_type'));
    }
}
