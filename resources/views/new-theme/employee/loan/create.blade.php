@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
@endpush

@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href="{{ route('loan-requests.index') }}">
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Create') }}</h3>
                    </div>
                </div>
            </a>

            <form action="{{ route('loan-requests.store') }}" method="post" class="formS1 inputsS1">
                @csrf
                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <div class="inputS1">
                                    <select name="employee_id" required>
                                        <option value="">{{ __('Select') }}</option>
                                        @foreach ($employees as $employee)
                                            <option {{ $employee->id == old('employee_id') ? 'selected' : '' }}
                                                value="{{ $employee->id }}">
                                                {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'emlpoyee_id'])
                            </div>
                            <div class="col-lg-6">
                                <label for="title" class="form-label">{{ __('Title') }}</label>
                                <div class="inputS1">
                                    <input name="title" type="text" value="{{ old('title') }}" placeholder="" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'title'])
                            </div>
                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{ __('Loan Options') }}</label>
                                <div class="inputS1">
                                    <select name="loan_option" required>
                                        <option value="">{{ __('Select') }}</option>
                                        @foreach ($loan_options as $loan_option)
                                            <option {{ $loan_option->id == old('loan_option') ? 'selected' : '' }}
                                                value="{{ $loan_option->id }}">
                                                {{ app()->isLocale('en') ? $loan_option->name : $loan_option->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'loan_option'])
                            </div>
                            <div class="col-lg-6">
                                <div class="name mb-3">{{ __('Amount') }}</div>
                                <div class="inputS1">
                                    <input name="amount" type="number" value="{{ old('amount') }}" placeholder="" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'amount'])
                            </div>
                            <div class="col-lg-6">
                                <div class="name mb-3">{{ __('Start Date') }}</div>
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    <input type="text" value="{{ old('month_nubmer') }}"
                                        placeholder="{{ __('Set The Time') }}" name="start_date" class="datePickerBasic"
                                        autocomplete="off" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'start_date'])
                            </div>
                            <div class="col-lg-6">
                                <div class="name mb-3">{{ __('Month Number') }}</div>
                                <div class="inputS1">
                                    <input name="month_nubmer" type="number" value="{{ old('month_nubmer') }}"
                                        placeholder="" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'month_number'])
                            </div>
                            <div class="col-lg-6">
                                <div class="name mb-3">{{ __('Reason') }}</div>
                                <div class="inputS1">
                                    <input name="reason" type="text" value="{{ old('reason') }}" placeholder="" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'reason'])
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex align end gap-15 orders ">
                    <a href="{{ route('loan-requests.index') }}" class="buttonS1 rejected" type="button"
                        data-bs-dismiss="offcanvas" aria-label="Close">
                        {{ __('Cancel') }}
                    </a>
                    <button class="buttonS1 primary" type="submit">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>



    </div>
    </div>
@endsection
