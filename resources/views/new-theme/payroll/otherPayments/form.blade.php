<div class="row">

    <div class="col-lg-6">
        <label for="Title" class="form-label">{{ __('Title') }}</label>
        <div class="inputS1">
            <input type="text" name="title" value="{{ isset($otherpayment) ? $otherpayment->title : '' }}"
                placeholder='{{ __('Title') }}'>
        </div>
        @include('new-theme.components.error1',['error' => 'title'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="text" name="date"
                value="{{ isset($otherpayment) ? \Carbon\Carbon::parse($otherpayment->date)->format('d/m/Y') : '' }}"
                 placeholder="{{ __('Date') }}" name="date" class="datePickerBasic"
                autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'date'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Amount') }}</label>
        <div class="inputS1 noHeight">
            <input type="number" name="amount" value="{{ isset($otherpayment) ? $otherpayment->amount : '' }}"
                placeholder="{{ __('Amount') }}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'amount'])
    </div>

</div>