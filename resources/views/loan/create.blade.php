    {{Form::open(array('url'=>'loan','method'=>'post' , 'class' => 'add_loan'))}}
    {{ Form::hidden('employee_id',$employee->id, array()) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('title', __('Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('date',__('Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('date',date('Y-m-d'),array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('loan_option', __('Loan Options*'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::select('loan_option',$loan_options,null, array('class' => 'form-control ','required'=>'required')) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Loan Amount'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('month_nubmer', __('Pay for how many months?'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('month_nubmer',1, array('class' => 'form-control ','required'=>'required','min' => 1)) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('discount_monthly', __('discount_monthly'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('discount_monthly',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('start_date', __('Start Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('start_date',date('Y-m-d'), array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('reason', __('Reason'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::textarea('reason',null, array('class' => 'form-control','rows'=>1,'required'=>'required')) }}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}

    <script>
        $('input[name="amount"]' ).on('keyup change',function(){
            var amount = $(this).val();
            var month_number =  $('.add_loan').find('input[name="month_nubmer"]').val();
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
                   $('.add_loan').find('input[name="discount_monthly"]').val(response.discount_monthly);

                },
                error: function(response) {
                    alert("{{ __('Please make sure that the values of the number of months and the value of the loan are greater than zero') }}");
                }
            })
        });
        
        $('input[name="month_nubmer"]' ).on('keyup change',function(){
            var amount = $('.add_loan').find('input[name="amount"]').val();
            var month_number = $(this).val()  ;
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
                    $('.add_loan').find('input[name="discount_monthly"]').val(response.discount_monthly);
                },
                error: function(response) {
                    alert("{{ __('Please make sure that the values of the number of months and the value of the loan are greater than zero') }}");
                }
            })
        });

        $(function () {
            $(".gregorian-date , .datepicker").flatpickr({
            format:'YYYY-M-D',
            showSwitcher: false,
            hijri:false,
            useCurrent: true,
            });
        });
    </script>
