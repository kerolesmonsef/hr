<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ env('SITE_RTL') == 'on' ? 'rtl' : '' }}">

<head>
    <title>{{ __('Sign In') }}</title>
    <meta charset="utf-8">
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask &amp; Laravel versions. Grab your copy now and get life-time updates for free.">
    <meta name="keywords" content="Mwardi">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Mwardi">
    <meta property="og:url" content="https://mwardi.com/">
    <meta property="og:site_name" content="mwardi.com | Mwardi">
    <link rel="canonical" href="{{ asset('/') }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/media/logos/favicon.png') }}">
    <link rel="stylesheet" href="{{asset('admin/css?family=Inter:300,400,500,600,700')}}">
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css">
</head>
<style>
    body {
        background-image: url({{ asset('admin/assets/media/auth/bg4.png') }});
    }

    [data-theme="dark"] body {
        background-image: url({{ asset('assets/media/auth/bg4-dark.png') }});
    }
</style>

@php
$languages   = Utility::languages();
@endphp

<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-column">
                    <a href="{{ asset('/') }}" class="mb-7">
                        @if (app()->isLocale('en'))
                        <img style="width:200px;" alt="Logo" src="{{ url('logo-en.png') }}">
                        @else
                        <img style="width:200px;" alt="Logo" src="{{ url('logo-ar.png') }}">
                        @endif

                    </a>
                    <h2 class="text-white fw-normal m-0"> {{__('All you need to manage human resources')}} </h2>
                </div>
            </div>

            <div class="d-flex flex-center w-lg-50 p-10">
                <div class="card rounded-3 w-md-550px">
                    <div class="card-body p-10 p-lg-20">

                        <form class="form w-100" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3"> {{ __('Sign In') }} </h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    {{ __('Please enter your username and password') }} </div>
                            </div>

                            <div class="fv-row mb-8">
                                <input type="text" placeholder="{{ __('Email') }}" name="email" autocomplete="off" class="form-control bg-transparent">
                            </div>

                            <div class="fv-row mb-3">
                                <input type="password" placeholder="{{ __('Password') }}" name="password" autocomplete="off" class="form-control bg-transparent">
                            </div>

                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                {{-- <a href="#" class="link-primary">{{ __('Forgot Your Password?') }}</a> --}}
                            </div>

                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ __('Login') }}</span>
                                    <span class="indicator-progress">{{ __('Please wait...') }}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>

                        <div class="m-0 text-center">
							<!--begin::Toggle-->
							<button class="btn btn-flex btn-link rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
								<img data-kt-element="current-lang-flag" class="w-25px h-25px rounded-circle me-3" src="{{asset('admin/assets/media/flags/flag.png')}}" alt="">
								<span data-kt-element="current-lang-name" class="me-2">{{session()->has('lang') ? session()->get('lang') : 'en'}}</span>
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
								<span class="svg-icon svg-icon-3 svg-icon-muted rotate-180 m-0">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
									</svg>
								</span>
								<!--end::Svg Icon-->
							</button>
							<!--end::Toggle-->
							<!--begin::Menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4" data-kt-menu="true" id="kt_auth_lang_menu" style="">
								@foreach($languages as $key => $language)
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{route('change.language',$language)}}" class="menu-link d-flex px-5" data-kt-lang="English">
                                            <span class="symbol symbol-20px me-4">
                                                <img data-kt-element="lang-flag" class="rounded-1" src="{{asset('admin/assets/media/flags/flag.png')}}" alt="">
                                            </span>
                                            <span data-kt-element="lang-name">{{Str::upper($language)}}</span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                @endforeach
							</div>
							<!--end::Menu-->
						</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.bundle.js') }}"></script>

    @if($errors->any())
        <script>
            Swal.fire({
                text: "{{$errors->first()}}",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "{{__('messages.Ok')}}",
                customClass: {
                    confirmButton: "btn btn-danger"
                },
                timer: 1500,
            });
        </script>
    @endif

</body>

</html>
