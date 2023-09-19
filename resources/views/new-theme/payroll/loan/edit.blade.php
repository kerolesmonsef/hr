@extends('new-theme.layout.layout3')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush


@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href='{{ asset('payslip/showemployee/' . $loan->employee_id) }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Update') }}</h3>
                    </div>
                </div>
            </a>

            {{ Form::model($loan, ['route' => ['loan.update', $loan->id], 'class' => 'formS1 inputsS1', 'method' => 'PUT']) }}
            <div class='sectionS2'>
                <div class='content p-4'>
                    @include('new-theme.payroll.loan.form')
                </div>
            </div>

            <div class="flex align end gap-15 orders ">
                <a class="buttonS1 rejected" href="{{ asset('payslip/showemployee/' . $loan->employee_id) }}">
                    {{ __('Cancel') }}
                </a>
                <button class='buttonS1 primary' type="submit">
                    {{ __('Save') }}
                </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(function() {
            $('input[name="datepicker"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,

                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                },


                maxYear: parseInt(moment().format('YYYY'), 10)
            }, function(start, end, label) {

            });

            $('input[name="datepicker"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY'));
            });

            $('input[name="datepicker"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endpush
