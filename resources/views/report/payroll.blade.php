@extends('layouts.admin')
@section('page-title')
    {{__('Manage Payroll')}}
@endsection

@section('content')
<div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
        <!--begin::Card-->
        <div class="card card-docs flex-row-fluid mb-2">
            <!--begin::Card Body-->
            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                <!--begin::Section-->
                <div class="py-0">
                    <!--begin::Heading-->
                    <h1 class="fw-bold mb-5">{{__('Manage Payroll')}}</h1>

                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <!--begin::Filter menu-->
                        <div class="m-0">
                            <!--begin::Menu toggle-->
                            <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                            <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->{{__('Filter')}}</a>
                            <!--end::Menu toggle-->
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62fb49906e46a" style="">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">{{__('Filter Options')}}</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <div class="px-7 py-5">
                                    {{ Form::open(array('route' => array('report.payroll'),'method'=>'get','id'=>'report_payroll')) }}
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-semibold">{{__('Type')}}:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <div class="btn-box">
                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="monthly" value="monthly" name="type" class="custom-control-input monthly" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                                                            <label class="custom-control-label" for="monthly">{{__('Monthly')}}</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="yearly" value="yearly" name="type" class="custom-control-input yearly" {{isset($_GET['type']) && $_GET['type']=='yearly' ?'checked':''}}>
                                                            <label class="custom-control-label" for="yearly">{{__('Yearly')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">{{__('Month')}}:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <div class="btn-box">
                                                        {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control'))}}
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">{{__('Branch')}}:</label>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                    {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                                                </div>
                                                <!--end::Switch-->
                                            </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-semibold">{{__('Department')}}:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                    <!--end::Input group-->

                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <a href="{{route('report.payroll')}}" type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2">{{ __('Reset') }}</a>
                                            <button  onclick="document.getElementById('report_payroll').submit(); return false;" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">{{ __('apply') }}</button>
                                        </div>
                                        <!--end::Actions-->
                                    {{ Form::close() }}
                                </div>
                                <!--end::Form-->
                            </div>
                            <!--end::Menu 1-->
                        </div>
                        <!--end::Filter menu-->
                    </div>

                    <!--end::Heading-->

                    <!--begin::Block-->
                    <div class="py-5">
                        <!--begin::Card-->
                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                            <!--begin::Card header-->
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <div id="printableArea" class="mt-4">
                                        <div class="row mt-3">
                                            <div class="col">
                                                <input type="hidden" value="{{  $filterYear['branch'] .' '.__('Branch') .' '.$filterYear['dateYearRange'].' '.$filterYear['type'].' '.__('Payroll Report of').' '. $filterYear['department'].' '.'Department'}}" id="filename">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Report')}} :</h5>
                                                    <h5 class="report-text mb-0">{{$filterYear['type'].' '.__('Payroll Summary')}}</h5>
                                                </div>
                                            </div>
                                            @if($filterYear['branch']!='All')
                                                <div class="col">
                                                    <div class="card p-4 mb-4">
                                                        <h5 class="report-text gray-text mb-0">{{__('Branch')}} :</h5>
                                                        <h5 class="report-text mb-0">{{$filterYear['branch']}}</h5>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($filterYear['department']!='All')
                                                <div class="col">
                                                    <div class="card p-4 mb-4">
                                                        <h5 class="report-text gray-text mb-0">{{__('Department')}} :</h5>
                                                        <h5 class="report-text mb-0">{{$filterYear['department']}}</h5>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Duration')}} :</h5>
                                                    <h5 class="report-text mb-0">{{$filterYear['dateYearRange']}}</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Basic Salary')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalBasicSalary'])}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Net Salary')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalNetSalary'])}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Allowance')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalAllowance'])}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Commission')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalCommision'])}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Loan')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalLoan'])}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Saturation Deduction')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalSaturationDeduction'])}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Other Payment')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalOtherPayment'])}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Total Overtime')}} :</h5>
                                                    <h5 class="report-text mb-0">{{auth()->user()->priceFormat($filterData['totalOverTime'])}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--begin::Table-->
                                    <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                <th class="min-w-100px">{{__('Employee ID')}}</th>
                                                <th class="min-w-100px">{{__('Employee')}}</th>
                                                <th class="min-w-100px">{{__('Salary')}}</th>
                                                <th class="min-w-100px">{{__('Net Salary')}}</th>
                                                <th class="min-w-100px">{{__('Month')}}</th>
                                                <th class="min-w-100px">{{__('Status')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach($payslips as $payslip)
                                                <tr>
                                                    <td><a href="{{route('employee.show',($payslip->employee_id))}}" class="btn btn-sm btn-primary">{{ !empty($payslip->employees)?auth()->user()->employeeIdFormat($payslip->employees->employee_id):'' }}</a></td>
                                                    <td>{{(!empty($payslip->employees)) ? $payslip->employees->name:''}}</td>
                                                    <td>{{auth()->user()->priceFormat($payslip->basic_salary)}}</td>
                                                    <td>{{auth()->user()->priceFormat($payslip->net_payble)}}</td>
                                                    <td>{{$payslip->salary_month}}</td>
                                                    <td>
                                                        @if($payslip->status==0)
                                                            <div class="badge badge-danger"><a href="#" class="text-white">{{__('UnPaid')}}</a></div>
                                                        @else
                                                            <div class="badge badge-success"><a href="#" class="text-white">{{__('Paid')}}</a></div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->


                                </div>
                                <!--end::Card body-->

                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Block-->
                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Card Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>

@endsection

@push('script-page')
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();
            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.year').addClass('d-none');
                $('.year').removeClass('d-block');
            } else {
                $('.year').addClass('d-block');
                $('.year').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');
    </script>
@endpush
