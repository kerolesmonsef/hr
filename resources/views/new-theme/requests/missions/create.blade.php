@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ url('new-theme/styles/requests.css') }}" />
@endpush
@section('content')
    <div class="addPayroll">
        <div class="pageS1">
            <a href='{{ route("work-from-home.index") }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Create') }}</h3>
                    </div>
                </div>
            </a>
            <form class="formS1 inputsS1" action="{{ route('mission.store') }}" method="post">
                @csrf
                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{ __('Employee Name') }}</label>
                                <div class="inputS1">
                                    <select name="employee_id">
                                        @foreach ($employees as $employee)
                                            <option
                                                    {{ $employee->id ==  old('employee_id') ? 'selected' : '' }}
                                                    value="{{ $employee->id }}">
                                                    {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('new-theme.components.error1',['error' => 'employee_id'])
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{ __('Status') }}</label>
                                <div class="inputS1">
                                    <select name="status">
                                        <option
                                            {{ old('employee_id') == 'pending' ? 'selected' : '' }}
                                            value="pending">
                                            {{  __('Pending') }}
                                        </option>
                                        <option
                                            {{ old('employee_id') == 'approved' ? 'selected' : '' }}
                                            value="approved">
                                            {{  __('Approved')}}
                                        </option>
                                        <option
                                            {{ old('employee_id') == 'rejected' ? 'selected' : '' }}
                                            value="rejected">
                                            {{ __('Rejected') }}
                                        </option>
                                    </select>
                                </div>
                                @include('new-theme.components.error1',['error' => 'status'])
                            </div>
                            <div class="col-lg-6">
                                <label for="date" class="form-label">{{ __('Date') }}</label>
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    <input value="{{ old('date', Carbon\Carbon::now()->format('d/m/Y')) }}" type="text" value="" name="date" id="date" placeholder="{{ __('Enter Date') }}"
                                        name="date" class="datePickerBasic" />
                                </div>
                                @include('new-theme.components.error1',['error' => 'date'])
                            </div>
                            <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('Start') }}</label>
                                    <div class="inputS1">
                                        <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                        <input name="start" class="time-pickable" id="startTime" name="start"
                                            readonly>
                                        </div>
                                     @include('new-theme.components.error1',['error' => 'start'])
                                </div>
                                <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('End') }}</label>
                                    <div class="inputS1">
                                        <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                        <input name="end" class="time-pickable" id="startTime" name="end"
                                            readonly>
                                        </div>
                                     @include('new-theme.components.error1',['error' => 'end'])
                                </div>
                            <div class="col-lg-6">
                                <label for="discountMonthly" class="form-label">{{ __('Reason')  }}</label>
                                <div class="inputS1">
                                    <input  type="text" name="reason" id="discountMonthly" placeholder="{{ __('Enter Reason') }}">
                                </div>
                                 @include('new-theme.components.error1',['error' => 'reason'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex align end gap-15">
                    <a href="{{ route('work-from-home.index') }}">
                        <button class='buttonS1 rejected'>
                            {{ __('Cancel') }}
                        </button>
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        {{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
@endpush
