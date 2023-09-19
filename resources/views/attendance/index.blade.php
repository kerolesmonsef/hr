@extends('layouts.admin')
@section('page-title')
    {{__('Marked Attendance')}}
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
                    <h1 class="fw-bold mb-5">{{__('Marked Attendance')}}</h1>

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
                                        {{ Form::open(array('route' => array('attendanceemployee.index'),'method'=>'get','id'=>'attendanceemployee_filter')) }}
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">{{__('Type')}}:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <div class="btn-box">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="monthly" value="monthly" name="type" class="custom-control-input" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                                                            <label class="custom-control-label" for="monthly">{{__('Monthly')}}</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="daily" value="daily" name="type" class="custom-control-input" {{isset($_GET['type']) && $_GET['type']=='daily' ?'checked':''}}>
                                                            <label class="custom-control-label" for="daily">{{__('Daily')}}</label>
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
                                                        {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control month-btn'))}}
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">{{__('Date')}}:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <div class="btn-box">
                                                        {{ Form::text('date',isset($_GET['date'])?$_GET['date']:'', array('class' => 'form-control gregorian-date month-btn')) }}
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            @if(auth()->user()->type != 'employee')
                                                <!--begin::Input group-->
                                                    <div class="mb-10">
                                                        <!--begin::Label-->
                                                        <label class="form-label fw-semibold">{{__('Branch')}}:</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div>
                                                            <div class="btn-box">
                                                                {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                                                            </div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                    <div class="mb-10">
                                                        <!--begin::Label-->
                                                        <label class="form-label fw-semibold">{{__('Department')}}:</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div>
                                                            <div class="btn-box">
                                                                {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                                                            </div>
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                <!--end::Input group-->
                                            @endif

                                            <!--begin::Actions-->
                                                <div class="d-flex justify-content-end">
                                                    <button  onclick="document.getElementById('attendanceemployee_filter').submit(); return false;" class="btn btn-sm btn-primary"> {{__('Apply')}} </button>
                                                    <a href="{{route('attendanceemployee.index')}}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">{{__('Reset')}}</a>
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

                                <!--begin::Card body-->
                                <div class="card-body">
                                    <!--begin::Table-->
                                    <table id="payslipTable" class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                @if(auth()->user()->type!='employee')
                                                    <th class="min-w-100px">{{__('Employee')}}</th>
                                                @endif
                                                <th class="min-w-100px">{{__('Date')}}</th>
                                                <th class="min-w-100px">{{__('Status')}}</th>
                                                <th class="min-w-100px">{{__('Clock In')}}</th>
                                                <th class="min-w-100px">{{__('Clock Out')}}</th>
                                                <th class="min-w-100px">{{__('Late')}}</th>
                                                <th class="min-w-100px">{{__('Early Leaving')}}</th>
                                                <th class="min-w-100px">{{__('Overtime')}}</th>
                                                @if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))
                                                    <th class="min-w-100px">{{__('Action') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($attendanceEmployee as $attendance)
                                                <tr>
                                                    @if(auth()->user()->type!='employee')
                                                        <td>{{!empty($attendance->employee)?$attendance->employee->name:'' }}</td>
                                                    @endif
                                                    <td>{{ auth()->user()->dateFormat($attendance->date) }}</td>
                                                    <td>{{ $attendance->status }}</td>
                                                    <td>{{ ($attendance->clock_in !='00:00:00') ? auth()->user()->timeFormat( $attendance->clock_in):'00:00:00' }} </td>
                                                    <td>{{ ($attendance->clock_out !='00:00:00') ? auth()->user()->timeFormat( $attendance->clock_out):'00:00:00' }}</td>
                                                    <td>{{ $attendance->late }}</td>
                                                    <td>{{ $attendance->early_leaving }}</td>
                                                    <td>{{ $attendance->overtime }}</td>
                                                    @if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))
                                                        <td class="text-right action-btns">
                                                            @can('Edit Attendance')
                                                                <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ route('attendanceemployee.edit', $attendance->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                            @endcan
                                                            @can('Delete Attendance')
                                                                <a href="#" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{ __('Delete') }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id], 'id' => 'delete-form-'.$attendance->id]) !!}
                                                                {!! Form::close() !!}
                                                            @endif
                                                        </td>
                                                    @endif
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
    @if($attendanceEmployee->count() != 0)
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
                        document.getElementById('delete-form-{{$attendance->id}}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif

@endpush
