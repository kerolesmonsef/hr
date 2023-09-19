@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')

@if(auth()->user()->type == 'employee')
<div class="container" style="margin-top:100px;margin-bottom:30px;">
    <div class="card">
        <div class="card-body">
          <p class="card-text">{{ __('Check in today') }}</p>
            @if(auth()->user()->employee->haveAttendanceToday())
                <form action="{{ route('employee-check-out') }}" method="post">
            @else
                <form action="{{ route('employee-check-in') }}" method="post">
            @endif
                @csrf
                <input type="hidden" id="lat" name="lat" diabled />
                <input type="hidden" id="lon" name="lon"  diabled/>
                @if(auth()->user()->employee->haveAttendanceToday())
                    <p> Clock In Time : {{ auth()->user()->employee->haveAttendanceToday()->clock_in }} </p>
                    @if(auth()->user()->employee->haveAttendanceToday()->clock_out)
                        <p> Clock Out Time : {{ auth()->user()->employee->haveAttendanceToday()->clock_out }} </p>
                    @else
                        <button href="{{ route('employee-check-out') }}" class="btn btn-primary">{{ __('Check Out') }}</button>
                    @endif
                @else
                    <button href="{{ route('employee-check-in') }}" class="btn btn-primary">{{ __('Check in') }}</button>
                @endif
          </form>
        </div>
      </div>
</div>
@endif


