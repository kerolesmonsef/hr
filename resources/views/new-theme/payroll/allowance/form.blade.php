<div class="row">
    <div class="col-lg-6">
        <label for="name" class="form-label">{{ __('Allowance Option') }}</label>
        <div class="inputS1">
            <select name="allowance_option" >
                <option value="">{{ __('Select') }}</option>
                @foreach ($allowance_options as $option)
                    <option value="{{ $option->id }}"
                        {{ isset($allowance) ? ($allowance->allowance_option == $option->id ? 'selected' : '') : '' }}>
                        {{ $option['name' . $lang] }}</option>
                @endforeach
            </select>
        </div>
        @include('new-theme.components.error1',['error' => 'allowance_option'])
    </div>

    <div class="col-lg-6">
        <label for="Title" class="form-label">{{ __('Title') }}</label>
        <div class="inputS1">
            <input type="text" name="title" value="{{ isset($allowance) ? $allowance->title : '' }}"
             placeholder='{{ __('Title') }}'>
        </div>
        @include('new-theme.components.error1',['error' => 'title'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Date') }}</label>
        <div class="inputS1 noHeight">
            <img src="/new-theme/icons/date.svg" class="iconImg" />
            <input type="text" name="date"
                value="{{ isset($allowance) ? \Carbon\Carbon::parse($allowance->date)->format('d/m/Y') : '' }}"
                 placeholder="{{ __('Date') }}" name="date" class="datePickerBasic"
                autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'date'])
    </div>

    <div class="col-lg-6">
        <label for="datepicker" class="form-label">{{ __('Amount') }}</label>
        <div class="inputS1 noHeight">
            <input type="number" name="amount" value="{{ isset($allowance) ? $allowance->amount : '' }}"
                placeholder="{{ __('Amount') }}" autocomplete="off" />
        </div>
        @include('new-theme.components.error1',['error' => 'amount'])
    </div>

</div>
