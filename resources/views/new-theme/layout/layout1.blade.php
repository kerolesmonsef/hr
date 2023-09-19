<!DOCTYPE html>
<html lang="{{ $currentLang ?? 'en' }}">

<head>
    @include('new-theme.partials.head')
    @stack('styles')
</head>

<body class='layout'>
    <div class="app " id="app">
        <div class="addOver"></div>
        @php
            $routes_arr = ['employee.index', 'employee-shifts.index', 'attendance.index', 'saturationdeduction.index', 'employee.edit', 'employee.create', 'employee.editFinancial', 'employee.editDocuments', 'employee.breaks', 'employee.assets', 'employee.vacations', 'employee.attendance', 'employee.contract'];
            
            $requests_arr = ['employee-permissions.index', 'loan-requests.index', 'vacations.index', 'work-from-home.index', 'over-time.index', 'mission.index'];
        @endphp
        @include('new-theme.partials.alert-delete')
        <!--Start::sidebar-->
        @include('new-theme.partials.sidebar')
        <!--Start::sidebar-->
        @if (in_array(\Request::route()->getName(), $routes_arr))
            @include('new-theme.partials.subsidebar')
        @endif

        @if (in_array(\Request::route()->getName(), $requests_arr))
            @include('new-theme.partials.requestSidebar')
        @endif

        @if (request()->segment(1) == 'settings-s')
            @include('new-theme.partials.settingsSidebar')
        @endif
        @if (request()->segment(1) == 'meeting' || request()->segment(1) == 'event')
            @include('new-theme.partials.meetingsSidebar')
        @endif
        @isset($showReportMenu)
            @include('new-theme.partials.reportsSidebar')
        @endisset

        <div class="containerS1">
            @include('new-theme.partials.header')

            @yield('content')
        </div>
    </div>
    @include('new-theme.partials.script')
</body>

</html>
