@foreach ($attendances as $attendance)
    @if(!$attendance->employee) 
        @continue
    @endif
    
    <tr data-row-key="{{ $attendance->id }}" class="ant-table-row ant-table-row-level-0" data-bs-toggle="offcanvas"
        data-bs-target="#id{{ $attendance->id }}" aria-controls="id{{ $attendance->id }}">
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>
            <div class="userTabl user">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.16 10.87C12.06 10.86 11.94 10.86 11.83 10.87C9.45 10.79 7.56 8.84 7.56 6.44C7.56 3.99 9.54 2 12 2C14.45 2 16.44 3.99 16.44 6.44C16.43 8.84 14.54 10.79 12.16 10.87Z"
                        stroke="#066163" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M7.16 14.56C4.74 16.18 4.74 18.82 7.16 20.43C9.91 22.27 14.42 22.27 17.17 20.43C19.59 18.81 19.59 16.17 17.17 14.56C14.43 12.73 9.92 12.73 7.16 14.56Z"
                        stroke="#066163" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </td>
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>{{ auth()->user()->employeeIdFormat($attendance->employee->id) }}
        </td>
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ app()->isLocale('en') ? $attendance->employee->name : $attendance->employee->name_ar }}
        </td>
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ $attendance->employee->jobtitle ? $attendance->employee->jobtitle['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>{{ $attendance->date }}
        </td>
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>
            <div class="buttonS2 enabled">{{ $attendance->status }}</div>
        </td>
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>{{ $attendance->clock_in }}
        </td>
        <td class="tooltipS1">
            <div class="tooltip">{{__('View Details')}}</div>{{ $attendance->clock_out ?? 'N/A' }}
        </td>
        <td class="tooltipS1">

            <div class="tooltip">{{__('View Details')}}</div>{{ $attendance->work_hours() }}
        </td>
    </tr>
    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id{{ $attendance->id }}"
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
                    <h3>{{__('View History')}}</h3>
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

            <div class="contentDrawer">
                <div class="sectionHistory sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                        aria-controls="employeeInformation">
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
                                <span class="ant-collapse-header-text">{{__('Attendance  Information')}}</span>
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
                                                <div class="name">{{__('Name')}}</div>
                                                <div class="des">{{ app()->isLocale('en') ? $attendance->employee->name : $attendance->employee->name_ar }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{__('Code')}}</div>
                                                <div class="des">{{ auth()->user()->employeeIdFormat($attendance->employee->id) }}</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="sectionDDS1 ant-collapse-content ant-collapse-content-active my-3">
                                    <div class="ant-collapse-content-box">
                                        <div class="cards">
                                            <div class="cardS1 flex align">
                                                <div class="name">{{__('Date')}}</div>
                                                <div class="des">{{ $attendance->date }} </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{__('Status')}}</div>
                                                <div class="buttonS2 enabled small">{{ $attendance->status }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{__('Clock In')}}</div>
                                                <div class="des">{{ $attendance->clock_in }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{__('Clock Out')}}</div>
                                                <div class="des">{{ $attendance->clock_out ?? 'N/A' }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{__('Work Hours')}}</div>
                                                <div class="des">{{ $attendance->work_hours() }}</div>
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
    </div>
@endforeach
