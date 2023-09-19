    {{Form::open(array('url'=>'terminate-request','method'=>'post' , 'class' => 'terminate-employee-form'))}}
    <div class="row">

        <div class="form-group col-md-12">
            {{ Form::label('title', __('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select id="mySelect2" class = "form-control change-input" name="employee_id">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ app()->isLocale('en') ? $employee->name :  $employee->name_ar }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            {{Form::label('date_termination',__('Date of termination'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('date_termination',date('Y-m-d'),array('class'=>'form-control datepicker change-input'))}}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('date_notify',__('Date of notify'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('date_notify',date('Y-m-d'),array('class'=>'form-control datepicker'))}}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('reason', __('Reason'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('reason',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('leave_credit', __('Leave credit'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('leave_credit',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Paid leave amount'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}

    <script>
        $('.change-input').on('change' , function(){
            var date = $('.terminate-employee-form').find('input[name="date_termination"]').val();
            var employee_id = $('.terminate-employee-form').find('select[name="employee_id"]').val();

            $.ajax({
                type: "POST",
                url: "{{ route('terminate-request.get_leave_information') }}",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    date: date,
                    employee_id: employee_id,
                }),
                success: function(response) {
                   $('.terminate-employee-form').find('input[name="leave_credit"]').val(response.work_days);
                   $('.terminate-employee-form').find('input[name="amount"]').val(response.cost);
                },
                error: function(response) {
                    alert("{{ __('Please make sure that the values of the number of months and the value of the loan are greater than zero') }}");
                }
            });

        });
    </script>

    {{--  <script>
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
    </script>  --}}


