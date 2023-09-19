@extends('new-theme.layout.layout1')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script  type="module"  src="/new-theme/js/mapPlaces.js"></script>
@endpush



@section('content')
    <div class="attendancePage">
        <div class="pageS1">
            @component('new-theme.settings.attendance.components.tabs') 
                    @include('new-theme.settings.attendance.components.vacations')
                    @slot('active' , 'vacation')
            @endcomponent
        </div>
    </div>
@endsection


