@extends('layouts.admin')
@section('page-title')
    {{__('Manage Monthly Attendance')}}
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
                    <h1 class="fw-bold mb-5">{{__('Manage Monthly Attendance')}}</h1>

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
                                    {{ Form::open(array('route' => array('report.monthly.attendance'),'method'=>'get','id'=>'report_monthly_attendance')) }}
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
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <a href="{{route('report.monthly.attendance')}}" type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2">{{ __('Reset') }}</a>
                                            <button  onclick="document.getElementById('report_monthly_attendance').submit(); return false;" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">{{ __('apply') }}</button>
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
                                    <div id="printableArea">

                                        <div class="row mt-3">
                                            <div class="col">
                                                <input type="hidden" value="{{  $data['branch'] .' '.__('Branch') .' '.$data['curMonth'].' '.__('Attendance Report of').' '. $data['department'].' '.'Department'}}" id="filename">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Report')}} :</h5>
                                                    <h5 class="report-text mb-0">{{__('Attendance Summary')}}</h5>
                                                </div>
                                            </div>
                                            @if($data['branch']!='All')
                                                <div class="col">
                                                    <div class="card p-4 mb-4">
                                                        <h5 class="report-text gray-text mb-0">{{__('Branch')}} :</h5>
                                                        <h5 class="report-text mb-0">{{$data['branch']}}</h5>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($data['department']!='All')
                                                <div class="col">
                                                    <div class="card p-4 mb-4">
                                                        <h5 class="report-text gray-text mb-0">{{__('Department')}} :</h5>
                                                        <h5 class="report-text mb-0">{{$data['department']}}</h5>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Duration')}} :</h5>
                                                    <h5 class="report-text mb-0">{{$data['curMonth']}}</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-3 col-md-6 col-lg-3">
                                                <div class="card p-4 mb-4">
                                                    <div class="float-left">
                                                        <h5 class="report-text gray-text mb-0">{{__('Attendance')}}</h5>
                                                        <h5 class="report-text mb-0">{{__('Total present')}}: {{$data['totalPresent']}}</h5>
                                                    </div>
                                                    <div class="float-right">
                                                        <h5 class="report-text gray-text mb-0"></h5>
                                                        <h5 class="report-text mb-0">{{__('Total leave')}} : {{$data['totalLeave']}}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-lg-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Overtime')}}</h5>
                                                    <h5 class="report-text mb-0">{{__('Total overtime in hours')}} : {{number_format($data['totalOvertime'],2)}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-lg-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Early leave')}}</h5>
                                                    <h5 class="report-text mb-0">{{__('Total early leave in hours')}} : {{number_format($data['totalEarlyLeave'],2)}}</h5>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6 col-lg-3">
                                                <div class="card p-4 mb-4">
                                                    <h5 class="report-text gray-text mb-0">{{__('Employee late')}}</h5>
                                                    <h5 class="report-text mb-0">{{__('Total late in hours')}} : {{number_format($data['totalLate'],2)}}</h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                                                <div class="all-button-box">
                                                    <a href="#" class="btn w-100 mb-1 btn-primary btn-icon-only width-auto"
                                                        data-url="{{ route('attendance.file.import') }}" data-ajax-popup="true"
                                                        data-title="{{ __('Import Timesheet CSV file') }}">
                                                        <i class="fa fa-file-csv"></i> {{ __('Import') }}
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="card">
                                                    <div class="table-responsive py-4 attendance-table-responsive">
                                                        <table class="table table-striped mb-0" id="dataTable-1">
                                                            <thead>
                                                                <tr>
                                                                    <th class="active">{{__('Name')}}</th>
                                                                    @foreach($dates as $date)
                                                                        <th>{{explode('/',$date)[2]}}</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($employeesAttendance as $attendance)
                                                                    @php
                                                                       $Employee_Join_date = DB::table('employees')->where('id',$attendance['id'])->value('Join_date_gregorian');
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{$attendance['name']}}</td>
                                                                        @foreach($attendance['status'] as $key => $status)
                                                                            <td>
                                                                                @if(date("Y-m-d", strtotime(explode('-',$key)[0])) < date("Y-m-d" , strtotime($Employee_Join_date)) )
                                                                                <span style="color:#1a1818!important"> <b> N </b> </span>
                                                                                @elseif($status == 'P')
                                                                                    <span style="color:#28a745!important"> <b> P </b> </span>
                                                                                @elseif(in_array( explode('-',$key)[1] , explode(',',$setting->week_vacations ?? '') ))
                                                                                    <span style="color:#424443!important"> <b> O </b> </span>
                                                                                @elseif(in_array( date("Y-m-d", strtotime(explode('-',$key)[0])) , $holidays ?? '' ))
                                                                                    <span style="color:#377424!important"> <b> H </b> </span>
                                                                                @elseif($status =='A')
                                                                                    <span style="color:#990001!important"> <b> A </b> </span>
                                                                                @elseif($status =='V')
                                                                                    <span style="color:#786301!important"> <b> V </b> </span>
                                                                                @elseif($status =='S')
                                                                                    <span style="color:#C09000!important"> <b> S </b> </span>
                                                                                @elseif($status =='X')
                                                                                    <span style="color:#CC4025!important"> <b> X </b> </span>
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

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
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>

@endsection


