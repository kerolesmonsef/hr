@extends('new-theme.layout.layout1', ['showReportMenu' => true])
@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/reports.css') }}" />
@endpush
@section('content')
    <div class="reportsPage">
        <div class="pageS1">

            <div class="sectionS1 mb-4">
                <div class="content">
                    <div class="flex align between mb-3 options">
                        <div class='purchasesContent flex align gap-5'>
                            <h3>{{ __('Attendance Summary') }}</h3>
                        </div>
                    </div>
                    <div class="salesPurchasesWrapper">
                        @include('new-theme.reports.attendance.chart')
                    </div>
                    <div class='pieChartLabel flex align gap-3 mt-3'>
                        <div class="analyticsCard">
                            <div class="number">
                                <div class="boxColor" style="background: #61A2AF"></div> {{__('Attendance')}}
                            </div>
                        </div>
                        <div class="analyticsCard">
                            <div class="number">
                                <div class="boxColor" style="background: #98B37C"></div> {{__('Permission')}}
                            </div>
                        </div>
                        <div class="analyticsCard">
                            <div class="number">
                                <div class="boxColor" style="background: #C78394"></div> {{__('Vacation')}}
                            </div>
                        </div>
                        <div class="analyticsCard">
                            <div class="number">
                                <div class="boxColor" style="background: #FFA800"></div> {{__('Employee Late')}}
                            </div>
                        </div>
                        <div class="analyticsCard">
                            <div class="number">
                                <div class="boxColor" style="background: #E75894"></div> {{__('Overtime')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='sectionS2'>
                <div class="head withBorder flex align between">
                    <h3 class='small'>{{ __('Attendance History') }}</h3>
                    <div class='flex align gap-3'>
                        @can('AttendanceReport-Print')
                            <a target="_blank" class='buttonS2 withBorder' id="attendancePrint" href="{{ Route('attendancereport.print', [$formate_month_year]) }}">
                                <img src="/new-theme/icons/all/print.svg" class="iconImg" />
                                {{ __('Print') }}
                            </a>
                        @endcan

                        @can('AttendanceReport-Export')
                            <a target="_blank" id="attendanceExport" href="{{ Route('attendancereport.export', [$formate_month_year]) }}"
                                class="attendance_export_btn">
                                <button class='buttonS2 withBorder'>
                                    <img src="/new-theme/icons/all/download.svg" class="iconImg" />
                                    {{ __('Export') }}
                                </button>
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="searchWithDate options">
                    <div class="inputS1 searchInput">
                        <input type="text" id="search" placeholder="{{ __('Search') }}">
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
                        <div class='selectWithIcon'>
                            <div class="inputS1 svg-start  selectMonth">
                                <img src="/new-theme/icons/userIcon.svg" class="iconImg" />
                                <select id="department">
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if ($request->department == $department->id) selected @endif>
                                            {{ $department['name' . $lang] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div style="width: 140px">
                            <div class="inputS1 noHeight">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input type="text" name="datepicker" value="{{ $year }}/{{ $month }}"
                                    class="datePickerMonth" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tableS1 scroll">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    {{ __('Name') }}
                                </th>
                                @foreach ($days as $day)
                                    <th>{{ $day }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @include('new-theme.reports.attendance.attendance')
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="paginater">
                @include('new-theme.reports.attendance.paginate')
            </div>

        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {

            function fetch_data(query, datePicker, department) {
                $.ajax({
                    url: "{{ route('report.monthly.attendance') }}",
                    data: {
                        "search": query,
                        "datePicker": datePicker,
                        "department": department
                    },
                    success: function(data) {
                        $('tbody').html('');
                        $('tbody').html(data.search);

                        $('.salesPurchasesWrapper').html('');
                        $('.salesPurchasesWrapper').html(data.statistics);

                        var route = "{{ route('attendancereport.export', ['dateValue']) }}";
                        var printRoute = "{{ route('attendancereport.print', ['dateValue']) }}";
                        
                        var url = route.replace('dateValue', datePicker);
                        var printUrl = printRoute.replace('dateValue', datePicker);
                       
                        $('#attendanceExport').attr("href", url);
                        $('#attendancePrint').attr("href", printUrl);

                        $('.paginater').html('');
                        $('.paginater').html(data.paginate);

                        $(document).on('click', '.pagination a', function(event) {
                            event.preventDefault();
                            var query = $('#search').val();
                            var page = $(this).attr('href');
                            let position = page.search("&");
                            if (position == -1) {
                                href = page + '?search=' + query + '&datePicker=' + datePicker +
                                    '&department=' + department;
                            } else {
                                href = page + '&search=' + query + '&datePicker=' + datePicker +
                                    '&department=' + department;
                            }
                            window.location.replace(href);
                        });
                    }
                })
            }

            function get_datepicker(datePickerMonthValue) {
                const myDateArray = datePickerMonthValue.split("/");
                var datePicker = myDateArray[0] + '-' + myDateArray[1];
                return datePicker;
            }

            $(document).on('keyup', '#search', function() {
                var query = $('#search').val();
                var datePicker = get_datepicker($('.datePickerMonth').val());
                var department = $('#department').val();
                fetch_data(query, datePicker, department);
            });

            $(document).on('change', '.datePickerMonth,#department', function() {
                var query = $('#search').val();
                var datePicker = get_datepicker($('.datePickerMonth').val());
                var department = $('#department').val();
                fetch_data(query, datePicker, department);
            });
        });
    </script>
@endpush
