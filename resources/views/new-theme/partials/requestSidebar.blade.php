<div class="navFoChild">
    <div class="navFoChildFixed">
        <div class="head">
            <h2>{{ __('Requests') }}</h2>
        </div>
        <div class="menu">
            <ul class="scroll">
                <li>
                    <a href="{{ route('employee-permissions.index') }}"
                        class="{{ is_active_link_sidebar(route('employee-permissions.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/requsetPermissions.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/requsetPermissionsActive.svg') }}" />
                        </div>


                        <span>{{ __('Permissions') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('vacations.index') }}"
                        class="{{ is_active_link_sidebar(route('vacations.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/vacations.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/vacationsActive.svg') }}" />
                        </div>
                        <span>{{ __('Vacations') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('mission.index') }}"
                        class="{{ is_active_link_sidebar(route('mission.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/mission.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/missionActive.svg') }}" />
                        </div>

                        <span>{{ __('Missions') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('work-from-home.index') }}"
                        class="{{ is_active_link_sidebar(route('work-from-home.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/workremotely.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/workremotelyActive.svg') }}" />
                        </div>

                        <span>{{ __('Work Remotely') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('over-time.index') }}"
                        class="{{ is_active_link_sidebar(route('over-time.index')) }}">

                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/overtime.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/overtimeActive.svg') }}" />
                        </div>

                        <span>{{ __('Over Time') }}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('loan-requests.index') }}"
                        class="{{ is_active_link_sidebar(route('loan-requests.index')) }}">
                        <div class="icon">
                            <img class="noActive" src="{{ url('new-theme/icons/menu/loan.svg') }}" />
                            <img class="yesActive" src="{{ url('new-theme/icons/menu/loanActive.svg') }}" />
                        </div>
                        
                        <span>{{ __('Loan') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
