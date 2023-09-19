@extends('new-theme.layout.layout1')
@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
    <script src="{{ assert("new-theme/js/mapPlaces.js") }}"></script>

@endpush
@section('content')
    <div class="employeesDetails">
        <div class="pageS1">
            @component("new-theme.employee.components.edit-employee-tabs.tabs")
                @slot("active","printContract")
                @slot("employee",$employee)
                @include("new-theme.employee.components.edit-employee-tabs.contract",['employee'=>$employee])
            @endcomponent
        </div>
    </div>
@endsection