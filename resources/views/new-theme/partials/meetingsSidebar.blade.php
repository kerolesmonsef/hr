<div class="navFoChild">
    <div class="navFoChildFixed">
        <div class="head">
            <h2>{{ __('Meetings') }}</h2>
        </div>
        <div class="menu">
            <ul class="scroll">
                <li>
                    <a href="{{ route('meeting.index') }}"
                       class="{{ is_active_link_sidebar(route('meeting.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/meetingSidebar.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/meetingSidebarActive.svg') }}" />
                        </div>


                        <span>{{ __('Meetings') }}</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('event.index') }}"
                       class="{{ is_active_link_sidebar(route('event.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/events.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/eventsActive.svg') }}" />
                        </div>



                        <span>{{ __('Events') }}</span>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>
