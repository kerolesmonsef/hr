@extends('new-theme.layout.layout1')
@push('styles')
    <link rel="stylesheet" href="{{ url('new-theme/styles/joboffers.css') }}"/>
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}"/>
@endpush
@section('content')
    <div class="joboffersPage evaluationPage">
        <div class="pageS1">
            <div class='offerDetails'>
                <div class="row">
                    <div class="col-lg-8">
                        <h3 class="headerTitle">{{ __('New Job Offer') }}</h3>
                        <div class="row gy-4">
                            @foreach ($latest_offers as $latest_offer)
                                <div class="col-lg-4">
                                    <div class='sectionS1'>
                                        <div class='headerTitle'>{{ $latest_offer->title }}</div>
                                        <div class='offerCard flex'>
                                            <div class='content'>
                                                <div class='number'>
                                                    {{ $latest_offer->users_count ?? 0 }}
                                                </div>
                                                <div class='description'>{{ __('Applied') }}</div>
                                            </div>
                                            <div class='content'>
                                                <div class='number'>
                                                    0
                                                </div>
                                                <div class='description'>{{ __('New') }}</div>
                                            </div>
                                        </div>
                                        <button class='buttonS1 primary'>
                                            {{ __('See Job Post') }}
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class='headerTitle'>{{ __('Incoming Interviews') }}</div>
                        <div class="incomingInterviews">
                            @foreach($incoming_interviews as $interview)
                                <div class="interviewsCard">
                                    <div class="date">
                                        <span>{{ (new \Carbon\Carbon($interview->interview_from))->day }}</span>
                                        <span>{{ (new \Carbon\Carbon($interview->interview_from))->monthName }}</span>
                                    </div>
                                    <div class="content">
                                        <h3>{{ (new \Carbon\Carbon($interview->interview_from))->diffInMinutes($interview->interview_to) }} @lang("min") @lang("meeting with") {{ $interview->name }}</h3>
                                        <p>{{ $interview->job_offer?->title }} {{ (new \Carbon\Carbon($interview->interview_from))->format("H:i A") }} - {{ (new \Carbon\Carbon($interview->interview_to))->format("H:i A") }}</p>
                                        <a href="{{ route('job-offer-user.show',$interview) }}">@lang("Details")
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.37646 3.50098L12.8774 8.00196L8.37646 12.5029"
                                                      stroke="#066163"
                                                      stroke-width="1.00189" stroke-linecap="round"
                                                      stroke-linejoin="round">
                                                </path>
                                                <path d="M12.2528 8.00195H3.12579" stroke="#066163"
                                                      stroke-width="1.00189"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

            <div class='sectionS2'>
                <div class="head withBorder flex align between">
                    <h3 class='small'>{{ __('All Job Offers') }}</h3>
                    <div class='flex align gap-3 options'>

                        @can('JobOffers-Print')
                            <button id="print" class='buttonS2  withBorder'>
                                <img src="/new-theme/icons/all/print.svg" alt="">
                                @lang('Print')
                            </button>
                        @endcan

                        @can('JobOffers-Export')
                            <button id="export" class='buttonS2 withBorder'>
                                <img src="/new-theme/icons/all/download.svg" alt="">
                                {{ __('Export') }}
                            </button>
                        @endcan

                        @can('JobOffers-Create')
                            <a href="{{ route('job-offers.create') }}">
                                <button class='buttonS1 primary' data-bs-toggle="offcanvas" data-bs-target="#id"
                                        aria-controls="id">
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
                <div class="searchWithDate options">
                    <div class="inputS1 searchInput">
                        <input type="text" id="search" value="{{ request('search') }}"
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
                            <h3>@lang('Start Date')</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                <input style="width: 225px;" type="text" value="" id="start_date"
                                       placeholder="@lang('Start Date')" name="datepicker" class="datePickerBasic"
                                       autocomplete="off"/>
                            </div>
                        </div>
                        <div class='datePicker '>
                            <h3>@lang('End Date')</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                <input style="width: 225px;" type="text" value="" id="end_date"
                                       placeholder="@lang('End Date')" name="datepicker" class="datePickerBasic"
                                       autocomplete="off"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tableS1 scroll trPointer">
                    <table>
                        <thead>
                        <tr>
                            <!-- <th>@lang('Photo')</th> -->
                            <th>@lang('Code')</th>
                            <th>{{ __('Job Title') }}</th>
                            <th>@lang('Company')</th>
                            <th>{{ __('Publish Date') }}</th>
                            <th>{{ __('Applications N...') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('new-theme.job-offers.job-offers')
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="paginater">
                @include('new-theme.job-offers.paginate')
            </div>
        </div>
    </div>
@endsection
@push('script')
    @include('new-theme.components.export_print', [
        'print_url' => route('job-offers.print'),
        'export_url' => route('job-offers.export'),
    ])
    <script src="{{ asset('js/chart.js') }}"></script>
    <script>
        $(document).ready(function () {
            function fetch_data() {
                $.ajax({
                    url: "{{ route('job-offers.index') }}",
                    data: {
                        "search": $('#search').val(),
                        "start_date": $('#start_date').val(),
                        "end_date": $('#end_date').val(),
                    },
                    success: function (data) {
                        $('tbody').html('');
                        $('tbody').html(data.search);

                        $('.paginater').html('');
                        $('.paginater').html(data.paginate);

                        $(document).on('click', '.pagination a', function (event) {
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

            $(document).on('keyup', '#search', function () {
                fetch_data();
            });

            $(document).on('change', '#start_date , #end_date', function () {
                fetch_data();
            });
        });
    </script>
@endpush
