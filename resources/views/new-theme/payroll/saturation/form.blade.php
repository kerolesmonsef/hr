<div class="row">

    @if(isset($employees))
        <div class="col-lg-6">
            <label for="name" class="form-label">{{__('Employee')}}</label>
            <div class="inputS1">
                <select name="employee_id">
                    <option value="">{{ __('Select') }}</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"
                            {{ isset($saturationdeduction) ? ($saturationdeduction->employee_id == $employee->id ? 'selected' : '') : '' }}>
                            {{ $employee['name' . $lang] }}</option>
                    @endforeach
                </select>
            </div>
            @include('new-theme.components.error1',['error' => 'deduction_option'])
        </div>
    @endif

    <div class="col-lg-6">
        <label for="name" class="form-label">{{__('Deduction Options')}}</label>
        <div class="inputS1">
            <select name="deduction_option">
                <option value="">{{ __('Select') }}</option>
                @foreach ($deduction_options as $option)
                    <option value="{{ $option->id }}"
                        {{ isset($saturationdeduction) ? ($saturationdeduction->deduction_option == $option->id ? 'selected' : '') : '' }}>
                        {{ $option['name' . $lang] }}</option>
                @endforeach
            </select>
        </div>
        @include('new-theme.components.error1',['error' => 'deduction_option'])
    </div>

    <div class="col-lg-6">
        <label for="title" class="form-label">{{__('Title')}}</label>
        <div class="inputS1">
            <input type="text" name="title" value="{{ isset($saturationdeduction) ? $saturationdeduction->title : '' }}"  placeholder='{{__('Title')}}'>
        </div>
        @include('new-theme.components.error1',['error' => 'title'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="text" name="date"
                value="{{ isset($saturationdeduction) ? \Carbon\Carbon::parse($saturationdeduction->date)->format('d/m/Y') : '' }}"
                placeholder="{{ __('Date') }}" name="date"  class="datePickerBasic"
                autocomplete="off"/>
        </div>
        @include('new-theme.components.error1',['error' => 'date'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{__('Amount')}}</label>
        <div class="inputS1 noHeight">
            <input type="number" id="amount" name="amount" value="{{ isset($saturationdeduction) ? $saturationdeduction->amount : '' }}" placeholder="{{__('Amount')}}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'amount'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{__("Deduction Percent")}}</label>
        <div class="inputS1 noHeight">
            <input type="number" name="percent" id="percent"  onkeyup="calculateOvertimeRate('{{isset($saturationdeduction) ? $saturationdeduction->employee_id : (isset($employee) ? $employee->id : '')}}')" value="{{ isset($saturationdeduction) ? $saturationdeduction->percent : '' }}" placeholder="{{__('Deduction Percent')}}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'percent'])
    </div>
</div>

@push('script')
    <script>
        function calculateDeductionPercent(emp_id) {
            $.ajax({
                url : '{{route('saturationdeductions.calculate_deduction_percent')}}',
                type: 'POST',
                data: {
                    "_token"      : "{{ csrf_token() }}",
                    "employee_id" : emp_id,
                    "percent"     : $('#percent').val(),
                },
                success: function (data) {
                    $('#amount').val(data);
                }
            });
        }
    </script>
@endpush
