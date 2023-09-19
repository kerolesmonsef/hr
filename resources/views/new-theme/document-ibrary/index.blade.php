@extends('new-theme.layout.layout1')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/document-library.css') }}" />
@endpush

@section('content')
    <div class="documentLibraryPage">
        <div class="pageS1">
            <div class='sectionS2'>
                <div class="head withBorder flex align between">
                    <h3 class='small'>{{ __('All Folders') }}</h3>
                    <div class='flex align gap-3'>
                        <a href="{{ route('library.create') }}">
                            <button class='buttonS1 primary'>
                                <svg width="21" height="18" viewBox="0 0 21 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.58105 9C2.58105 8.68934 2.86993 8.4375 3.22628 8.4375H17.4211C17.7775 8.4375 18.0663 8.68934 18.0663 9C18.0663 9.31066 17.7775 9.5625 17.4211 9.5625H3.22628C2.86993 9.5625 2.58105 9.31066 2.58105 9Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.3237 2.25C10.68 2.25 10.9689 2.50184 10.9689 2.8125V15.1875C10.9689 15.4982 10.68 15.75 10.3237 15.75C9.96736 15.75 9.67848 15.4982 9.67848 15.1875V2.8125C9.67848 2.50184 9.96736 2.25 10.3237 2.25Z"
                                        fill="white" />
                                </svg>
                                {{ __('Create') }}
                            </button>
                        </a>
                    </div>
                </div>

                <div class="searchWithDate">
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
                            <h3>Start date</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input style="width: 225px;" type="text" value="" placeholder="Set The Time"
                                    name="daterange" class="datePickerBasic" autocomplete="off" />
                            </div>
                        </div>
                        <div class="datePicker">
                            <h3>End date</h3>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input style="width: 225px;" type="text" value="" placeholder="Set The Time"
                                    name="daterange" class="datePickerBasic" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tableS1 scroll trPointer">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Documents N..') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('new-theme.document-library.document-library')
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="paginater paginationS1 flex gap-4 align">
                @include('new-theme.document-library.paginate')
            </div>

        </div>

    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            function fetch_data(query) {
                $.ajax({
                    url: "{{ route('library.index') }}",
                    data: {
                        "search": query
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

            $(document).on('keyup', '#search', function() {
                var query = $('#search').val();
                fetch_data(query);
            });

        });
    </script>
@endpush
