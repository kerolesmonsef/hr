@foreach ($deductions as $value => $deduction)
    <tr data-row-key="{{ $deduction->id }}" class="ant-table-row ant-table-row-level-0">
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>
            <div class="userTabl user">
                <img src="/new-theme/icons/all/user.svg" />
            </div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ \Auth::user()->employeeIdFormat($deduction->employee ? $deduction->employee->id : 'N/A') }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $deduction->employee ? $deduction->employee->{'name' . $lang} : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $deduction->employee && $deduction->employee->jobtitle ? $deduction->employee->jobtitle['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>
            {{ $deduction->employee && $deduction->employee->department ? $deduction->employee->department['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>{{ $deduction->percent ?? 0 }} %
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>{{ $deduction->date }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $deduction->id }}"
            aria-controls="id{{ $deduction->id }}">
            <div class="tooltip">{{ __('View Details') }}</div>{{ $deduction->title }}
        </td>
    </tr>

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id{{ $deduction->id }}"
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
                    <h3>{{ __('Deduction Details') }}</h3>
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
                                <span class="ant-collapse-header-text">{{ __('Employee Details') }} </span>
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
                                                {{ $deduction->employee ? $deduction->employee->{'name' . $lang} : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{ __('Code') }}</div>
                                            <div class="des">
                                                {{ \Auth::user()->employeeIdFormat($deduction->employee ? $deduction->employee->id : 'N/A') }}
                                            </div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{ __('Job Title') }} </div>
                                            <div class="des">
                                                {{ $deduction->employee && $deduction->employee->jobtitle ? $deduction->employee->jobtitle['name' . $lang] : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{ __('Department') }} </div>
                                            <div class="des">
                                                {{ $deduction->employee && $deduction->employee->department ? $deduction->employee->department['name' . $lang] : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="sectionDDS1 section">
                    <div>
                        <div class="ant-collapse flex align between">
                            <div class="flex align gap-3 pointer" data-bs-toggle="collapse" data-bs-target="#deducationDetails" aria-expanded="true" aria-controls="deducationDetails">
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
                                <span class="ant-collapse-header-text">{{ __('Deduction Details') }}</span>
                            </div>
                            
                            <div class="editIcon flex align gap-3">
                                @can('Saturationdeduction-Edit')
                                    <div data-bs-toggle="offcanvas"
                                        data-bs-target="#edit{{ $deduction->id }}"
                                        aria-controls="edit{{ $deduction->id }}">
                                        <img src="/new-theme/icons/edit.svg" />
                                    </div>
                                @endcan

                                @can('Saturationdeduction-Delete')
                                    <div>
                                        <a data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                            data-route="{{ route('saturationdeduction.destroy', $deduction->id) }}">
                                            <img src="/new-theme/icons/delete.svg" alt="" />
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="deducationDetails">
                        <div
                            class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                            <div class="ant-collapse-item ant-collapse-item-active">

                                <div class="ant-collapse-content ant-collapse-content-active my-3">
                                    <div class="ant-collapse-content-box">
                                        
                                        <div class="cards">
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Deduction Percent') }}</div>
                                                <div class="des">{{ $deduction->percent ?? 0 }} %</div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Reason') }}</div>
                                                <div class="des"> {{ $deduction->date }} </div>
                                            </div>
                                            <div class="cardS1 flex align">
                                                <div class="name">{{ __('Date') }}</div>
                                                <div class="des">{{ $deduction->title }}</div>
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

    <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit{{ $deduction->id }}"
        aria-labelledby="edit1Label">
        <div class=" drawerS1">
            <div class="head_">
                <h3>{{ __('Deduction Details') }}</h3>
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
                                                        {{ $deduction->employee ? $deduction->employee->{'name' . $lang} : 'N/A' }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Code') }}</div>
                                                    <div class="des">
                                                        {{ \Auth::user()->employeeIdFormat($deduction->employee ? $deduction->employee->id : 'N/A') }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Job Title') }} </div>
                                                    <div class="des">
                                                        {{ $deduction->employee && $deduction->employee->jobtitle ? $deduction->employee->jobtitle['name' . $lang] : 'N/A' }}
                                                    </div>
                                                </div>
                                                <div class="cardS1 flex align">
                                                    <div class="name">{{ __('Department') }} </div>
                                                    <div class="des">
                                                        {{ $deduction->employee && $deduction->employee->department ? $deduction->employee->department['name' . $lang] : 'N/A' }}
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
                    <div data-bs-toggle="collapse" data-bs-target="#deductionDetails" aria-expanded="true"
                        aria-controls="deductionDetails">
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
                                <span class="ant-collapse-header-text">{{ __('Deduction Details') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="deductionDetails">


                        <div class="my-3">
                            <form class="formS1 inputsS1 ajax-submit"
                                action="{{ route('saturationdeduction.update', $deduction->id) }}" method="post"
                                id="">
                                @method('PUT')
                                @csrf
                                <div class="ant-collapse-content-box">
                                    <div class="cardS1 my-4">
                                        <div class="name mb-3">{{ __('Deduction Options') }}</div>
                                        <div class="inputS1">
                                            <select name="deduction_option">
                                                <option value="">{{ __('Select') }}</option>
                                                @foreach ($deduction_options as $option)
                                                    <option value="{{ $option->id }}"
                                                        {{ isset($deduction) ? ($deduction->deduction_option == $option->id ? 'selected' : '') : '' }}>
                                                        {{ $option['name' . $lang] }}</option>
                                                @endforeach
                                            </select>
                                            @include('new-theme.components.error1', [
                                                'error' => 'deduction_option',
                                            ])
                                        </div>
                                    </div>

                                    <div class="cardS1 my-4">
                                        <div class="name mb-3">{{ __('Reason') }}</div>
                                        <div class="inputS1">
                                            <input type="text" name="title"
                                                value="{{ isset($deduction) ? $deduction->title : '' }}"
                                                placeholder='{{ __('Title') }}'>
                                        </div>
                                    </div>

                                    <div class="cardS1 my-4">
                                        <div class="name mb-3">{{ __('Date') }}</div>
                                        <div class="inputS1">
                                            <img src="/new-theme/icons/date.svg" class="iconImg" />
                                            <input type="text" name="date"
                                                value="{{ isset($deduction) ? \Carbon\Carbon::parse($deduction->date)->format('d/m/Y') : '' }}"
                                                placeholder="{{ __('Date') }}" name="date"
                                                class="datePickerBasic" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="cardS1 my-4">
                                        <div class="name mb-3">{{ __('Amount') }}</div>
                                        <div class="inputS1">
                                            <input type="number" id="amount" name="amount"
                                                value="{{ isset($deduction) ? $deduction->amount : '' }}"
                                                placeholder="{{ __('Amount') }}" autocomplete="off" />
                                        </div>
                                        @include('new-theme.components.error1', ['error' => 'amount'])
                                    </div>

                                    <div class="flex align end gap-15 orders  my-5">
                                        <button type="button" class="buttonS1 rejected" data-bs-dismiss="offcanvas" aria-label="Close">
                                            {{ __('Cancel') }}
                                        </button>
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
