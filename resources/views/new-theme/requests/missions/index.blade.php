@extends('new-theme.layout.layout1')
@push('styles')
    <link rel="stylesheet" href="{{ url('new-theme/styles/requests.css') }}"/>
@endpush
@section('content')
    <div class="workRemotely requests">
        <div class="pageS1">

            <div class='sectionS2'>
                <div class="head withBorder flex align between">
                    <h3 class='small'>{{ __('All Missions') }}</h3>
                    <div class='flex align gap-3'>

                        @can('Mission-Print')
                            <button id="print" class='buttonS2  withBorder'>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.4375 5.25H12.5625V3.75C12.5625 2.25 12 1.5 10.3125 1.5H7.6875C6 1.5 5.4375 2.25 5.4375 3.75V5.25Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path
                                        d="M12 11.25V14.25C12 15.75 11.25 16.5 9.75 16.5H8.25C6.75 16.5 6 15.75 6 14.25V11.25H12Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path
                                        d="M15.75 7.5V11.25C15.75 12.75 15 13.5 13.5 13.5H12V11.25H6V13.5H4.5C3 13.5 2.25 12.75 2.25 11.25V7.5C2.25 6 3 5.25 4.5 5.25H13.5C15 5.25 15.75 6 15.75 7.5Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path d="M12.75 11.25H11.8425H5.25" stroke="#292D32" stroke-width="1.2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.25 8.25H7.5" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{__('Print')}}
                            </button>
                        @endcan

                        @can('Mission-Export')
                            <button id="export" class='buttonS2 withBorder'>
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.33 6.67505C15.03 6.90755 16.1325 8.29505 16.1325 11.3325V11.43C16.1325 14.7825 14.79 16.125 11.4375 16.125H6.55499C3.20249 16.125 1.85999 14.7825 1.85999 11.43V11.3325C1.85999 8.31755 2.94749 6.93005 5.60249 6.68255"
                                        stroke="#292D32" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 1.5V11.16" stroke="#292D32" stroke-width="1.2" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                    <path d="M11.5125 9.48755L8.99999 12L6.48749 9.48755" stroke="#292D32"
                                        stroke-width="1.2"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                {{ __('Export') }}
                            </button>
                        @endcan

                        @can('Mission-Create')
                            <a href="{{ route('mission.create') }}">
                                <button class='buttonS1 primary'>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                            fill="white"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                            fill="white"/>
                                    </svg>
                                    {{ __('Create') }}
                                </button>
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="searchWithDate ">
                    <div class="inputS1 primary searchInput">
                        <input type="text" class="searchInput" value="{{ request('search') }}" id="search"
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
                            <h3>{{__("Start date")}}</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                <input style="width: 225px;" type="text" id="start_date" value=""
                                       placeholder="{{__("Start date")}}"
                                       name="datepicker" class="datePickerBasic" autocomplete="off"/>
                            </div>
                        </div>
                        <div class='datePicker'>
                            <h3>{{__("End date")}}</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                <input style="width: 225px;" id="end_date" type="text" value=""
                                       placeholder="{{__("End date")}}"
                                       name="datepicker" class="datePickerBasic" autocomplete="off"/>
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
                                            fill="#868686"/>
                                        <path
                                            d="M9.64001 9.05005H4.37001C2.01001 9.05005 0.100006 10.97 0.100006 13.32V14C0.100006 14.96 0.890006 15.75 1.85001 15.75H12.16C13.12 15.75 13.91 14.96 13.91 14V13.33C13.91 10.97 11.99 9.05005 9.64001 9.05005Z"
                                            fill="#868686"/>
                                    </svg>
                                </div>
                            </th>
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Job Title') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Start') }}</th>
                            <th>{{ __('End') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tbody>
                            @include('new-theme.requests.missions.missions')
                        </tbody>

                    </table>

                </div>
            </div>

            <div class="paginater paginationS1 flex gap-4 align">
                @include('new-theme.requests.missions.paginate')
            </div>


            <!-- rejected modal -->
            <div class="modal fade customeModal" id="addNewDocument" tabindex="-1"
                 aria-labelledby="addNewDocumentLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="formS1 reject-form" action="" method="post">
                                @csrf
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class='small'>Reject Details</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="content">
                                        <div class="">
                                            <label for="ID" class="form-label">reason</label>
                                            <div class="inputS1">
                                                <input required name="reject_reason" type="text"
                                                       placeholder="Enter Reason">
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                {{ __('Cancel') }}
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
    @include("new-theme.components.export_print",[
        'print_url'=>route('mission.print'),
        'export_url'=>route('mission.export'),
    ])
    <script>
        $(document).ready(function () {
            $('#changeStatus').on('change', function () {
                if ($(this).val() == "rejected") {
                    $('#statusReason').addClass('show');
                } else {
                    $('#statusReason').removeClass('show');
                }
            });
        });
    </script>
@endpush
@push('script')
    <script>
        $(document).ready(function () {
            function fetch_data(query) {
                $.ajax({
                    url: "{{ route('mission.index') }}",
                    data: {
                        "search": query,
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
                });
            }

            $(document).on('keyup', '#search', function() {
                var query = $('#search').val();
                fetch_data(query);
            });

        });
    </script>
@endpush
