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
@foreach ($loans as $value => $loan)
    <tr data-row-key="{{ $value }}" class="ant-table-row ant-table-row-level-0">
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">{{ __('View Details') }}</div>

            <div class="userTabl user">
                <img src="/new-theme/icons/all/user.svg" />
            </div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">{{ __('View Details') }}</div>

            {{ auth()->user()->employeeIdFormat($loan->employee->id) }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            {{ app()->isLocale('ar') ? $loan->employee->name_ar : $loan->employee->name }}
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">{{ __('View Details') }}</div>{{ $loan->start_date }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $loan->employee->jobtitle ? $loan->employee->jobtitle['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $loan->amount }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">

            <div class="buttonS2  {{ $status_class_array[$loan->status] }}">
                {{ $status_translate_array[$loan->status] }}</div>
            <div class="tooltip">{{ __('View Details') }}</div>
        </td>
        <td>
            @if ($loan->status == 'pending')
                <div class="actions flex gap-3">
                    @can('Loan-Accept')
                    <a href="{{ route('loan-requests.approve', $loan) }}"
                        class="buttonS1 primary">{{ __('new_theme.Accept') }}</a>
                    @endcan

                    @can('Loan-Reject')
                        <a href="{{ route('loan-requests.reject', $loan) }}" class="buttonS1 rejected reject-button"
                            data-bs-toggle="modal" data-bs-target="#rejectReason">{{ __('Reject') }}</a>
                    @endcan
                </div>
            @else
                N/A
            @endif
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
                    <img src="/new-theme/icons/all/print.svg" class="iconImg" />
                    <img src="/new-theme/icons/all/download.svg" class="iconImg" />
                </div>
            </div>

            <div class="contentDrawer scroll">

                <div class="sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                        aria-controls="employeeInformation">
                        <div class="ant-collapse flex align between">
                            <div class="ant-collapse-header" aria-expanded="true" aria-disabled="false" role="button"
                                tabindex="0">
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
                            <div class="ant-collapse-content ant-collapse-content-active">
                                <div class="ant-collapse-content-box">
                                    <div class="cards">
                                        <div class="cardS1 flex align">
                                            <div class="name">{{ __('Name') }}</div>
                                            <div class="des">
                                                {{ app()->isLocale('ar') ? $loan->employee->name_ar : $loan->employee->name }}
                                            </div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{ __('Code') }}</div>
                                            <div class="des">
                                                {{ auth()->user()->employeeIdFormat($loan->employee->id) }}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{ __('Job Title') }}</div>
                                            <div class="des">
                                                {{ $loan->employee->jobtitle ? $loan->employee->jobtitle['name' . $lang] : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#deducationDetails" aria-expanded="true"
                        aria-controls="deducationDetails">
                        <div class="ant-collapse flex align between">
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
                                <span class="ant-collapse-header-text">{{ __('Loan Details') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="deducationDetails">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">
                                <div class="ant-collapse-content ant-collapse-content-active">
                                    <div class="ant-collapse-content-box">


                                    </div>
                                </div>

                                <div class=" ant-collapse-content ant-collapse-content-active my-3">
                                    <div class="ant-collapse-content-box">
                                        <div class="editIcon flex align gap-3">

                                            @can('Loan-Edit')
                                                <div data-bs-toggle="offcanvas" data-bs-target="#edit{{ $value }}"
                                                    aria-controls="edit{{ $value }}">
                                                    <img src="/new-theme/icons/edit.svg" />
                                                </div>
                                            @endcan

                                            @can('Loan-Delete')
                                                <div>
                                                    <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                                        data-route="{{ route('loan-requests.destroy', $loan->id) }}"
                                                        src="/new-theme/icons/delete.svg" />
                                                </div>
                                            @endcan
                                        </div>
                                        <div class="cards">
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Amount') }}</div>
                                                <div class="des">{{ $loan->amount }}</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Start Date') }}</div>
                                                <div class="des">{{ $loan->start_date }} </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('End Date') }}</div>
                                                <div class="des">
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $loan->start_date)->addMonth($loan->month_nubmer)->format('Y-m-d') }}
                                                </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Discount Monthly') }}</div>
                                                <div class="des">{{ $loan->amount / $loan->month_nubmer }}
                                                </div>
                                            </div>
                                            {{--  <div class="cardS1 flex align">
                                                <div class="name">Paid</div>
                                                <div class="des">1000 EGP</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">Remaining</div>
                                                <div class="des">1000 EGP</div>
                                            </div>  --}}


                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Status') }}</div>
                                                <div class="des">
                                                    {{ $status_translate_array[$loan->status] }}
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
    </div>
    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $value }}"
        aria-labelledby="edit1Label">
        <div class=" drawerS1">
            <div class="head_">
                <h3>{{ __('View Details') }}</h3>
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
                                        <div class="col-sm-8 col-md-9">
                                            <div class="cards">
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Name') }}</div>
                                                    <div class="des">
                                                        {{ app()->isLocale('ar') ? $loan->employee->name_ar : $loan->employee->name }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Code') }}</div>
                                                    <div class="des">
                                                        {{ auth()->user()->employeeIdFormat($loan->employee->id) }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Job Title') }}</div>
                                                    <div class="des">
                                                        {{ $loan->employee->jobtitle ? $loan->employee->jobtitle['name' . $lang] : 'N/A' }}
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
                    <div data-bs-toggle="collapse" data-bs-target="#loanDetails" aria-expanded="true"
                        aria-controls="loanDetails">
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
                                <span class="ant-collapse-header-text">{{ __('Loan Details') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="collapse show" id="loanDetails">
                        <div class=" my-3">
                            <form class="ajax-submit" action="{{ route('loan-requests.update', $loan->id) }}"
                                method="post">
                                @csrf
                                @method('put')
                                <div class="flex align end mt-3">
                                    <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                        data-route="{{ route('loan-requests.destroy', $loan->id) }}"
                                        src="/new-theme/icons/delete.svg" alt="" />
                                </div>
                                <div class="ant-collapse-content-box">
                                    <div class="cardS1  my-4">
                                        <div class="name mb-3">{{ __('Title') }}</div>
                                        <div class="inputS1">
                                            <input name="title" type="text" value="{{ $loan->title }}"
                                                placeholder="" />
                                        </div>
                                        @include('new-theme.components.error1', ['error' => 'title'])
                                    </div>
                                    <div class="cardS1 datePicker my-4">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <div class="inputS1">
                                            <select name="employee_id" required>
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($employees as $employee)
                                                    <option
                                                        {{ $employee->id == old('employee_id', $loan->employee_id) ? 'selected' : '' }}
                                                        value="{{ $employee->id }}">
                                                        {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @include('new-theme.components.error1', ['error' => 'emlpoyee_id'])
                                    </div>
                                    <div class="cardS1 datePicker my-4">
                                        <label for="name" class="form-label">{{ __('Loan Options') }}</label>
                                        <div class="inputS1">
                                            <select name="loan_option" required>
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($loan_options as $loan_option)
                                                    <option
                                                        {{ $loan_option->id == old('loan_option', $loan->loan_option) ? 'selected' : '' }}
                                                        value="{{ $loan_option->id }}">
                                                        {{ app()->isLocale('en') ? $loan_option->name : $loan_option->name_ar }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @include('new-theme.components.error1', ['error' => 'loan_option'])

                                    </div>
                                    <div class="cardS1 mb-4 mt-0">
                                        <div class="name mb-3">{{ __('Amount') }}</div>
                                        <div class="inputS1">
                                            <input name="amount" type="number"
                                                value="{{ old('amount', $loan->amount) }}" placeholder="" />
                                        </div>
                                        @include('new-theme.components.error1', ['error' => 'amount'])
                                    </div>
                                    <div class="cardS1 my-4">
                                        <div class="name mb-3">{{ __('Start Date') }}</div>
                                        <div class="inputS1">
                                            <img src="/new-theme/icons/date.svg" class="iconImg" />
                                            <input type="text"
                                                value="{{ Carbon\Carbon::createFromFormat('Y-m-d', $loan->start_date)->format('d/m/Y') }}"
                                                placeholder="Set The Time" name="start_date" class="datePickerBasic"
                                                autocomplete="off" />
                                        </div>
                                        @include('new-theme.components.error1', ['error' => 'start_date'])
                                    </div>

                                    <div class="cardS1  my-4">
                                        <div class="name mb-3">{{ __('Month Number') }}</div>
                                        <div class="inputS1">
                                            <input name="month_nubmer" type="number"
                                                value="{{ $loan->month_nubmer }}" placeholder="" />
                                        </div>
                                        @include('new-theme.components.error1', [
                                            'error' => 'month_number',
                                        ])
                                    </div>

                                    <div class="cardS1  my-4">
                                        <div class="name mb-3">{{ __('Reason') }}</div>
                                        <div class="inputS1">
                                            <input type="text" value="{{ $loan->reason }}" placeholder="" />
                                        </div>
                                        @include('new-theme.components.error1', ['error' => 'reason'])
                                    </div>

                                    <div class="my-4">
                                        <div class="name mb-3">{{ __('Status') }}</div>
                                        <div class="inputS1">
                                            <select name="status">
                                                <option value="pending" {{ $loan->status == "pending" ? "selected" : "" }}>@lang("Pending")</option>
                                                <option value="approved" {{ $loan->status == "approved" ? "selected" : "" }}>@lang("Approved")</option>
                                                <option value="rejected" {{ $loan->status == "rejected" ? "selected" : "" }}>@lang("Reject")</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="flex align end gap-15 orders  my-5">
                                        <a href="{{ route('loan-requests.index') }}" class="buttonS1 rejected"
                                            type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                                            {{ __('Cancel') }}
                                        </a>
                                        <button class="buttonS1 primary" type="submit">
                                            {{ __('Save') }}
                                        </button>
                                    </div>

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
$('.reject-button').click(function(){
    var action = $(this).attr('href');
    $('.reject-form').attr('action', action);
});
</script>
@endpush
