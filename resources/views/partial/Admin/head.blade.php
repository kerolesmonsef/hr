<head>
    <title>@yield('page-title')</title>
    <meta charset="utf-8">
    <meta name="description"
    content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask &amp; Laravel versions. Grab your copy now and get life-time updates for free.">
    <meta name="keywords" content="Mwardi">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Mwardi">
    <meta property="og:url" content="https://mwardi.com/">
    <meta property="og:site_name" content="mwardi.com | Mwardi">
    <link rel="canonical" href="{{ asset('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/media/logos/favicon.png') }}">
    <!--begin::Vendor Stylesheets(used by this page)-->
    <link href="{{url('assets/css/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/plugins/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" type="text/css">

    @if(env('SITE_RTL') == 'on' || session()->get('lang') == "ar")
    <link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css">
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('admin/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css">
    @else
        <link href="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
        <!--end::Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{asset('admin/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css">
    @endif
    <!--end::Global Stylesheets Bundle-->

    <!--Begin::Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5FS8GGP');</script>
    <!--End::Google Tag Manager -->

</head>
<style>
    .Action{
        display: contents;
    }
    .action-btns a{
        display: contents;
    }
    img{
        width: 100%;
    }
</style>
@stack('style')
