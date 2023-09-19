<!DOCTYPE html>
<html lang="{{ $currentLang }}">

<head>
    @include('new-theme.partials.head')
    @stack('styles')
</head>

<body class='layout'>
    <div class="app">
        <div class="addOver"></div>
        @include('new-theme.partials.alert-delete')
        <!--Start::sidebar-->
        @include('new-theme.partials.sidebar')
        <!--Start::sidebar-->


        <div class="containerS1">

            @yield('content')
        </div>
    </div>
    @include('new-theme.partials.script')
</body>

</html>
