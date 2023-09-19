@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/meetingsAndEvents.css') }}" />
@endpush


@section('content')
    <div class="addJobofferPage">
        <div class="pageS1">

            <a href='/meetings/index'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('new_theme.Add new Meeting') }}</h3>
                    </div>
                </div>
            </a>

            {{ Form::open(['url' => 'meeting', 'method' => 'post', 'class' => 'formS1 inputsS1']) }}

            <div class='sectionS2'>
                <div class='content p-4'>

                    <div class="row">

                        {{-- @if (auth()->user()->type != 'employee') 
                            <div class="col-lg-6">
                                <label for="branch_id" class="form-label"> {{ __('new_theme.Branches') }} </label>
                                <div class="inputS1">
                                    <select class="" name="branch_id" id="branch_id"
                                        placeholder="{{ __('new_theme.Branches') }}" >
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}"> {{ $branch->translated_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1',['error'  => 'branch_id'])
                            </div>
                            @endif --}}
                        <div class="col-lg-6">
                            {{ Form::label('title', __('new_theme.Meeting Name'), ['class' => 'form-label']) }}
                            <div class="sectionInput">
                                <div class="inputS1">
                                    {{ Form::text('title', null, ['class' => '', 'placeholder' => __('new_theme.Enter', ['val' => __('new_theme.Meeting Name')])]) }}
                                </div>
                                @include('new-theme.components.error1', ['error' => 'title'])
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="datepicker" class="form-label">{{ __('new_theme.Date') }}</label>
                            <div class="sectionInput">
                                <div class="inputS1 noHeight">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    {{ Form::text('date', null, ['autocomplete' => 'off', 'class' => 'datePickerBasic', 'placeholder' => __('new_theme.Enter', ['val' => __('new_theme.Date')])]) }}
                                </div>
                                @include('new-theme.components.error1', ['error' => 'date'])
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label for="time" class="form-label">{{ __('new_theme.Time') }}</label>
                            <div class="sectionInput">
                                <div class="inputS1 noHeight">
                                    <img src="/new-theme/icons/clock.svg" class="iconImg" />
                                    {{ Form::text('time', '09:00 am', ['readonly' => 'readonly', 'class' => 'time-pickable']) }}
                                </div>
                                @include('new-theme.components.error1', ['error' => 'time'])
                            </div>
                        </div>

                        <div class="col-lg-6">
                            {{ Form::label('duration', __('new_theme.Duration'), ['class' => 'form-label']) }}
                            <div class="sectionInput">
                                <div class="inputS1">
                                    {{ Form::text('duration', null, ['class' => '', 'placeholder' => __('new_theme.Enter', ['val' => __('new_theme.Duration')])]) }}
                                </div>
                                @include('new-theme.components.error1', ['error' => 'duration'])
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="employee_id" class="form-label"> {{ __('new_theme.Employees') }} </label>
                            <div class="sectionInput">
                                <div class="inputS1  multipleSelect removeSearch">
                                    <select class="" name="employee_id[]" id="selectEmployees"
                                        placeholder="{{ __('new_theme.Employees') }}" multiple>
                                        @foreach ($employees as $id => $employee_name)
                                            <option value="{{ $id }}"> {{ $employee_name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'employee_id'])
                            </div>
                        </div>
                        <div class="col-lg-6">
                            {{ Form::label('location', __('new_theme.location'), ['class' => 'form-label']) }}
                            <div class="sectionInput">
                                <div class="inputS1">
                                    {{ Form::text('location', null, ['class' => '', 'placeholder' => __('new_theme.Enter', ['val' => __('new_theme.location')])]) }}
                                </div>
                                @include('new-theme.components.error1', ['error' => 'location'])
                            </div>
                        </div>
                        <div class="col-lg-12">
                            {{ Form::label('note', __('new_theme.Note'), ['class' => 'form-label']) }}
                            <div class="sectionInput">
                                <div class="inputS1">
                                    {{ Form::textarea('note', null, ['class' => '', 'placeholder' => __('new_theme.Enter', ['val' => __('new_theme.Note')])]) }}
                                </div>
                                @include('new-theme.components.error1', ['error' => 'note'])
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex align end gap-15">
                <a href="{{ route('meeting.index') }}" class='buttonS1 rejected'>
                    {{ __('new_theme.Cancel') }}
                </a>
                <button class='buttonS1 primary' type="submit">
                    {{ __('new_theme.Save') }}
                </button>
            </div>

            </form>
        </div>



    </div>
@endsection

@push('script')
    <script>
        $('#selectEmployees').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>
@endpush
