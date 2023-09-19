@php
    $logo = asset(Storage::url('uploads/logo/'));
    $company_logo = Utility::getValByName('company_logo');
@endphp

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{ __('Monthly payroll Log') }} </title>
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    @if (env('SITE_RTL') == 'on' || app()->getLocale() == 'ar')
        <link href="{{ asset('admin/assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    @endif
    <link href="{{ asset('admin/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
</head>

<style>
    table thead {
        position: sticky;
        top: 0;
        background: #495057;
        color: #fff;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 10px;
    }

    td {
        text-align: center;
        width: 5%;
    }

    th {
        background: rgb(0 0 0 / 50%);
        text-align: center;
        width: 5%;
    }
</style>

<body>
    <div class="card container mt-4 bg-none card-box">
        <h5 class="text-center d-print-none">
            <a href="" class="btn" onclick="window.print()"> <i class="fa fa-print"></i> </a>
            <a href="" class="btn download-pdf"> <i class="fa fa-download"></i> </a>
        </h5>

        <div class="invoice " style="padding:1%;" id="printableArea">

            <div class="row text-sm">
                <div class="col-md-4">
                    <address style="text-align:right">
                        <p> {{ \Utility::getValByName('company_name') }} </p>
                        <p> {{ __('Created By') }} {{ auth()->user()->name }} </p>
                        <p></p>
                    </address>
                </div>

                <div class="col-md-4">
                    <h4 style="border:3px solid;padding:1%;" class="text-center"> {{ __('Monthly payroll Log') }} </h4>
                    <h5 class="text-center"> {{ $months[$month] . ' - ' . $year }}</h5>
                </div>

                <div class="col-md-4">
                    <address>
                        <p> {{ date('Y/m/d') }} </p>
                        <p> {{ date('H:i:s') }} </p>
                        <p></p>
                    </address>
                </div>
            </div>

            <div class="invoice-print">
                <table class="border-0" width="100%">
                    <thead>
                        <tr>
                            @if ($payroll_settings[0]['name'] == 'Employee Code' && $payroll_settings[0]['payroll_dispaly'] == 1)
                                <th>{{ __('Employee Code') }}</th>
                            @endif

                            @if ($payroll_settings[1]['name'] == 'Name' && $payroll_settings[1]['payroll_dispaly'] == 1)
                                <th>{{ __('Name') }}</th>
                            @endif

                            @if ($payroll_settings[2]['name'] == 'Job' && $payroll_settings[2]['payroll_dispaly'] == 1)
                                <th>{{ __('Job') }}</th>
                            @endif

                            @if ($payroll_settings[3]['name'] == 'Work Days' && $payroll_settings[3]['payroll_dispaly'] == 1)
                                <th> {{ __('Work Days') }}</th>
                            @endif

                            @if ($payroll_settings[4]['name'] == 'Basic Salary' && $payroll_settings[4]['payroll_dispaly'] == 1)
                                <th>{{ __('Basic Salary') }}</th>
                            @endif

                            @foreach ($allowoptions as $option)
                                <th>{{ $option['name' . $lang] }}</th>
                            @endforeach

                            @if ($payroll_settings[5]['name'] == 'Other allowances' && $payroll_settings[5]['payroll_dispaly'] == 1)
                                <th>{{ __('Other allowances') }}</th>
                            @endif

                            @if ($payroll_settings[6]['name'] == 'OverTime' && $payroll_settings[6]['payroll_dispaly'] == 1)
                                <th>{{ __('OverTime') }}</th>
                            @endif

                            @if ($payroll_settings[7]['name'] == 'Sales percentage' && $payroll_settings[7]['payroll_dispaly'] == 1)
                                <th>{{ __('Sales percentage') }}</th>
                            @endif

                            @if ($payroll_settings[8]['name'] == 'Other dues' && $payroll_settings[8]['payroll_dispaly'] == 1)
                                <th>{{ __('Other dues') }}</th>
                            @endif

                            @if ($payroll_settings[9]['name'] == 'Total due' && $payroll_settings[9]['payroll_dispaly'] == 1)
                                <th>{{ __('Total due') }}</th>
                            @endif

                            @if ($payroll_settings[10]['name'] == 'Employee social insurance' && $payroll_settings[10]['payroll_dispaly'] == 1)
                                <th>{{ __('Employee social insurance') }}</th>
                            @endif

                            @if ($payroll_settings[11]['name'] == 'Employee medical insurance' &&
                                $payroll_settings[11]['payroll_dispaly'] == 1)
                                <th>{{ __('Employee medical insurance') }}</th>
                            @endif

                            @if ($payroll_settings[12]['name'] == 'Absence' && $payroll_settings[12]['payroll_dispaly'] == 1)
                                <th>{{ __('Absence') }}</th>
                            @endif

                            @if ($payroll_settings[13]['name'] == 'vacations' && $payroll_settings[13]['payroll_dispaly'] == 1)
                                <th>{{ __('vacations') }}</th>
                            @endif

                            @if ($payroll_settings[14]['name'] == 'Advanced Loans' && $payroll_settings[14]['payroll_dispaly'] == 1)
                                <th>{{ __('Advanced Loans') }}</th>
                            @endif

                            @if ($payroll_settings[15]['name'] == 'Other deductions' && $payroll_settings[15]['payroll_dispaly'] == 1)
                                <th>{{ __('Other deductions') }}</th>
                            @endif

                            @if ($payroll_settings[16]['name'] == 'Total deduction' && $payroll_settings[16]['payroll_dispaly'] == 1)
                                <th>{{ __('Total deduction') }}</th>
                            @endif

                            @if ($payroll_settings[17]['name'] == 'net salary' && $payroll_settings[17]['payroll_dispaly'] == 1)
                                <th>{{ __('net salary') }}</th>
                            @endif

                            @if(auth()->user()->creatorId() == 22)
                                @if ($payroll_settings[18]['name'] == 'Currency rate' && $payroll_settings[18]['payroll_dispaly'] == 1)
                                    <th>{{ __('Currency rate') }}</th>
                                @endif

                                @if ($payroll_settings[19]['name'] == 'Egyptian net salary' && $payroll_settings[19]['payroll_dispaly'] == 1)
                                    <th>{{ __('Egyptian net salary') }}</th>
                                @endif
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="20" class="border-0 pt-3 pb-3"></td>
                        </tr>
                        @foreach($payslip as $employee)
                            @php
                                $allowances = json_decode($employee->allowance);
                                $totalBasicSalary += !empty($employee->basic_salary) ? $employee->basic_salary : 0;
                                $totalOtherAllowance += collect(json_decode($employee->allowance))
                                    ->whereNotIn('allowance_option', $allowoptions->pluck('id'))
                                    ->sum('amount');
                                $totalOverTime += collect(json_decode($employee->overtime))->sum('rate');
                                $totalCommission += collect(json_decode($employee->commission))->sum('amount');
                                $totalOtherPayment += collect(json_decode($employee->other_payment))->sum('amount');
                                $totalDue += $employee->getTotalDue($employee->id);
                                $totalinsurance += $employee->insurance($employee->id, 'employee');
                                $totalMedicalInsurance += $employee->medical_insurance($employee->id, 'employee');
                                $totalAbsence +=
                                    collect(json_decode($employee->absence))
                                        ->where('type', 'A')
                                        ->sum('number_of_days') *
                                        $employee->getEmployeeSalaryPerDay($employee->id) *
                                        $salarysetting->absence_with_permission_discount +
                                    collect(json_decode($employee->absence))
                                        ->where('type', 'X')
                                        ->sum('number_of_days') *
                                        ($employee->getEmployeeSalaryPerDay($employee->id) * $salarysetting->absence_without_permission_discount);

                                $totalAbsenceLeaves       += json_decode($employee->absenceLeaves(($employee->id)))->totalDeduction;
                                $totalLoan += collect(json_decode($employee->loan))->sum('amount');
                                $totalsaturationDeduction += collect(json_decode($employee->saturation_deduction))->sum('amount');
                                $totalDeduction += $employee->getTotalDeduction($employee->id);
                                $totalNetSalary += $employee->getNetSalary($employee->id);
                            @endphp
                            <tr>
                                @if ($payroll_settings[0]['name'] == 'Employee Code' && $payroll_settings[0]['payroll_dispaly'] == 1)
                                    <td>{{ auth()->user()->employeeIdFormat($employee->employee_id) }}</td>
                                @endif

                                @if ($payroll_settings[1]['name'] == 'Name' && $payroll_settings[1]['payroll_dispaly'] == 1)
                                    <td>{{ $employee->name }}</td>
                                @endif

                                @if ($payroll_settings[2]['name'] == 'Job' && $payroll_settings[2]['payroll_dispaly'] == 1)
                                    <td>{{ $employee->employee($employee->id) ? $employee->employee($employee->id)->jobtitle['name' . $lang] : '' }}
                                    </td>
                                @endif

                                @if ($payroll_settings[3]['name'] == 'Work Days' && $payroll_settings[3]['payroll_dispaly'] == 1)
                                    <td>{{ $employee->workdays($employee->id) }}</td>
                                @endif

                                @if ($payroll_settings[4]['name'] == 'Basic Salary' && $payroll_settings[4]['payroll_dispaly'] == 1)
                                    <td>{{ !empty($employee->basic_salary) ? auth()->user()->priceFormat($employee->basic_salary) : '0' }}
                                    </td>
                                @endif

                                @foreach ($allowoptions as $option)
                                    @php
                                        $totalallowance += collect(json_decode($employee->allowance))
                                            ->where('allowance_option', $option->id)
                                            ->sum('amount');
                                    @endphp
                                    <td> {{ collect(json_decode($employee->allowance))->where('allowance_option', $option->id)->sum('amount') }}
                                    </td>
                                @endforeach

                                @if ($payroll_settings[5]['name'] == 'Other allowances' && $payroll_settings[5]['payroll_dispaly'] == 1)
                                    <td>
                                        {{ collect(json_decode($employee->allowance))->whereNotIn('allowance_option', $allowoptions->pluck('id'))->sum('amount') }}
                                    </td>
                                @endif

                                @if ($payroll_settings[6]['name'] == 'OverTime' && $payroll_settings[6]['payroll_dispaly'] == 1)
                                    <td>{{ collect(json_decode($employee->overtime))->sum('rate') }}</td>
                                @endif

                                @if ($payroll_settings[7]['name'] == 'Sales percentage' && $payroll_settings[7]['payroll_dispaly'] == 1)
                                    <td>{{ collect(json_decode($employee->commission))->sum('amount') }}</td>
                                @endif

                                @if ($payroll_settings[8]['name'] == 'Other dues' && $payroll_settings[8]['payroll_dispaly'] == 1)
                                    <td> {{ collect(json_decode($employee->other_payment))->sum('amount') }} </td>
                                @endif

                                @if ($payroll_settings[9]['name'] == 'Total due' && $payroll_settings[9]['payroll_dispaly'] == 1)
                                    <td>
                                        {{ $employee->getTotalDue($employee->id) }}
                                    </td>
                                @endif

                                @if ($payroll_settings[10]['name'] == 'Employee social insurance' && $payroll_settings[10]['payroll_dispaly'] == 1)
                                    <td>{{ $employee->insurance($employee->id, 'employee') }}</td>
                                @endif

                                @if ($payroll_settings[11]['name'] == 'Employee medical insurance' &&
                                    $payroll_settings[11]['payroll_dispaly'] == 1)
                                    <td>{{ $employee->medical_insurance($employee->id, 'employee') }}</td>
                                @endif

                                @if ($payroll_settings[12]['name'] == 'Absence' && $payroll_settings[12]['payroll_dispaly'] == 1)
                                    <td>{{ collect(json_decode($employee->absence))->where('type', 'A')->sum('number_of_days') *
                                        $employee->getEmployeeSalaryPerDay($employee->id) *
                                        $salarysetting->absence_with_permission_discount +
                                        collect(json_decode($employee->absence))->where('type', 'X')->sum('number_of_days') *
                                            ($employee->getEmployeeSalaryPerDay($employee->id) * $salarysetting->absence_without_permission_discount) }}
                                    </td>
                                @endif

                                @if($payroll_settings[13]['name'] == 'vacations' && $payroll_settings[13]['payroll_dispaly'] == 1)
                                    <td>
                                        {{ number_format(json_decode($employee->absenceLeaves(($employee->id)))->totalDeduction , 2) }}
                                    </td>
                                @endif

                                @if ($payroll_settings[14]['name'] == 'Advanced Loans' && $payroll_settings[14]['payroll_dispaly'] == 1)
                                    <td>{{ collect(json_decode($employee->loan))->sum('amount') }}</td>
                                @endif

                                @if ($payroll_settings[15]['name'] == 'Other deductions' && $payroll_settings[15]['payroll_dispaly'] == 1)
                                    <td>{{ collect(json_decode($employee->saturation_deduction))->sum('amount') }}</td>
                                @endif

                                @if ($payroll_settings[16]['name'] == 'Total deduction' && $payroll_settings[16]['payroll_dispaly'] == 1)
                                    <td>{{ $employee->getTotalDeduction($employee->id) }}</td>
                                @endif

                                @if ($payroll_settings[17]['name'] == 'net salary' && $payroll_settings[17]['payroll_dispaly'] == 1)
                                    <td>
                                        {{ $employee->getNetSalary($employee->id) }}
                                    </td>
                                @endif

                                @if(auth()->user()->creatorId() == 22)
                                    @if ($payroll_settings[18]['name'] == 'Currency rate' && $payroll_settings[18]['payroll_dispaly'] == 1)
                                        <td>
                                            {{ number_format($currency_rate , 2) }}
                                        </td>
                                    @endif

                                    @if ($payroll_settings[19]['name'] == 'Egyptian net salary' && $payroll_settings[19]['payroll_dispaly'] == 1)
                                        <td>
                                            {{ number_format($employee->getNetSalary($employee->id) * $currency_rate , 2) }}
                                        </td>                                    
                                    @endif

                                @endif
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="20" class="border-0 pt-3 pb-3"></td>
                        </tr>

                        <tr>
                            <td colspan="{{$itemsCount}}" class="pt-3 pb-3">{{ __('Total') }}</td>
                            @if ($payroll_settings[4]['name'] == 'Basic Salary' && $payroll_settings[4]['payroll_dispaly'] == 1)
                                <td>{{ auth()->user()->priceFormat($totalBasicSalary) }}</td>
                            @endif

                            @foreach ($allowoptions as $option)
                                <td>{{ auth()->user()->priceFormat($totalallowance) }}</td>
                            @endforeach

                            @if ($payroll_settings[5]['name'] == 'Other allowances' && $payroll_settings[5]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalOtherAllowance) }}</td>
                            @endif

                            @if ($payroll_settings[6]['name'] == 'OverTime' && $payroll_settings[6]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalOverTime) }}</td>
                            @endif

                            @if ($payroll_settings[7]['name'] == 'Sales percentage' && $payroll_settings[7]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalCommission) }}</td>
                            @endif

                            @if ($payroll_settings[8]['name'] == 'Other dues' && $payroll_settings[8]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalOtherPayment) }}</td>
                            @endif

                            @if ($payroll_settings[9]['name'] == 'Total due' && $payroll_settings[9]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalDue) }}</td>
                            @endif

                            @if ($payroll_settings[10]['name'] == 'Employee social insurance' && $payroll_settings[10]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalinsurance) }}</td>
                            @endif

                            @if ($payroll_settings[11]['name'] == 'Employee medical insurance' && $payroll_settings[11]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalMedicalInsurance) }}</td>
                            @endif

                            @if ($payroll_settings[12]['name'] == 'Absence' && $payroll_settings[12]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalAbsence) }}</td>
                            @endif

                            @if ($payroll_settings[13]['name'] == 'vacations' && $payroll_settings[13]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalAbsenceLeaves) }}</td>
                            @endif

                            @if ($payroll_settings[14]['name'] == 'Advanced Loans' && $payroll_settings[14]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalLoan) }}</td>
                            @endif

                            @if ($payroll_settings[15]['name'] == 'Other deductions' && $payroll_settings[15]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalsaturationDeduction) }}</td>
                            @endif

                            @if ($payroll_settings[16]['name'] == 'Total deduction' && $payroll_settings[16]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalDeduction) }}</td>
                            @endif

                            @if ($payroll_settings[17]['name'] == 'net salary' && $payroll_settings[17]['payroll_dispaly'] == 1)
                            <td>{{ auth()->user()->priceFormat($totalNetSalary) }}</td>
                            @endif

                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="text-md-right row pb-2 text-sm">
                <div class="float-lg-left col-md-3 mb-lg-0 mb-3 ">
                    <p class="mt-2">{{ __('Human Resources Officer') }}</p>
                    <p> ................................ </p>
                </div>
                <div class="float-lg-left col-md-3 mb-lg-0 mb-3 ">
                    <p class="mt-2">{{ __('Human Resources Manager') }}</p>
                    <p> ................................ </p>
                </div>
                <div class="float-lg-left col-md-3 mb-lg-0 mb-3 ">
                    <p class="mt-2">{{ __('financial manager') }}</p>
                    <p> ................................ </p>
                </div>
                <div class="float-lg-left col-md-3 mb-lg-0 mb-3 ">
                    <p class="mt-2">{{ __('CEO') }}</p>
                    <p> ................................ </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('admin/assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('admin/assets/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>

    <script>
        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: 'Payroll - {{ $months[$month] . ' - ' . $year }}',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 6,
                    dpi: 100,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A4',
                    orientation: 'landscape'
                }
            };
            html2pdf().set(opt).from(element).save();
        }

        $('.download-pdf').on('click', function(e) {
            e.preventDefault();
            saveAsPDF();
        })
    </script>

</body>

</html>
