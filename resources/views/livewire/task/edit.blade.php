<div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit1" aria-labelledby="editLabel"
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
                @if ($task->id)
                <div class="modal modal-delete fade" id="confirm1" abindex="-1" aria-hidden="true">
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

                <div data-bs-toggle="modal" data-bs-target="#confirm1">
                    <img class="" src="/new-theme/icons/delete.svg" />
                </div>
                @endif
            </div>
        </div>

        <div class="contentDrawer scroll">

            <form action="" class="formS1" wire:submit.prevent='edit({{ $data['id'] }})'>
                <div class="sectionDDS1 section">
                    <div class="ant-collapse-content-box">
                        <div class="cards">

                            <div class="cardS1">
                                {{Form::label('name',__('Name'),['class' => 'form-label'])}}
                                <div class="inputS1">
                                    {{Form::text('name',null,array('class'=>'','placeholder'=>__('Enter Task
                                    Name'),'wire:model'=> 'data.name'))}}
                                </div>
                                @include('new-theme.components.error1',['error' => 'data.name'])
                            </div>

                            <div class="cardS1">
                                {{Form::label('label',__('Label'),['class' => 'form-label'])}}
                                <div class="inputS1">
                                    {{Form::text('label',null,array('class'=>'','placeholder'=>__('Enter Label')
                                    ,'wire:model'=> 'data.label' ))}}
                                </div>
                                @include('new-theme.components.error1',['error' => 'data.label'])
                            </div>

                            <div class="cardS1">
                                {{Form::label('start_date',__('Start Date'),['class' => 'form-label'])}}
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    {{Form::text('start_date',null,array('class'=>'datePickerBasic','placeholder'=>__('Start
                                    Date') ,'wire:model' => 'data.start_date' ))}}
                                </div>
                                @include('new-theme.components.error1',['error' => 'data.start_date'])
                            </div>

                            <div class="cardS1 ">
                                {{Form::label('label',__('Status'),['class' => 'form-label'])}}
                                <div class="inputS1">
                                    <select wire:model='data.status' class="thabet">
                                        @foreach(\App\Models\Task::getStatuses() as $status)
                                        <option value="{{ $status }}">{{ __('task_status_'.$status) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1',['error' => 'data.status'])
                            </div>

                            <div class="cardS1">
                                {{Form::label('due_date',__('Due Date'),['class' => 'form-label'])}}
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    {{Form::text('due_date',null,array('class'=>'datePickerBasic','placeholder'=>__('Due
                                    Date') , 'wire:model' => 'data.due_date' ))}}
                                </div>
                                @include('new-theme.components.error1',['error' => 'data.due_date'])
                            </div>
                        </div>
                    </div>
                </div>


                <div class="sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#editAllMembers" aria-expanded="true"
                        aria-controls="editAllMembers">
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
                    <div class="collapse show" id="editAllMembers">
                        <div class="ant-collapse-content-box">
                            @foreach ( $members as $member_id => $member_name)
                            <div class="taskMember flex align gap-3 mb-4">
                                <div class="icon">
                                    <img src="/new-theme/icons/userS1.svg" alt="" />
                                </div>
                                <div class="flex align between" style="width: 90%;">
                                    <h4>{{ $member_name }}</h4>
                                    <div style="cursor: pointer" wire:click="deleteMember({{ $member_id }},{{ $data['id'] }})">
                                        <img src="/new-theme/icons/delete.svg" alt="" />
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @foreach ($new_employees as $key=>$new_employee)

                            <div class="taskMember mb-4">
                                <div class="flex align gap-3">
                                    <div class="icon">
                                        <img src="/new-theme/icons/userS1.svg" alt="" />
                                    </div>
                                    <div class="flex align between" style="width: 60%;">
                                        <div class="inputS1 selectMember">
                                            <select wire:model="new_employees.{{ $key }}">
                                                <option value="">{{ __('Employee') }}</option>
                                                @foreach ($not_assigned_employees as $not_assigned_employee_id
                                                =>$not_assigned_employee)
                                                <option value="{{ $not_assigned_employee_id }}">{{ $not_assigned_employee }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex align gap-2">
                                        <span class="buttonS1 primary addMemberBtn" wire:click="assignMember({{ $key }})"> 
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.580933 7C0.580933 6.68934 0.869808 6.4375 1.22615 6.4375H15.421C15.7774 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7774 7.5625 15.421 7.5625H1.22615C0.869808 7.5625 0.580933 7.31066 0.580933 7Z" fill="white"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.32358 0.25C8.67992 0.25 8.9688 0.50184 8.9688 0.8125V13.1875C8.9688 13.4982 8.67992 13.75 8.32358 13.75C7.96723 13.75 7.67836 13.4982 7.67836 13.1875V0.8125C7.67836 0.50184 7.96723 0.25 8.32358 0.25Z" fill="white"/>
                                            </svg>
                                            {{__("Add")}} 
                                        </span>
                                        <span class="removeMemberBtn" wire:click="removeKey({{ $key }})"><img src="/new-theme/icons/delete.svg" alt="" /></span>
                                    </div>
                                </div>
                                @include('new-theme.components.error1',['error' => 'new_employees.'.$key])
                            </div>

                            @endforeach



                        </div>


                        <div class="addNewMemberBtn buttonS1" wire:click="addMember" >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 12H18" stroke="#066163" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12 18V6" stroke="#066163" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            {{ __('Add New Member') }}
                        </div>

                    </div>

                </div>

                <div class="sectionDDS1 section">
                    <div data-bs-toggle="collapse" data-bs-target="#editDescriptionOfNote" aria-expanded="true"
                        aria-controls="editDescriptionOfNote">
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

                    <div class="collapse show" id="editDescriptionOfNote">
                        <div class="ant-collapse-content-box">
                            <div class="cards">
                                <div class="cardS1">
                                    <div class="inputS1 ">
                                        {{Form::text('note',null,array('class'=>'scroll','placeholder'=>__('Note') ,'id'
                                        => 'descriptionOfNote' ,'wire:model' => 'data.note'))}}
                                    </div>
                                    @include('new-theme.components.error1',['error' => 'data.note'])
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- <div class="sectionDDS1 section">
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

                                @foreach ($activityLogs as $log)

                                <div class="activityCard flex gap-3">
                                    <div class="image"><img src="/new-theme/icons/note.svg" alt="" /></div>
                                    <div class="cardContent">
                                        <h4>
                                            <span>
                                                {{ $log->employee->name }} </span> {{ __('added this card to ') }}
                                            <span> {{ __('task_status_'.$log->description) }}
                                            </span>
                                        </h4>
                                        <p>{{ $log->created_at->format('d-m-Y - h:i a') }} </p>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                </div> --}}

                <div class="flex align end gap-15 p-4">

                    <button class="buttonS1 rejected" type="button" data-bs-dismiss="offcanvas" aria-label="Close">
                        {{ __('Cancel') }}
                    </button>

                    <button class="buttonS1 primary" type="submit">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>