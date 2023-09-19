<div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="edit1" aria-labelledby="edit1Label"
    wire:ignore.self>
    <div class="drawerS1">
        <div class="head_ flex align between">
            <h3>{{ __('Event Details') }}</h3>

            @if ($event->id)
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
                                action="{{ route('meeting.destroy', $event->id) }}">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div data-bs-toggle="modal" data-bs-target="#confirm1" wire:ignore.self>
                <img class="" src="/new-theme/icons/delete.svg" />
            </div>

            @endif

        </div>
        {{-- @if (isset($event) && $event->id != null) --}}

        <div class="contentDrawer scroll">
            <div class="sectionDDS1 section">
                <div class="ant-collapse">
                    <span class="ant-collapse-header-text">{{ __('Event information') }}</span>

                </div>
                <div class="ant-collapse-content-box">
                    <form class="formS1" wire:submit.prevent='edit'>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3">{{ __('Name') }}</div>
                            <div class="inputS1">
                                <input wire:model="data.title" type="text" value="Meeting 1"
                                    placeholder="{{ __('Enter Event Title') }}" />
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.title'])
                        </div>
                        {{-- {{ $name ?? '' }} --}}

                        <div class="cardS1 datePicker my-4" wire:ignore>
                            <div class="name mb-3">{{ __('Start Event Date') }} </div>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input wire:model="data.start_date" type="text" value=""
                                    placeholder="{{ __('Enter Start Event Date') }}" name="datepicker"
                                    class="datePickerBasic" autocomplete="off" />
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.start_date'])

                        </div>

                        <div class="cardS1 datePicker my-4" wire:ignore>
                            <div class="name mb-3">{{ __('End Event Date') }} </div>
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                <input wire:model="data.end_date" type="text" value=""
                                    placeholder="{{ __('Enter End Event Date') }}" name="datepicker"
                                    class="datePickerBasic" autocomplete="off" />
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.end_date'])

                        </div>


                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('Start Event Time') }} </div>
                            <div class="inputS1">
                                <img src="/new-theme/icons/clock.svg" class="iconImg" />
                                <input wire:model="data.start_time" placeholder="" class="time-pickable" readonly>
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.start_time'])
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('End Event Time') }} </div>
                            <div class="inputS1">
                                <img src="/new-theme/icons/clock.svg" class="iconImg" />
                                <input wire:model="data.end_time" placeholder="" class="time-pickable" readonly>
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.end_time'])
                        </div>


                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('The Lectures') }} </div>
                            <div class="inputS1">
                                <input wire:model="data.lectures" type="text"
                                    placeholder="{{ __('Enter Lectures') }}" />
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.lectures'])
                        </div>



                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('location') }} </div>
                            <div class="inputS1">
                                <input wire:model="data.location" type="text" value="Naser city"
                                    placeholder="Enter Location" />
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.location'])
                        </div>

                        <div class="cardS1 datePicker my-4">
                            <div class="name mb-3"> {{ __('About') }} </div>
                            <div class="inputS1">
                                <textarea wire:model="data.about"
                                    placeholder="{{ __('Enter About Event') }}"></textarea>
                            </div>
                            @include('new-theme.components.error1', ['error' => 'data.about'])
                        </div>

                        <div class="cardS1 flex align py-4" style="border-top: 1px solid #EFEFEF; border-bottom: 1px solid #EFEFEF;">
                            <div class="name">@lang("Event photo")</div>
                            <div class="logo">
                                <div class="editIcon">
                                    <svg width="16" height="16" viewBox="0 0 16 16"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.33333 1.33203H6C2.66666 1.33203 1.33333 2.66536 1.33333 5.9987V9.9987C1.33333 13.332 2.66666 14.6654 6 14.6654H10C13.3333 14.6654 14.6667 13.332 14.6667 9.9987V8.66536"
                                            stroke="#868686" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M10.6933 2.01155L5.44 7.26488C5.24 7.46488 5.04 7.85822 5 8.14488L4.71333 10.1515C4.60666 10.8782 5.12 11.3849 5.84666 11.2849L7.85333 10.9982C8.13333 10.9582 8.52666 10.7582 8.73333 10.5582L13.9867 5.30488C14.8933 4.39822 15.32 3.34488 13.9867 2.01155C12.6533 0.678215 11.6 1.10488 10.6933 2.01155Z"
                                            stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M9.94 2.76562C10.3867 4.35896 11.6333 5.60562 13.2333 6.05896"
                                            stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <input name="photo" type="file"
                                        onchange="onUploadFilePreviewCard2(event,'outputImge1news')">

                                <img id="outputImge1news" src="/new-theme/images/logoLarge.svg" />
                            </div>
                        </div>

                        <div class="sectionEmployees sectionDDS1 section mb-4">
                <div data-bs-toggle="collapse" data-bs-target="#sectionEmployees" aria-expanded="true"
                    aria-controls="sectionEmployees">
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
                            <span class="ant-collapse-header-text">{{__('Employee List')}}</span>
                        </div>
                    </div>
                </div>

                <div class="collapse show" id="sectionEmployees">
                    <div
                        class="ant-collapse ant-collapse-icon-position-start ant-collapse-borderless css-dev-only-do-not-override-ilhm5s">
                        <div class="ant-collapse-item ant-collapse-item-active">
                            <div class="ant-collapse-content ant-collapse-content-active">
                                <div class="ant-collapse-content-box">

                                    <div class="cards tableS1">
                                        <!-- TODO: change employees list -->
                                        <div class="cardS1 flex align between gap-2 mb-4">
                                            <div class="flex align gap-2">
                                                <div class="icon">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.1601 10.87C12.0601 10.86 11.9401 10.86 11.8301 10.87C9.45006 10.79 7.56006 8.84 7.56006 6.44C7.56006 3.99 9.54006 2 12.0001 2C14.4501 2 16.4401 3.99 16.4401 6.44C16.4301 8.84 14.5401 10.79 12.1601 10.87Z"
                                                            stroke="#292D32" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M7.15997 14.56C4.73997 16.18 4.73997 18.82 7.15997 20.43C9.90997 22.27 14.42 22.27 17.17 20.43C19.59 18.81 19.59 16.17 17.17 14.56C14.43 12.73 9.91997 12.73 7.15997 14.56Z"
                                                            stroke="#292D32" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <div class="des" style="width: auto">Omar Ahmed</div>
                                            </div>
                                            <div class="">
                                                <img src="/new-theme/icons/delete.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="cardS1 flex align between gap-2 mb-4">
                                            <div class="flex align gap-2">
                                                <div class="icon">
                                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.1601 10.87C12.0601 10.86 11.9401 10.86 11.8301 10.87C9.45006 10.79 7.56006 8.84 7.56006 6.44C7.56006 3.99 9.54006 2 12.0001 2C14.4501 2 16.4401 3.99 16.4401 6.44C16.4301 8.84 14.5401 10.79 12.1601 10.87Z"
                                                            stroke="#292D32" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M7.15997 14.56C4.73997 16.18 4.73997 18.82 7.15997 20.43C9.90997 22.27 14.42 22.27 17.17 20.43C19.59 18.81 19.59 16.17 17.17 14.56C14.43 12.73 9.91997 12.73 7.15997 14.56Z"
                                                            stroke="#292D32" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <div class="des" style="width: auto">Omar Ahmed</div>
                                            </div>
                                            <div class="">
                                                <img src="/new-theme/icons/delete.svg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="addNewButton buttonS1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 12H18" stroke="#066163" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 18V6" stroke="#066163" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Add New Member
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

                        <div class="flex align end gap-3 my-3">
                            <a class="buttonS1 rejected" href="{{ route('event.index') }}" data-bs-dismiss="offcanvas"
                                aria-label="Close">{{ __('Cancel') }}</a>
                            <button class="buttonS1 primary">{{ __('Save') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        {{-- @endif --}}
    </div>
</div>