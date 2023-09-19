<div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id1" aria-labelledby="id1Label"
    wire:ignore.self>

    <div class=" drawerS1">
        <div class="head_ flex align between">
            <div class="flex align gap-25">
                <div class="" data-bs-dismiss="offcanvas" aria-label="Close">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.29289 5.29289C6.68342 4.90237 7.31658 4.90237 7.70711 5.29289L17.7071 15.2929C18.0976 15.6834 18.0976 16.3166 17.7071 16.7071L7.70711 26.7071C7.31658 27.0976 6.68342 27.0976 6.29289 26.7071C5.90237 26.3166 5.90237 25.6834 6.29289 25.2929L15.5858 16L6.29289 6.70711C5.90237 6.31658 5.90237 5.68342 6.29289 5.29289Z"
                            fill="black" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.2929 5.29289C16.6834 4.90237 17.3166 4.90237 17.7071 5.29289L27.7071 15.2929C28.0976 15.6834 28.0976 16.3166 27.7071 16.7071L17.7071 26.7071C17.3166 27.0976 16.6834 27.0976 16.2929 26.7071C15.9024 26.3166 15.9024 25.6834 16.2929 25.2929L25.5858 16L16.2929 6.70711C15.9024 6.31658 15.9024 5.68342 16.2929 5.29289Z"
                            fill="black" />
                    </svg>
                </div>
                <h3>{{ __('Task Details') }}</h3>
            </div>
            <div class="flex gap-15">

                @can('Task-Edit')
                    <div data-bs-toggle="offcanvas" data-bs-target="#edit1" aria-controls="edit1" class="edit-task" data-id="{{ $task->id }}">
                        <img src="/new-theme/icons/edit.svg" alt="" />
                    </div>
                @endcan

                @can('Task-Edit')
                    @if($task->id) 
                        <div class="modal modal-delete fade" id="confirm2" abindex="-1" aria-hidden="true">
                            <div class="modal-dialog confirmS1 ">
                                <div class="content">
                                    <div class="des">{{ __('Are you sure to delete this item ?') }}</div>
                                    <div class="btns">
                                        <button form="delete-form2" type="submit" class="buttonS2 danger">{{ __('Remove')
                                            }}</button>
                                        <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">{{ __('Close')
                                            }}</button>
                                        <form id="delete-form2" style="display:none;" method="post"
                                            action="{{ route('tasks.destroy', $task->id) }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <img data-bs-toggle="modal" data-bs-target="#confirm2" class="" src="/new-theme/icons/delete.svg" />
                    @endif
                @endcan
            </div>

        </div>

        <div class="contentDrawer scroll">

            <div class="sectionDDS1 section">

                <div class="">
                    <div class="ant-collapse-content-box">
                        <div class="cards">
                            <div class="cardS1 flex">
                                <div class="name">{{ __('Name') }}</div>
                                <div class="des">{{ $task->name }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Label') }}</div>
                                <div class="des">{{ $task->label }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Start Date') }}</div>
                                <div class="des">{{ $task->start_date }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('status') }}</div>
                                <div class="buttonS2 {{ $task->task_status_label }} small">{{
                                    __('task_status_'.$task->status) }}</div>
                            </div>
                            <div class="cardS1 flex align">
                                <div class="name">{{ __('Due Date') }}</div>
                                <div class="des">{{ $task->days_until_due }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="sectionDDS1 section">
                <div data-bs-toggle="collapse" data-bs-target="#allMembers" aria-expanded="true"
                    aria-controls="allMembers">
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
                            <span class="ant-collapse-header-text">{{ __('All Members') }}</span>
                        </div>
                    </div>
                </div>

                <div class="collapse show" id="allMembers">
                    <div class="ant-collapse-content-box">

                        @foreach ($task->employees as $employee)
                        <div class="taskMember flex align gap-3 mb-4">
                            <div class="icon">
                                <img src="/new-theme/icons/userS1.svg" alt="" />
                            </div>
                            <h4>{{ $employee->name }}</h4>
                        </div>
                        @endforeach


                    </div>
                </div>

            </div>

            <div class="sectionDDS1 section">
                <div data-bs-toggle="collapse" data-bs-target="#descriptionOfNote" aria-expanded="true"
                    aria-controls="descriptionOfNote">
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
                            <span class="ant-collapse-header-text">{{ __('Note') }}</span>
                        </div>
                    </div>
                </div>

                <div class="collapse show" id="descriptionOfNote">
                    <div class="ant-collapse-content-box">
                        <div class="cards">
                            <div class="cardS1">
                                <p class="des" style="width: auto; margin-inline-start: 30px">{{ $task->note }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="sectionDDS1 section">
                <div data-bs-toggle="collapse" data-bs-target="#activeties" aria-expanded="true"
                    aria-controls="activeties">
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
                            <span class="ant-collapse-header-text">{{ __('Activity') }}</span>
                        </div>
                    </div>
                </div>

                <div class="collapse show" id="activeties">
                    <div class="ant-collapse-content-box">
                        <div class="activityCards">

                            @foreach ($task->activityLogs as $log)

                            <div class="activityCard flex gap-3">
                                <div class="image"><img src="/new-theme/icons/note.svg" alt="" /></div>
                                <div class="cardContent">
                                    <h4>
                                        <span>
                                            {{  $log->user->employee ?  $log->user->employee->name  :  $log->user->name  }} </span> {{ __('added this card to ') }} <span> {{ __('task_status_'.$log->description) }}
                                        </span>
                                    </h4>
                                    <p>{{ $log->created_at->format('d-m-Y - h:i a') }} </p>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>