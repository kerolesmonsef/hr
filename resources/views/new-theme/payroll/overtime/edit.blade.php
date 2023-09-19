@extends('new-theme.layout.layout3')

@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href='{{ asset('payslip/showemployee/' . $overtime->employee_id) }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3> {{ __('Update') }} </h3>
                    </div>
                </div>
            </a>

            {{ Form::model($overtime, ['route' => ['overtime.update', $overtime->id], 'class' => 'formS1 inputsS1', 'method' => 'PUT']) }}

            <div class='sectionS2'>
                <div class='content p-4'>
                    @include('new-theme.payroll.overtime.form')
                </div>
            </div>

            <div class="flex align end gap-15 orders ">
                <a class="buttonS1 rejected" href="{{ asset('payslip/showemployee/' . $overtime->employee_id) }}">
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