@if(auth()->user()->type == 'company' && auth()->id() != 218)
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <!--begin::Title-->
                        {{-- <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('indicator panel') }}</h1> --}}
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar container-->
            </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    @if(auth()->user()->type != 'employee')
                        <!--begin::Row-->
                            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                <!--begin::Col-->
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-3 mb-md-5 mb-xl-10">
                                    <!--begin::Card widget 17-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                        <!--begin::Header-->
                                        <div class="card-header pt-5">
                                            <!--begin::Title-->
                                            <div class="card-title d-flex flex-column">
                                                <!--begin::Info-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Amount-->
                                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$totalemployees->count()}}</span>
                                                    <!--end::Amount-->
                                                </div>
                                                <!--end::Info-->
                                                <!--begin::Subtitle-->
                                                <span class="text-gray-400 pt-1 fw-semibold fs-6">{{__('employee numbers')}}</span>
                                                <!--end::Subtitle-->
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Header-->

                                        <!--begin::Card body-->
                                        <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                                            <!--begin::Chart-->
                                                <div class="d-flex flex-center me-5 pt-2">
                                                    <canvas id="kt_card_widget_chart" width="100" height="100"></canvas>
                                                </div>
                                            <!--end::Chart-->

                                            <!--begin::Labels-->
                                                <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                                    <!--begin::Label-->
                                                    <div class="d-flex fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="text-gray-500 flex-grow-1 me-4">{{__('Joined this month')}}</div>
                                                        <!--end::Label-->
                                                        <!--begin::Stats-->
                                                        <div class="fw-bolder text-gray-700 text-xxl-end">{{$joinedEmployees}}</div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->

                                                    <!--begin::Label-->
                                                    <div class="d-flex fw-semibold align-items-center my-3">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-3px rounded-2 bg-danger me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="text-gray-500 flex-grow-1 me-4">{{__('Offboarded this month')}}</div>
                                                        <!--end::Label-->
                                                        <!--begin::Stats-->
                                                        <div class="fw-bolder text-gray-700 text-xxl-end">{{$offboardEmployees}}</div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->

                                                    <!--begin::Label-->
                                                    <div class="d-flex fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="text-gray-500 flex-grow-1 me-4">{{__('Open ticket')}}</div>
                                                        <!--end::Label-->
                                                        <!--begin::Stats-->
                                                        <div class="fw-bolder text-gray-700 text-xxl-end">{{$countOpenTicket}}</div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->

                                                    <!--begin::Label-->
                                                    <div class="d-flex fw-semibold align-items-center">
                                                        <!--begin::Bullet-->
                                                        <div class="bullet w-8px h-3px rounded-2 bg-info me-3"></div>
                                                        <!--end::Bullet-->
                                                        <!--begin::Label-->
                                                        <div class="text-gray-500 flex-grow-1 me-4">{{__('Close ticket')}}</div>
                                                        <!--end::Label-->
                                                        <!--begin::Stats-->
                                                        <div class="fw-bolder text-gray-700 text-xxl-end">{{$countCloseTicket}}</div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Label-->

                                                </div>
                                            <!--end::Labels-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card widget 17-->
                                </div>
                                <!--end::Col-->
                            </div>
                        <!--end::Row-->
                    @endif

                    <!--begin::Row-->
                        <div class="row gy-5 g-xl-8 mb-xl-10">
                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Mixed Widget 3-->
                                <div class="card card-xl-stretch mb-xl-8">
                                    <!--begin::Beader-->
                                    <div class="card-header border-0 py-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">{{__('Report')}}</span>
                                            <span class="text-muted fw-semibold fs-7"></span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body p-0 d-flex flex-column">
                                        <!--begin::Stats-->
                                        <div class="card-p pt-5 bg-body flex-grow-1">
                                            <!--begin::Row-->
                                            <div class="row g-0">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('totalBasicSalary')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold">{{auth()->user()->priceFormat($filterData['totalBasicSalary'] )}}</div>
                                                    </div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('totalNetSalary')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="fs-4 fw-bold">{{auth()->user()->priceFormat($filterData['totalNetSalary'])}}</div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="row g-0 mt-8">
                                                <!--begin::Col-->
                                                <div class="col mr-8">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('totalAllowance')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="fs-4 fw-bold">{{auth()->user()->priceFormat($filterData['totalAllowance'])}}</div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('totalCommision')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold">{{auth()->user()->priceFormat($filterData['totalCommision'])}}</div>
                                                    </div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->

                                            <!--begin::Row-->
                                            <div class="row g-0 mt-8">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('totalSaturationDeduction')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold">{{auth()->user()->priceFormat($filterData['totalSaturationDeduction']) }}</div>
                                                    </div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('totalLoan')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="fs-4 fw-bold">
                                                        {{auth()->user()->priceFormat($filterData['totalLoan']) }}
                                                    </div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Row-->
                                            <div class="row g-0 mt-8">
                                                <!--begin::Col-->
                                                <div class="col mr-8">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('totalOtherPayment')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="fs-4 fw-bold">{{auth()->user()->priceFormat($filterData['totalOtherPayment'])}}</div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold"> {{__('totalOverTime')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold"> {{auth()->user()->priceFormat($filterData['totalOverTime'])}} </div>
                                                    </div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Mixed Widget 3-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-xl-6">
                                <!--begin::Mixed Widget 4-->
                                <div class="card card-xl-stretch">
                                    <!--begin::Beader-->
                                    <div class="card-header border-0 py-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">{{__('Finance')}}</span>
                                            <span class="text-muted fw-semibold fs-7"></span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body d-flex flex-column">
                                        <div class="flex-grow-1">
                                            <canvas id="mixed_widget_chart" width="225" height="225"></canvas>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Mixed Widget 4-->
                            </div>
                            <!--end::Col-->
                        </div>
                    <!--end::Row-->

                    @if(auth()->user()->type == 'company')
                        <!--begin::Row-->
                            <div class="row gy-5 g-xl-8 mb-xl-10">
                                <!--begin::Col-->
                                <div class="col-xl-12">
                                    <!--begin::Mixed Widget 3-->
                                    <div class="card card-xl-stretch mb-xl-8">
                                        <!--begin::Beader-->
                                        <div class="card-header border-0 py-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bold fs-3 mb-1"></span>
                                                <span class="text-muted fw-semibold fs-7"></span>
                                            </h3>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body p-0 d-flex flex-column">
                                            <!--begin::Stats-->
                                            <div class="card-p pt-5 bg-body flex-grow-1">
                                                <canvas style="height: -webkit-fill-available;" class="flot-chart-content" id="flot-dashboard-chart"></canvas>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Mixed Widget 3-->
                                </div>
                                <!--end::Col-->
                            </div>
                        <!--end::Row-->
                    @endif

                    <!--begin::Row-->
                        <div class="row g-5 g-xl-8 mb-xl-10">
                            <div class="col-xl-4">
                                <!--begin::List Widget 4-->
                                <div class="card card-xl-stretch mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-dark">{{__('latest_Announcements')}}</span>
                                            <span class="text-muted mt-1 fw-semibold fs-7"></span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        @if($announcements->count() != 0)
                                            @foreach($announcements as $key => $Announcement)
                                                <!--begin::Item-->
                                                    <div class="d-flex align-items-sm-center mb-7">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-50px me-5">
                                                            <span class="symbol-label">
                                                                <img src="{{asset('admin/assets/media/icons/announcement.png')}}" class="h-50 align-self-center" alt="">
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->

                                                        <!--begin::Section-->
                                                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                            <div class="flex-grow-1 me-2">
                                                                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">{{$Announcement->title}}</a>
                                                                <span class="text-muted fw-semibold d-block fs-7">{{$Announcement->employee ? $Announcement->employee->name : '-'}}</span>
                                                            </div>
                                                            <span class="badge badge-light fw-bold my-2">{{$Announcement->start_date}} - {{$Announcement->end_date}}</span>
                                                        </div>
                                                        <!--end::Section-->
                                                    </div>
                                                <!--end::Item-->
                                            @endforeach
                                        @else
                                            <p class="text-center"> {{__('No_Announcements_today')}}</p>
                                        @endif
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::List Widget 4-->
                            </div>

                            <div class="col-xl-4">
                                <!--begin::List Widget 5-->
                                <div class="card card-xl-stretch mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header align-items-center border-0 mt-4">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="fw-bold mb-2 text-dark">{{__('Today_events')}}</span>
                                            <span class="text-muted fw-semibold fs-7"></span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        <!--begin::Timeline-->
                                        <div class="timeline-label">
                                            @if($events->count() != 0)
                                                @foreach($events as $key => $event)
                                                <!--begin::Item-->
                                                    <div class="timeline-item">
                                                        <!--begin::Label-->
                                                        <div class="timeline-label fw-bold text-gray-800 fs-12">{{date('m-d' , strtotime($event->start_date))}}</div>

                                                        <!--end::Label-->
                                                        <!--begin::Badge-->
                                                        <div class="timeline-badge">
                                                            <i class="fa fa-genderless fs-1" style="color: {{$event->color}}"></i>
                                                        </div>
                                                        <!--end::Badge-->
                                                        <!--begin::Text-->
                                                        <div class="fw-mormal timeline-content text-muted ps-3"> {{$event['title'.$lang]}} </div>
                                                        <!--end::Text-->
                                                    </div>
                                                <!--end::Item-->
                                                @endforeach
                                            @else
                                                <p class="text-center"> {{__('No_events_today')}} </p>
                                            @endif
                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end: Card Body-->
                                </div>
                                <!--end: List Widget 5-->
                            </div>

                            <div class="col-xl-4">
                                <!--begin::List Widget 3-->
                                <div class="card card-xl-stretch mb-5 mb-xl-8">
                                    <!--begin::Header-->
                                    <div class="card-header border-0">
                                        <h3 class="card-title fw-bold text-dark">{{__('Today_Meetings')}}</h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-2">
                                        @if($meetings->count() != 0)
                                            @foreach($meetings as $key => $meet)
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-8">
                                                    <!--begin::Description-->
                                                    <div class="flex-grow-1">
                                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">{{$meet->title}}</a>
                                                        <span class="text-muted fw-semibold d-block">{{$meet->time}}</span>
                                                    </div>
                                                    <!--end::Description-->
                                                    <span class="badge badge-light-success fs-8 fw-bold">{{$meet->date}}</span>
                                                </div>
                                                <!--end:Item-->
                                            @endforeach
                                        @else
                                            <p class="text-center"> {{__('No_meetings_today')}} </p>
                                        @endif
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end:List Widget 3-->
                            </div>
                        </div>
                    <!--end::Row-->

                    @if(auth()->user()->type == 'company')
                        <!--begin::Row-->
                            <div class="g-5 gx-xxl-8 mb-xl-10">
                                <!--begin::Tables Widget 10-->
                                <div class="card">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 pt-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold fs-3 mb-1">{{__("Today's Not Clock In")}}</span>
                                            <span class="text-muted mt-1 fw-semibold fs-7"></span>
                                        </h3>

                                        <div class="card-p pt-5 bg-body flex-grow-1">
                                            <!--begin::Row-->
                                            <div class="row g-0">
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{__('employee numbers')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-4 fw-bold">{{$totalemployees->count()}}</div>
                                                    </div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{ __('Absent')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="fs-4 fw-bold">{{$notClockIns->count()}}</div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col">
                                                    <!--begin::Label-->
                                                    <div class="fs-7 text-muted fw-bold">{{ __('Present')}}</div>
                                                    <!--end::Label-->
                                                    <!--begin::Stat-->
                                                    <div class="fs-4 fw-bold">{{$ClockIns->count()}}</div>
                                                    <!--end::Stat-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->

                                        </div>


                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-0">
                                                        <th class="p-0"></th>
                                                        <th class="p-0 min-w-250px"></th>
                                                        <th class="p-0 min-w-150px text-end"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    @foreach($totalemployees as $employee)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <!--begin::Avatar-->
                                                                    <div class="symbol symbol-45px me-5">
                                                                        <img alt="Pic" src="{{ $employee->user && $employee->user->avatar ? asset(Storage::url('uploads/avatar/'.$employee->user->avatar)) : asset(Storage::url('uploads/avatar/avatar.png'))}}">
                                                                    </div>
                                                                    <!--end::Avatar-->

                                                                    <!--begin::Name-->
                                                                    <div class="d-flex justify-content-start flex-column">
                                                                        <a href="{{route('employee.show',($employee->id))}}" class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $employee->name }}</a>
                                                                        <a href="{{route('employee.show',($employee->id))}}" class="text-muted text-hover-primary fw-semibold text-muted d-block fs-7">
                                                                            {{ auth()->user()->employeeIdFormat($employee->employee_id) }}
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Name-->
                                                                </div>
                                                            </td>
                                                            <td class="text-end">
                                                                @if(in_array($employee->id,$attendanceEmployee))
                                                                    <span class="badge badge-light-success">{{ __('Present')}}</span>
                                                                @else
                                                                    <span class="badge badge-light-danger">{{__('Absent')}}</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-end">
                                                                <a href="{{route('employee.show',($employee->id))}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                                                    <span class="svg-icon svg-icon-3">
                                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                                                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--begin::Body-->
                                </div>
                                <!--end::Tables Widget 10-->
                            </div>
                        <!--end::Row-->
                    @endif

                </div>
                <!--end::Content container-->
            </div>
        <!--end::Content-->
    </div>
