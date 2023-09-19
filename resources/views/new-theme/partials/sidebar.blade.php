<div class="showMenu">

    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em"
        xmlns="http://www.w3.org/2000/svg">
        <g>
            <path fill="none" d="M0 0H24V24H0z"></path>
            <path d="M21 18v2H3v-2h18zM6.95 3.55v9.9L2 8.5l4.95-4.95zM21 11v2h-9v-2h9zm0-7v2h-9V4h9z"></path>
        </g>
    </svg>
</div>
<div class="sidebarApp" id="sidebarApp">
    <nav class="sidebar ">
        <div class="showMenu">
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16" height="1em"
                width="1em" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.116 8l-4.558 4.558.884.884L8 8.884l4.558 4.558.884-.884L8.884 8l4.558-4.558-.884-.884L8 7.116 3.442 2.558l-.884.884L7.116 8z">
                </path>
            </svg>
        </div>

        <header>
            <a href="{{ asset('/home') }}">
                <span class="image">
                    <img src="{{ url('new-theme/images/logoLarge.svg') }}" alt="logo" class="logoLarge" />
                    <img src="{{ url('new-theme/images/logoSmall.svg') }}" alt="logo" class="logoSmall" />
                </span>
            </a>

        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links menuScroll scroll">
                    <li class="nav-link active">
                        <a href="{{ route('home') }}" class="{{ is_active_link_sidebar(route('home') , asset("/home")) }}">
                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/home.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/homeActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{ route('employee.index') }}"
                            class="{{ is_active_link_like(asset('employee')) }}">
                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/users2.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/users2Active.svg') }}" />
                            </div>
                            <span class="text nav-text">{{ __('Employees') }}</span>
                        </a>
                    </li>

                    <li class="nav-link ">
                        <a href="{{ route('tasks.index') }}"
                            class="{{ is_active_link_sidebar([route('tasks.index'), route('get.tasks.grid')]) }}">


                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/tasks.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/tasksActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('Tasks') }}</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('employee-permissions.index') }}"
                            class="{{ is_active_link_like(asset('requests')) }}">
                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/permissions.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/permissionsActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('Requests') }}</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('evaluation.index') }}"
                            class="{{ is_active_link_like(asset('evaluation')) }}">

                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/evaluation2.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/evaluation2.svg') }}" />
                            </div>

                            <span class="text nav-text">@lang('Evaluation')</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="{{ route('meeting.index') }}"
                            class="{{ is_active_link_sidebar(route('meeting.index'),route('event.index')) }}">
                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/meeting.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/meetingActive.svg') }}" />
                            </div>
                            <span class="text nav-text">{{ __('Meetings') }}</span>
                        </a>
                    </li>


                    <li class="nav-link ">
                        <a href="{{ route('news.index') }}" class="{{ is_active_link_sidebar(route('news.index')) }}">


                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/news.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/newsActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('News') }}</span>
                        </a>
                    </li>


                    <li class="nav-link ">
                        <a href="{{ route('offers.index') }}"
                            class="{{ is_active_link_sidebar(route('offers.index')) }}">

                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/offers.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/offersActive.svg') }}" />
                            </div>
                            <span class="text nav-text">{{ __('Offers') }}</span>
                        </a>
                    </li>





                    <li class="nav-link">
                        <a href="{{ route('job-offers.index') }}"
                            class="{{ is_active_link_sidebar(route('job-offers.index')) }}">

                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/job-offers.svg') }}" />
                                <img class="yesActive"
                                    src="{{ url('new-theme/icons/menu/job-offersActive.svg') }}" />
                            </div>
                            <span class="text nav-text">{{ __('Job Offers') }}</span>
                        </a>
                    </li>



                    <li class="nav-link">
                        <a href="{{ route('payslip.index') }}"
                            class="{{ is_active_link_sidebar(route('payslip.index')) }}">


                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/payrolls.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/payrollsActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('Payroll') }}</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="{{ route('account-assets.index') }}"
                            class="{{ is_active_link_sidebar(route('account-assets.index')) }}">

                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/assets.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/assetsActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('Assets') }}</span>
                        </a>
                    </li>



                    <li class="nav-link ">
                        <a href="{{ route('companyStructureList') }}"
                            class="{{ is_active_link_sidebar(route('companyStructureList')) }}">

                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/structureList.svg') }}" />
                                <img class="yesActive"
                                    src="{{ url('new-theme/icons/menu/structureListActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('Structure list') }}</span>
                        </a>
                    </li>





                    <li class="nav-link">
                        <a href="{{ route('library.index') }}"
                            class="{{ is_active_link_sidebar(route('library.index')) }}">

                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/folders.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/foldersActive.svg') }}" />
                            </div>
                            <span class="text nav-text">{{ __('Document Library') }}</span>
                        </a>
                    </li>







                    <li class="nav-link">
                        <a href="{{ route('report.monthly.attendance') }}"
                            class="{{ is_active_link_like(asset('report')) }}">

                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/attendance2.svg') }}" />
                                <img class="yesActive"
                                    src="{{ url('new-theme/icons/menu/attendance2Active.svg') }}" />
                            </div>


                            <span class="text nav-text">{{ __('Reports') }}</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="{{ route('user.index') }}"
                            class="tab danger-text flexAlign {{ is_active_link_like(asset('settings-s')) }}">
                            <div class="icon">
                                <img class="noActive" src="{{ url('new-theme/icons/menu/settings.svg') }}" />
                                <img class="yesActive" src="{{ url('new-theme/icons/menu/settingsActive.svg') }}" />
                            </div>

                            <span class="text nav-text">{{ __('Setting') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
</div>
