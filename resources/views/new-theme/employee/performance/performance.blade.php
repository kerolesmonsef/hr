@foreach($performance as $id => $value)
    <tr data-row-key="{{ $id }}" class="ant-table-row ant-table-row-level-0">
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            <div class="userTabl user">
                <img src="/new-theme/icons/all/user.svg"/>
            </div>
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ auth()->user()->employeeIdFormat($value->employee->id) }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ $value->employee ? $value->employee['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ $value->employee->branch ? $value->employee->branch['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ $value->employee->jobtitle ? $value->employee->jobtitle['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ $value->employee->department ? $value->employee->department['name' . $lang] : 'N/A' }}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            {{ $value->date}}
        </td>
        <td class="tooltipS1" data-bs-toggle="offcanvas"
            data-bs-target="#performanceId{{ $id }}"
            aria-controls="performanceId{{ $id }}">
            <div class="tooltip">{{__('View Details')}}</div>
            <ul class="flex align gap-1">
                <li>
                    <div class="starsView" style="--rating: {{ $value->rate ?? 0}};"></div>
                </li>
                <li>({{ $value->rate ?? 0}})</li>
            </ul>
        </td>

        <td>
            <div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1"
                id="performanceId{{ $id }}" aria-labelledby="id1Label">
                <div class=" drawerS1">
                    <div class="head_ flex align between">
                        <div class="flex align gap-25">
                            <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                                        fill="black"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                                        fill="black"/>
                                </svg>
                            </div>
                            <h3>{{__('Performance Details')}}</h3>
                        </div>
                        <div class="flex gap-15">

                            @can('Performance-Edit')
                                <a href="{{Route('performance.edit',$value->id)}}">
                                    <img src="/new-theme/icons/edit.svg" alt=""/>
                                </a>
                            @endcan

                            @can('Performance-Delete')
                                <div>
                                    <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                                    data-route="{{ route('performance.destroy', $value->id) }}"
                                    src="/new-theme/icons/delete.svg" />
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="contentDrawer scroll">

                        <div class="sectionDDS1 section">
                            <div data-bs-toggle="collapse" data-bs-target="#employeeInformation"
                                aria-expanded="true" aria-controls="employeeInformation">
                                <div class="ant-collapse">
                                    <div class="ant-collapse-header" aria-expanded="true"
                                        aria-disabled="false" role="button" tabindex="0">
                                        <div class="ant-collapse-expand-icon">
                                            <svg stroke="currentColor" fill="currentColor"
                                                stroke-width="0" version="1.1" viewBox="0 0 17 17"
                                                class="ant-collapse-arrow" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g></g>
                                                <path
                                                    d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z"></path>
                                            </svg>
                                        </div>
                                        <span class="ant-collapse-header-text">
                                            {{__('Employee Details')}}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse show" id="employeeInformation">
                                <div class="ant-collapse-content-box">
                                    <div class="cards">
                                        <div class="cardS1 flex align">
                                            <div class="name">{{__('Name')}}</div>
                                            <div class="des">{{ $value->employee ? $value->employee['name' . $lang] : 'N/A' }}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{__('Code')}}</div>
                                            <div class="des">{{ auth()->user()->employeeIdFormat($value->employee->id) }}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{__('Job Title')}}</div>
                                            <div class="des">{{ $value->employee->jobtitle ? $value->employee->jobtitle['name' . $lang] : 'N/A' }}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{__('Branch')}}</div>
                                            <div class="des">{{ $value->employee->branch ? $value->employee->branch['name' . $lang] : 'N/A' }}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{__('Department')}}</div>
                                            <div class="des">{{ $value->employee->department ? $value->employee->department['name' . $lang] : 'N/A' }}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{__('Date')}}</div>
                                            <div class="des">{{$value->date}}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name">{{__('Evaluation Type')}}</div>
                                            <div class="des">{{$value->performance_period['name'.$lang]}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sectionDDS1 section">
                            <div data-bs-toggle="collapse" data-bs-target="#performanceDetails"
                                aria-expanded="true" aria-controls="performanceDetails">
                                <div class="ant-collapse">
                                    <div class="ant-collapse-header" aria-expanded="true"
                                        aria-disabled="false" role="button" tabindex="0">
                                        <div class="ant-collapse-expand-icon">
                                            <svg stroke="currentColor" fill="currentColor"
                                                stroke-width="0" version="1.1" viewBox="0 0 17 17"
                                                class="ant-collapse-arrow" height="1em" width="1em"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g></g>
                                                <path
                                                    d="M12.146 6.146l0.707 0.707-4.353 4.354-4.354-4.353 0.707-0.707 3.647 3.646 3.646-3.647zM17 8.5c0 4.687-3.813 8.5-8.5 8.5s-8.5-3.813-8.5-8.5 3.813-8.5 8.5-8.5 8.5 3.813 8.5 8.5zM16 8.5c0-4.136-3.364-7.5-7.5-7.5s-7.5 3.364-7.5 7.5 3.364 7.5 7.5 7.5 7.5-3.364 7.5-7.5z"></path>
                                            </svg>
                                        </div>
                                        <span
                                            class="ant-collapse-header-text">{{__('Performance Details')}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse show" id="performanceDetails">
                                <div class="ant-collapse-content-box">
                                    <div class="cards">
                                        @foreach ($value->details as $detail)
                                            <div class="cardS1 flex align">
                                                <div class="name" style="width: 80%">
                                                    {{$detail->performance_factor}}
                                                </div>
                                                <div class="des flex end">{{$detail->points}}</div>
                                            </div>
                                        @endforeach
                                       
                                        <hr/>
                                        <div class="cardS1 flex align">
                                            <div class="name" style="width: 80%">{{__('Total Points')}}</div>
                                            <div class="des flex end">{{$value->rate ?? 0}}</div>
                                        </div>
                                        <div class="cardS1 flex align">
                                            <div class="name" style="width: 80%">{{__('Overall Rating')}}
                                            </div>
                                            <div class="des flex end">
                                                <ul class="flex align gap-1">
                                                    <div class="starsView" style="--rating: {{ $value->rate ?? 0}};"></div>
                                                    <li>({{$value->rate ?? 0}})</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach