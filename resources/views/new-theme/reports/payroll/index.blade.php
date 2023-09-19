@extends('new-theme.layout.layout1', ['showReportMenu' => true])

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/reports.css') }}" />
@endpush
@section('content')
    <div class="payrollReports">
        <div class="pageS1">

            <div class='payrollCards'>
                @include('new-theme.reports.payroll.statistics')
            </div>

            <div class='sectionS2'>
                <div class="head withBorder flex align between">
                    <div class="month_text">
                        <h3 class='small '>{{ __($str_month) }} {{ $year }}</h3>
                    </div>

                    <div class='flex align gap-3'>
                        @can('PayrollReport-Print')
                            <button class='buttonS2  withBorder'>
                                <img src="/new-theme/icons/all/print.svg" class="iconImg" />
                                {{ __('Print') }}
                            </button>
                        @endcan

                        @can('PayrollReport-Print')
                            <a class="payroll_export_btn" href="{{ Route('payrollreport.export', [$formate_month_year]) }}">
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
                        <input type="text" id="search" placeholder="{{ __('Search') }}....">
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
                                <img src="/new-theme/icons/userS3.svg" class="iconImg" />
                                <select id="payroll_department">
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if ($request->department == $department->id) selected @endif>
                                            {{ $department['name' . $lang] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div style="width: 120px">
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
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @include('new-theme.reports.payroll.payroll')
                        </tbody>

                    </table>
                </div>
            </div>

            <div class="paginater">
                @include('new-theme.reports.payroll.paginate')
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            function fetch_data(query, datePicker, department) {
                $.ajax({
                    url: "{{ route('report.payroll') }}",
                    data: {
                        "search": query,
                        "datePicker": datePicker,
                        "department": department
                    },
                    success: function(data) {
                        $('tbody').html('');
                        $('tbody').html(data.search);

                        $('.payrollCards').html('');
                        $('.payrollCards').html(data.statistics);

                        $('.payroll_export_btn').prop("href", "payroll/export/" + datePicker);

                        // $('.month_text').html('');
                        // $('.month_text').html("<h3 class='small '>{{ __($str_month) }} {{ $year }}</h3>");

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
                var department = $('#payroll_department').val();
                fetch_data(query, datePicker, department);
            });

            $(document).on('change', '.datePickerMonth,#payroll_department', function() {
                var query = $('#search').val();
                var datePicker = get_datepicker($('.datePickerMonth').val());
                var department = $('#payroll_department').val();
                fetch_data(query, datePicker, department);
            });
        });
    </script>
@endpush
