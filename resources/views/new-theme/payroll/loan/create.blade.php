@extends('new-theme.layout.layout3')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush


@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href='{{ asset('payslip/showemployee/' . $employee->id) }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Add New') }}</h3>
                    </div>
                </div>
            </a>

            {{ Form::open(['url' => 'loan', 'method' => 'post', 'class' => 'add_loan formS1 inputsS1']) }}
            {{ Form::hidden('employee_id', $employee->id, []) }}

            <div class='sectionS2'>
                <div class='content p-4'>
                    @include('new-theme.payroll.loan.form')
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

        $('input[name="amount"]').on('keyup change', function() {
            var amount = $(this).val();
            var month_number = $('.add_loan').find('input[name="month_nubmer"]').val();
            $.ajax({
                type: "POST",
                url: "{{ route('loan.get_monthly_loan') }}",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    amount: amount,
                    month_number: month_number,
                }),
                success: function(response) {
                    $('.add_loan').find('input[name="amount"]').val(response.amount);
                    $('.add_loan').find('input[name="month_nubmer"]').val(response.month_nubmer);
                    $('.add_loan').find('input[name="discount_monthly"]').val(response
                    .discount_monthly);

                },
                error: function(response) {
                    alert(
                        "{{ __('Please make sure that the values of the number of months and the value of the loan are greater than zero') }}");
                }
            })
        });

        $('input[name="month_nubmer"]').on('keyup change', function() {
            var amount = $('.add_loan').find('input[name="amount"]').val();
            var month_number = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ route('loan.get_monthly_loan') }}",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    amount: amount,
                    month_number: month_number,
                }),
                success: function(response) {
                    $('.add_loan').find('input[name="amount"]').val(response.amount);
                    $('.add_loan').find('input[name="month_number"]').val(response.month_number);
                    $('.add_loan').find('input[name="discount_monthly"]').val(response
                    .discount_monthly);
                },
                error: function(response) {
                    alert(
                        "{{ __('Please make sure that the values of the number of months and the value of the loan are greater than zero') }}");
                }
            })
        });
    </script>
@endpush
