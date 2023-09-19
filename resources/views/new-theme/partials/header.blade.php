<header class="headerApp">
    <div class="containerS1 flex align between">
        <div class="section1 flex align">
            <!-- <div class="logo">
                <img src="{{ url('new-theme/images/logoLarge.svg') }}" />
            </div> -->
            <div class="inputS1 noBorder">
                <input type="text" placeholder="{{ __('Search') }}" />
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                        fill="#D9D9D9" />
                    <path
                        d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                        fill="#D9D9D9" />
                    <path
                        d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                        fill="#D9D9D9" />
                    <path
                        d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                        fill="#D9D9D9" />
                </svg>

            </div>

        </div>


        <div class="section2 flex align end">

            <div class="userDropdown">
                <div class="dropdown-toggle gap-10" type="button" id="defaultDropdown" data-bs-toggle="dropdown">
                    <div class="userImg">
                        <img src="/new-theme/icons/userS1.svg" alt="noImageUser" />
                    </div>


                    @if (preg_match('/[اأإء-ي]/ui', auth()->user()['name']))
                        <span style=" direction: rtl; ">{{ auth()->user()['name'] }}</span>
                    @else
                        <span style=" direction: ltr; ">{{ auth()->user()['name'] }}</span>
                    @endif

                </div>
                <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                    <li>
                        <img src="/new-theme/icons/userEdit.svg" alt="support" />
                        {{ __('Edit profile') }}
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <img src="/new-theme/icons/logout.svg" alt="support" />
                            {{ __('Logout') }}
                        </a>
                    </li>
                </ul>
            </div>

            <div class="notification iconS1" data-bs-toggle="modal" data-bs-target="#addNewClient">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                        stroke="#868686" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8.0001 3H9.0001C7.0501 8.84 7.0501 15.16 9.0001 21H8.0001" stroke="#868686"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M15 3C16.95 8.84 16.95 15.16 15 21" stroke="#868686" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M3 16V15C8.84 16.95 15.16 16.95 21 15V16" stroke="#868686" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M3 8.99961C8.84 7.04961 15.16 7.04961 21 8.99961" stroke="#868686" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

        </div>

        <!-- Change Lang Modal -->
        <div class="modal fade customeModal changeLangModal" id="addNewClient" tabindex="-1"
            aria-labelledby="addNewClient" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="formS1" action="{{ route('change.language_') }}" >
                            <div class="sectionS2">
                                <div class="head withBorder flex align between mb-0">
                                    <h3 class='small'>{{ __('Choose Language') }}</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="content">
                                    <label class="form-check">
                                        <input class="" type="radio" name="lang"
                                            id="flexRadioDefault1" value="en" {{ session("lang") == "en" ? "checked" : "" }}>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <img src="/new-theme/icons/en.svg" alt="en">
                                            {{ __('English') }}
                                        </label>
                                    </label>
                                    <label class="form-check">
                                        <input class="" type="radio" name="lang"
                                            id="flexRadioDefault2" value="ar" {{ session("lang") == "ar" ? "checked" : "" }}>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            <img src="/new-theme/icons/ar.svg" alt="ar">
                                            {{ __('Arabic') }}
                                        </label>
                                    </label>
                                    <button class="buttonS1 primary mb-4" style="width: 100%" type="submit">
                                        {{ __('save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>