@endif

@endsection

@push('script-page')

@if(auth()->user()->type != 'employee')
    <script>
        // doughnut chart js
        var oilCanvas = document.getElementById("kt_card_widget_chart");
        var oilData   = {
            datasets:
            [
                {
                    data: [
                        {{ $joinedEmployees}}
                        ,
                        {{ $offboardEmployees }}
                        ,
                        {{ $countOpenTicket }}
                        ,
                        {{ $countCloseTicket }}
                    ],
                    backgroundColor: [
                        KTUtil.getCssVariableValue('--kt-success'),
                        KTUtil.getCssVariableValue('--kt-danger'),
                        KTUtil.getCssVariableValue('--kt-primary'),
                        KTUtil.getCssVariableValue('--kt-info'),
                    ]
                }
            ]
        };

        var pieChart = new Chart(oilCanvas, {
        type: 'doughnut',
        data: oilData
        });

    </script>
@endif

<script>
    function getCurrentLocation() {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                  };
                  
                  document.getElementById("lat").value = pos.lat;
                  document.getElementById("lon").value = pos.lng;
                }, function() {
                  handleLocationError(true, map.getCenter());
                });
          } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, map.getCenter());
          }
};

getCurrentLocation();

</script>

<script>
    //polarArea chart js
    var FinanceCanvas = document.getElementById("mixed_widget_chart");
    var FinanceData   = {
    labels: [
            '{{__('totalBasicSalary')}}',
            '{{__('totalNetSalary')}}',
            '{{__('totalAllowance')}}',
            '{{__('totalCommision')}}',
            '{{__('totalSaturationDeduction')}}',
            '{{__('totalLoan')}}',
            '{{__('totalOtherPayment')}}',
            '{{__('totalOverTime')}}',
        ],
    datasets: [
        {
            data: [
                {{ $filterData['totalBasicSalary'] }}
                ,
                {{ $filterData['totalNetSalary'] }}
                ,
                {{ $filterData['totalAllowance'] }}
                ,
                {{ $filterData['totalCommision'] }}
                ,
                {{ $filterData['totalLoan'] }}
                ,
                {{ $filterData['totalSaturationDeduction'] }}
                ,
                {{ $filterData['totalOtherPayment'] }}
                ,
                {{ $filterData['totalOverTime'] }}
            ],
            backgroundColor: [
                KTUtil.getCssVariableValue('--kt-success'),
                KTUtil.getCssVariableValue('--kt-danger'),
                KTUtil.getCssVariableValue('--kt-primary'),
                KTUtil.getCssVariableValue('--kt-info'),
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(201, 203, 207)',
            ]
        }]
    };

    var pieChart1 = new Chart(FinanceCanvas, {
        type: 'pie',
        data: FinanceData
    });

    // chart
    const ctx    = document.getElementById('flot-dashboard-chart').getContext('2d');
    var depts    = <?php echo $depts; ?>;
    var empcount = <?php echo $empcount; ?>;

    const myChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: depts,
            datasets: [{
                label: "",
                fill: !0,
                backgroundColor: KTUtil.getCssVariableValue('--kt-info'),
                borderColor: KTUtil.getCssVariableValue('--kt-primary'),
                pointBackgroundColor: KTUtil.getCssVariableValue('--kt-info'),
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(156,204,101,1)",
                data: empcount,
            }, ],
        },
        options: {
            animations: {
            radius: {
                duration: 400,
                easing: 'linear',
                loop: (context) => context.active
            }
            },
            hoverRadius: 12,
            hoverBackgroundColor: 'yellow',
            interaction: {
            mode: 'nearest',
            intersect: false,
            axis: 'x'
            },
            plugins: {
                tooltips: {
                callbacks: {
                    label: function(e, r) {
                        return " $ " + e.yLabel;
                    },
                },
            },
            }
        },
    });

</script>
@endpush
