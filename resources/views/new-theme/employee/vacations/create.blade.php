@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
@endpush
@section('content')
    <div class="employees">
        <div class="addVacation">
            <div class="pageS1">
                <a href='{{ route("vacations.index") }}'>
                    <div class='heading mb-4'>
                        <div class='flex align gap-15'>
                            <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                            <h3>{{ __('Add Vacation') }}</h3>
                        </div>
                    </div>
                </a>
                <form class="formS1 inputsS1" action="{{ route('vacations.store') }}" method="post">
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
                                                <option value="{{ $employee->id }}" {{ old('employee_id',null) == $employee->id ?  'selected' : '' }}>
                                                    {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>                                
                                    </div>
                                    @include('new-theme.components.error1',['error'  => 'employee_id'])
                                </div>

                                <div class="col-lg-6">
                                    <label for="name" class="form-label">{{ __('Replacement Employee') }}</label>
                                    <div class="inputS1">
                                        <select name="replacement_employee_id" required>
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" {{ old('replacement_employee_id',null) == $employee->id ?  'selected' : '' }}>
                                                    {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>                            
                                    </div>
                                    @include('new-theme.components.error1',['error'  => 'replacement_employee_id'])
                                </div>


                                <div class="col-lg-6">
                                    <label for="name" class="form-label">{{ __('Leave Type') }}</label>
                                    <div class="inputS1">
                                        <select name="leave_type_id">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($leave_type->childs as $child)
                                                <option value="{{ $child->id }}"  {{ old('leave_type_id',null) == $child->id ?  'selected' : '' }}>
                                                    {{ app()->isLocale('en') ? $child->title : $child->title_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('new-theme.components.error1',['error'  => 'leave_type_id'])
                                </div>

                                <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('Applied On') }}</label>
                                    <div class="inputS1 noHeight">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        <input name="applied_on" type="text" value="{{ old('applied_on') }}"
                                            placeholder="{{ __('Enter Date') }}" name="datepicker" class="datePickerBasic"
                                            autocomplete="off" />
                                    </div>
                                    @include('new-theme.components.error1',['error'  => 'applied_on'])
                                </div>


                                <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('Date') }}</label>
                                    <div class="inputS1 noHeight">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        <input name="start_date" type="text" value="{{ old('start_date') }}"
                                            placeholder="{{ __('Enter Date') }}" name="datepicker" class="datePickerRange"
                                            autocomplete="off" />                               
                                    </div>
                                    @include('new-theme.components.error1',['error'  => 'start_date'])
                                </div>
                                {{-- <div class="col-lg-6">
                                    <label for="datepicker" class="form-label">{{ __('To') }}</label>
                                    <div class="inputS1 noHeight">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        <input name="end_date" type="text" value=""
                                            placeholder="{{ __('Enter Date') }}" name="datepicker" class="datePickerBasic"
                                            autocomplete="off" />
                                        @error('end_date')
                                            <label>{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-6">
                                    <label for="code" class="form-label">{{ __('Note') }}</label>
                                    <div class="inputS1">
                                        <input name="leave_reason" type="text" id="leave_reason"
                                            placeholder="{{ __('Note') }}" value="{{ old('leave_reason') }}">
                                    </div>                                 
                                    @include('new-theme.components.error1',['error'  => 'leave_reason'])
                                </div>
                                {{-- <div class="col-lg-6">
                                    <label for="status" class="form-label">{{ __('Status') }}</label>
                                    <div class="inputS1">
                                        <select>
                                            <option value="">rejected</option>
                                        </select>
                                    </div>
                                    @error('leave_reason')
                                        <label>{{ $message }}</label>
                                    @enderror
                                </div> --}}

                            </div>
                        </div>

                    </div>

                    <div class="flex align end gap-15 orders ">
                        <a class='buttonS1 rejected' href="{{ route('vacations.index') }}">
                            {{ __('Cancel') }}
                        </a>
                        <button class='buttonS1 primary' data-bs-toggle="offcanvas" data-bs-target="#id" aria-controls="id">
                            {{ __('Save') }}
                        </button>
                    </div>

                </form>
            </div>



        </div>
    </div>
    </div>
@endsection
