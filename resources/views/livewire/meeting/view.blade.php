<div style="width: 470px;" class="offcanvas offcanvas-end" tabindex="-1" id="id1" aria-labelledby="id1Label"
    wire:ignore.self>
    <div class="drawerS1">
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
                <h3>{{__('Meeting Details')}}</h3>

            </div>
            <div class="flex gap-15">
                @can('Meeting-Edit')
                    <div data-bs-toggle="offcanvas" data-bs-target="#edit1" aria-controls="edit1" class="edit-meeting"
                        data-id="{{ $meeting->id }}">
                        <img src="/new-theme/icons/edit.svg" alt="">
                    </div>
                @endcan
               
                @can('Meeting-Delete')
                    @if($meeting->id)
                        <div class="modal modal-delete fade" id="confirm2" abindex="-1" aria-hidden="true">
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

                        <img data-bs-toggle="modal" data-bs-target="#confirm2" class=""
                            data-route="{{ route('meeting.destroy', $meeting->id) }}" src="/new-theme/icons/delete.svg" />
                    @endif
                @endcan

            </div>
        </div>

        <div class="contentDrawer scroll">
            <div class="sectionDDS1 section">
                <div class="ant-collapse">
                    <span class="ant-collapse-header-text">{{ __('new_theme.Meeting information') }}</span>
                </div>

                <div class="ant-collapse-content-box">
                    <div class="cards">
                        <div class="cardS1 flex align">
                            <div class="name">{{ __('new_theme.Name') }}</div>
                            <div class="des">{{ $meeting->title }}</div>
                        </div>
                        <div class="cardS1 flex align">
                            <div class="name">{{ __('new_theme.Date') }}</div>
                            <div class="des">{{ $meeting->date ? $meeting->date->format('d/m/Y') : '' }}</div>
                        </div>
                        <div class="cardS1 flex align">
                            <div class="name">{{ __('new_theme.Time') }}</div>
                            <div class="des">{{ $meeting->time }}</div>
                        </div>
                        <div class="cardS1 flex align">
                            <div class="name">{{ __('new_theme.Duration') }}</div>
                            <div class="des">{{ $meeting->duration }}</div>
                        </div>
                        <div class="cardS1 flex align">
                            <div class="name">{{ __('new_theme.Employees') }}</div>
                            <div class="des">
                                {{ implode(' , ', $meeting->employees->pluck('name')->toArray() ?? []) ?? '' }}</div>
                        </div>
                        <div class="cardS1 flex align">
                            <div class="name">{{ __('new_theme.location') }}</div>
                            <div class="des">{{ $meeting->location }}</div>
                        </div>
                        <div class="cardS1">
                            <div class="name">{{ __('new_theme.Note') }}</div>
                            <textarea readonly>{{ $meeting->note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
