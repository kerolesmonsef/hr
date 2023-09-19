<div class="row">

    <div class="col-lg-6">
        <label for="name" class="form-label">{{ __('commission Type') }}</label>
        <div class="inputS1">
            <select name="type" id="commission_type">
                <option value="$" {{ isset($commission) ? ($commission->type == '$' ? 'selected' : '') : '' }}>{{__('budget')}}</option>
                <option value="%" {{ isset($commission) ? ($commission->type == '%' ? 'selected' : '') : '' }}>{{__('percentage')}}</option>
            </select>
        </div>
        @include('new-theme.components.error1',['error' => 'type'])
    </div>

    <div class="col-lg-6">
        <label for="code" class="form-label">{{ __('Title') }}</label>
        <div class="inputS1">
            <input type="text" name="title" value="{{ isset($commission) ? $commission->title : '' }}"
                id="code" placeholder='{{ __('Title') }}'>
        </div>
        @include('new-theme.components.error1',['error' => 'title'])
    </div>

    <div id="date_section" class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="text"  name="date" value="{{ isset($commission) ? \Carbon\Carbon::parse($commission->date)->format('d/m/Y') : '' }}" class="datePickerBasic" placeholder="{{__('Date')}}"  autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'date'])
    </div>

</div>

@push('script')
    <script>
        function changeCommissionType() {
            var type = $('#commission_type').val();
            if(type == '%')
            {
                $('#amount_commission').remove();
                $('<div id="percentage_commission" class="col-md-6"><div class="row"><div class="col-lg-6"><label for="datepicker" class="form-label">{{ __('percentage') }}</label><div class="inputS1 noHeight"><input type="number" step="any" name="percentage" value="{{isset($commission) ? $commission->percentage  : ''}}"  placeholder="{{__('percentage')}}" autocomplete="off" /></div></div><div class="col-lg-6"><label for="datepicker" class="form-label">{{ __('Close Deal Amount') }}</label><div class="inputS1 noHeight"><input type="number" name="close_deal_amount" value="{{isset($commission) ? $commission->close_deal_amount  : ''}}"  placeholder="{{__('Close Deal Amount')}}" autocomplete="off" /></div></div></div></div>').insertAfter("#date_section")
            }else{
                $('#percentage_commission').remove();
                $('<div id="amount_commission" class="col-lg-6"><label for="datepicker" class="form-label">{{ __('Amount') }}</label><div class="inputS1 noHeight"><input type="number" name="amount" value="{{isset($commission) ? $commission->amount  : ''}}"  placeholder="{{__('Amount')}}" autocomplete="off" /></div></div>').insertAfter("#date_section");
            }
        }

        $('#commission_type' ).on('change',function(){
            changeCommissionType();
        });

        $(window).on('load',function(){
            changeCommissionType();
        });

    </script>
@endpush
