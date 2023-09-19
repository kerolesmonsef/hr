<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\Controller;
use App\Http\Resources\PayrollResource;
use App\Mail\sendemail;
use App\Models\AttendanceMovement;
use App\Models\Employee;
use App\Models\PaySlip;
use App\Traits\ApiResponser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class PayrollController extends Controller
{
    use ApiResponser;

    public function index()
    {
        request()->validate([
            'month' => 'nullable|date|date_format:Y-m',
        ]);

        $employee = auth()->user()->employee;
        $payslip = PaySlip::query()->select(
            [
                'employees.id',
                'employees.employee_id',
                'employees.name',
                'employees.residence_number',
                'employees.Join_date_gregorian',
                'employees.jobtitle_id',
                'payslip_types.name as payroll_type',
                'pay_slips.allowance',
                'pay_slips.commission',
                'pay_slips.loan',
                'pay_slips.is_recieved',
                'pay_slips.saturation_deduction',
                'pay_slips.other_payment',
                'pay_slips.overtime',
                'pay_slips.absence',
                'pay_slips.basic_salary',
                'pay_slips.net_payble',
                'pay_slips.id as pay_slip_id',
                'pay_slips.status',
                'pay_slips.salary_month',
                'employees.user_id',
            ]
        )->leftjoin(
            'employees',
            function ($join) {
                $join->on('employees.id', '=', 'pay_slips.employee_id');
                $join->leftjoin('payslip_types', 'payslip_types.id', '=', 'employees.salary_type');
            }
        )
            ->when(request('month'), function ($query) {
                $query->where('pay_slips.salary_month', request('month'));
            })->when(!request('month'), function ($query) {
                $query->latest("pay_slips.id");
            })
            ->where('employees.id', $employee->id)
            ->first();

        if ($payslip)
            return $this->success([
                'payroll' => $payslip ? new PayrollResource($payslip) : null
            ]);

        return $this->error(__("There is no payroll for this month"));

    }

}
