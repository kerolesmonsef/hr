@extends('new-theme.layout.layout1')

@section('content')
    <div class="employessPage">
        <div class="pageS1">
            <div class='sectionOne mb-4'>

                <div class="attendanceChart">
                    <div class="sectionS1">

                        <div class="content">
                            <div class="salesPurchasesHeader flex between align mb-3 options">
                                <div class="head">
                                    <h3 class='small'>{{ __('Attendance Summary') }}</h3>
                                </div>

                                <div class="inputS1  selectMonth">
                                    <select onchange="window.location.href=this.options[this.selectedIndex].value;"
                                        id="thabeeeeeeeeeeet" class="pt-0 pb-0">
                                        @for ($year = 1970; $year < 2035; $year++)
                                            <option value="{{ route('attendance.index', ['year' => $year]) }}"
                                                {{ $graph_year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>
                            <div class="attendanceChartWrapper">
                                <canvas id="salesPurchases"
                                    style="display: block;box-sizing: border-box;height: 350px;width: 100%;"></canvas>
                                <div class="pieChartLabel mt-2">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div class="analyticsCard">
                                                <div class="number">
                                                    <div class="boxColor" style="background: #61A2AF"></div> {{__("Attendance")}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="analyticsCard">
                                                <div class="number">
                                                    <div class="boxColor" style="background: #98B37C"></div> {{__("Permission")}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="analyticsCard">
                                                <div class="number">
                                                    <div class="boxColor" style="background: #C78394"></div> {{__("Vacation")}}
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

            <div class='sectionS2'>
                <div class="head withBorder flex align between">

                    <h3 class='small'>{{ __('All Attendace') }}</h3>
                    <div class='flex align gap-3 options'>
                        @can('Attendance-Print')
                            <button id="print" class='buttonS2  withBorder'>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.4375 5.25H12.5625V3.75C12.5625 2.25 12 1.5 10.3125 1.5H7.6875C6 1.5 5.4375 2.25 5.4375 3.75V5.25Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12 11.25V14.25C12 15.75 11.25 16.5 9.75 16.5H8.25C6.75 16.5 6 15.75 6 14.25V11.25H12Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M15.75 7.5V11.25C15.75 12.75 15 13.5 13.5 13.5H12V11.25H6V13.5H4.5C3 13.5 2.25 12.75 2.25 11.25V7.5C2.25 6 3 5.25 4.5 5.25H13.5C15 5.25 15.75 6 15.75 7.5Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12.75 11.25H11.8425H5.25" stroke="#292D32" stroke-width="1.2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5.25 8.25H7.5" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ __('Print') }}
                            </button>
                        @endcan


                        @can('Attendance-Export')
                            <a id="export" href="{{ route('attendance.export') }}">
                                <button class='buttonS2 withBorder'>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12.33 6.67505C15.03 6.90755 16.1325 8.29505 16.1325 11.3325V11.43C16.1325 14.7825 14.79 16.125 11.4375 16.125H6.55499C3.20249 16.125 1.85999 14.7825 1.85999 11.43V11.3325C1.85999 8.31755 2.94749 6.93005 5.60249 6.68255"
                                            stroke="#292D32" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 1.5V11.16" stroke="#292D32" stroke-width="1.2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M11.5125 9.48755L8.99999 12L6.48749 9.48755" stroke="#292D32"
                                            stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    {{ __('Export') }}
                                </button>
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="searchWithDate options">
                    <div class="inputS1 searchInput">
                        <input type="text" value="{{ request('search') }}" id="search"
                            placeholder="{{ __('Search') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                fill="#D9D9D9"></path>
                            <path
                                d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                fill="#D9D9D9"></path>
                            <path
                                d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                fill="#D9D9D9"></path>
                            <path
                                d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                fill="#D9D9D9"></path>
                        </svg>
                    </div>
                    <div class='datePickerContainer'>
                        <div class='datePicker'>
                            <h3>{{ __('Start date') }}</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input style="width: 225px;" id="start_date" type="text" value=""
                                    placeholder="{{ __('Start date') }}" name="daterange" class="datePickerCustom"
                                    autocomplete="off" />
                            </div>
                        </div>
                        <div class="datePicker">
                            <h3>{{ __('End date') }}</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input style="width: 225px;" id="end_date" type="text" value=""
                                    placeholder="{{ __('End date') }}" name="daterange" class="datePickerCustom"
                                    autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tableS1 scroll trPointer">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <div class='icon'>
                                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.76001 7.62C8.79001 7.62 10.45 5.97 10.45 3.94C10.45 1.91 8.80001 0.25 6.76001 0.25C4.73001 0.25 3.08001 1.9 3.08001 3.94C3.08001 5.98 4.73001 7.62 6.76001 7.62Z"
                                                fill="#868686" />
                                            <path
                                                d="M9.64001 9.05005H4.37001C2.01001 9.05005 0.100006 10.97 0.100006 13.32V14C0.100006 14.96 0.890006 15.75 1.85001 15.75H12.16C13.12 15.75 13.91 14.96 13.91 14V13.33C13.91 10.97 11.99 9.05005 9.64001 9.05005Z"
                                                fill="#868686" />
                                        </svg>
                                    </div>
                                </th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Job Title') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Clock In') }}</th>
                                <th>{{ __('Clock Out') }}</th>
                                <th>{{ __('Work Hours') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('new-theme.employee.attendance.attendance')
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="paginater paginationS1 flex gap-4 align">
                @include('new-theme.employee.attendance.paginate')
            </div>

        </div>
    </div>
@endsection

@push('script')
    @include('new-theme.components.export_print', [
        'print_url' => route('attendance.print'),
        'export_url' => route('attendance.export'),
    ])
    <script>
        $(document).ready(function() {
            function fetch_data(query, start_date, end_date) {
                $.ajax({
                    url: "{{ route('attendance.index') }}",
                    data: {
                        "search": query,
                        "start_date": start_date,
                        "end_date": end_date,
                    },
                    success: function(data) {
                        $('tbody').html('');
                        $('tbody').html(data.search);
                        $('.paginater').html('');
                        $('.paginater').html(data.paginate);

                        $(document).on('click', '.pagination a', function(event) {
                            event.preventDefault();
                            var query = $('#search').val();
                            var page = $(this).attr('href');
                            let position = page.search("&");
                            if (position == -1) {
                                href = page + '?search=' + query + '&start_date=' + start_date +
                                    '&end_date=' + end_date;
                            } else {
                                href = page + '&search=' + query + '&start_date=' + start_date +
                                    '&end_date=' + end_date;
                            }
                            window.location.replace(href);
                        });
                    }
                })
            }

            $(document).on('keyup', '#search', function() {
                var query = $('#search').val();
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                fetch_data(query, start_date, end_date);
            });

            $(document).on('change', '.datePickerCustom', function() {
                var query = $('#search').val();
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();
                fetch_data(query, start_date, end_date);
            });

            flatpickr(".datePickerCustom", {
                dateFormat: "Y-m-d"
            });


        });
    </script>
@endpush

@push('script')
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>
        const cta = document.getElementById("salesPurchases");
        new Chart(cta, {
            type: "bar",
            data: {
                labels: [
                    "{{ __('Jan') }}",
                    "{{ __('Feb') }}",
                    "{{ __('Mar') }}",
                    "{{ __('Apr') }}",
                    "{{ __('May') }}",
                    "{{ __('Jun') }}",
                    "{{ __('Jul') }}",
                    "{{ __('Aug') }}",
                    "{{ __('Sep') }}",
                    "{{ __('Oct') }}",
                    "{{ __('Nov') }}",
                    "{{ __('Dec') }}",
                ],

                datasets: [{
                        label: "{{ __('Attendance') }}",
                        data: <?php echo $graph_attendance_arr; ?>,
                        backgroundColor: "#61A2AF",
                        borderRadius: 4,
                    },

                    {
                        label: "{{ __('Permission') }}",
                        data: <?php echo $graph_permission_arr; ?>,
                        backgroundColor: "#98B37C",
                        borderRadius: 4,
                    },

                    {
                        label: "{{ __('Vacation') }}",
                        data: <?php echo $graph_leave_arr; ?>,
                        backgroundColor: "#C78394",
                        borderRadius: 4,
                        marginLeft: 2
                    },

                ],
            },
            options: {
                barPercentage: 1,
                plugins: {
                    legend: {
                        align: "end",
                        display: false,
                        labels: {
                            usePointStyle: true,
                            pointStyle: "circle",
                            boxWidth: 8,
                            boxHeight: 8,
                        },
                    },
                },
                scales: {
                    xAxes: [{
                        categoryPercentage: 0.0,
                        barPercentage: 0.0,
                    }, ],
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
@endpush
