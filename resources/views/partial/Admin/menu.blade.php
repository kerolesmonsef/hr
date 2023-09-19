@php
    $logo               = asset(Storage::url('uploads/logo/'));
    $company_logo       = Utility::getValByName('company_logo');
    $company_small_logo = Utility::getValByName('company_small_logo');
    $profile            = asset(Storage::url('uploads/avatar/'));
@endphp

<!--begin::sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ asset('/home') }}">
            <img alt="Logo" src="{{ $company_logo ? $logo . '/' . $company_logo : $logo.'/logo.png' }}" class="h-25px app-sidebar-logo-default">
            <img alt="Logo" src="{{ $company_logo ? $logo . '/' . $company_logo : $logo.'/logo.png' }}" class="h-20px app-sidebar-logo-minimize">
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor"></path>
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor"></path>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            @if (auth()->user()->type == 'company' && auth()->id() == 218)
                <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'section' ? 'active' : '' }}"
                            href="{{ route('landpage.section') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Sections') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'blog' ? 'active' : '' }}"
                            href="{{ route('landpage.blog') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Blogs') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landcloudcard' ? 'active' : '' }}"
                            href="{{ route('landpage.landcloudcard') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Cloud cards') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landconactcard' ? 'active' : '' }}"
                            href="{{ route('landpage.landcontactcard') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Contact cards') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landdemocard' ? 'active' : '' }}"
                            href="{{ route('landpage.landdemocard') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Demo cards') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landchatbot' ? 'active' : '' }}"
                            href="{{ route('landpage.landchatbot') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Chatbot questions') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landaboutcard' ? 'active' : '' }}"
                            href="{{ route('landpage.landaboutcard') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.About cards') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'feature' ? 'active' : '' }}"
                            href="{{ route('landpage.landfeature') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Features') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landhelpcard' ? 'active' : '' }}"
                            href="{{ route('landpage.landhelpcard') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Help cards') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landplan' ? 'active' : '' }}"
                            href="{{ route('landpage.landplan') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Plan') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landsaycard' ? 'active' : '' }}"
                            href="{{ route('landpage.landsaycard') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Say card') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'slider' ? 'active' : '' }}"
                            href="{{ route('landpage.landslider') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Slider') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ request()->segment(2) == 'landsocial' ? 'active' : '' }}"
                            href="{{ route('landpage.landsocial') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="currentColor"></path>
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('landpage.Social media') }}</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                </div>
            @else
                <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Dashboard') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ asset('/home') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('indicator panel') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->



                    @if (auth()->user()->type == 'company')
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">

                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Structure list') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('companystructure.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Structure list') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    @endif

                    <!--begin:Menu item-->
                    @if (auth()->user()->type == 'super admin')
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Company') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('user.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Company') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                    @else
                        @if (Gate::check('Manage User') ||
                            Gate::check('Manage Role') ||
                            Gate::check('Manage Employee Profile') ||
                            Gate::check('Manage Employee Last Login'))
                            <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">

                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="9" height="9"
                                                    rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('Staff') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->

                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">

                                    @can('Manage User')
                                        <div class="menu-item">
                                            <!--begin:Menu link-->
                                            <a class="menu-link " href="{{ route('user.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ __('Staff') }}</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                    @endcan

                                    @can('Manage Role')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('roles.index') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="nav-label"> {{ __('Role') }}</span>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('Manage Employee Last Login')
                                        <div class="menu-item">
                                            <a class="menu-link" href="{{ route('lastlogin') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="nav-label"> {{ __('Last Login') }}</span>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                                <!--end:Menu sub-->
                            </div>
                        @endif
                    @endif
                    <!--end:Menu item-->

                    @if (Gate::check('Manage Employee'))
                        @if (auth()->user()->type == 'employee')
                            @php
                                $employee = App\Models\Employee::where('user_id', auth()->user()->id)->first();
                            @endphp
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="9" height="9"
                                                    rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('Employee') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->

                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link "
                                            href="{{ route('employee.show', ($employee->id)) }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Employee List') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                        @else
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="9" height="9"
                                                    rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('Employee Setting') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->

                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">

                                    <!--begin:Menu item-->
                                    {{-- <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link" href="{{ route('category.index') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">{{ __('Categories') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div> --}}
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link " href="{{ route('jobtitle.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Job Titles') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('nationality.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Nationality') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    {{-- <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('labor_companies.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('labor_companies') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div> --}}
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('place.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Location') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('jobtypes.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('jobtypes') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('banks.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('banks') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('request_types.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Request Type') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="{{ route('holiday.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Holidays') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                    {{-- <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link" href="{{ route('salary_component_type.index') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">{{ __('Salary components types') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div> --}}
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->

                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="9" height="9"
                                                    rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('Employee') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->

                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link " href="{{ route('employee.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Employee List') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->

                            </div>
                            <!--end:Menu item-->
                        @endif
                    @endif

                    @if (Gate::check('Manage Set Salary') || Gate::check('Manage Pay Slip'))
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Payroll') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('setsalary.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Set Salary') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('payslip.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Payslip List') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    @endif

                    @if (auth()->user()->type == 'employee')
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Payroll') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('setsalary.show', auth()->user()->id) }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Set Salary') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            {{-- <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link" href="{{ route('setsalary.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ __('Payslip') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                            <!--end:Menu item-->
                                        </div> --}}
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    @endif






                    @if (auth()->user()->type != 'employee')
                        @if (Gate::check('Manage Attendance') || Gate::check('Manage Leave') || Gate::check('Manage TimeSheet'))
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="2" y="2" width="9" height="9"
                                                    rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="2" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="13" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                                <rect opacity="0.3" x="2" y="13" width="9"
                                                    height="9" rx="2" fill="currentColor"></rect>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('Attendance') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->

                                @can('Manage Attendance')
                                    <!--begin:Menu item-->
                                        <div class="menu-sub menu-sub-accordion">
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link" href="{{ route('attendancemovement.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('Attendance Movement') }}</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                        </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu item-->
                                        <div class="menu-sub menu-sub-accordion">
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link" href="{{ route('employee-shifts.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('employee_shifts') }}</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                        </div>
                                    <!--end:Menu item-->

                                    <!--begin:Menu sub-->
                                        <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link " href="{{ route('attendanceemployee.index') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('Attendance') }}</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>
                                    <!--end:Menu sub-->

                                    <!--begin:Menu sub-->

                                        {{--  <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                            <div class="menu-item">
                                                <!--begin:Menu link-->
                                                <a class="menu-link" href="{{ route('attendanceemployee.bulkattendance') }}">
                                                    <span class="menu-bullet">
                                                        <span class="bullet bullet-dot"></span>
                                                    </span>
                                                    <span class="menu-title">{{ __('Updated attendance') }}</span>
                                                </a>
                                                <!--end:Menu link-->
                                            </div>
                                            <!--end:Menu item-->
                                        </div>  --}}
                                    <!--end:Menu sub-->
                            @endif

                    </div>
                    <!--end:Menu item-->
                @endif
                @endif

                @if (Gate::check('Manage Indicator') || Gate::check('Manage Appraisal') || Gate::check('Manage Goal Tracking'))
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Performance') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        @can('Manage Attendance')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('indicator.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Indicator') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('appraisal.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Appraisal') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('goaltracking.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Goal Tracking') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                    @endif
                </div>
                <!--end:Menu item-->
                @endif

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Leaves') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('New leaves') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->




                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Approved leaves') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Approved with deduction leaves') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Rejected leaves') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->

                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Job offers') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->






                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="{{ route('job-offers.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Job offers') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->



                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Work from home requests') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="{{ route('work_from_home_request.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Work from home requests') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
           0             <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">

                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Loan requests') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ route('loan-requests.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Loan requests') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->


                @if (Gate::check('Manage Trainer') || Gate::check('Manage Training'))
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                            fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Training') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        @can('Manage Training')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                @can('Manage Training')
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link " href="{{ route('training.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('Training List') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                @endcan
                            </div>
                            <!--end:Menu sub-->
                        @endcan

                        @can('Manage Trainer')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('trainer.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title"> {{ __('Trainer') }} </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                    </div>
                    <!--end:Menu item-->
                @endif

                @if (Gate::check('Manage Job') ||
                    Gate::check('Manage Job Application') ||
                    Gate::check('Manage Job OnBoard') ||
                    Gate::check('Manage Custom Question') ||
                    Gate::check('Manage Interview Schedule'))
                    <!--begin:Menu item-->
                    {{-- <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                                    <!--begin:Menu link-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">{{ __('Recruitment') }}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                    <!--end:Menu link-->

                                    @can('Manage Job')
                                        <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion">
                                                <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link " href="{{ route('job.index') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title">{{ __('Jobs') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                <!--end:Menu item-->
                                            </div>
                                        <!--end:Menu sub-->
                                    @endcan

                                    @can('Manage Job Application')
                                        <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion">
                                                <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link" href="{{ route('job.application.candidate') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title"> {{ __('Job Application') }} </span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                <!--end:Menu item-->
                                            </div>
                                        <!--end:Menu sub-->
                                    @endcan

                                    @can('Manage Job OnBoard')
                                        <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion">
                                                <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link" href="{{ route('job.on.board') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>
                                                            </span>
                                                            <span class="menu-title"> {{ __('Job OnBoard') }} </span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                <!--end:Menu item-->
                                            </div>
                                        <!--end:Menu sub-->
                                    @endcan

                                    @can('Manage Custom Question')
                                        <!--begin:Menu sub-->
                                        <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link" href="{{ route('custom-question.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title"> {{ __('Custom Question') }} </span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                            <!--end:Menu item-->
                                        </div>
                                        <!--end:Menu sub-->
                                    @endcan

                                    @can('Manage Interview Schedule')
                                        <!--begin:Menu sub-->
                                        <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link" href="{{ route('interview-schedule.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title"> {{ __('Interview Schedule') }} </span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                            <!--end:Menu item-->
                                        </div>
                                        <!--end:Menu sub-->
                                    @endcan

                                </div> --}}
                    <!--end:Menu item-->
                @endif

                @can('Manage Ticket')
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                            fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Ticket') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ route('ticket.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Ticket') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                    </div>
                    <!--end:Menu item-->
                @endcan

                @can('Manage Event')
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                            fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Event') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        @can('Manage Event')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('event.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Event') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                    </div>
                    <!--end:Menu item-->
                @endcan

                @can('Manage Meeting')
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2"
                                            fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Meeting') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ route('meeting.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Meeting') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                    </div>
                    <!--end:Menu item-->
                @endcan

                @if (auth()->user()->type == 'company')
                    @can('Manage Meeting')
                        <!--begin:Menu item-->
                        {{-- <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                                        <!--begin:Menu link-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">{{ __('Zoom Meeting') }}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                        <!--end:Menu link-->

                                            <div class="menu-sub menu-sub-accordion">
                                                    <!--begin:Menu item-->
                                                        <div class="menu-item">
                                                            <!--begin:Menu link-->
                                                            <a class="menu-link " href="{{ route('zoom-meeting.index') }}">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span class="menu-title">{{ __('Zoom Meeting') }}</span>
                                                            </a>
                                                            <!--end:Menu link-->
                                                        </div>
                                                    <!--end:Menu item-->
                                            </div>
                                    </div> --}}
                        <!--end:Menu item-->
                    @endcan
                @endif

                @if (Gate::check('Manage Assets'))
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Assets') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ route('account-assets.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Assets') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                    </div>
                    <!--end:Menu item-->
                @endcan

                @if (auth()->user()->type == 'company')
                    @if (Gate::check('Manage Document'))
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Document') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('document-upload.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Document') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('document-upload.report') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Document employees report') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->

                        </div>
                        <!--end:Menu item-->
                    @endif
                @endif

                @if (Gate::check('Manage Company Policy'))
                    <!--begin:Menu item-->
                    {{-- <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                                    <!--begin:Menu link-->
                                        <span class="menu-link">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title">{{ __('Company Policy') }}</span>
                                            <span class="menu-arrow"></span>
                                        </span>
                                    <!--end:Menu link-->

                                    <!--begin:Menu sub-->
                                        <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link " href="{{ route('company-policy.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ __('Company Policy') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                            <!--end:Menu item-->
                                        </div>
                                    <!--end:Menu sub-->
                                </div> --}}
                    <!--end:Menu item-->
                @endif

                @if (auth()->user()->id == 68)
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('vehicles list') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ route('vehicle.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('vehicles list') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                @endif

                @if (auth()->user()->type == 'super admin')
                    @if (Gate::check('Manage Plan'))
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Plan') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('plans.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">
                                            {{ __('Plan') }}
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Plan Request') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('plan_requests.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">
                                            {{ __('Plan Request') }}
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    @endif

                    @if (Gate::check('manage coupon'))
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Coupon') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('coupons.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">
                                            {{ __('Coupon') }}
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    @endif

                    @if (Gate::check('Manage Order'))
                        <!--begin:Menu item-->
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="2" width="9" height="9"
                                                rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="2" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="13" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                            <rect opacity="0.3" x="2" y="13" width="9"
                                                height="9" rx="2" fill="currentColor"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Order') }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <!--end:Menu link-->

                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('order.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">
                                            {{ __('Order') }}
                                        </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        </div>
                        <!--end:Menu item-->
                    @endif
                @endif

                @if (Gate::check('Manage Report'))
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Report') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ route('report.monthly.attendance') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Monthly Attendance') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('report.payroll') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Payroll') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('report.employee_with_emails') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Employee with emails') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('report.employee_with_leaves') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Employee with leaves') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('report.employee_with_salaries') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Employee with salaries') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                    </div>
                    <!--end:Menu item-->
                @endif

                @if (Gate::check('Manage Department') ||
                    Gate::check('Manage Designation') ||
                    Gate::check('Manage Document Type') ||
                    Gate::check('Manage Branch') ||
                    Gate::check('Manage Award Type') ||
                    Gate::check('Manage Termination Types') ||
                    Gate::check('Manage Payslip Type') ||
                    Gate::check('Manage Allowance Option') ||
                    Gate::check('Manage Loan Options') ||
                    Gate::check('Manage Deduction Options') ||
                    Gate::check('Manage Expense Type') ||
                    Gate::check('Manage Income Type') ||
                    Gate::check('Manage Payment Type') ||
                    Gate::check('Manage Leave Type') ||
                    Gate::check('Manage Training Type') ||
                    Gate::check('Manage Job Category') ||
                    Gate::check('Manage Job Stage'))
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9"
                                            rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="2" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="13" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                        <rect opacity="0.3" x="2" y="13" width="9"
                                            height="9" rx="2" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">{{ __('Constant') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->

                        <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('salary_setting.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('salary_setting') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('payroll_setting.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('payroll_setting') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('company-breaks.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Breaks') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                        @can('Manage Branch')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link " href="{{ route('branch.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Branch') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        <!--end:Menu sub-->

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link " href="{{ route('insurance-companies.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('Insurance companies') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->


                        <!--begin:Menu sub-->
                        @can('Manage Department')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('department.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Department') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        {{--  <!--begin:Menu sub-->
                        @can('Manage Designation')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('designation.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Designation') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan  --}}

                        <!--begin:Menu sub-->
                        @can('Manage Document Type')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('document.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Document Type') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Award Type')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('awardtype.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Award Type') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Termination Types')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('terminationtype.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Termination Type') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Payslip Type')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('paysliptype.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Payslip Type') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Allowance Option')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('allowanceoption.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Allowance Option') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Loan Option')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('loanoption.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Loan Option') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Deduction Option')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('deductionoption.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{ __('Deduction Option') }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Payment Type')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('paymenttype.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title"> {{ __('Payment Type') }} </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Termination Type')
                            {{-- <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link" href="{{ route('terminationtype.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title"> {{ __('Termination Type') }} </span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                            <!--end:Menu item-->
                                        </div> --}}
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Goal Type')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('goaltype.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title"> {{ __('Goal Type') }} </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Training Type')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('trainingtype.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title"> {{ __('Training Type') }} </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Job Category')
                            {{-- <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link" href="{{ route('job-category.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title"> {{ __('Job Category') }} </span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                            <!--end:Menu item-->
                                        </div> --}}
                        @endcan

                        <!--begin:Menu sub-->
                        @can('Manage Job Stage')
                            {{-- <div class="menu-sub menu-sub-accordion">
                                            <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link" href="{{ route('job-stage.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title"> {{ __('Job Stage') }} </span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                            <!--end:Menu item-->
                                        </div> --}}
                        @endcan

                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="{{ route('performanceType.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title"> {{ __('Performance Type') }} </span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>

                        <!--begin:Menu sub-->
                        @can('Manage Competencies')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('competencies.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title"> {{ __('Competencies') }} </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan

                        @if(Gate::check('Manage Company Settings') || Gate::check('Manage System Settings'))
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link" href="{{ route('settings.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title"> {{ __('System Setting') }} </span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                    </div>
                    <!--end:Menu item-->
                @endif

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="2" width="9"
                                        height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="13" width="9"
                                        height="9" rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="2" y="13" width="9"
                                        height="9" rx="2" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Evaluation') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->

                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('evaluation.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Manage evaluations') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('question_category.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Evaluation question categories') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link" href="{{ route('question.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Evaluation questions') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->


                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                        fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9"
                                        rx="2" fill="currentColor"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">{{ __('Documents library') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link " href="{{ route('library.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">{{ __('Documents library') }}</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                </div>
                <!--end:Menu item-->



    </div>
    @endif
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
</div>
<!--end::sidebar-->
