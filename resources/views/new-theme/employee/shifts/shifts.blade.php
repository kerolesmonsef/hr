@foreach ($shifts as $value => $shift)
    <tr data-row-key="{{ $value }}" class="ant-table-row ant-table-row-level-0" data-bs-toggle="offcanvas"
        data-bs-target="#id{{ $value }}" aria-controls="id{{ $value }}">
        <td class="tooltipS1">
            <div class="tooltip">{{ __('View Details') }}</div>
            <div class="userTabl">
                {{ $shift['name' . $lang] }}
            </div>
        </td>

        <td class="tooltipS1">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $shift['shift_starttime'] }}
        </td>

        <td class="tooltipS1">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $shift['shift_endtime'] }}
        </td>

        <td class="tooltipS1">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ Carbon\Carbon::parse($shift->shift_endtime)->diffInMinutes(Carbon\Carbon::parse($shift->shift_starttime)) / 60 }}
        </td>

        <td class="tooltipS1">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $shift->employees->count() }}
        </td>
    </tr>


    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id{{ $value }}"
        aria-labelledby="id1Label">
        <div class=" drawerS1">
            <div class="head_ flex align between">
                <div class="flex align gap-25">
                    <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                fill="black" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                fill="black" />
                        </svg>
                    </div>
                    <h3>{{ __('View Details') }}</h3>
                </div>
                <div class="flex gap-15">

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.25 7H16.75V5C16.75 3 16 2 13.75 2H10.25C8 2 7.25 3 7.25 5V7Z" stroke="#292D32"
                            stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M16 15V19C16 21 15 22 13 22H11C9 22 8 21 8 19V15H16Z" stroke="#292D32"
                            stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M21 10V15C21 17 20 18 18 18H16V15H8V18H6C4 18 3 17 3 15V10C3 8 4 7 6 7H18C20 7 21 8 21 10Z"
                            stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M17 15H15.79H7" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7 11H10" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.44 8.8999C20.04 9.2099 21.51 11.0599 21.51 15.1099V15.2399C21.51 19.7099 19.72 21.4999 15.25 21.4999H8.73998C4.26998 21.4999 2.47998 19.7099 2.47998 15.2399V15.1099C2.47998 11.0899 3.92998 9.2399 7.46998 8.9099"
                            stroke="#292D32" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 2V14.88" stroke="#292D32" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M15.3499 12.6499L11.9999 15.9999L8.6499 12.6499" stroke="#292D32" stroke-width="1.2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </div>

            <div class="contentDrawer scroll">

                <div class="sectionHistory sectionDDS1 section">
                    <div>
                        <div class="ant-collapse flex align between">
                            <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                role="button" tabindex="0"  data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true" aria-controls="employeeInformation">
                                <div class="ant-collapse-expand-icon">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1"
                                        viewBox="0 0 17 17" class="ant-collapse-arrow" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g></g>
                                        <path
                                            d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ant-collapse-header-text">{{ __('Shift Information') }}</span>
                            </div>
                            <div class="flex align gap-3">
                                @can('Shift-Edit')
                                <div data-bs-toggle="offcanvas" data-bs-target="#edit{{ $value }}"
                                    aria-controls="edit{{ $value }}">
                                    <img src="/new-theme/icons/edit.svg" alt="">
                                </div>
                                @endcan
                                @can('Shift-Delete')
                                    <img src="/new-theme/icons/delete.svg" alt="">
                                @endcan
                            </div>


                        </div>
                    </div>

                    <div class="collapse show" id="employeeInformation">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">
                                        <div class="cards">
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Name') }}</div>
                                                <div class="des">{{ $shift['name' . $lang] }} {{$shift->id}}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Clock In') }}</div>
                                                <div class="des">{{ $shift['shift_starttime'] }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Clock Out') }}</div>
                                                <div class="des"> {{ $shift['shift_endtime'] }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Shift Hours') }}</div>
                                                <div class="des">
                                                    {{ Carbon\Carbon::parse($shift->shift_endtime)->diffInMinutes(Carbon\Carbon::parse($shift->shift_starttime)) / 60 }}
                                                </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Employees N..') }}.</div>
                                                <div class="des">{{ $shift->employees->count() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="sectionEmployees sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#sectionEmployees" aria-expanded="true"
                        aria-controls="sectionEmployees">
                        <div class="ant-collapse">
                            <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                role="button" tabindex="0">
                                <div class="ant-collapse-expand-icon">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1"
                                        viewBox="0 0 17 17" class="ant-collapse-arrow" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g></g>
                                        <path
                                            d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ant-collapse-header-text">{{__('Employee List')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="sectionEmployees">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">

                                        <div class="cards">
                                            @foreach ($shift->employees as $employee)
                                                <div class="cardS1 flex align gap-2 mb-4">
                                                    <div class="icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.1601 10.87C12.0601 10.86 11.9401 10.86 11.8301 10.87C9.45006 10.79 7.56006 8.84 7.56006 6.44C7.56006 3.99 9.54006 2 12.0001 2C14.4501 2 16.4401 3.99 16.4401 6.44C16.4301 8.84 14.5401 10.79 12.1601 10.87Z"
                                                                stroke="#292D32" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M7.15997 14.56C4.73997 16.18 4.73997 18.82 7.15997 20.43C9.90997 22.27 14.42 22.27 17.17 20.43C19.59 18.81 19.59 16.17 17.17 14.56C14.43 12.73 9.91997 12.73 7.15997 14.56Z"
                                                                stroke="#292D32" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <div class="des">{{$employee['name'.$lang]}}</div>
                                                </div>
                                            @endforeach
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

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $value }}"
        aria-labelledby="id1Label">
        <div class=" drawerS1">
            <div class="head_">
                <h3>{{ __('View Details') }}</h3>
            </div>

            <div class="contentDrawer scroll">

                <div class="sectionEmployees sectionDDS1 section">
                    <div class="ant-collapse">
                        <div class="ant-collapse-header flex align between">
                            <span class="ant-collapse-header-text">{{__("Shift Information")}}</span>
                            @can('shift-delete')
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998"
                                    stroke="#DE0000" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97"
                                    stroke="#DE0000" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M18.85 9.14014L18.2 19.2101C18.09 20.7801 18 22.0001 15.21 22.0001H8.79002C6.00002 22.0001 5.91002 20.7801 5.80002 19.2101L5.15002 9.14014"
                                    stroke="#DE0000" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M10.33 16.5H13.66" stroke="#DE0000" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M9.5 12.5H14.5" stroke="#DE0000" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                            @endcan
                        </div>
                    </div>

                    <form class="formS1" action="{{ route('employee-shifts.update', $shift) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mt-4">
                            <label for="employeeName" class="form-label">{{ __('Name') }}</label>
                            <div class="inputS1">
                                <input name="name" value="{{ old('name', $shift->name) }}" type="text"
                                    id="employeeName" placeholder="">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="employeeName" class="form-label">{{ __('Arabic Name') }}</label>
                            <div class="inputS1">
                                <input name="name_ar" value="{{ old('name_ar', $shift->name_ar) }}"
                                    type="text" id="employeeName" placeholder="">
                            </div>
                        </div>


                        <div class="mt-4">
                            <label for="shift_starttime" class="form-label">{{ __('Clock In') }}</label>
                            <div class="inputS1">
                                <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                <input value="{{ old('shift_starttime', $shift->shift_starttime) }}"
                                    name="shift_starttime" class="time-pickable" id="shift_starttime">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="shift_endtime" class="form-label">{{ __('Clock Out') }}</label>
                            <div class="inputS1">
                                <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                <input value="{{ old('shift_endtime', $shift->shift_endtime) }}"
                                    name="shift_endtime" class="time-pickable" id="shift_endtime">
                            </div>
                        </div>



                        <div class="buttons flex end gap-3 mt-5">
                            <button class="buttonS1 rejected" type="button"  data-bs-dismiss="offcanvas" aria-label="Close">{{ __('Cancel') }}</button>
                            <button class="buttonS1 primary" type="submit">{{ __('Save') }}</button>
                        </div>

                </div>
                </form>

                <div class="sectionEmployeesEdit sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#sectionEmployeesEdit" aria-expanded="true" aria-controls="sectionEmployeesEdit">
                        <div class="ant-collapse">
                            <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                role="button" tabindex="0">
                                <div class="ant-collapse-expand-icon">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1"
                                        viewBox="0 0 17 17" class="ant-collapse-arrow" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g></g>
                                        <path
                                            d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="ant-collapse-header-text">{{__('Employee List')}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="sectionEmployeesEdit">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">
                                        <div class="cards">
                                            @foreach ($shift->employees as $employee)
                                                <div class="cardS1 flex align gap-2 mb-4">
                                                    <div class="icon">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.1601 10.87C12.0601 10.86 11.9401 10.86 11.8301 10.87C9.45006 10.79 7.56006 8.84 7.56006 6.44C7.56006 3.99 9.54006 2 12.0001 2C14.4501 2 16.4401 3.99 16.4401 6.44C16.4301 8.84 14.5401 10.79 12.1601 10.87Z"
                                                                stroke="#292D32" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path
                                                                d="M7.15997 14.56C4.73997 16.18 4.73997 18.82 7.15997 20.43C9.90997 22.27 14.42 22.27 17.17 20.43C19.59 18.81 19.59 16.17 17.17 14.56C14.43 12.73 9.91997 12.73 7.15997 14.56Z"
                                                                stroke="#292D32" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                    <div class="des">{{$employee['name'.$lang]}}</div>
                                                </div>
                                            @endforeach
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
@endforeach
