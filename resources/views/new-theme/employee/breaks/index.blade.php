@extends('new-theme.layout.layout1')
@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}"/>
    <script src="{{ assert('new-theme/js/mapPlaces.js') }}"></script>
@endpush

@section('content')
    <div class="employeesDetails">
        <div class="pageS1">
            @component('new-theme.employee.components.edit-employee-tabs.tabs')
                @slot('active', 'breaks')
                @slot('employee', $employee)

                <div class='sectionS2'>
                    <div class="head withBorder flex align between options">
                        <h3 class='small'>{{ __('Breaks') }}</h3>
                        <div class='flex align gap-3 options'>
                            <button id="print" class='buttonS2  withBorder'>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.4375 5.25H12.5625V3.75C12.5625 2.25 12 1.5 10.3125 1.5H7.6875C6 1.5 5.4375 2.25 5.4375 3.75V5.25Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path
                                        d="M12 11.25V14.25C12 15.75 11.25 16.5 9.75 16.5H8.25C6.75 16.5 6 15.75 6 14.25V11.25H12Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path
                                        d="M15.75 7.5V11.25C15.75 12.75 15 13.5 13.5 13.5H12V11.25H6V13.5H4.5C3 13.5 2.25 12.75 2.25 11.25V7.5C2.25 6 3 5.25 4.5 5.25H13.5C15 5.25 15.75 6 15.75 7.5Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path d="M12.75 11.25H11.8425H5.25" stroke="#292D32" stroke-width="1.2"
                                          stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.25 8.25H7.5" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                {{ __('Print') }}
                            </button>

                            <button id="export" class='buttonS2 withBorder'>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.33 6.67505C15.03 6.90755 16.1325 8.29505 16.1325 11.3325V11.43C16.1325 14.7825 14.79 16.125 11.4375 16.125H6.55499C3.20249 16.125 1.85999 14.7825 1.85999 11.43V11.3325C1.85999 8.31755 2.94749 6.93005 5.60249 6.68255"
                                        stroke="#292D32" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path d="M9 1.5V11.16" stroke="#292D32" stroke-width="1.2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M11.5125 9.48755L8.99999 12L6.48749 9.48755" stroke="#292D32"
                                          stroke-width="1.2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ __('Export') }}
                            </button>
                        </div>
                    </div>


                    <div class="searchWithDate options">
                        <div class='datePickerContainer'>
                            <div class='datePicker'>
                                <h3>{{__('Start date')}}</h3>
                                <div class="inputS1 noHeight">
                                    <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                    <input id="start_date" style="width: 225px;" type="text" value=""
                                           placeholder="{{__('Start date')}}" name="datepicker" class="datePickerBasic"
                                           autocomplete="off"/>
                                </div>
                            </div>
                            <div class='datePicker '>
                                <h3>{{__('End date')}}</h3>
                                <div class="inputS1 noHeight">
                                    <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                    <input id="end_date" style="width: 225px;" type="text" value=""
                                           placeholder="{{__('End date')}}" name="datepicker" class="datePickerBasic"
                                           autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tableS1 scroll trPointer">
                        <table>
                            <thead>
                            <tr>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time from - Time To') }}</th>
                                <th>{{ __('Start Time') }}</th>
                                <th>{{ __('End Time') }}</th>
                                <th>{{ __('Delay in minutes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @include('new-theme.employee.breaks.breaks')
                            </tbody>
                        </table>
                        <!-- <div class="status enabled">Pending</div> -->
                    </div>
                </div>

                <div class="paginater">
                    @include('new-theme.employee.breaks.paginate')
                </div>
            @endcomponent
        </div>
    </div>
@endsection


@push('script')
    @include("new-theme.components.export_print",[
        'export_url'=> route('breaks.export',['employee_id'=>$employee]),
        'print_url'=> route('breaks.print',['employee_id'=>$employee]),
    ])
    <script>
        $(document).ready(function () {
            function fetch_data(obj) {
                console.log(obj)
                $.ajax({
                    url: "{{ route('employee.breaks', $employee) }}",
                    data: {
                        ...obj
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
                                href = page + '?search=' + query;
                            } else {
                                href = page + '&search=' + query;
                            }
                            window.location.replace(href);
                        });
                    }
                })
            }

            $(document).on('change', '.datePickerBasic', function() {
                const start_date = $("#start_date").val();
                const end_date = $("#end_date").val();
                fetch_data({
                    end_date,
                    start_date
                });
            });

        });
    </script>
@endpush
