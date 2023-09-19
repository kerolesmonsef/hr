@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ url('new-theme/styles/tasks.css') }}" />
@endpush

@section('content')
    <div class="addTaskPage">
        <div class="pageS1">

            <a href='/tasks'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3> {{ __('Add new Task') }} </h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="{{ route('tasks.store', ['view' => request('view')]) }}" method="post">
                @csrf
                <div class='sectionS2'>
                    <div class='content p-4'>

                        <div class="row">
                            <div class="col-lg-6">
                                {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                                <div class="sectionInput">
                                    <div class="inputS1">
                                        {{ Form::text('name', null, ['class' => '', 'placeholder' => __('Enter Task Name')]) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'name'])
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{ Form::label('label', __('Label'), ['class' => 'form-label']) }}
                                <div class="sectionInput">
                                    <div class="inputS1">
                                        {{ Form::text('label', null, ['class' => '', 'placeholder' => __('Enter Label')]) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'label'])
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                <div class="sectionInput">
                                    <div class="inputS1">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        {{ Form::text('start_date', null, ['class' => 'datePickerBasic', 'placeholder' => __('Start Date')]) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'start_date'])
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{ Form::label('due_date', __('Due Date'), ['class' => 'form-label']) }}
                                <div class="sectionInput">
                                    <div class="inputS1">
                                        <img src="/new-theme/icons/date.svg" class="iconImg" />
                                        {{ Form::text('due_date', null, ['class' => 'datePickerBasic', 'placeholder' => __('Due Date')]) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'due_date'])
                                </div>
                            </div>

                            <div class="col-lg-6">
                                {{ Form::label('label', __('Members'), ['class' => 'form-label']) }}
                                <div class="sectionInput">
                                    <div class="inputS1">
                                        {{ Form::select('employees[]', $employees, null, ['multiple', 'class' => 'select2']) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'employees'])
                                </div>
                            </div>

                            <div class="col-lg-6">
                                {{ Form::label('label', __('Status'), ['class' => 'form-label']) }}
                                <div class="sectionInput">
                                    <div class="inputS1">
                                        <select name="status">
                                            @foreach (\App\Models\Task::getStatuses() as $status)
                                                <option value="{{ $status }}">{{ __('task_status_' . $status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'status'])
                            </div>


                            <div class="col-lg-6">
                                {{ Form::label('label', __('Note'), ['class' => 'form-label']) }}
                                <div class="sectionInput">
                                    <div class="inputS1">
                                        {{ Form::text('note', null, ['class' => '', 'placeholder' => __('Note')]) }}
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'note'])
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="flex align end gap-15">
                    <a href="{{ route('tasks.index') }}">
                        <button class='buttonS1 rejected' type="button">
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
