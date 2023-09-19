<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Models\AllowanceOption;
use App\Models\Commission;
use App\Models\Employee;
use App\Models\Loan;
use App\Models\AttendanceMovement;
use App\Models\Absence;
use App\Mail\InvoiceSend;
use App\Mail\PayslipSend;
use App\Models\OtherPayment;
use App\Models\Overtime;
use App\Models\PaySlip;
use App\Models\SaturationDeduction;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaySlipExport;
use App\Models\Department;
use App\Models\PayrollSetting;
use App\Models\Salary_setting;
use Illuminate\Support\Facades\Http;
use Carbon\carbon;
use DB;
use Illuminate\Pagination\Paginator;

class PaySlipController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Payroll-List', ['only' => ['index']]);
        $this->middleware('permission:Payroll-Create', ['only' => ['create','store']]);
        $this->middleware('permission:Payroll-View', ['only' => ['showemployee']]);
        $this->middleware('permission:Payroll-Export', ['only' => ['export']]);
        $this->middleware('permission:Payroll-Print', ['only' => ['print']]);
        $this->middleware('permission:Payroll-MonthlySalaryRecord', ['only' => ['Payrollpdf']]);
        $this->middleware('permission:Payroll-PayrollTape', ['only' => ['Payrollbarpdf','employeePayrollbarpdf']]);
        $this->middleware('permission:Payroll-Payment', ['only' => ['paysalary','bulk_pay_create','bulkpayment']]);
    }


    public function index(Request $request)
    {
        $departments           = Department::where('created_by',auth()->user()->creatorId())->get();
        $currentAttendance     = auth()->user()->CurrentAttendanceMovement();
        $month                 = $currentAttendance ? Carbon::parse($currentAttendance->end_movement_date)->format('m') : date('m');
        $year                  = $currentAttendance ? Carbon::parse($currentAttendance->end_movement_date)->format('Y') : date('m');
        $formate_month_year    = request('datePicker') ? request('datePicker') : $year.'-'.$month;
        $type                  = '0,1';

        $employee_payroll  = PaySlip::whereHas('employees' , function($q) use($type) {
            $q->where('is_active',1)
            ->whereIn('contract_type',explode(',',$type))
            ->where('created_by',auth()->user()->creatorId())
            ->when(request('department'), function ($q) {
                return $q->where('department_id',request('department'));
            });
        })->where('salary_month',$formate_month_year);

        if(request('search')){
            $employee_payroll = $employee_payroll->where(function($q){
                $q->whereHas('employees' , function($q){
                    $q->where('name' , 'like' , '%' . request('search') . '%' )
                        ->orwhere('name_ar' , 'like' , '%' . request('search') . '%')
                        ->orwhere('id' , 'like' , '%' . request('search') . '%')
                        ->orwhere('salary' , request('search'));
                });
            });
        }

        $employee_payroll = $employee_payroll->paginate(10);

        $Employees       = PaySlip::where('salary_month', $formate_month_year)->get();
        $unpaidEmployees = PaySlip::where('salary_month', $formate_month_year)->where('status', '=', 0)->get();

        if($request->ajax()) {
            $search   = view('new-theme.payroll.payroll', compact("employee_payroll","formate_month_year","year","month"));
            $paginate = view('new-theme.payroll.paginate', compact("employee_payroll","Employees","unpaidEmployees","formate_month_year"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }

        return view('new-theme.payroll.index', compact('employee_payroll','departments','Employees','unpaidEmployees','month','year','type','formate_month_year','request'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $month = explode('/',$request->datepicker)[1];
        $year  = explode('/',$request->datepicker)[0];

        $formate_month_year = $year . '-' . $month;

        $validatePaysilp    = PaySlip::where('salary_month', '=', $formate_month_year)->pluck('employee_id');
        $employees          = Employee::get();


        if(!Utility::salary_setting()){
            return redirect()->route('payslip.index')->with('error', __('Please set Salary Setting.'));
        }

        foreach ($employees as $employee)
        {
            $payslipEmployee =  PaySlip::where('salary_month', '=', $formate_month_year)->where('employee_id',$employee->id)->first();

            if(!$payslipEmployee){
                $payslipEmployee                       = new PaySlip();
                $payslipEmployee->employee_id          = $employee->id;
            }

            $payslipEmployee->net_payble           = $employee->get_net_salary();
            $payslipEmployee->salary_month         = $formate_month_year;
            $payslipEmployee->status               = 0;
            $payslipEmployee->basic_salary         = !empty($employee->salary) ? $employee->salary : 0;

            $payslipEmployee->allowance            = $employee->allowance($employee->id);
            $payslipEmployee->commission           = $employee->commission($employee->id);
            $payslipEmployee->loan                 = $employee->loan($employee->id);
            $payslipEmployee->saturation_deduction = $employee->saturation_deduction($employee->id);
            $payslipEmployee->other_payment        = $employee->other_payment($employee->id);
            $payslipEmployee->overtime             = $employee->overtime($employee->id);
            $payslipEmployee->absence              = $employee->absence($employee->id);
            $payslipEmployee->created_by           = auth()->user()->creatorId();
            $payslipEmployee->save();

            // slack
            $setting = Utility::settings(auth()->user()->creatorId());
            $month = date('M Y', strtotime($payslipEmployee->salary_month . ' ' . $payslipEmployee->time));
            if(isset($setting['monthly_payslip_notification']) && $setting['monthly_payslip_notification'] == 1) {
                $msg = ("payslip generated of") . ' ' . $month . '.';
                Utility::send_slack_msg($msg);
            }

            // telegram
            $setting = Utility::settings(auth()->user()->creatorId());
            $month = date('M Y', strtotime($payslipEmployee->salary_month . ' ' . $payslipEmployee->time));
            if (isset($setting['telegram_monthly_payslip_notification']) && $setting['telegram_monthly_payslip_notification'] == 1) {
                $msg = ("payslip generated of") . ' ' . $month . '.';
                Utility::send_telegram_msg($msg);
            }

            // twilio
            $setting  = Utility::settings(auth()->user()->creatorId());
            $emp = Employee::where('id', $payslipEmployee->employee_id = auth()->user()->id)->first();
            if(isset($setting['twilio_payslip_notification']) && $setting['twilio_payslip_notification'] == 1) {
                $employeess = Employee::where($request->employee_id)->get();
                foreach ($employeess as $key => $employee) {
                    $msg = ("payslip generated of") . ' ' . $month . '.';

                    Utility::send_twilio_msg($emp->phone, $msg);
                }
            }
        }

        return redirect()->route('payslip.index')->with('success', __('Payslip successfully created.'));
    }

    public function destroy($id)
    {
        $payslip = PaySlip::find($id);
        $payslip->delete();

        return true;
    }

    public function showemployee($id)
    {
        $employee      = Employee::find($id);
        $insurance     = $employee->insurance($id,'employee');
        return view('new-theme.payroll.details', compact('employee','insurance'));
    }

    public function search_json(Request $request)
    {
        $formate_month_year = $request->datePicker;
        $type               = explode(',',$request->contract_type);

        $validatePaysilp    = PaySlip::where('salary_month', '=', $formate_month_year)->get()->toarray();
        $data = [];
        if(empty($validatePaysilp))
        {
            $data = [];
            return $data;
        }
        else
        {
            $paylip_employee = PaySlip::select(
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
                    'pay_slips.saturation_deduction',
                    'pay_slips.other_payment',
                    'pay_slips.overtime',
                    'pay_slips.absence',
                    'pay_slips.basic_salary',
                    'pay_slips.net_payble',
                    'pay_slips.id as pay_slip_id',
                    'pay_slips.status',
                    'employees.user_id',
                    'employees.contract_type',
                ]
            )->leftjoin(
                'employees',
                function ($join) use ($formate_month_year) {
                    $join->on('employees.id', '=', 'pay_slips.employee_id');
                    $join->on('pay_slips.salary_month', '=', \DB::raw("'" . $formate_month_year . "'"));
                    $join->leftjoin('payslip_types', 'payslip_types.id', '=', 'employees.salary_type');
                }
            )->whereIn('employees.contract_type',$type)->where('employees.is_active',1)->where('employees.created_by', auth()->user()->creatorId())->get();


            foreach ($paylip_employee as $employee) {
                if (auth()->user()->type == 'employee') {
                    if(auth()->user()->id == $employee->user_id) {
                        $tmp   = [];
                        $tmp[] = $employee->id;
                        $tmp[] = $employee->name;
                        $tmp[] = $employee->payroll_type;
                        $tmp[] = $employee->pay_slip_id;
                        $tmp[] = !empty($employee->basic_salary) ? auth()->user()->priceFormat($employee->basic_salary) : '-';
                        $tmp[] =  auth()->user()->priceFormat($employee->getNetSalary($employee));
                        if ($employee->status == 1) {
                            $tmp[] = 'paid';
                        } else {
                            $tmp[] = 'unpaid';
                        }
                        $tmp[]  = !empty($employee->pay_slip_id) ? $employee->pay_slip_id : 0;
                        $data[] = $tmp;
                    }
                } else {
                    $tmp   = [];
                    $tmp[] = $employee->id;
                    $tmp[] = auth()->user()->employeeIdFormat($employee->employee_id);
                    $tmp[] = $employee->name;
                    $tmp[] = $employee->payroll_type;
                    $tmp[] = !empty($employee->basic_salary) ? auth()->user()->priceFormat($employee->basic_salary) : '-';
                    $tmp[] = auth()->user()->priceFormat($employee->getNetSalary($employee));
                    if($employee->status == 1) {
                        $tmp[] = 'Paid';
                    } else {
                        $tmp[] = 'UnPaid';
                    }
                    $tmp[]  = !empty($employee->pay_slip_id) ? $employee->pay_slip_id : 0;
                    $data[] = $tmp;
                }
            }

            return $data;
        }
    }

    public function paysalary($id, $date)
    {
        $employeePayslip = PaySlip::where('employee_id', '=', $id)->where('salary_month', '=', $date)->first();
        if (!empty($employeePayslip)) {
            $employeePayslip->status = 1;
            $employeePayslip->save();

            return redirect()->route('payslip.index')->with('success', __('Payslip Payment successfully.'));
        } else {
            return redirect()->route('payslip.index')->with('error', __('Payslip Payment failed.'));
        }
    }
    
    public function bulk_pay_create($date)
    {
        $Employees       = PaySlip::where('salary_month', $date)->get();
        $unpaidEmployees = PaySlip::where('salary_month', $date)->where('status', '=', 0)->get();

        return view('payslip.bulkcreate', compact('Employees', 'unpaidEmployees', 'date'));
    }

    public function bulkpayment(Request $request, $date)
    {
        $unpaidEmployees = PaySlip::where('salary_month', $date)->where('status', '=', 0)->get();

        foreach ($unpaidEmployees as $employee) {
            $employee->status = 1;
            $employee->save();
        }

        return redirect()->route('payslip.index')->with('success', __('Payment completed successfully'));
    }

    public function employeepayslip()
    {
        $employees = Employee::where(
            [
                'user_id' => auth()->user()->id,
            ])->first();

        $payslip = PaySlip::where('employee_id', '=', $employees->id)->get();

        return view('payslip.employeepayslip', compact('payslip'));
    }

    public function pdf($id, $month)
    {
        $payslip       = PaySlip::where('employee_id', $id)->where('salary_month', $month)->first();
        $employee      = Employee::find($payslip->employee_id);
        $totalSalary   = $employee->get_totalsalary();
        $insurance     = $employee->insurance($payslip->employee_id,'employee');
        $payslipDetail = Utility::employeePayslipDetail($id);

        return view('payslip.pdf', compact('payslip', 'employee', 'payslipDetail','totalSalary','insurance'));
    }

    public function Payrollpdf($month,$year,$type)
    {
        // $attendancemovement = AttendanceMovement::whereNull('status')->first();
        // if(!$attendancemovement){
        //     return back();
        // }
        $currency_rate = Salary_setting::where('created_by',auth()->user()->creatorId())->first()['other_currency_rate'];
        $months = [
            '01' => __('JAN'),
            '02' => __('FEB'),
            '03' => __('MAR'),
            '04' => __('APR'),
            '05' => __('MAY'),
            '06' => __('JUN'),
            '07' => __('JUL'),
            '08' => __('AUG'),
            '09' => __('SEP'),
            '10' => __('OCT'),
            '11' => __('NOV'),
            '12' => __('DEC'),
        ];

        // $enddate = strtotime($attendancemovement->end_movement_date);
        // $month   = date('m',$enddate);
        // $year    = date('Y',$enddate);
        $formate_month_year = $year.'-'.$month;
        $payroll_type       = explode(',',$type);

        $payslip = PaySlip::select(
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
                'pay_slips.saturation_deduction',
                'pay_slips.other_payment',
                'pay_slips.overtime',
                'pay_slips.absence',
                'pay_slips.basic_salary',
                'pay_slips.net_payble',
                'pay_slips.id as pay_slip_id',
                'pay_slips.status',
                'employees.user_id',
            ]
        )->leftjoin(
            'employees',
            function ($join) use ($formate_month_year) {
                $join->on('employees.id', '=', 'pay_slips.employee_id');
                $join->on('pay_slips.salary_month', '=', \DB::raw("'" . $formate_month_year . "'"));
                $join->leftjoin('payslip_types', 'payslip_types.id', '=', 'employees.salary_type');
            }
        )->whereIn('employees.contract_type',$payroll_type)->where('employees.is_active',1)->where('employees.created_by', auth()->user()->creatorId())->get();

        $allowoptions    = AllowanceOption::where('created_by',auth()->user()->creatorId())->where('payroll_dispaly',1)->get();
        $payroll_settings = PayrollSetting::where('created_by',auth()->user()->creatorId())->get(['name','payroll_dispaly'])->toArray();
        $topScores = array_slice( $payroll_settings, 0, 4 );

        $items = array_filter($topScores,function($item){
            return $item['payroll_dispaly'] == 1;
        });

        $itemsCount = count($items);

        $totalBasicSalary = $totalallowance = $totalOtherAllowance = $totalOverTime = $totalCommission = $totalOtherPayment =
        $totalDue = $totalinsurance = $totalMedicalInsurance = $totalAbsence = $totalAbsence_S = $totalLoan =
        $totalsaturationDeduction = $totalDeduction = $totalNetSalary = $totalAbsenceLeaves = 0;
        return view('payslip.payrollpdf', compact('payslip','months','year','month','allowoptions','totalBasicSalary','totalallowance',
                                                  'totalOtherAllowance','totalOverTime','totalCommission','totalOtherPayment',
                                                   'totalDue','totalinsurance','totalMedicalInsurance','totalAbsence','totalNetSalary',
                                                   'totalAbsence_S','currency_rate','totalLoan','totalsaturationDeduction','totalDeduction','payroll_settings','itemsCount','totalAbsenceLeaves'));
    }

    public function Payrollbarpdf ($month,$year,$type)
    {
       
        // $attendancemovement = AttendanceMovement::whereNull('status')->first();
        // if(!$attendancemovement){
        //     return back();
        // }

        $months = [
            '01' => __('JAN'),
            '02' => __('FEB'),
            '03' => __('MAR'),
            '04' => __('APR'),
            '05' => __('MAY'),
            '06' => __('JUN'),
            '07' => __('JUL'),
            '08' => __('AUG'),
            '09' => __('SEP'),
            '10' => __('OCT'),
            '11' => __('NOV'),
            '12' => __('DEC'),
        ];

        $formate_month_year = $year.'-'.$month;
        $payroll_type       = explode(',',$type);

        $payslip = PaySlip::select(
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
                'pay_slips.saturation_deduction',
                'pay_slips.other_payment',
                'pay_slips.overtime',
                'pay_slips.absence',
                'pay_slips.basic_salary',
                'pay_slips.net_payble',
                'pay_slips.id as pay_slip_id',
                'pay_slips.status',
                'employees.user_id',
            ]
        )->leftjoin(
            'employees',
            function ($join) use ($formate_month_year) {
                $join->on('employees.id', '=', 'pay_slips.employee_id');
                $join->on('pay_slips.salary_month', '=', \DB::raw("'" . $formate_month_year . "'"));
                $join->leftjoin('payslip_types', 'payslip_types.id', '=', 'employees.salary_type');
            }
        )->whereIn('employees.contract_type',$payroll_type)->where('employees.is_active',1)->where('employees.created_by', auth()->user()->creatorId())->get();

        return view('payslip.payrollbarpdf', compact('payslip','months','year','month'));
    }

    public function employeePayrollbarpdf($id,$month,$year)
    {
        
        $months = [
            '01' => __('JAN'),
            '02' => __('FEB'),
            '03' => __('MAR'),
            '04' => __('APR'),
            '05' => __('MAY'),
            '06' => __('JUN'),
            '07' => __('JUL'),
            '08' => __('AUG'),
            '09' => __('SEP'),
            '10' => __('OCT'),
            '11' => __('NOV'),
            '12' => __('DEC'),
        ];

        $formate_month_year = $year.'-'.$month;

        $payslip = PaySlip::select(
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
                'pay_slips.saturation_deduction',
                'pay_slips.other_payment',
                'pay_slips.overtime',
                'pay_slips.absence',
                'pay_slips.basic_salary',
                'pay_slips.net_payble',
                'pay_slips.id as pay_slip_id',
                'pay_slips.status',
                'employees.user_id',
            ]
        )->leftjoin(
            'employees',
            function ($join) use ($formate_month_year) {
                $join->on('employees.id', '=', 'pay_slips.employee_id');
                $join->on('pay_slips.salary_month', '=', \DB::raw("'" . $formate_month_year . "'"));
                $join->leftjoin('payslip_types', 'payslip_types.id', '=', 'employees.salary_type');
            }
        )->where('employees.is_active',1)->where('pay_slips.id', $id)->get();

        return view('payslip.payrollbarpdf', compact('payslip','months','year','month'));
    }

    public function exportExcel($month , $year,$type)
    {
        $name = 'PayRoll_' . date('Y-m-d i:h:s');
        $payroll_type       = explode(',',$type);
        $data = Excel::download(new PaySlipExport($month , $year,$payroll_type), $name . '.xlsx');
        if(ob_get_contents()) ob_end_clean();
        return $data;
    }

    public function send($id, $month)
    {
        $payslip  = PaySlip::where('employee_id', $id)->where('salary_month', $month)->first();
        $employee = Employee::find($payslip->employee_id);

        $payslip->name  = $employee->name;
        $payslip->email = $employee->email;

        $payslipId    = ($payslip->id);
        $payslip->url = route('payslip.payslipPdf', $payslipId);

        $setings = Utility::settings();
        if ($setings['payroll_create'] == 1) {
            try {
                Mail::to($payslip->email)->send(new PayslipSend($payslip));
            } catch (\Exception $e) {
                $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
            }

            return redirect()->back()->with('success', __('Payslip successfully sent.') . (isset($smtp_error) ? $smtp_error : ''));
        }

        return redirect()->back()->with('success', __('Payslip successfully sent.'));
    }

    public function payslipPdf($id)
    {
        $payslipId = ($id);
        $payslip  = PaySlip::where('id', $payslipId)->first();
        $employee = Employee::find($payslip->employee_id);
        $insurance = $employee->insurance($payslip->employee_id);
        $payslipDetail = Utility::employeePayslipDetail($payslip->employee_id);
        return view('payslip.payslipPdf', compact('payslip', 'employee', 'payslipDetail','insurance'));
    }

    public function editEmployee($paySlip)
    {
        $payslip = PaySlip::find($paySlip);
        return view('payslip.salaryEdit', compact('payslip'));
    }

    public function updateEmployee(Request $request, $id)
    {

        if (isset($request->allowance) && !empty($request->allowance)) {
            $allowances   = $request->allowance;
            $allowanceIds = $request->allowance_id;
            foreach ($allowances as $k => $allownace) {
                $allowanceData         = Allowance::find($allowanceIds[$k]);
                $allowanceData->amount = $allownace;
                $allowanceData->save();
            }
        }

        if (isset($request->commission) && !empty($request->commission)) {
            $commissions   = $request->commission;
            $commissionIds = $request->commission_id;
            foreach ($commissions as $k => $commission) {
                $commissionData         = Commission::find($commissionIds[$k]);
                $commissionData->amount = $commission;
                $commissionData->save();
            }
        }

        if (isset($request->loan) && !empty($request->loan)) {
            $loans   = $request->loan;
            $loanIds = $request->loan_id;
            foreach ($loans as $k => $loan) {
                $loanData         = Loan::find($loanIds[$k]);
                $loanData->amount = $loan;
                $loanData->save();
            }
        }


        if (isset($request->saturation_deductions) && !empty($request->saturation_deductions)) {
            $saturation_deductionss   = $request->saturation_deductions;
            $saturation_deductionsIds = $request->saturation_deductions_id;
            foreach ($saturation_deductionss as $k => $saturation_deductions) {

                $saturation_deductionsData         = SaturationDeduction::find($saturation_deductionsIds[$k]);
                $saturation_deductionsData->amount = $saturation_deductions;
                $saturation_deductionsData->save();
            }
        }


        if (isset($request->other_payment) && !empty($request->other_payment)) {
            $other_payments   = $request->other_payment;
            $other_paymentIds = $request->other_payment_id;
            foreach ($other_payments as $k => $other_payment) {
                $other_paymentData         = OtherPayment::find($other_paymentIds[$k]);
                $other_paymentData->amount = $other_payment;
                $other_paymentData->save();
            }
        }


        if (isset($request->rate) && !empty($request->rate)) {
            $rates   = $request->rate;
            $rateIds = $request->rate_id;
            $hourses = $request->hours;

            foreach ($rates as $k => $rate) {
                $overtime        = Overtime::find($rateIds[$k]);
                $overtime->rate  = $rate;
                $overtime->hours = $hourses[$k];
                $overtime->save();
            }
        }


        $payslipEmployee                       = PaySlip::find($request->payslip_id);
        $payslipEmployee->allowance            = Employee::allowance($payslipEmployee->employee_id);
        $payslipEmployee->commission           = Employee::commission($payslipEmployee->employee_id);
        $payslipEmployee->loan                 = Employee::loan($payslipEmployee->employee_id);
        $payslipEmployee->saturation_deduction = Employee::saturation_deduction($payslipEmployee->employee_id);
        $payslipEmployee->other_payment        = Employee::other_payment($payslipEmployee->employee_id);
        $payslipEmployee->overtime             = Employee::overtime($payslipEmployee->employee_id);
        $payslipEmployee->net_payble           = Employee::find($payslipEmployee->employee_id)->get_net_salary();
        $payslipEmployee->save();

        return redirect()->route('payslip.index')->with('success', __('Employee payroll successfully updated.'));
    }

    public function export($m,$y)
    {
        return Excel::download(new PaySlipExport($m,$y), 'payroll.xlsx');
    }
}
