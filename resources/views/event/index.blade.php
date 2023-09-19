@extends('layouts.admin')

@section('page-title')
    {{__('Event')}}
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        </div>
        <!--end::Toolbar container-->
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <h2 class="card-title fw-bold">{{__('Event')}}</h2>
                    <div class="card-toolbar">
                        {{-- @can('Create Event') --}}
                            <button data-url="{{ route('event.create') }}" data-ajax-popup="true" data-title="{{__('Create New Event')}}" class="btn btn-flex btn-primary" data-kt-calendar="add">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                {{__('Create')}}
                            </button>
                        {{-- @endcan --}}
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Calendar-->
                    <div class="page-title">
                        <div class="row justify-content-between align-items-center full-calender">
                            <div class="col d-flex align-items-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                                <h5 class="fullcalendar-title h4 d-inline-block font-weight-400 mb-0"></h5>
                            </div>
                            <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">{{__('Month')}}</a>
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar e-height" data-toggle="event_calendar" id="event_calendar"></div>
                    <!--end::Calendar-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
@endsection

@push('script-page')\
    
    <script src="{{asset('admin/assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/fullcalendar/dist/fullcalendar.min.js')}}"></script>

    <script>
        // load chart data using these
        // event_calendar (not working now)
        var e, t, a = $('[data-toggle="event_calendar"]');
        a.length && (t = {
            header: {right: "", center: "", left: ""},
            buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
            theme: !1,
            selectable: !0,
            selectHelper: !0,
            editable: !0,
            events: {!! $arrEvents !!} ,
            eventStartEditable: !1,
            locale: '{{basename(App::getLocale())}}',

            eventResize: function (event) {
                var eventObj = {
                    start: event.start.format(),
                    end: event.end.format(),
                };

                $.ajax({
                    url: event.resize_url,
                    method: 'PUT',
                    data: eventObj,
                    success: function (response) {

                    },
                    error: function (data) {
                        data = data.responseJSON;
                    }
                });
            },
            viewRender: function (t) {

                e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
            },
            eventClick: function (e, t) {
                var title = e.title;
                var url = e.url;


                if (typeof url != 'undefined') {
                    $("#commonModal .modal-title").html(title);
                    $("#commonModal .modal-dialog").addClass('modal-md');
                    $("#commonModal").modal('show');
                    $.get(url, {}, function (data) {

                        $('#commonModal .modal-body').html(data);
                    });
                    return false;
                }
            }
        }, (e = a).fullCalendar(t),
            $("body").on("click", "[data-calendar-view]", function (t) {
                t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass("active");
                var a = $(this).attr("data-calendar-view");
                e.fullCalendar("changeView", a)
            }), $("body").on("click", ".fullcalendar-btn-next", function (t) {
            t.preventDefault(), e.fullCalendar("next")
        }), $("body").on("click", ".fullcalendar-btn-prev", function (t) {
            t.preventDefault(), e.fullCalendar("prev")
        }));

    </script>

    <script>
        $(document).ready(function () {
            var b_id = $('#branch_id').val();
            getDepartment(b_id);
        });

        $(document).on('change', 'select[name=branch_id]', function () {
            var branch_id = $(this).val();
            getDepartment(branch_id);
        });

        function getDepartment(bid) {
            $.ajax({
                url: '{{route('event.getdepartment')}}',
                type: 'POST',
                data: {
                    "branch_id": bid, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {

                    $('#department_id').empty();
                    $('#department_id').append('<option value="">{{__('Select Department')}}</option>');

                    $('#department_id').append('<option value="0"> {{__('All Department')}} </option>');
                    $.each(data, function (key, value) {
                        $('#department_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }

        $(document).on('change', '#department_id', function () {
            var department_id = $(this).val();
            getEmployee(department_id);
        });

        function getEmployee(did) {
            $.ajax({
                url: '{{route('event.getemployee')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {

                    $('#employee_id').empty();
                    $('#employee_id').append('<option value="">{{__('Select Employee')}}</option>');
                    $('#employee_id').append('<option value="0"> {{__('All Employee')}} </option>');

                    $.each(data, function (key, value) {
                        $('#employee_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    </script>
@endpush

