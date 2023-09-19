@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
@endpush


@section('content')
    <div class="employees">
        <div class="addVacation">
            <div class="pageS1">

                <a href="{{ route('employee-permissions.index') }}">
                    <div class='heading mb-4'>
                        <div class='flex align gap-15'>
                            <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                            <h3>{{ __('Create') }}</h3>
                        </div>
                    </div>
                </a>

                <form class="formS1 inputsS1" action="{{ route('employee-permissions.store') }}" method="post">
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
                                                <option value="{{ $employee->id }}">
                                                    {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('new-theme.components.error1',['error' => 'employee_id'])
                                </div>
                                <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('Date') }}</label>
                                    <div class="inputS1 noHeight">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        <input name="date" type="date" value=""
                                            placeholder="{{ __('Enter Date') }}" name="datepicker" class="datePickerBasic"
                                            autocomplete="off" />
                                            
                                    </div>
                                     @include('new-theme.components.error1',['error' => 'date'])
                                </div>
                                <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('Time From') }}</label>
                                    <div class="inputS1">
                                        <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                        <input name="from" class="time-pickable" id="startTime" name="startTime"
                                            readonly>
                                    </div>
                                     @include('new-theme.components.error1',['error' => 'from'])
                                </div>
                                <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('Time To') }}</label>
                                    <div class="inputS1">
                                        <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                        <input name="to" class="time-pickable" id="startTime" name="startTime"
                                            readonly>
                                    </div>
                                     @include('new-theme.components.error1',['error' => 'to'])
                                </div>
                                <div class="col-lg-6">
                                    <label for="name" class="form-label">{{ __('status') }}</label>
                                    <div class="inputS1">
                                        <select name="status" required>
                                            <option value="" disabled>{{ __('Select') }}</option>
                                            <option value="approved">
                                                {{__("Accepted")}}
                                            </option>
                                            <option value="rejected">
                                                {{__("Rejected")}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="clockOut" class="form-label">{{ __('Reason') }}</label>
                                    <div class="inputS1">
                                        <input name="message" type="text" id="clockOut">
                                    </div>
                                     @include('new-theme.components.error1',['error' => 'message'])
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="flex align end gap-15">
                        <button class='buttonS1 rejected' type="button">
                            {{ __('Cancel') }}
                        </button>
                        <button class='buttonS1 primary'>
                            {{ __('Save') }}
                        </button>
                    </div>

                </form>
            </div>



        </div>
    </div>

    </div>
@endsection
