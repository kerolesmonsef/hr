@extends('new-theme.layout.layout3')



@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href='{{ asset('payslip/showemployee/' . $employee->id) }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3> {{ __('Add New') }} </h3>
                    </div>
                </div>
            </a>

            {{ Form::open(['url' => 'overtime', 'class' => 'formS1 inputsS1', 'method' => 'post']) }}
            {{ Form::hidden('employee_id', $employee->id, []) }}

            <div class='sectionS2'>
                <div class='content p-4'>
                    @include('new-theme.payroll.overtime.form')
                </div>
            </div>

            <div class="flex align end gap-15 orders ">
                <a class="buttonS1 rejected" href="{{ asset('payslip/showemployee/' . $employee->id) }}">
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
