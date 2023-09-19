
@foreach ($permissions as $value => $permission)
    <tr data-row-key="{{ $value }}" class="ant-table-row ant-table-row-level-0">
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="userTabl user">
                <img src="/new-theme/icons/all/user.svg" />
            </div>

            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ auth()->user()->employeeIdFormat($permission->employee->id) }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ app()->isLocale('ar') ? $permission->employee->name_ar : $permission->employee->name }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $permission->date }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td>Type new</td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $permission->employee->jobtitle ? $permission->employee->jobtitle['name' . $lang] : 'N/A' }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        @php
            $minutes = Carbon\Carbon::createFromFormat('h:i a', $permission->to)->diffInMinutes(Carbon\Carbon::createFromFormat('h:i a', $permission->from));
        @endphp


        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $minutes }} {{ $minutes > 1 ? __('Minutes') : __('Minute') }} <p>
                {!! __('From') . ' ' . (new \Carbon\Carbon($permission->from))->translatedFormat("H:i A") . ' ' . __('To') . ' ' . (new \Carbon\Carbon($permission->to))->translatedFormat("H:i A") !!}
            </p>
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            @php
                $status_class_array = [
                    'approved' => 'success',
                    'pending' => 'pending',
                    'rejected' => 'danger',
                ];
                
                $status_translate_array = [
                    'approved' => __('Approved'),
                    'pending' => __('Pending'),
                    'rejected' => __('Rejected'),
                ];
                
            @endphp
            <div class="buttonS2  {{ $status_class_array[$permission->status] }}">
                {{ $status_translate_array[$permission->status] }}</div>
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td>
            @if ($permission->status == 'pending')
                <div class="actions flex gap-3">
                    @can('EmployeePermission-Accept')
                        <a href="{{ route('employee-permissions.approve', $permission) }}"
                            class="buttonS1 primary">{{ __('Accept') }}
                        </a>
                    @endcan

                    @can('EmployeePermission-Reject')
                        <div data-bs-toggle="modal" data-bs-target="#reson1">
                            <div data-action="{{ route('employee-permissions.reject', $permission) }}"
                                class="buttonS1 rejected reject-button">{{ __('Reject') }}</div>
                        </div>
                    @endcan
                </div>
            @else
                N/A
            @endif
        </td>
    </tr>

    <!-- Add New Payroll Modal -->
    <div class="modal fade customeModal" id="reson1" tabindex="-1" aria-labelledby="reson1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="formS1 reject-form" action="" method="post">
                        @csrf
                        <div class="sectionS2">
                            <div class="head withBorder flex align between">
                                <h3 class='small'>{{ __('Reject Details') }}</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="content">
                                <div class="">
                                    <label for="payrollType" class="form-label">{{ __('Reason') }}</label>
                                    <div class="inputS1">
                                        <input required name="admin_message" type="text" id="payrollType"
                                            placeholder="{{ __('Enter Reason') }}"/>
                                    </div>
                                </div>
                                <div class="flex align end gap-15 orders  mt-5 mb-4">
                                    <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button
                                        class="buttonS1 primary">{{ __('Reject') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
                            stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M16 15V19C16 21 15 22 13 22H11C9 22 8 21 8 19V15H16Z" stroke="#292D32"
                            stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round" />
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

                <div class="sectionDDS1 section">
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
                                <span class="ant-collapse-header-text">{{ __('Employee Details') }}</span>
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
                                                <div class="des">
                                                    {{ app()->isLocale('en') ? $permission->employee->name : $permission->employee->name_ar }}
                                                </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Code') }}</div>
                                                <div class="des">
                                                    {{ auth()->user()->employeeIdFormat($permission->employee->id) }}
                                                </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Job Title') }}</div>
                                                <div class="des">
                                                    {{ $permission->employee->jobtitle ? $permission->employee->jobtitle['name' . $lang] : 'N/A' }}
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sectionHistory sectionDDS1 section">
                    <div >
                        <div class="ant-collapse">
                            <div class="ant-collapse-header flex align between" aria-expanded="true" aria-disabled="false"
                                role="button" tabindex="0">
                                <div class="flex align gap-2" style="flex: 1" data-bs-toggle="collapse" data-bs-target="#allPermissions" aria-expanded="true" aria-controls="allPermissions">
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
                                    <span class="ant-collapse-header-text">{{ __('Permission Details') }}</span>
                                </div>
                                <div class="editIcon flex align gap-3">

                                    @can('EmployeePermission-Edit')
                                        <div data-bs-toggle="offcanvas" data-bs-target="#edit{{ $value }}"
                                            aria-controls="edit{{ $value }}">
                                            <img src="/new-theme/icons/edit.svg" />
                                        </div>
                                    @endcan

                                    @can('EmployeePermission-Delete')
                                        <div>
                                            <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                                data-route="{{ route('employee-permissions.destroy', $permission->id) }}"
                                                src="/new-theme/icons/delete.svg" />
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sectionDDS1 section"  style="border: none">
                    <div class="collapse show" id="allPermissions">
                        <div class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">
                                        
                                        <div class="cards">
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Date') }}</div>
                                                <div class="des">{{ $permission->date }}</div>
                                            </div>

                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Time') }}</div>
                                                <div class="des">{{ $permission->get_time_format() }}</div>
                                            </div>

                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Status') }}</div>
                                                <div
                                                    class="buttonS2  {{ $status_class_array[$permission->status] }} small">
                                                    {{ $status_translate_array[$permission->status] }}</div>
                                            </div>
                                            
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Reason') }}</div>
                                                <div class="des">{{ $permission->message ?? 'N/A' }}</div>
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


    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $value }}"
        aria-labelledby="edit1Label">
        <div class=" drawerS1">
            <div class="head_">
                <h3>{{ __('Permission Details') }}</h3>
            </div>
            <div class="contentDrawer scroll">
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
                                <span class="ant-collapse-header-text">{{ __('Employee Details') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="collapse show" id="employeeInformation">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">
                                        <div class="col-sm-8 col-md-9">
                                            <div class="cards">
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Name') }}</div>
                                                    <div class="des">
                                                        {{ app()->isLocale('en') ? $permission->employee->name : $permission->employee->name_ar }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Code') }}</div>
                                                    <div class="des">
                                                        {{ auth()->user()->employeeIdFormat($permission->employee->id) }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Job Title') }}</div>
                                                    <div class="des">
                                                        {{ $permission->employee->jobtitle ? $permission->employee->jobtitle['name' . $lang] : 'N/A' }}
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
                <div class="sectionDDS1 section">
                    <div
                        class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                        <div class="flex align between">
                            <span class="ant-collapse-header-text">{{ __('Edit Permission') }}</span>
                            @can('employee_permission-delete')
                                <div data-bs-toggle="offcanvas" data-bs-target="#id" aria-controls="id">
                                    <svg data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                        data-route="{{ route('employee-permissions.destroy', $permission->id) }}"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 5.97998C17.67 5.64998 14.32 5.47998 10.98 5.47998C9 5.47998 7.02 5.57998 5.04 5.77998L3 5.97998"
                                            stroke="#FF1B0C" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.5 4.97L8.72 3.66C8.88 2.71 9 2 10.69 2H13.31C15 2 15.13 2.75 15.28 3.67L15.5 4.97"
                                            stroke="#FF1B0C" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M18.8499 9.13989L18.1999 19.2099C18.0899 20.7799 17.9999 21.9999 15.2099 21.9999H8.7899C5.9999 21.9999 5.9099 20.7799 5.7999 19.2099L5.1499 9.13989"
                                            stroke="#FF1B0C" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M10.3301 16.5H13.6601" stroke="#FF1B0C" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.5 12.5H14.5" stroke="#FF1B0C" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            @endcan
                        </div>
                        <div class="ant-collapse-content-box">
                            <form method="POST"
                                action="{{ route('employee-permissions.update', $permission->id) }}">
                                @csrf
                                @method('put')
                                <div class="cardS1 datePicker my-4">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <div class="inputS1">
                                        <select name="employee_id" required>
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($employees as $employee)
                                                <option
                                                    {{ $employee->id == old('employee_id', $permission->employee_id) ? 'selected' : '' }}
                                                    value="{{ $employee->id }}">
                                                    {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="cardS1 datePicker my-4">
                                    <label class="form-label">{{ __('Status') }}</label>
                                    <div class="inputS1">
                                        <select name="status">
                                            <option value="pending" {{ $permission->status == "pending" ? "selected" : "" }}>@lang("Pending")</option>
                                            <option value="approved" {{ $permission->status == "approved" ? "selected" : "" }}>@lang("Approved")</option>
                                            <option value="rejected" {{ $permission->status == "rejected" ? "selected" : "" }}>@lang("Reject")</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="cardS1 datePicker my-4">
                                    <div class="name mb-3">{{ __('Date') }}</div>
                                    <div class="inputS1 noHeight">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        @php
                                            $date = Carbon\Carbon::createFromFormat('Y-m-d', $permission->date)->format('d/m/Y');
                                        @endphp
                                        <input type="text" value="{{ old('date', $date) }}"
                                            placeholder="Set The Time" name="date" class="datePickerBasic"
                                            autocomplete="off" />
                                    </div>
                                </div>

                                <div class="cardS1 datePicker my-4">
                                    <label for="datepicker" class="form-label">{{ __('Time From') }}</label>
                                    <div class="inputS1">
                                        <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                        <input name="from" value="{{ old('from', $permission->from) }}"
                                            class="time-pickable" id="startTime" readonly>
                                    </div>
                                </div>

                                <div class="cardS1 datePicker my-4">
                                    <label for="datepicker" class="form-label">{{ __('Time To') }}</label>
                                    <div class="inputS1">
                                        <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                        <input name="to" value="{{ old('to', $permission->to) }}"
                                            class="time-pickable" id="startTime">
                                    </div>
                                </div>


                                <div class="my-4">
                                    <label class="form-label">{{ __('Note') }}</label>
                                    <div class="inputS1">
                                        <input type="text" name="message"
                                            value="{{ old('message', $permission->message) }}">
                                    </div>
                                </div>



                                <div class="flex align end gap-15 mb-3">
                                    <button class="buttonS1 rejected" type="button" data-bs-dismiss="offcanvas"
                                        aria-label="Close">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button class="buttonS1 primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endforeach

@push('script')
    <script>
        $(document).ready(function() {
            $('#changeStatus').on('change', function() {
                if ($(this).val() == "rejected") {
                    $('#statusReason').style('display', 'block');
                } else {
                    $('#statusReason').style('display', 'none');
                }
            });
        });
        $('.reject-button').click(function() {
            $('.reject-form').attr('action', $(this).attr('data-action'));
        });
    </script>
@endpush
