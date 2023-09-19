@extends('new-theme.layout.layout3')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/payroll.css') }}" />
@endpush

@section('content')
    <div class="payrollDetailsPage">

        <div class="pageS1">
            <a href='{{ Route('payslip.index') }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/all/arrowLeft.svg' alt='' />
                        <h3>{{$employee['name'.$lang]}}</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class='payrollCards'>
            <div class="row">
                <div class="col-lg-4">
                    <div class='sectionS1'>
                        <div class='headerTitle'>{{__('Employee Salary')}}</div>
                        <div class='payrollCard flex'>
                            <div class='content'>
                                <div class='number'>{{ $employee->salary_type() ?? 'N/A' }}</div>
                                <div class='description'>{{__('Pay slip Type')}}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>{{ number_format($employee->salary, 2)}} <span>{{auth()->user()->currencySymbol()}}</span> </div>
                                <div class='description'>{{__('Salary')}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class='sectionS1'>
                        <div class='headerTitle'>{{__('Employee Social Insurance')}}</div>
                        <div class='payrollCard flex'>
                            <div class='content'>
                                <div class='number'>
                                    {{ number_format($employee->insurance($employee->id,'employee'), 2)}} <span>{{auth()->user()->currencySymbol()}}</span> 
                                </div>
                                <div class='description'>{{__('on_employee') }}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>
                                    {{ number_format($employee->insurance($employee->id,'company'), 2)}} <span>{{auth()->user()->currencySymbol()}}</span> 
                                </div>
                                <div class='description'>{{__('on_company') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class='sectionS1'>
                        <div class='headerTitle'>{{__('Employee Medical Insurance')}}</div>
                        <div class='payrollCard flex'>
                            <div class='content'>
                                <div class='number'>
                                    {{ number_format($employee->medical_insurance($employee->id,'employee'), 2)}} <span>{{auth()->user()->currencySymbol()}}</span> 
                                </div>
                                <div class='description'>{{__('on_employee') }}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>
                                    {{ number_format($employee->medical_insurance($employee->id,'company'), 2)}} <span>{{auth()->user()->currencySymbol()}}</span> 
                                </div>
                                <div class='description'>{{__('on_company') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class='sectionS1'>
                        <div class='headerTitle'>{{__('Delays')}}</div>
                        <div class='payrollCard flex'>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeDelays(0 , 15)}} </div>
                                <div class='description'>0-15 {{__('MIN')}}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeDelays(16 , 30)}}</div>
                                <div class='description'>16-30 {{__('MIN')}}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeDelays(31 , 60)}}</div>
                                <div class='description'>31-60 {{__('MIN')}}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeDelays(61 , null)}}</div>
                                <div class='description'>61-... {{__('MIN')}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class='sectionS1'>
                        <div class='headerTitle'>{{__('Attendance OverTime')}}</div>
                        <div class='payrollCard flex'>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeOverTimes(0 , 15)}}</div>
                                <div class='description'>0-15 {{__('MIN')}}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeOverTimes(16 , 30)}}</div>
                                <div class='description'>16-30 {{__('MIN')}}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeOverTimes(31 , 60)}}</div>
                                <div class='description'>31-60 {{__('MIN')}}</div>
                            </div>
                            <div class='content'>
                                <div class='number'>{{$employee->getEmployeeOverTimes(61 , null)}}</div>
                                <div class='description'>61-... {{__('MIN')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{__('Allowances')}}</h3>
                <div class='flex align gap-3'>
                    <button class='buttonS2  withBorder'>
                        <img src="/new-theme/icons/all/print.svg" alt="" />
                        {{__('Print')}}
                    </button>

                    <a href="{{Route('allowance.export',[$employee->id])}}">
                        <button class='buttonS2 withBorder'>
                            <img src="/new-theme/icons/all/download.svg" alt="" />
                            {{__('Export')}}
                        </button>
                    </a>
                    
                    <a href='{{route('allowances.create',[$employee->id])}}'>
                        <button class='buttonS1 primary'>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                    fill="white" />
                            </svg>
                            {{__('Add New')}}
                        </button>
                    </a>
                </div>
            </div>
            <div class="tableS1 scroll">
                <table>
                    <thead>
                        <tr>
                            <th>{{__('Allowance Option')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->employee_allowances() as $allowance)
                            <tr>
                                <td>{{ $allowance->allowance_option() ? $allowance->allowance_option()['name'.$lang] : 'N/A' }} </td>
                                <td>{{ $allowance->title }}</td>
                                <td>{{  auth()->user()->priceFormat($allowance->amount) }}</td>
                                <td>
                                    <div class='action flex gap-3'>
                                        <div>
                                            <a href="{{ URL::to('allowance/'.$allowance->id.'/edit') }}">
                                                <img src="/new-theme/icons/all/edit2.svg" alt="" />
                                            </a>
                                        </div>

                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('allowance.destroy' , $allowance->id) }}">
                                                <img src="/new-theme/icons/all/delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{__('Sales Percentage')}}</h3>
                <div class='flex align gap-3'> 
                    <button class='buttonS2  withBorder'>
                        <img src="/new-theme/icons/all/print.svg" alt="" />
                        {{__('Print')}}
                    </button>

                    <a href="{{Route('commission.export',[$employee->id])}}">
                        <button class='buttonS2 withBorder'>
                            <img src="/new-theme/icons/all/download.svg" alt="" />
                            {{__('Export')}}
                        </button>
                    </a>

                    <a href='{{route('commissions.create',[$employee->id])}}'>
                        <button class='buttonS1 primary'>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                    fill="white" />
                            </svg>
                            {{__('Add New')}}
                        </button>
                    </a>
                </div>
            </div>
           
            <div class="tableS1 scroll">
                <table>
                    <thead>
                        <!-- TODO: CHANGE DATE AND TYPE -->
                        <tr>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee->employee_commissions() as $commission )
                            <tr>
                                <td>{{ $commission->title }}</td>
                                <td>{{ auth()->user()->priceFormat($commission->amount) }}</td>
                                <td>
                                    <div class='action flex gap-3'>
                                        <div>
                                             <a href="{{ URL::to('commission/'.$commission->id.'/edit') }}">
                                                <img src="/new-theme/icons/all/edit2.svg" alt="" />
                                            </a>
                                        </div>
                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('commission.destroy' , $commission->id) }}">
                                                <img src="/new-theme/icons/all/delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{__('Advanced Loans')}}</h3>
                <div class='flex align gap-3'>
                    <button class='buttonS2  withBorder'>
                        <img src="/new-theme/icons/all/print.svg" alt="" />
                        {{__('Print')}}
                    </button>

                    <a href="{{Route('loan.export',[$employee->id])}}">
                        <button class='buttonS2 withBorder'>
                            <img src="/new-theme/icons/all/download.svg" alt="" />
                            {{__('Export')}}
                        </button>
                    </a>

                    <a href='{{route('loans.create',[$employee->id])}}'>
                        <button class='buttonS1 primary'>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                    fill="white" />
                            </svg>
                            {{__('Add New')}}
                        </button>
                    </a>
                </div>
            </div>
           
            <div class="tableS1 scroll">
                <table>
                    <thead>
                        <tr>
                            <th>{{__('Loan Options')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Reason')}}</th>
                            <th>{{__('Loan Amount')}}</th>
                            <th>{{__('Pay Date')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->employee_loans() as $loan)
                            <tr>
                                <td>{{!empty($loan->loan_option()) ? $loan->loan_option()->name: 'N/A' }}</td>
                                <td>{{ $loan->title }}</td>
                                <td>{{ $loan->reason }}</td>
                                <td>{{ auth()->user()->priceFormat($loan->discount_monthly) }}</td>
                                <td>{{ auth()->user()->dateFormat($loan->date) }}</td>
                                <td>
                                    <div class='action flex gap-3'>
                                        <div>
                                            <a href="{{ URL::to('loan/'.$loan->id.'/edit') }}">
                                                <img src="/new-theme/icons/all/edit2.svg" alt="" />
                                            </a>
                                        </div>
                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('loan.destroy' , $loan->id) }}">
                                                <img src="/new-theme/icons/all/delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{__('Deductions')}}</h3>
                <div class='flex align gap-3'>
                    <button class='buttonS2  withBorder'>
                        <img src="/new-theme/icons/all/print.svg" alt="" />
                        {{__('Print')}}
                    </button>

                    <a href="{{Route('saturationdeduction.export',[$employee->id])}}">
                        <button class='buttonS2 withBorder'>
                            <img src="/new-theme/icons/all/download.svg" alt="" />
                            {{__('Export')}}
                        </button>
                    </a>

                    <a href='{{route('saturationdeductions.create',[$employee->id])}}'>
                        <button class='buttonS1 primary'>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                    fill="white" />
                            </svg>
                            {{__('Add New')}}
                        </button>
                    </a>
                </div>
            </div>
           
            <div class="tableS1 scroll">
                <table>
                    <thead>
                        <tr>
                            <th>{{__('Deduction options')}}</th>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Deduction Percent')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->employee_deductions() as $saturationdeduction)
                            <tr>
                                <td>{{ $saturationdeduction->deduction_option() ? $saturationdeduction->deduction_option()['name'.$lang] : 'N/A' }}</td>
                                <td>{{ $saturationdeduction->title }}</td>
                                <td>{{ $saturationdeduction->percent }} %</td>
                                <td>{{ auth()->user()->priceFormat( $saturationdeduction->amount) }}</td>
                                <td>{{ auth()->user()->dateFormat($saturationdeduction->date)}}</td>
                                <td>
                                    <div class='action flex gap-3'>
                                        <div>
                                            <a href="{{ URL::to('saturationdeduction/'.$saturationdeduction->id.'/edit') }}">
                                                <img src="/new-theme/icons/all/edit2.svg" alt="" />
                                            </a>
                                        </div>
                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('saturationdeduction.destroy' , $saturationdeduction->id) }}">
                                                <img src="/new-theme/icons/all/delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'> {{__('Other Payment')}}</h3>
                <div class='flex align gap-3'>
                    <button class='buttonS2  withBorder'>
                        <img src="/new-theme/icons/all/print.svg" alt="" />
                        {{__('Print')}}
                    </button>

                    <a href="{{Route('otherpayment.export',[$employee->id])}}">
                        <button class='buttonS2 withBorder'>
                            <img src="/new-theme/icons/all/download.svg" alt="" />
                            {{__('Export')}}
                        </button>
                    </a>

                    <a href='{{route('otherpayments.create',[$employee->id])}}'>
                        <button class='buttonS1 primary'>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                    fill="white" />
                            </svg>
                             {{__('Add New')}}
                        </button>
                    </a>
                </div>
            </div>
           
            <div class="tableS1 scroll">
                <table>
                    <thead>
                        <tr>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->employee_otherPayment() as $otherpayment)
                            <tr>
                                <td>{{ $otherpayment->title }}</td>
                                <td>{{  auth()->user()->priceFormat($otherpayment->amount) }}</td>
                                <td>{{  auth()->user()->dateFormat($otherpayment->date) }}</td>
                                <td>
                                    <div class='action flex gap-3'>
                                        <div>
                                             <a href="{{ URL::to('otherpayment/'.$otherpayment->id.'/edit') }}">
                                                <img src="/new-theme/icons/all/edit2.svg" alt="" />
                                            </a>
                                        </div>
                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('otherpayment.destroy' , $otherpayment->id) }}">
                                                <img src="/new-theme/icons/all/delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{__('Overtime')}}</h3>
                <div class='flex align gap-3'>
                    <button class='buttonS2  withBorder'>
                        <img src="/new-theme/icons/all/print.svg" alt="" />
                        {{__('Print')}}
                    </button>

                    <a href="{{Route('overtime.export',[$employee->id])}}">
                        <button class='buttonS2 withBorder'>
                            <img src="/new-theme/icons/all/download.svg" alt="" />
                            {{__('Export')}}
                        </button>
                    </a>

                    <a href='{{route('overtimes.create',[$employee->id])}}'>
                        <button class='buttonS1 primary'>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                    fill="white" />
                            </svg>
                            {{__('Add New')}}
                        </button>
                    </a>
                </div>
            </div>
            
            <div class="tableS1 scroll">
                <table>
                    <thead>
                        <tr>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Number Of Days')}}</th>
                            <th>{{__('Hours')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->employee_overtimes() as $overtime)
                            <tr>
                                <td>{{ $overtime->title }}</td>
                                <td>{{ $overtime->number_of_days }}</td>
                                <td>{{ $overtime->hours }}</td>
                                <td>{{  auth()->user()->priceFormat($overtime->rate) }}</td>
                                <td>
                                    <div class='action flex gap-3'>
                                        <div>
                                             <a href="{{ URL::to('overtime/'.$overtime->id.'/edit') }}">
                                                <img src="/new-theme/icons/all/edit2.svg" alt="" />
                                            </a>
                                        </div>
                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('overtime.destroy' , $overtime->id) }}">
                                                <img src="/new-theme/icons/all/delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{__('Absence')}}</h3>
                <div class='flex align gap-3'>
                    <button class='buttonS2  withBorder'>
                        <img src="/new-theme/icons/all/print.svg" alt="" />
                        {{__('Print')}}
                    </button>

                    <a href="{{Route('absence.export',[$employee->id])}}">
                        <button class='buttonS2 withBorder'>
                            <img src="/new-theme/icons/all/download.svg" alt="" />
                            {{__('Export')}}
                        </button>
                    </a>

                    <a href='{{route('absences.create',[$employee->id])}}'>
                        <button class='buttonS1 primary'>
                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                    fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                    fill="white" />
                            </svg>
                            {{__('Add New')}}
                        </button>
                    </a>
                </div>
            </div>
           
            <div class="tableS1 scroll">
                <table>
                    <thead>
                        <tr>
                            <th>{{__('Title')}}</th>
                            <th>{{__('Number Of Days')}}</th>
                            <th>{{__('Start Date')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->employee_absence() as $absence)
                            <tr>
                                <td>{{ $absence->leave != null ? (app()->isLocale('en') ?  $absence->leave->leaveType->title :  $absence->leave->leaveType->title_ar )  : '' }}</td>
                                <td>{{ $absence->number_of_days }}</td>
                                <td>{{ $absence->start_date }}</td>
                                <td>
                                    <div class='action flex gap-3'>
                                        <div>
                                             <a href="{{ URL::to('absence/'.$absence->id.'/edit') }}">
                                                <img src="/new-theme/icons/all/edit2.svg" alt="" />
                                            </a>
                                        </div>
                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('absence.destroy' , $absence->id) }}">
                                                <img src="/new-theme/icons/all/delete.svg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
@endsection

@push('script')
@endpush
