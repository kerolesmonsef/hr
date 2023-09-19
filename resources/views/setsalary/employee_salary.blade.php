@extends('layouts.admin')
@section('page-title')
    {{__('Employee Set Salary')}} - {{$employee->name}}
@endsection
<style>
    .col-md-6{
        margin-bottom: 2%;
    }
</style>
@section('content')
<div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="fw-bold mb-5 p-4"> {{$employee->name}} </h3>
                </div>
                <div class="col-md-4">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                <!--begin::Section-->
                                <div class="py-0 text-center">
                                    <!--begin::Heading-->

                                    <div style="justify-content: space-between;align-items: center !important;" class="d-flex align-items-center gap-2 gap-lg-3">
                                        <h4 class="fw-bold mb-5"> {{__('Employee Salary')}} </h4>
                                        <!--begin::Primary button-->
                                        @can('Create Employee')
                                        <a href="#" data-url="{{ route('employee.basic.salary',$employee->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                        @endcan
                                        <!--end::Primary button-->
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
                                                    <div class="project-info d-flex text-sm">
                                                        <div class="project-info-inner mr-3 col-6">
                                                            <b class="m-0"> {{__('Payslip Type') }} </b>
                                                            <div class="project-amnt pt-1">{{ $employee->salary_type() }}</div>
                                                        </div>
                                                        <div class="project-info-inner mr-3 col-6">
                                                            <b class="m-0"> {{__('Salary') }} </b>
                                                            <div class="project-amnt pt-1">{{ auth()->user()->priceFormat($employee->salary) }}</div>
                                                        </div>
                                                    </div>
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
                </div>

                <div class="col-md-4">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                <!--begin::Section-->
                                <div class="py-0 text-center">
                                    <!--begin::Heading-->
                                    <h4 class="fw-bold mb-5"> {{__('social_insurance')}} </h4>

                                    <!--end::Heading-->

                                    <!--begin::Block-->
                                    <div class="py-5">
                                        <!--begin::Card-->
                                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                                            <!--begin::Card header-->
                                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                <!--begin::Card body-->
                                                <div class="card-body">
                                                    <div class="project-info d-flex text-sm">
                                                        <div class="project-info-inner mr-3 col-6">
                                                            <b class="m-0"> {{__('on_employee') }} </b>
                                                            <div class="project-amnt pt-1"> {{  auth()->user()->priceFormat($employee->insurance($employee->id,'employee'))}} </div>
                                                        </div>
                                                        <div class="project-info-inner mr-3 col-6">
                                                            <b class="m-0"> {{__('on_company') }} </b>
                                                            <div class="project-amnt pt-1">{{  auth()->user()->priceFormat($employee->insurance($employee->id,'company'))}}</div>
                                                        </div>
                                                    </div>
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
                </div>

                <div class="col-md-4">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                <!--begin::Section-->
                                <div class="py-0 text-center">
                                    <!--begin::Heading-->
                                    <h4 class="fw-bold mb-5"> {{__('Medical_insurance')}} </h4>

                                    <!--end::Heading-->

                                    <!--begin::Block-->
                                    <div class="py-5">
                                        <!--begin::Card-->
                                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                                            <!--begin::Card header-->
                                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                <!--begin::Card body-->
                                                <div class="card-body">
                                                    <div class="project-info d-flex text-sm">
                                                        <div class="project-info-inner mr-3 col-6">
                                                            <b class="m-0"> {{__('on_employee') }} </b>
                                                            <div class="project-amnt pt-1"> {{  auth()->user()->priceFormat($employee->medical_insurance($employee->id,'employee'))}} </div>
                                                        </div>
                                                        <div class="project-info-inner mr-3 col-6">
                                                            <b class="m-0"> {{__('on_company') }} </b>
                                                            <div class="project-amnt pt-1">{{  auth()->user()->priceFormat($employee->medical_insurance($employee->id,'company'))}}</div>
                                                        </div>
                                                    </div>
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
                </div>

                <div class="col-md-6">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                <!--begin::Section-->
                                <div class="py-0 text-center">
                                    <!--begin::Heading-->
                                    <h4 class="fw-bold mb-5"> {{__('Delays')}} </h4>

                                    <!--end::Heading-->

                                    <!--begin::Block-->
                                    <div class="py-5">
                                        <!--begin::Card-->
                                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                                            <!--begin::Card header-->
                                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                <!--begin::Card body-->
                                                <div class="card-body">
                                                    <div class="project-info d-flex text-sm">

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 0 - 15 m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeDelays(0 , 15)}} </div>
                                                        </div>

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 16 - 30 m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeDelays(16 , 30)}} </div>
                                                        </div>

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 31 - 60 m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeDelays(31 , 60)}} </div>
                                                        </div>

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 61 - ... m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeDelays(61 , null)}} </div>
                                                        </div>

                                                    </div>
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
                </div>

                <div class="col-md-6">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                            <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                <!--begin::Section-->
                                <div class="py-0 text-center">
                                    <!--begin::Heading-->
                                    <h4 class="fw-bold mb-5"> {{__('Attendance OverTime')}} </h4>

                                    <!--end::Heading-->

                                    <!--begin::Block-->
                                    <div class="py-5">
                                        <!--begin::Card-->
                                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                                            <!--begin::Card header-->
                                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                <!--begin::Card body-->
                                                <div class="card-body">
                                                    <div class="project-info d-flex text-sm">

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 0 - 15 m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeOverTimes(0 , 15)}} </div>
                                                        </div>

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 16 - 30 m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeOverTimes(16 , 30)}} </div>
                                                        </div>

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 31 - 60 m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeOverTimes(31 , 60)}} </div>
                                                        </div>

                                                        <div class="project-info-inner mr-3 col-3">
                                                            <b class="m-0"> 61 - ... m </b>
                                                            <div class="project-amnt pt-1"> {{$employee->getEmployeeOverTimes(61 , null)}} </div>
                                                        </div>

                                                    </div>
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
                </div>

                <div class="col-md-12">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                            <!--begin::Section-->
                            <div class="py-0">
                                <!--begin::Heading-->
                                <h1 class="fw-bold mb-5">{{__('Allowance')}}</h1>

                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    @can('Create Allowance')
                                    <a href="#" data-url="{{ route('allowances.create',$employee->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                    @endcan
                                    <!--end::Primary button-->
                                </div>

                                <!--end::Heading-->

                                <!--begin::Block-->
                                <div class="py-5">
                                    <!--begin::Card-->
                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->

                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <!--begin::Export dropdown-->
                                                <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                        <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{__('Export')}}</button>
                                                <!--begin::Menu-->
                                                <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Export dropdown-->
                                                <!--begin::Hide default export buttons-->
                                                <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                <!--end::Hide default export buttons->
                                                </div>
                                                <!==end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <br><br>

                                            <!--begin::Card body-->
                                            <div class="card-body">
                                                <!--begin::Table-->
                                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th class="min-w-100px">{{__('Allownace Option')}}</th>
                                                            <th class="min-w-100px">{{__('Title')}}</th>
                                                            <th class="min-w-100px">{{__('Amount')}}</th>
                                                            <th class="min-w-100px">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach ($allowances as $allowance)
                                                            <tr>
                                                                <td>{{ !empty($allowance->allowance_option())?$allowance->allowance_option()->name:'' }}</td>
                                                                <td>{{ $allowance->title }}</td>
                                                                <td>{{  auth()->user()->priceFormat($allowance->amount) }}</td>
                                                                <td class="Action text-center">
                                                                    <span>
                                                                        @can('Edit Allowance')
                                                                            <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ URL::to('allowance/'.$allowance->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        @endcan
                                                                        @can('Delete Allowance')
                                                                            <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['allowance.destroy', $allowance->id],'id'=>'delete-allowance-form-'.$allowance->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        @endcan
                                                                    </span>
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
                </div>

                <div class="col-md-12">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                            <!--begin::Section-->
                            <div class="py-0">
                                <!--begin::Heading-->
                                <h1 class="fw-bold mb-5">{{__('Commission')}}</h1>

                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    @can('Create Commission')
                                    <a href="#" data-url="{{ route('commissions.create',$employee->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                    @endcan
                                    <!--end::Primary button-->
                                </div>

                                <!--end::Heading-->

                                <!--begin::Block-->
                                <div class="py-5">
                                    <!--begin::Card-->
                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->

                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <!--begin::Export dropdown-->
                                                <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                        <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{__('Export')}}</button>
                                                <!--begin::Menu-->
                                                <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Export dropdown-->
                                                <!--begin::Hide default export buttons-->
                                                <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                <!--end::Hide default export buttons->
                                                </div>
                                                <!==end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <br><br>

                                            <!--begin::Card body-->
                                            <div class="card-body">
                                                <!--begin::Table-->
                                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th class="min-w-100px">{{__('Title')}}</th>
                                                            <th class="min-w-100px">{{__('Amount')}}</th>
                                                            <th class="min-w-100px">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($commissions as $commission)
                                                            <tr>
                                                                <td>{{ $commission->title }}</td>
                                                                <td> {{$commission->type == '$' ? auth()->user()->priceFormat($commission->amount) : $commission->amount.' % ' }}</td>
                                                                <td class="Action text-center">
                                                                    <span>
                                                                        @can('Edit Commission')
                                                                            <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ URL::to('commission/'.$commission->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        @endcan
                                                                        @can('Delete Commission')
                                                                            <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['commission.destroy', $commission->id],'id'=>'commission-delete-form-'.$commission->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        @endcan
                                                                    </span>
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
                </div>

                <div class="col-md-12">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                            <!--begin::Section-->
                            <div class="py-0">
                                <!--begin::Heading-->
                                <h1 class="fw-bold mb-5">{{__('Loan')}}</h1>

                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    @can('Create Loan')
                                    <a href="#" data-url="{{ route('loans.create',$employee->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                    @endcan
                                    <!--end::Primary button-->
                                </div>

                                <!--end::Heading-->

                                <!--begin::Block-->
                                <div class="py-5">
                                    <!--begin::Card-->
                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->

                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <!--begin::Export dropdown-->
                                                <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                        <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{__('Export')}}</button>
                                                <!--begin::Menu-->
                                                <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Export dropdown-->
                                                <!--begin::Hide default export buttons-->
                                                <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                <!--end::Hide default export buttons->
                                                </div>
                                                <!==end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <br><br>

                                            <!--begin::Card body-->
                                            <div class="card-body">
                                                <!--begin::Table-->
                                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th class="min-w-100px">{{__('Loan Options')}}</th>
                                                            <th class="min-w-100px">{{__('Title')}}</th>
                                                            <th class="min-w-100px">{{__('Loan Amount')}}</th>
                                                            <th class="min-w-100px">{{__('Start Date')}}</th>
                                                            <th class="min-w-100px">{{__('End Date')}}</th>
                                                            <th class="min-w-100px">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($loans as $loan)
                                                            <tr>
                                                                <td>{{!empty( $loan->loan_option())? $loan->loan_option()->name:'' }}</td>
                                                                <td>{{ $loan->title }}</td>
                                                                <td>{{ auth()->user()->priceFormat($loan->discount_monthly) }}</td>
                                                                <td>{{ auth()->user()->dateFormat($loan->start_date) }}</td>
                                                                <td>{{ auth()->user()->dateFormat( $loan->end_date) }}</td>
                                                                <td class="Action text-center">
                                                                    <span>
                                                                        @can('Edit Loan')
                                                                            <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ URL::to('loan/'.$loan->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        @endcan
                                                                        @can('Delete Loan')
                                                                            <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['loan.destroy', $loan->id],'id'=>'loan-delete-form-'.$loan->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        @endcan
                                                                    </span>
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
                </div>

                <div class="col-md-12">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                            <!--begin::Section-->
                            <div class="py-0">
                                <!--begin::Heading-->
                                <h1 class="fw-bold mb-5">{{__('Saturation Deduction')}}</h1>

                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    @can('Create Saturation Deduction')
                                    <a href="#" data-url="{{ route('saturationdeductions.create',$employee->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                    @endcan
                                    <!--end::Primary button-->
                                </div>

                                <!--end::Heading-->

                                <!--begin::Block-->
                                <div class="py-5">
                                    <!--begin::Card-->
                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->

                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <!--begin::Export dropdown-->
                                                <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                        <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{__('Export')}}</button>
                                                <!--begin::Menu-->
                                                <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Export dropdown-->
                                                <!--begin::Hide default export buttons-->
                                                <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                <!--end::Hide default export buttons->
                                                </div>
                                                <!==end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <br><br>

                                            <!--begin::Card body-->
                                            <div class="card-body">
                                                <!--begin::Table-->
                                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th class="min-w-100px">{{__('Deduction Option')}}</th>
                                                            <th class="min-w-100px">{{__('Title')}}</th>
                                                            <th class="min-w-100px">{{__('Amount')}}</th>
                                                            <th class="min-w-100px">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($saturationdeductions as $saturationdeduction)
                                                            <tr>
                                                                <td>{{ !empty($saturationdeduction->deduction_option())?$saturationdeduction->deduction_option()->name:'' }}</td>
                                                                <td>{{ $saturationdeduction->title }}</td>
                                                                <td>{{ auth()->user()->priceFormat( $saturationdeduction->amount) }}</td>
                                                                <td class="Action text-center">
                                                                    <span>
                                                                        @can('Edit Saturation Deduction')
                                                                            <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ URL::to('saturationdeduction/'.$saturationdeduction->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        @endcan
                                                                        @can('Delete Saturation Deduction')
                                                                            <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['saturationdeduction.destroy', $saturationdeduction->id],'id'=>'deduction-delete-form-'.$saturationdeduction->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        @endcan
                                                                    </span>
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
                </div>

                <div class="col-md-12">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                            <!--begin::Section-->
                            <div class="py-0">
                                <!--begin::Heading-->
                                <h1 class="fw-bold mb-5">{{__('Other Payment')}}</h1>

                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    @can('Create Saturation Deduction')
                                    <a href="#" data-url="{{ route('otherpayments.create',$employee->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                    @endcan
                                    <!--end::Primary button-->
                                </div>

                                <!--end::Heading-->

                                <!--begin::Block-->
                                <div class="py-5">
                                    <!--begin::Card-->
                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->

                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <!--begin::Export dropdown-->
                                                <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                        <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{__('Export')}}</button>
                                                <!--begin::Menu-->
                                                <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Export dropdown-->
                                                <!--begin::Hide default export buttons-->
                                                <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                <!--end::Hide default export buttons->
                                                </div>
                                                <!==end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <br><br>

                                            <!--begin::Card body-->
                                            <div class="card-body">
                                                <!--begin::Table-->
                                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th class="min-w-100px">{{__('Title')}}</th>
                                                            <th class="min-w-100px">{{__('Amount')}}</th>
                                                            <th class="min-w-100px">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach ($otherpayments as $otherpayment)
                                                            <tr>
                                                                <td>{{ $otherpayment->title }}</td>
                                                                <td>{{  auth()->user()->priceFormat($otherpayment->amount) }}</td>
                                                                <td class="Action text-center">
                                                                    <span>
                                                                        @can('Edit Other Payment')
                                                                            <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ URL::to('otherpayment/'.$otherpayment->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        @endcan
                                                                        @can('Delete Other Payment')
                                                                            <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['otherpayment.destroy', $otherpayment->id],'id'=>'payment-delete-form-'.$otherpayment->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        @endcan
                                                                    </span>
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
                </div>

                <div class="col-md-12">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                            <!--begin::Section-->
                            <div class="py-0">
                                <!--begin::Heading-->
                                <h1 class="fw-bold mb-5">{{__('Overtime')}}</h1>

                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    @can('Create Overtime')
                                    <a href="#" data-url="{{ route('overtimes.create',$employee->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                    @endcan
                                    <!--end::Primary button-->
                                </div>

                                <!--end::Heading-->

                                <!--begin::Block-->
                                <div class="py-5">
                                    <!--begin::Card-->
                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->

                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <!--begin::Export dropdown-->
                                                <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                        <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{__('Export')}}</button>
                                                <!--begin::Menu-->
                                                <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Export dropdown-->
                                                <!--begin::Hide default export buttons-->
                                                <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                <!--end::Hide default export buttons->
                                                </div>
                                                <!==end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <br><br>

                                            <!--begin::Card body-->
                                            <div class="card-body">
                                                <!--begin::Table-->
                                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th class="min-w-100px">{{__('Overtime Title')}}</th>
                                                            <th class="min-w-100px">{{__('Number of days')}}</th>
                                                            <th class="min-w-100px">{{__('Hours')}}</th>
                                                            <th class="min-w-100px">{{__('Rate')}}</th>
                                                            <th class="min-w-100px">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach ($overtimes as $overtime)
                                                            <tr>
                                                                <td>{{ $overtime->title }}</td>
                                                                <td>{{ $overtime->number_of_days }}</td>
                                                                <td>{{ $overtime->hours }}</td>
                                                                <td>{{  auth()->user()->priceFormat($overtime->rate) }}</td>
                                                                <td class="Action text-center">
                                                                    <span>
                                                                        @can('Edit Overtime')
                                                                            <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ URL::to('overtime/'.$overtime->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        @endcan
                                                                        @can('Delete Overtime')
                                                                            <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['overtime.destroy', $overtime->id],'id'=>'overtime-delete-form-'.$overtime->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        @endcan
                                                                    </span>
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
                </div>

                <div class="col-md-12">
                    <div class="card card-docs flex-row-fluid mb-2">
                        <!--begin::Card Body-->
                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                            <!--begin::Section-->
                            <div class="py-0">
                                <!--begin::Heading-->
                                <h1 class="fw-bold mb-5">{{__('Absences')}}</h1>

                                 <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    @can('Create Overtime')
                                    <a href="#" data-url="{{ route('absences.create',$employee->id) }}" data-ajax-popup="true"
                                    data-title="{{ __('Create New') }}" class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}</a>
                                    @endcan
                                    <!--end::Primary button-->
                                </div>

                                <!--end::Heading-->

                                <!--begin::Block-->
                                <div class="py-5">
                                    <!--begin::Card-->
                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->

                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <!--begin::Export dropdown-->
                                                <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                                        <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{__('Export')}}</button>
                                                <!--begin::Menu-->
                                                <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Export dropdown-->
                                                <!--begin::Hide default export buttons-->
                                                <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                <!--end::Hide default export buttons->
                                                </div>
                                                <!==end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <br><br>

                                            <!--begin::Card body-->
                                            <div class="card-body">
                                                <!--begin::Table-->
                                                <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                    <thead>
                                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                            <th class="min-w-100px">{{__('Absent Type')}}</th>
                                                            <th class="min-w-100px">{{__('Number of days')}}</th>
                                                            <th class="min-w-100px">{{__('Start Date')}}</th>
                                                            <th class="min-w-100px">{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fw-semibold text-gray-600">
                                                        @foreach($absences as $absence)
                                                            <tr>
                                                                <td>{{ $absence->leave != null ? (app()->isLocale('en') ?  $absence->leave->leaveType->title :  $absence->leave->leaveType->title_ar )  : '' }}</td>
                                                                <td>{{ $absence->number_of_days }}</td>
                                                                <td>{{ $absence->start_date }}</td>
                                                                <td class="Action text-center">
                                                                    <span>
                                                                        @can('Edit Overtime')
                                                                            <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ URL::to('absence/'.$absence->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        @endcan

                                                                        @can('Delete Overtime')
                                                                            <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['absence.destroy', $absence->id],'id'=>'absence-delete-form-'.$absence->id]) !!}
                                                                            {!! Form::close() !!}
                                                                        @endcan

                                                                    </span>
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
                </div>

            </div>
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection

