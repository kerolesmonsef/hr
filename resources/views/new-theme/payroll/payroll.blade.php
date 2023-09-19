@foreach ($employee_payroll as $value => $payroll)
    <tr data-row-key="{{ $payroll->employee_id }}" class="ant-table-row ant-table-row-level-0">

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $payroll->employee_id }}"
            aria-controls="id{{ $payroll->employee_id }}">
            <div class="userTabl user">
                <img src="{{ asset('new-theme/icons/all/user.svg') }}" />
            </div>

            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $payroll->employee_id }}"
            aria-controls="id{{ $payroll->employee_id }}">
            {{ auth()->user()->employeeIdFormat($payroll->employees->id) }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $payroll->employee_id }}"
            aria-controls="id{{ $payroll->employee_id }}">
            {{ $payroll->employees['name' . $lang] }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $payroll->employee_id }}"
            aria-controls="id{{ $payroll->employee_id }}">
            {{ $payroll->employees->jobtitle ? $payroll->employees->jobtitle['name' . $lang] : 'N/A' }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $payroll->employee_id }}"
            aria-controls="id{{ $payroll->employee_id }}">
            {{ $payroll->employees->department ? $payroll->employees->department['name' . $lang] : 'N/A' }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $payroll->employee_id }}"
            aria-controls="id{{ $payroll->employee_id }}">
            {{ auth()->user()->priceFormat($payroll->getNetSalary($payroll->employee_id)) }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $payroll->employee_id }}"
            aria-controls="id{{ $payroll->employee_id }}">
                @include("new-theme.payroll.components.payroll_status")
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td>
            <div style="width: 470px; cursor: initial;" class="offcanvas offcanvas-end" tabindex="-1" id="id{{ $payroll->employee_id }}" aria-labelledby="id1Label">
                <div class=" drawerS1">
                    <div class="head_ flex align between">
                        <div class="flex align gap-25">
                            <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                        fill="black" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                        fill="black" />
                                </svg>
                            </div>
                            <h3>{{ __('Payroll Details') }}</h3>
                        </div>
                        <div class="flex gap-15">

                            @can('Payroll-Payment')
                                <a href="{{ url('payslip/paysalary/'.$payroll->employee_id.'/'.$formate_month_year) }}">
                                    <img src="/new-theme/icons/all/card.svg" class="iconImg" />
                                </a>
                            @endcan
        
                            @can('Payroll-Print')
                                <img src="/new-theme/icons/all/print.svg" class="iconImg" />
                            @endcan

                            @can('Payroll-PayrollTape')
                                <a href="{{ route('payslip.employeePayrollbarpdf', [$payroll->id,explode('-',$formate_month_year)[1], explode('-',$formate_month_year)[0] ]) }}">
                                    <img src="/new-theme/icons/all/download.svg" class="iconImg" />
                                </a>
                            @endcan

                        </div>
                    </div>
        
                    <div class="contentDrawer scroll">
        
                        <div class="sectionDDS1 section">
                            <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                                aria-controls="employeeInformation">
                                <div class="ant-collapse">
                                    <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false" role="button"
                                        tabindex="0">
                                        <div class="ant-collapse-expand-icon">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1"
                                                viewBox="0 0 17 17" class="ant-collapse-arrow" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g></g>
                                                <path
                                                    d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="ant-collapse-header-text">{{ __('Employee Details') }}</span>
                                    </div>
                                </div>
                            </div>
        
                            <div class="collapse show" id="employeeInformation">
                                <div
                                    class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                                    <div class="ant-collapse-item ant-collapse-item-active">
                                        <div class="ant-collapse-content ant-collapse-content-active">
                                            <div class="ant-collapse-content-box">
        
                                                <div class="cards">
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Name') }}</div>
                                                        <div class="des">{{ $payroll->employees['name' . $lang] }}</div>
                                                    </div>
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Code') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->employeeIdFormat($payroll->employees->id) }}
                                                        </div>
                                                    </div>
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Job Title') }}</div>
                                                        <div class="des">
                                                            {{ $payroll->employees->jobtitle ? $payroll->employees->jobtitle['name' . $lang] : 'N/A' }}
                                                        </div>
                                                    </div>
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Date') }}</div>
                                                        <div class="des">{{ $payroll->employees->Join_date_gregorian }}
                                                        </div>
                                                    </div>
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Department') }}</div>
                                                        <div class="des">
                                                            {{ $payroll->employees->department ? $payroll->employees->department['name' . $lang] : 'N/A' }}
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                        </div>
        
                        <div class="sectionDDS1 section">
                            <div class="flex align between">
                                <div class="ant-collapse" data-bs-toggle="collapse" data-bs-target="#monthlyPayroll"
                                    aria-expanded="true" aria-controls="monthlyPayroll">
                                    <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                        role="button" tabindex="0">
                                        <div class="ant-collapse-expand-icon">
                                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1"
                                                viewBox="0 0 17 17" class="ant-collapse-arrow" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g></g>
                                                <path
                                                    d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                                </path>
                                            </svg>
                                        </div>
                                        <span class="ant-collapse-header-text">{{ __('Monthly Payroll Record') }}</span>
                                    </div>
                                </div>

                                @can('Payroll-View')
                                    <a href="{{ asset('payslip/showemployee/' . $payroll->employee_id) }}" class="withIcon">
                                        {{ __('See More Details') }}
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.4299 5.92969L20.4999 11.9997L14.4299 18.0697" stroke="#066163"
                                                stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M3.5 12H20.33" stroke="#066163" stroke-width="1.5" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                @endcan
                            </div>
        
                            <div class="collapse show" id="monthlyPayroll">
                                <div
                                    class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                                    <div class="ant-collapse-item ant-collapse-item-active">
                                        <div class="ant-collapse-content ant-collapse-content-active">
                                            <div class="ant-collapse-content-box">
        
                                                <div class="cards">
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Basic Salary') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat($payroll->employees->salary) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Allowances') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(collect(json_decode($payroll->employees->allowance($payroll->employee_id)))->sum('amount')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Overtime') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(collect(json_decode($payroll->employees->overtime($payroll->employee_id)))->sum('rate')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Sales Percentage') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(collect(json_decode($payroll->employees->commission($payroll->employee_id)))->sum('amount')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Other Dues') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(collect(json_decode($payroll->employees->other_payment($payroll->employee_id)))->sum('amount')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Total Due') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat($payroll->getTotalDue($payroll->employee_id)) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Employee Social Insurance') }}
                                                        </div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat($payroll->employees->insurance($payroll->employee_id, 'employee')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Employee Medical Insurance') }}
                                                        </div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat($payroll->employees->medical_insurance($payroll->employee_id, 'employee')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Absence') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(collect(json_decode($payroll->employees->allowance($payroll->employee_id)))->sum('amount')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Vacations') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(json_decode($payroll->employees->absenceLeaves($payroll->employee_id))->totalDeduction) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Advanced Loans') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(collect(json_decode($payroll->employees->loan($payroll->employee_id)))->sum('amount')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Deductions') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat(collect(json_decode($payroll->employees->saturation_deduction($payroll->employee_id)))->sum('amount')) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Total Deduction') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat($payroll->getTotalDeduction($payroll->employee_id)) }}
                                                        </div>
                                                    </div>
        
                                                    <div class="cardS1 flex align">
                                                        <div class="name">{{ __('Net Salary') }}</div>
                                                        <div class="des">
                                                            {{ auth()->user()->priceFormat($payroll->getNetSalary($payroll->employee_id)) }}
                                                        </div>
                                                    </div>
        
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                        </div>
        
        
                    </div>
        
                </div>
            </div>
        </td>
    </tr>
@endforeach

