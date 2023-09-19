<!DOCTYPE html>
<html lang="{{ $currentLang ?? '' }}">

<head>
    @include('new-theme.partials.head')
    @stack('styles')
</head>

<body class='layout'>
    <div class="app " id="app">
        @php
            $subsidebar_routes_arr = ['employee.index',  'employee-shifts.index', 'attendance.index'];
        @endphp
        <div class="addOver"></div>
        @include('new-theme.partials.alert-delete')
        <!--Start::sidebar-->
        @include('new-theme.partials.sidebar')
        <!--Start::sidebar-->

        @if (in_array(\Request::route()->getName(), $subsidebar_routes_arr))
            @include('new-theme.partials.subsidebar')
        @endif

        <div class="containerS1">

            @yield('content')
        </div>
    </div>
    @include('new-theme.partials.script')
</body>

</html>
