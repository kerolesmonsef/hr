@extends('new-theme.layout.layout3')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href="{{ isset($employee) ? asset('payslip/showemployee/' . $employee->id) : asset('saturationdeduction') }}">
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Add New') }}</h3>
                    </div>
                </div>
            </a>

            {{ Form::open(['url' => 'saturationdeduction', 'class' => 'formS1 inputsS1', 'method' => 'post']) }}

            @if (isset($employee))
                {{ Form::hidden('employee_id', $employee->id, []) }}
            @endif

            <div class='sectionS2'>
                <div class='content p-4'>
                    @include('new-theme.payroll.saturation.form')
                </div>
            </div>

            <div class="flex align end gap-15 orders ">
                <a class="buttonS1 rejected"
                    href="{{ isset($employee) ? asset('payslip/showemployee/' . $employee->id) : asset('saturationdeduction') }}">
                    {{ __('Cancel') }}
                </a>
                <button class='buttonS1 primary' type="submit">
                    {{ __('Save') }}
                </button>
            </div>

            {{ Form::close() }}
        </div>
    </div>
    </div>
@endsection
