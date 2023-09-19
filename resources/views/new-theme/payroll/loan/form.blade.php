<div class="row">
    <div class="col-lg-6">
        <label for="loan_option" class="form-label">{{__('Loan options')}}</label>
        <div class="inputS1">
            <select name="loan_option">
                <option value="">{{__('Select')}}</option>
                @foreach($loan_options as $option)
                    <option value="{{$option->id}}" {{ isset($loan) ? ($loan->loan_option == $option->id ? 'selected' : '') : '' }}>{{$option['name'.$lang]}}</option>
                @endforeach
            </select>
        </div>
        @include('new-theme.components.error1',['error' => 'loan_option'])
    </div>

    <div class="col-lg-6">
        <label for="title" class="form-label">{{__('Title')}}</label>
        <div class="inputS1">
            <input type="text" name="title" value="{{ isset($loan) ? $loan->title : ''}}"  placeholder='{{__('Title')}}'>
        </div>
        @include('new-theme.components.error1',['error' => 'title'])
    </div>

    <div class="col-lg-6">
        <label for="reason" class="form-label">{{__('Reason')}}</label>
        <div class="inputS1">
            <input type="text" id="reason" name="reason" value="{{ isset($loan) ? $loan->reason : ''}}" placeholder='{{__('Reason')}}'>
        </div>
        @include('new-theme.components.error1',['error' => 'reason'])
    </div>
    @if(!isset($loan))
    <div class="col-lg-6">
        <label for="amount" class="form-label"> {{__('Amount')}}</label>
        <div class="inputS1 noHeight">
            <input type="number"  name="amount" value="{{ isset($loan) ? $loan->amount : ''}}" placeholder="{{__('Amount')}}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'amount'])
    </div>
    @endif

    <div class="col-lg-6">
        <label for="start_date" class="form-label"> {{__('Start Date')}}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="text" name="start_date" value="{{ isset($loan) ? \Carbon\Carbon::parse($loan->start_date)->format('d/m/Y') : ''}}" class="datePickerBasic"  placeholder="{{__('Start Date')}}" name="datepicker"
                id="datepicker" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'date'])
    </div>

    @if(!isset($loan))
    <div class="col-lg-6">
        <label for="month_nubmer" class="form-label">{{__('Month Number')}}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="number" name="month_nubmer" value="{{ isset($loan) ? $loan->month_nubmer : 1 }}"  placeholder="{{__('Month Number')}}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'month_nubmer'])
    </div>
    @endif

    <div class="col-lg-6">
        <label for="discount_monthly" class="form-label"> {{__('Discount Monthly')}}</label>
        <div class="inputS1 noHeight">
            <input type="number" readonly name="discount_monthly" value="{{ isset($loan) ? $loan->discount_monthly : ''}}"  placeholder="00.00 {{__('EGP')}}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'discount_monthly'])
    </div>
</div>

@push('script')
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
</script>
@endpush