@push('script-page')
    <script type="text/javascript">
        $(document).ready(function () {
            var d_id = $('#department_id').val();
            var designation_id = '{{ $employee->designation_id }}';
            getDesignation(d_id);


            $("#allowance-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#commission-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#loan-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#saturation-deduction-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#other-payment-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#overtime-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });
        });

        $(document).on('change', 'select[name=department_id]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '{{route('employee.json')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value="">{{__('Select any Designation')}}</option>');
                    $.each(data, function (key, value) {
                        var select = '';
                        if (key == '{{ $employee->designation_id }}') {
                            select = 'selected';
                        }

                        $('#designation_id').append('<option value="' + key + '"  ' + select + '>' + value + '</option>');
                    });
                }
            });
        }

        function calculateOvertimeRate(emp_id) {
            $.ajax({
                url : '{{route('overtimes.calculateOvertime')}}',
                type: 'POST',
                data: {
                    "_token"      : "{{ csrf_token() }}",
                    "employee_id" : emp_id,
                    "hours"       : parseFloat($('#hours').val()),
                },
                success: function (data) {
                    $('#rate').val(data);
                }
            });
        }

        function calculateDeductionPercent(emp_id) {
            $.ajax({
                url : '{{route('saturationdeductions.calculate_deduction_percent')}}',
                type: 'POST',
                data: {
                    "_token"      : "{{ csrf_token() }}",
                    "employee_id" : emp_id,
                    "percent"     : $('#percent').val(),
                },
                success: function (data) {
                    $('#amount').val(data);
                }
            });
        }
    </script>

    <script>
        $('.confirm-delete').click(function(e){
            e.preventDefault();
            Swal.fire({
                html: `{{__('Are You Sure?').' '.__('This action can not be undone. Do you want to continue?')}}`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "{{__('messages.Ok')}}",
                cancelButtonText: "{{__('Cancel')}}",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).siblings('form').submit();
                }
            });
            return false;
        });
    </script>
@endpush
