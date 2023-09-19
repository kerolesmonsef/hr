@foreach ($vacations as $value => $vacation)
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
            {{ auth()->user()->employeeIdFormat($vacation->employee?->id) }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ app()->isLocale('ar') ? $vacation->employee?->name_ar : $vacation->employee?->name }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $vacation->employee?->jobtitle ? $vacation->employee?->jobtitle['name' . $lang] : 'N/A' }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>



        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $vacation->total_leave_days }}
            {{ $vacation->total_leave_days > 1 ? __('Days') : __('Day') }} <p>
                {{ __('From') . ' ' . $vacation->start_date . ' ' . __('To') . ' ' . $vacation->end_date }}
            </p>
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>

        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ $vacation->leaveType ? $vacation->leaveType->title : 'N/A' }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>


        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            @php
                $status_class_array = [
                    'approved' => 'success',
                    'approvedWithDeduction' => 'success',
                    'pending' => 'pending',
                    'rejected' => 'danger',
                ];
                
                $status_translate_array = [
                    'approved' => __('Approved'),
                    'approvedWithDeduction' => __('Approved With Deduction'),
                    'pending' => __('Pending'),
                    'rejected' => __('Rejected'),
                ];
                
            @endphp
            <div class="buttonS2  {{ $status_class_array[$vacation->status] }}">
                {{ $status_translate_array[$vacation->status] }}</div>
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td>
            @if ($vacation->status == 'pending')
                <div class="actions flex gap-3">



                    @can('Vacation-Accept')
                        <div data-bs-toggle="modal" data-bs-target="#acceptReson1">
                                            <div class="buttonS1 primary">{{ __('Accept') }}</div>
                                        </div>
                    @endcan
                                        


                    @can('Vacation-Reject')
                    <div data-bs-toggle="modal" data-bs-target="#rejectedReson1">
                        <div class="buttonS1 rejected">{{ __('Reject') }}</div>
                    </div>
                    @endcan



                </div>
            @else
                N/A
            @endif
        </td>
    </tr>


    <!-- rejected Details Modal -->

    <div class="modal fade customeModal" id="rejectedReson1" tabindex="-1" aria-labelledby="rejectedReson1Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="formS1"  method="post" action="{{ route('vacations.reject' , $vacation -> id) }}">
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
                                        <input type="text" name="admin_message" id="payrollType" placeholder=''>
                                    </div>
                                </div>
                                <div class="flex align end gap-15 orders  mt-5 mb-4">
                                    <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        {{ __('Cancel') }}
                                    </button>
                                    <button href="{{ route('employee-permissions.reject', $vacation) }}"
                                        class="buttonS1 primary">{{ __('Reject') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Accept Details Modal -->
    <div class="modal fade customeModal" id="acceptReson1" tabindex="-1" aria-labelledby="acceptReson1Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="formS1" method="post" action="{{ route('vacations.approve' , $vacation -> id) }}">
                        @csrf
                        <div class="sectionS2">
                            <div class="head withBorder flex align between">
                                <h3 class='small'>{{ __('Accept Details') }}</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="content">
                                <div class="">
                                    <label for="payrollType" class="form-label">{{ __('Deduction Details') }}</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="inputRadio" for="type1">
                                                <input checked type="radio" name="type" id="type1">
                                                <span>{{ __('Without Deduction') }}</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="inputRadio" for="type2">
                                                <input type="radio" name="type" id="type2"
                                                    data-type="other">
                                                <span>{{ __('With Deduction') }}</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="otherDetails" style="display:none">

                                    <div class="mt-4">
                                        <label for="payrollType" class="form-label">{{ __('Reason') }}</label>
                                        <div class="inputS1">
                                            <input name="admin_message" type="text" id="payrollType" placeholder=''>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label for="payrollType" class="form-label">{{ __('Deduction Percent') }}</label>
                                        <div class="inputS1">
                                        <input min="1" step="0.01" type="number" name="deduction" id="payrollType" placeholder=''>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label for="payrollType" class="form-label">{{ __('Flight Benifints') }}</label>
                                        <div class="inputS1">
                                            <select name="ticket_flight_status" required="">
                                                <option value="no_both">{{ __('no_both') }}</option>
                                                <option value="go">{{ __('go') }}</option>
                                                <option value="back">{{ __('back') }}</option>
                                                <option value="go_back">{{ __('go_back') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>



    
                                <div class="flex align end gap-15 orders  mt-5 mb-4">
                                    <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        {{ __('Cancel') }}
                                    </button>

                                    <button type="submit" class="buttonS1 primary">{{ __('Accept') }}</button>


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
                    <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true" aria-controls="employeeInformation">
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
                                                    {{ app()->isLocale('en') ? $vacation->employee?->name : $vacation->employee?->name_ar }}
                                                </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Code') }}</div>
                                                <div class="des">
                                                    {{ auth()->user()->employeeIdFormat($vacation->employee?->id) }}
                                                </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Job Title') }}</div>
                                                <div class="des">
                                                    {{ $vacation->employee?->jobtitle ? $vacation->employee?->jobtitle['name' . $lang] : 'N/A' }}
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
                    <div>
                        <div class="ant-collapse">
                            <div class="ant-collapse-header flex align between" aria-expanded="true" aria-disabled="false"
                                role="button" tabindex="0">
                                <div class="flex align gap-2" style="flex: 1"  data-bs-toggle="collapse" data-bs-target="#allPermissions" aria-expanded="true" aria-controls="allPermissions">
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
                                    <span class="ant-collapse-header-text">{{ __('Vacation Details') }}</span>
                                </div>
                                <div class="editIcon flex align gap-3">
                                    @can('Vacation-Edit')
                                            <div data-bs-toggle="offcanvas"
                                            data-bs-target="#edit{{ $value }}"
                                            aria-controls="edit{{ $value }}">
                                            <img src="/new-theme/icons/edit.svg" />
                                        </div>
                                    @endcan
                                    
                                    @can('Vacation-Delete')
                                            <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                                 data-route="{{ route('vacations.destroy', $vacation->id) }}" src="/new-theme/icons/delete.svg"/>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show mt-4" id="allPermissions">
                        <div class="collapse show" id="allPermissions">
                            <div
                                class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                                <div class="ant-collapse-item ant-collapse-item-active">
                                    <div class="ant-collapse-content ant-collapse-content-active">
                                        <div class="ant-collapse-content-box">
                                            <div class="cards">
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Vacation Type') }}</div>
                                                    <div class="des">
                                                        {{ app()->isLocale('en') ? $vacation->leaveType->title : $vacation->leaveType->title_ar }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Publish Date') }}</div>
                                                    <div class="des">
                                                        {{ Carbon\Carbon::parse($vacation->applied_on)->format('Y-m-d') }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Start Date') }}</div>
                                                    <div class="des">{{ $vacation->start_date }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('End Date') }}</div>
                                                    <div class="des">{{ $vacation->end_date }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Total Days') }}</div>
                                                    <div class="des">{{ $vacation->total_leave_days }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Status') }}</div>
                                                    <div
                                                        class="buttonS2  {{ $status_class_array[$vacation->status] }}">
                                                        {{ $status_translate_array[$vacation->status] }}</div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Replacement Employee') }}
                                                    </div>
                                                    <div class="des">
                                                        {{ app()->isLocale('en') ? $vacation->replacement_employee?->name : $vacation->replacement_employee?->name_ar }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Reason') }}</div>
                                                    <div class="des">{{ $vacation->leave_reason }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

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
            </div>
        </div>
    </div>
    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $value }}"
        aria-labelledby="edit1Label">
        <div class=" drawerS1">
            <div class="head_">
                <h3>{{ __('Vacation Details') }}</h3>
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
                                                        {{ app()->isLocale('en') ? $vacation->employee?->name : $vacation->employee?->name_ar }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Code') }}</div>
                                                    <div class="des">
                                                        {{ auth()->user()->employeeIdFormat($vacation->employee?->id) }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Job Title') }}</div>
                                                    <div class="des">
                                                        {{ $vacation->employee?->jobtitle ? $vacation->employee?->jobtitle['name' . $lang] : 'N/A' }}
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
                <div class="flex align between section sectionDDS1">
                    <div data-bs-toggle="collapse" data-bs-target="#editV" aria-expanded="true"
                        aria-controls="editV">
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
                                <span class="ant-collapse-header-text">{{ __('Edit Vacation') }}</span>
                            </div>
                        </div>
                    </div>
                    @can('vacation-delete')
                        <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                             data-route="{{ route('vacations.destroy', $vacation->id) }}" src="/new-theme/icons/delete.svg"/>
                    @endcan
                </div>
                <div class="ant-collapse-content-box section" id="editV" style=" padding-top: 0; ">
                    <form method="POST" action="{{ route('vacations.update', $vacation->id) }}">
                        @csrf
                        @method('put')
                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('Name') }}</div>
                            <div class="inputS1">
                                <select name="employee_id" required>
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($employees as $employee)
                                        <option
                                            {{ $employee?->id == old('employee_id', $vacation->employee_id) ? 'selected' : '' }}
                                            value="{{ $employee?->id }}">
                                            {{ app()->isLocale('en') ? $employee?->name : $employee?->name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('Replacement Employee') }}</div>
                            <div class="inputS1">
                                <select name="replacement_employee_id">
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($employees as $employee)
                                        <option
                                            {{ $employee?->id == old('replacement_employee_id', $vacation->replacement_employee_id) ? 'selected' : '' }}
                                            value="{{ $employee?->id }}">
                                            {{ app()->isLocale('en') ? $employee?->name : $employee?->name_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <label class="form-label">{{ __('Status') }}</label>
                            <div class="inputS1">
                                <select name="status">
                                    <option value="pending" {{ $vacation->status == "pending" ? "selected" : "" }}>@lang("Pending")</option>
                                    <option value="approved" {{ $vacation->status == "approved" ? "selected" : "" }}>@lang("Approved")</option>
                                    <option value="rejected" {{ $vacation->status == "rejected" ? "selected" : "" }}>@lang("Reject")</option>
                                </select>
                            </div>
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <label for="name" class="form-label">{{ __('Leave Type') }}</label>
                            <div class="inputS1">
                                <select name="leave_type_id">
                                    <option value="">{{ __('Select') }}</option>
                                    @foreach ($leave_type->childs as $child)
                                        <option
                                            {{ $child->id == old('leave_type_id', $vacation->leave_type_id) ? 'selected' : '' }}
                                            value="{{ $child->id }}">
                                            {{ app()->isLocale('en') ? $child->title : $child->title_ar }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('Applied On') }}</div>
                            <div class="inputS1 noHeight">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input type="text" name="applied_on"
                                    value="{{ Carbon\Carbon::parse( $vacation->applied_on)->format('d/m/Y') }}"
                                    placeholder="Set The Time" name="datepicker" class="datePickerBasic"
                                    autocomplete="off" />
                            </div>
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('Start Date') }}</div>
                            <div class="inputS1 noHeight">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input type="text" name="start_date"
                                    value="{{ Carbon\Carbon::parse( $vacation->start_date)->format('d/m/Y') }}"
                                    placeholder="Set The Time" name="datepicker" class="datePickerBasic"
                                    autocomplete="off" />
                            </div>
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('End Date') }}</div>
                            <div class="inputS1 noHeight">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input type="text" name="end_date"
                                    value="{{ Carbon\Carbon::parse($vacation->end_date)->format('d/m/Y') }}"
                                    placeholder="Set The Time" name="datepicker" class="datePickerBasic"
                                    autocomplete="off" />
                            </div>
                        </div>

                        <div class="cardS1  my-4">
                            <div class="name mb-3">{{ __('Note') }}</div>
                            <div class="inputS1">
                                <input type="text" name="leave_reason"
                                    value="{{ old('message', $vacation->leave_reason) }}">
                            </div>
                        </div>

                        <div class="my-4">
                            <div class="name mb-3">{{ __('Status') }}</div>
                            <div class="inputS1">
                                <select name="status">
                                    <option value="pending" {{ $vacation->status == "pending" ? "selected" : "" }}>@lang("Pending")</option>
                                    <option value="approved" {{ $vacation->status == "approved" ? "selected" : "" }}>@lang("Approved")</option>
                                    <option value="rejected" {{ $vacation->status == "rejected" ? "selected" : "" }}>@lang("Reject")</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex align end gap-15 orders mb-3">
                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="buttonS1 primary">
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
        $('input[type="radio"]').click(function() {
            if ($(this).data('type') == "other") {
                $('.otherDetails').show();
            } else {
                $('.otherDetails').hide();
            }

        });


        document.getElementById('changeStatus').addEventListener('change', function() {
            console.log(this.value)
            if (this.value == "rejected") {

                document.getElementById('statusReason').style.display = "block"
            } else {
                document.getElementById('statusReason').style.display = "none"
            }
        });
    </script>
@endpush
