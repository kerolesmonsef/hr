<div class="row">

    <div class="col-lg-6">
        <label for="name" class="form-label">{{__('Absence Type')}}</label>
        <div class="inputS1">
            <select name="type">
                <option value="">{{ __('Select') }}</option>
                <option value="A" @if(isset($Absence) && $Absence->type == 'A') selected @endif> {{__('Absence With Permission')}} </option>
                <option value="X" @if(isset($Absence) && $Absence->type == 'X') selected @endif> {{__('Absence Without Permission')}}</option>
            </select>
        </div>
        @include('new-theme.components.error1',['error' => 'type'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="text" name="start_date" value="{{ isset($Absence) ? \Carbon\Carbon::parse($Absence->start_date)->format('d/m/Y') : '' }}" required placeholder="{{ __('Date') }}" class="datePickerBasic" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'start_date'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{__('Number Of Days')}}</label>
        <div class="inputS1 noHeight">
            <input type="number" name="number_of_days" value="{{ isset($Absence) ? $Absence->number_of_days : '' }}" placeholder="{{__('Number Of Days')}}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'number_of_days'])
    </div>

</div>
