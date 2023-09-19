<div class="row">
    
    <div class="col-lg-6">
        <label for="title" class="form-label">{{__('Title')}}</label>
        <div class="inputS1">
            <input type="text" name="title" value="{{isset($overtime )? $overtime->title : ''}}" placeholder='{{__('Title')}}'>
        </div>
        @include('new-theme.components.error1',['error' => 'title'])
    </div>

    <div id="date_section" class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="text"  name="date" value="{{ isset($overtime) ? \Carbon\Carbon::parse($overtime->date)->format('d/m/Y') : '' }}" class="datePickerBasic" placeholder="{{__('Date')}}"  autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'date'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{__('Hours')}}</label>
        <div class="inputS1 noHeight">
            <input type="number" id="hours" name="hours" onkeyup="calculateOvertimeRate('{{isset($overtime )? $overtime->employee_id : $employee->id}}')" value="{{isset($overtime )? $overtime->hours : ''}}" placeholder="{{__('Hours')}}"
                autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'hours'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{__('Rate')}}</label>
        <div class="inputS1 noHeight">
            <input type="number" id="rate" name="rate" value="{{isset($overtime )? $overtime->rate : ''}}" placeholder="{{__('Rate')}}"
                autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'rate'])
    </div>

</div>

@push('script')
    <script>
        function calculateOvertimeRate(emp_id) {
            $.ajax({
                url : '{{route('overtimes.calculateOvertime')}}',
                type: 'POST',
                data: {
                    "_token"      : "{{ csrf_token() }}",
                    "employee_id" : emp_id,
                    "hours"       : $('#hours').val(),
                },
                success: function (data) {
                    $('#rate').val(data);
                }
            });
        }
    </script>
@endpush
