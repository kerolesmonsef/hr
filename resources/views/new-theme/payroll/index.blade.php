@extends('new-theme.layout.layout1')
@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/payroll.css') }}" />
@endpush
@section('content')
    <div class="payrollPage">

        <div class="pageS1">
            <div class='sectionS2'>
                <div class="head withBorder flex align between">
                    <h3 class='small'>{{ __('All Payrolls') }}</h3>
                    <div class='flex align gap-3 options'>

                        @can('Payroll-Print')
                            <button class='buttonS2  withBorder'>
                                <img src="/new-theme/icons/all/print.svg" class="iconImg" />
                                {{ __('Print') }}
                            </button>
                        @endcan

                        @can('Payroll-Export')
                            <a id="payroll_export" href="{{ Route('payroll.export', [$month, $year]) }}">
                                <button class='buttonS2 withBorder'>
                                    <img src="/new-theme/icons/all/download.svg" class="iconImg" />
                                    {{ __('Export') }}
                                </button>
                            </a>
                        @endcan

                        @can('Payroll-MonthlySalaryRecord')
                            <a id="Payrollpdf" href="{{ route('payslip.Payrollpdf', [$month, $year, $type]) }}">
                                <button class='buttonS1 primary'>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.58272 8.3623H5.59522C5.12272 8.3623 4.74023 8.74477 4.74023 9.21727V13.0573H7.58272V8.3623V8.3623Z"
                                            stroke="white" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9.57117 4.9502H8.43116C7.95866 4.9502 7.57617 5.33271 7.57617 5.80521V13.0502H10.4187V5.80521C10.4187 5.33271 10.0437 4.9502 9.57117 4.9502Z"
                                            stroke="white" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M12.4113 9.6377H10.4238V13.0502H13.2663V10.4927C13.2588 10.0202 12.8763 9.6377 12.4113 9.6377Z"
                                            stroke="white" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M6.75 16.5H11.25C15 16.5 16.5 15 16.5 11.25V6.75C16.5 3 15 1.5 11.25 1.5H6.75C3 1.5 1.5 3 1.5 6.75V11.25C1.5 15 3 16.5 6.75 16.5Z"
                                            stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    {{ __('Monthly payroll Log') }}
                                </button>
                            </a>
                        @endcan

                        @can('Payroll-PayrollTape')
                            <a id="Payrollbarpdf" href="{{ route('payslip.Payrollbarpdf', [$month, $year, $type]) }}">
                                <button class='buttonS1 primary'>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.5 4.5V6.315C16.5 7.5 15.75 8.25 14.565 8.25H12V3.0075C12 2.175 12.6825 1.5 13.515 1.5C14.3325 1.5075 15.0825 1.8375 15.6225 2.3775C16.1625 2.925 16.5 3.675 16.5 4.5Z"
                                            stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M1.5 5.25V15.75C1.5 16.3725 2.20498 16.725 2.69998 16.35L3.9825 15.39C4.2825 15.165 4.7025 15.195 4.9725 15.465L6.21748 16.7175C6.50998 17.01 6.99002 17.01 7.28252 16.7175L8.54251 15.4575C8.80501 15.195 9.225 15.165 9.5175 15.39L10.8 16.35C11.295 16.7175 12 16.365 12 15.75V3C12 2.175 12.675 1.5 13.5 1.5H5.25H4.5C2.25 1.5 1.5 2.8425 1.5 4.5V5.25Z"
                                            stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M4.5 6.75H9" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M5.0625 9.75H8.4375" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    {{ __('Payroll Bar') }}
                                </button>
                            </a>
                        @endcan

                        @can('Payroll-Payment')
                            <a href="#">
                                <button class='buttonS1 primary' type="button" data-bs-toggle="modal"
                                    data-bs-target="#bulkPayment">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.125 10.3122C7.125 11.0397 7.68751 11.6247 8.37751 11.6247H9.78749C10.3875 11.6247 10.875 11.1147 10.875 10.4772C10.875 9.79468 10.575 9.54719 10.1325 9.38969L7.875 8.60218C7.4325 8.44468 7.13251 8.20469 7.13251 7.51469C7.13251 6.88469 7.61999 6.36719 8.21999 6.36719H9.63C10.32 6.36719 10.8825 6.95219 10.8825 7.67969"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9 5.625V12.375" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.5 9C16.5 13.14 13.14 16.5 9 16.5C4.86 16.5 1.5 13.14 1.5 9C1.5 4.86 4.86 1.5 9 1.5"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16.5 4.5V1.5H13.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.75 5.25L16.5 1.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    {{ __('Bulk payment') }}
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
                    <div class="datePickerContainer">
                        {{ Form::open(['route' => ['payslip.store'], 'method' => 'POST', 'class' => '', 'id' => 'payslip_form']) }}

                        <div class='flex flex-wrap align gap-3'>
                            <div class='selectWithIcon'>
                                <div class="inputS1 noHeight start">
                                    <img src="/new-theme/icons/userS3.svg" class="iconImg" />
                                    <select id="department">
                                        <option value="">{{ __('All') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if ($request->department == $department->id) selected @endif>
                                                {{ $department['name' . $lang] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input style="width: 225px;" type="text" name="datepicker"
                                    value="{{ str_replace('-', '/', $formate_month_year) }}" placeholder="Feb 2023"
                                    class="datePickerMonth" autocomplete="off" />
                            </div>

                            @can('Payroll-Create')
                                <button type="submit" class='buttonS1 primary'>
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.125 10.3122C7.125 11.0397 7.68751 11.6247 8.37751 11.6247H9.78749C10.3875 11.6247 10.875 11.1147 10.875 10.4772C10.875 9.79468 10.575 9.54719 10.1325 9.38969L7.875 8.60218C7.4325 8.44468 7.13251 8.20469 7.13251 7.51469C7.13251 6.88469 7.61999 6.36719 8.21999 6.36719H9.63C10.32 6.36719 10.8825 6.95219 10.8825 7.67969"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9 5.625V12.375" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M16.5 9C16.5 13.14 13.14 16.5 9 16.5C4.86 16.5 1.5 13.14 1.5 9C1.5 4.86 4.86 1.5 9 1.5"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M16.5 4.5V1.5H13.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12.75 5.25L16.5 1.5" stroke="white" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    {{ __('Generate Payslip') }}
                                </button>
                            @endcan

                        </div>
                        {{ Form::close() }}
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
                                <th>{{ __('Department') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @include('new-theme.payroll.payroll')
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="paginater">
                @include('new-theme.payroll.paginate')
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            function fetch_data(query, datePicker, department) {
                $.ajax({
                    url: "{{ route('payslip.index') }}",
                    data: {
                        "search": query,
                        "datePicker": datePicker,
                        "department": department,
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
                var dateArr = datePicker.split('-');

                var route = "{{ route('payslip.Payrollpdf', ['monthValue', 'yearValue', '0,1']) }}";
                var url = route.replace('monthValue', dateArr[1]);
                url = url.replace('yearValue', dateArr[0]);
                $('#Payrollpdf').attr("href", url);

                var route2 = "{{ route('payslip.Payrollbarpdf', ['monthValue', 'yearValue', '0,1']) }}";
                var url2 = route.replace('monthValue', dateArr[1]);
                url2 = url.replace('yearValue', dateArr[0]);
                $('#Payrollbarpdf').attr("href", url2);

                var route3 = "{{ route('payroll.export', ['monthValue', 'yearValue']) }}";
                var url3 = route.replace('monthValue', dateArr[1]);
                url3 = url.replace('yearValue', dateArr[0]);
                $('#payroll_export').attr("href", url3);

                var department = $('#department').val();
                fetch_data(query, datePicker, department);
            });
        });
    </script>
@endpush
