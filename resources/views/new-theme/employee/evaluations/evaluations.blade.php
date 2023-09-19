@foreach ($evaluations as $value => $evaluation)
    <tr data-row-key="{{ $value }}" class="ant-table-row ant-table-row-level-0">
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details')</div> {{ $evaluation->title }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details') {{ $evaluation->id }}</div>{{ $evaluation->start_date }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details')</div>{{ $evaluation->end_date }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details')</div>
            {{ $evaluation->childs_count }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details')</div>
            {{ $evaluation->done_childs_count }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details')</div>
            {{ $evaluation->childs_count - $evaluation->done_childs_count }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details')</div>
            @php
                $status_attr = $evaluation->get_status();
            @endphp
            <div class="buttonS2 {{ $status_attr['class'] }}">{{ $status_attr['status'] }}</div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas" data-bs-target="#id{{ $value }}"
            aria-controls="id{{ $value }}">
            <div class="tooltip">@lang('View Details')</div>
            50%
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
                    <h3>@lang('Evaluation Details')</h3>
                </div>
                <div class="flex gap-15">
                    @can('Evaluation-Edit')
                        <a href="{{ route('evaluation.edit', $evaluation) }}">
                            <img src="/new-theme/icons/edit.svg" alt="" />
                        </a>
                    @endcan

                    @can('Evaluation-Delete')
                        <div>
                            <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                data-route="{{ route('evaluation.destroy', $evaluation->id) }}"
                                src="/new-theme/icons/delete.svg" />
                        </div>
                    @endcan
                </div>
            </div>

            <div class="contentDrawer scroll">

                <div class="sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                        aria-controls="employeeInformation">
                        <div class="ant-collapse">
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
                                <span class="ant-collapse-header-text">@lang('Evaluation Information')</span>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show" id="employeeInformation">
                        <div class="ant-collapse-content-box">
                            <div class="cards">
                                <div class="cardS1 flex align">
                                    <div class="name">@lang('Name')</div>
                                    <div class="des">{{ $evaluation->title }}</div>
                                </div>
                                <div class="cardS1 flex align">
                                    <div class="name">@lang('Start Date')</div>
                                    <div class="des">{{ $evaluation->start_date }}</div>
                                </div>
                                <div class="cardS1 flex align">
                                    <div class="name">@lang('End Date')</div>
                                    <div class="des">{{ $evaluation->end_date }}</div>
                                </div>
                                <div class="cardS1 flex align">
                                    <div class="name">@lang('Employees Numbers')</div>
                                    <div class="des">{{ $evaluation->childs_count }}</div>
                                </div>
                                <div class="cardS1 flex align">
                                    <div class="name">@lang('Done')</div>
                                    <div class="des">{{ $evaluation->done_childs_count }} {{__("Employees")}}</div>
                                </div>
                                <div class="cardS1 flex align">
                                    <div class="name">@lang('Left')</div>
                                    <div class="des">
                                        {{ $evaluation->childs_count - $evaluation->done_childs_count }}</div>
                                </div>
                                <div class="cardS1 flex align">
                                    <div class="name">@lang('Status')</div>
                                    <div class="des">
                                        {{ __($evaluation->status) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- 
                <div class="sectionDDS1 section allEmployees">
                    <div class="ant-collapse">
                        <div class="ant-collapse-header" aria-expanded="true"
                             aria-disabled="false" role="button" tabindex="0">
                            <div class="ant-collapse-expand-icon"
                                 data-bs-toggle="collapse"
                                 data-bs-target="#sectionEmployees"
                                 aria-expanded="true" aria-controls="sectionEmployees">
                                <svg stroke="currentColor" fill="currentColor"
                                     stroke-width="0" version="1.1"
                                     viewBox="0 0 17 17" class="ant-collapse-arrow"
                                     height="1em" width="1em"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g></g>
                                    <path
                                        d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z">
                                    </path>
                                </svg>
                            </div>

                        </div>
                    </div>

                    <div class="collapse show" id="sectionEmployees">
                        <div class="ant-collapse-content-box">
                            @foreach ($evaluation->childs as $child) 
                                <a href="{{ $child->is_completed ? route('evaluation.show',$child) : "javascript:void(0)" }}">
                                    <div class="evaluationCard flex align gap-2 mb-4">
                                        <div class="icon">
                                            <img src="/new-theme/icons/userS1.svg" alt=""/>
                                        </div>
                                        <div class="cardContent">
                                            <h4>{{ $child->employee?->name }}</h4>
                                            
                                            {!! generateStarRating($evaluationService->getEmployeeRate($evaluation,$child->employee)) !!}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div> --}}

            </div>
        </div>
    </div>
@endforeach
