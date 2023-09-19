<div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit1" aria-labelledby="edit1Label"
    wire:ignore.self>
    <div class="drawerS1">
        <div class="head_ flex align between">
            <h3>{{ __('Meeting Details') }}</h3>

            @if ($meeting->id)
                <div class="modal modal-delete fade" id="confirm1" abindex="-1" aria-hidden="true">
                    <div class="modal-dialog confirmS1 ">
                        <div class="content">
                            <div class="des">{{ __('Are you sure to delete this item ?') }}</div>
                            <div class="btns">
                                <button form="delete-form2" type="submit"
                                    class="buttonS2 danger">{{ __('Remove') }}</button>
                                <button type="button" class="buttonS2 cancel"
                                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                                <form id="delete-form2" style="display:none;" method="post"
                                    action="{{ route('meeting.destroy', $meeting->id) }}">
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
        {{-- @if (isset($meeting) && $meeting->id != null) --}}

        <div class="contentDrawer scroll">
            <div class="sectionDDS1 section">
                <div class="ant-collapse">
                    <span class="ant-collapse-header-text">Meeting information</span>

                </div>
                <div class="ant-collapse-content-box">
                    <form class="formS1" wire:submit.prevent='edit'>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('Name') }}</div>
                            <div class="sectionInput">
                                <div class="inputS1">
                                    <input wire:model="data.title" type="text" value="Meeting 1"
                                        placeholder="Enter Meeting Name" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'data.title'])
                            </div>
                        </div>
                        {{-- {{ $name ?? '' }} --}}

                        <div class="cardS1 datePicker my-4" wire:ignore>
                            <div class="name mb-3">{{ __('Date') }} </div>
                            <div class="sectionInput">
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    <input wire:model="data.date" type="text" value=""
                                        placeholder="Enter Publish Date" name="datepicker" class="datePickerBasic"
                                        autocomplete="off" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'data.date'])
                            </div>

                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('Time') }} </div>
                            <div class="sectionInput">
                                <div class="inputS1">
                                    <img src="/new-theme/icons/clock.svg" class="iconImg" />
                                    <input wire:model="data.time" placeholder="Enter Meeting Time" class="time-pickable"
                                        id="CompanyStart" name="CompanyStart" readonly>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'data.time'])
                            </div>

                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('Duration') }} </div>
                            <div class="sectionInput">
                                <div class="inputS1">
                                    <input wire:model="data.duration" type="text" value="3 Hours"
                                        placeholder="Enter Duration" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'data.duration'])
                            </div>
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('new_theme.Employees') }}</div>
                            <div class="sectionInput">
                                <div class="inputS1">
                                    {{-- seeee error check livewire  --}}
                                    <select class="" multiple style="height: 100px" wire:model="data.employee_id"
                                        name="employee_id" id="employee_id">
                                        {{-- <option value="all">All</option> --}}
                                        @foreach ($all_employees as $employee_id => $employee_name)
                                            <option value="{{ $employee_id }}"
                                                {{ in_array($employee_id, is_array($employees) ? $employees : []) ? 'selected' : '' }}>
                                                {{ $employee_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'data.employee_id'])
                            </div>
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('location') }} </div>
                            <div class="sectionInput">
                                <div class="inputS1">
                                    <input wire:model="data.location" type="text" value="Naser city"
                                        placeholder="Enter Location" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'data.location'])
                            </div>
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('Note') }} </div>
                            <div class="sectionInput">
                                <div class="inputS1">
                                    <textarea wire:model="data.note" placeholder="Enter About"></textarea>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'data.note'])
                            </div>
                        </div>

                        <div class="flex align end gap-3 my-3">
                            <a class="buttonS1 rejected" href="{{ route('meeting.index') }}"
                                data-bs-dismiss="offcanvas" aria-label="Close">{{ __('Cancel') }}</a>
                            <button class="buttonS1 primary">{{ __('Save') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        {{-- @endif --}}
    </div>
</div>
