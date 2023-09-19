@extends('new-theme.layout.layout1')
@push('styles')
    <!--  -->
    <link rel="stylesheet" href="{{ url('new-theme/styles/index.css') }}"/>
@endpush
@section('content')
@if(auth()->user()->can('Dashboard-View'))
    <div class="indexPage">
        <div class="pageS1">
            <div class="row">
                <div class="col-lg-7">
                    <div class='sectionOne'>
                        <div class="cardHead">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="sectionS1 cardS1 flex align gap-3">
                                        <div class='mainIcon'>
                                            <img src="{{ url('new-theme/icons/group.svg') }}" alt=''/>
                                        </div>
                                        <div class="sectionNumber">
                                            <div class="name">{{ __('Total Employees') }}</div>
                                            <div class="number">{{ $employees_count }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="sectionS1 cardS1 flex align gap-3">
                                        <div class='mainIcon'>
                                            <img src="{{ url('new-theme/icons/calendar.svg') }}" alt=''/>
                                        </div>
                                        <div class="sectionNumber">
                                            <div class="name">{{ __('Total Attendance') }}</div>
                                            <div class="number">{{ $attendance_employees }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="sectionS1 cardS1 flex align gap-3">
                                        <div class='mainIcon'>
                                            <img src="{{ url('new-theme/icons/calendarSecond.svg') }}" alt=''/>
                                        </div>
                                        <div class="sectionNumber">
                                            <div class="name">{{ __('Total Vacations') }}</div>
                                            <div class="number">{{ $leaves_today_count }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="salesPurchases">
                                <div class="sectionS1">

                                    <div class="content">
                                        <div class="salesPurchasesHeader flex between align">
                                            <div class="head">
                                                <h3 class='small'> {{ __('Attendance Summary') }}</h3>
                                            </div>
                                            <div>

                                                <div class="inputS1" style="width: 130px">
                                                    <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                                    <input type="text" value="{{ request('month',now()->format('Y-m')) }}"
                                                        placeholder= "{{__('Monthly')}}" name="datepicker"
                                                        id="month-select"
                                                        
                                                        class="datePickerMonth flatpickr-input" autocomplete="off"
                                                        style="height: 35px" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="salesPurchasesWrapper mt-4">
                                            <div class="pieChartLabel">
                                                <div class="row" style=" padding-right: 14px; padding-left: 14px; ">

                                                    <div class="col-12 col-lg-4">

                                                        <div class="analyticsCard">
                                                            <div class="number">
                                                                <div class="boxColor" style="background: #61A2AF"></div>
                                                                {{ __('Attendance') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="analyticsCard">
                                                            <div class="number">
                                                                <div class="boxColor" style="background: #98B37C"></div>
                                                                {{ __('Permission') }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-lg-4">
                                                        <div class="analyticsCard">
                                                            <div class="number">
                                                                <div class="boxColor" style="background: #C78394"></div>
                                                                {{ __('Vacation') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <canvas id="salesPurchases"></canvas>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class='sectionS2 mt-4'>
                                <div class="head">
                                    <h3 class='small'>{{ __('Pending Request') }}</h3>
                                </div>

                                <div class="tableS1 scroll" style=" max-height: 350px; ">
                                    <table>

                                        <thead>
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Request Date') }}</th>
                                            <th>{{ __('Details') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($total_requests as $key => $request)
                                            @php
                                                $accept_arr = [
                                                    'leave' => route('vacations.approve', $request->id),
                                                    'permission' => route('employee-permissions.approve', $request->id),
                                                    'work_from_home_request' => route('work-from-home.approve', $request->id),
                                                    'loan' => route('loan-requests.approve', $request->id),
                                                    'mission'=> route('mission.approve', $request->id),
                                                    'over_time'=> route('over-time.accept', $request->id)
                                                ];
                                                $reject_arr = [
                                                    'leave' => route('vacations.reject', $request->id),
                                                    'permission' => route('employee-permissions.reject', $request->id),
                                                    'work_from_home_request' => route('work-from-home.reject', $request->id),
                                                    'loan' => route('loan-requests.reject', $request->id),
                                                    'mission'=> route('mission.reject', $request->id),
                                                    'over_time'=> route('over-time.reject', $request->id)
                                                ];
                                            @endphp
                                            <tr>
                                                <td>{{ app()->isLocale('en') ? $request->employee?->name : $request->employee?->name_ar }}
                                                </td>
                                                <td> {{ print_request_date($request) }}
                                                </td>
                                                <td>{{ __($request->modeltype) }}</td>
                                                <td>
                                                    <div class='actions flex gap-3'>

                                                        <a href="{{ $accept_arr[$request->modeltype] }}"
                                                        class='buttonS1 primary'>{{ __('Accept') }}</a>
                                                        <a href="{{ $reject_arr[$request->modeltype] }}"
                                                        class='buttonS1 rejected'>{{ __('Reject') }}</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class='sectionTwo'>
                            <div class='sectionS1 cardS1 todayAttendance'>
                                <div class="head">
                                    <h3 class='small'>{{ __('Today’s Attendance') }}</h3>
                                </div>
                                <div class='circleChart'>
                                    <canvas id="circleChart"></canvas>
                                </div>
                                <div class="pieChartLabel">
                                    <div class="row" style=" padding-right: 14px; padding-left: 14px; ">

                                        <div class="col-12 col-lg-4">

                                            <div class="analyticsCard">
                                                <div class="number">
                                                    <div class="boxColor" style="background: #61A2AF"></div>
                                                    {{ __('Attendance') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="analyticsCard">
                                                <div class="number">
                                                    <div class="boxColor" style="background: #98B37C"></div>
                                                    {{ __('Permission') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="analyticsCard">
                                                <div class="number">
                                                    <div class="boxColor" style="background: #C78394"></div>
                                                    {{ __('Vacation') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='sectionS2 mt-4'>
                                <div class="head">
                                    <h3 class='small'>{{ __('Today’s Meetings') }} </h3>
                                </div>
                                <table class="tableS1">
                                    <colgroup>
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                        <col>
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Time') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @forelse($meetings  as $meeting)
                                        <tr>
                                            <td>{{ $meeting->title }}</td>
                                            <td>{{ $meeting->date }}</td>
                                            <td>{{ $meeting->time }}</td>
                                            <td>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                                                        stroke="#066163" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"/>
                                                    <path d="M10.74 15.53L14.26 12L10.74 8.47" stroke="#066163"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"/>
                                                </svg>
                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-center"> {{ __('No_meetings_today') }} </p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade customeModal" id="rejectedReson1" tabindex="-1" aria-labelledby="rejectedReson1Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="formS1">
                            <div class="sectionS2">
                                <div class="head withBorder flex align between">
                                    <h3 class='small'>Reject Details</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="content">
                                    <div class="">
                                        <label for="payrollType" class="form-label">reason</label>
                                        <div class="inputS1">
                                            <input type="text" id="payrollType" placeholder='Enter reason'>
                                        </div>
                                    </div>

                                    <div class="flex align end gap-15 orders  mt-5 mb-4">
                                        <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            Cancel
                                        </button>


                                        <a href="##" class="buttonS1 primary">{{ __('Reject') }}</a>


                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Accept Details Modal -->
        <div class="modal fade customeModal" id="acceptReson1" tabindex="-1" aria-labelledby="acceptReson1Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="formS1">
                            <div class="sectionS2">
                                <div class="head withBorder flex align between">
                                    <h3 class='small'>Accept Details</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="content">


                                    <div class="">
                                        <label for="payrollType" class="form-label">Vacation type</label>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label class="inputRadio" for="type1">
                                                    <input type="radio" name="type" id="type1">
                                                    <span>Vacation balance</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="inputRadio" for="type2">
                                                    <input type="radio" name="type" id="type2" data-type="other">
                                                    <span>Other</span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="otherDetails" style="display:none">

                                        <div class="mt-4">
                                            <label for="payrollType" class="form-label">reason</label>
                                            <div class="inputS1">
                                                <input type="text" id="payrollType" placeholder='Enter reason'>
                                            </div>
                                        </div>


                                        <div class="mt-4">
                                            <label for="payrollType" class="form-label">deduction percent</label>

                                            <div class="inputS1">
                                                <select name="employee_id" required="">
                                                    <option value="0">0</option>
                                                    <option value="25">25%</option>
                                                    <option value="50">50%</option>
                                                    <option value="75">75%</option>
                                                    <option value="100">100%</option>


                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="flex align end gap-15 orders  mt-5 mb-4">
                                        <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            Cancel
                                        </button>


                                        <a href="##" class="buttonS1 primary">{{ __('Accept') }}</a>


                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirm1" abindex="-1" aria-hidden="true">
            <div class="modal-dialog confirmS1 ">
                <div class="content">
                    <div class="des">Are you sure you want to remove this Item?</div>
                    <div class="btns">
                        <button type="submit" class="buttonS2 danger">remove</button>
                        <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('script')
    <script>

        flatpickr(".datePickerMonth", {
            plugins: [
                new monthSelectPlugin({
                    shorthand: true, //defaults to false
                    dateFormat: "Y-m", //defaults to "F Y"
                }),
            ],
        })

        const cta = document.getElementById("salesPurchases");
        new Chart(cta, {
            type: "line",
            data: {
                labels: @json($employees_attendance['days']),
                datasets: [{
                    label: "{{ __('Attendance') }}",
                    data: @json($employees_attendance['counts']),
                    borderColor: "#61A2AF",

                },
                    {
                        label: "{{ __('Permission') }}",
                        data: @json($employees_leaves['counts']),
                        // backgroundColor: "#98B37C",
                        borderColor: "#98B37C",
                    },
                    {
                        label: "{{ __('Vacation') }}",
                        data: @json($employees_permissions['counts']),
                        // backgroundColor: "#C78394",
                        borderColor: "#C78394",
                    },
                ],
            },
            options: {
                barPercentage: 1,
                plugins: {
                    legend: {
                        display: false,
                        align: "{{ app()->getLocale() == 'en' ? 'start' : 'end' }}",


                        labels: {

                            usePointStyle: false,
                            boxWidth: 10,
                            boxHeight: 10,
                            font: {
                                family: "{{ app()->getLocale() == 'en' ? 'Poppins' : 'Tajawal' }}",

                            }

                        },
                    },
                },
                elements: {
                    display: false,
                    point: {

                        hoverRadius: 2,


                    }
                },

                scales: {

                    xAxes: [{
                        categoryPercentage: 0.0,
                        barPercentage: 0.0,
                    },],
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>

    <script>
        const counter = {
            id: "counter",
            beforeDraw(chart, args, options) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        right,
                        bottom,
                        left,
                        width,
                        height
                    },
                } = chart;
                ctx.save();
            },
            legend: {
                fontWeight: "bold",
            }
        };
        const des = {
            id: "des",
            beforeDraw(chart, args, options) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        right,
                        bottom,
                        left,
                        width,
                        height
                    },
                } = chart;
                ctx.save();
            },
        };

        const ctx = document.getElementById("circleChart");

        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["{{ __('Attendance') }}", "{{ __('Permission') }}", "{{ __('Vacation') }}"],
                datasets: [{
                    data: [{{ $attendance_employees }}, {{ $permission_today_count }}, {{ $leaves_today_count }}],
                    backgroundColor: ["#61A2AF", "#98B37C", "#C78394"],
                    hoverOffset: 4,
                    borderWidth: 0,
                },],
            },

            options: {
                cutout: "65%",
                plugins: {

                    legend: {
                        display: false,
                        position: 'bottom',
                        align: "{{ app()->getLocale() == 'en' ? 'start' : 'end' }}",
                        boxWidth: 10,
                        boxHeight: 10
                    },
                },
            },

            plugins: [counter, des],
        });
        
        $("#month-select").change(function (){
            let month = $(this).val();
            location.href = "{{ route('home') }}?month="+month;
        })
    </script>
@endpush
