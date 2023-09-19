@extends('new-theme.layout.layout2')

@push('styles')
<link rel="stylesheet" href="{{ asset('new-theme/styles/meetingsAndEvents.css') }}" />
@endpush


@section('content')
<div class="addJobofferPage">
    <div class="pageS1">

        <a href='/meetings/events/index'>
            <div class='heading mb-4'>
                <div class='flex align gap-15'>
                    <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                    <h3>{{ __('add New Event') }}</h3>
                </div>
            </div>
        </a>

        <form class="formS1 inputsS1" action="{{ route('event.store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class='sectionS2'>
                <div class='content p-4'>

                    <div class="row">
                        <div class="col-lg-12">
                            {{Form::label('title',__('Event Title'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                {{Form::text('title',null,array('class'=>'','placeholder'=>__('Enter Event Title')))}}
                            </div>
                            @include('new-theme.components.error1',['error' => 'title'])
                        </div>

                        <div class="col-lg-6">
                            {{Form::label('employees',__('Employees'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                <select>
                                    <option value="">omar ahmed</option>
                                </select>
                            </div>
                            @include('new-theme.components.error1',['error' => 'employees'])
                        </div>

                        <div class="col-lg-6">
                            {{Form::label('end_date',__('Date'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                <img src="/new-theme/icons/date.svg" class="iconImg" />
                                {{ Form::text('end_date', null, ['autocomplete' => 'off', 'class' => 'datePickerRange',
                                'placeholder' => __('Enter Event Date')]) }}
                            </div>
                            @include('new-theme.components.error1',['error' => 'end_date'])
                        </div>

                        <div class="col-lg-6">
                            {{Form::label('start_time',__('Start Event Time'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                <img src="/new-theme/icons/clock.svg" class="iconImg" />
                                {{ Form::text('start_time', '09:00 am', ['readonly' => 'readonly', 'class' =>
                                'time-pickable']) }}
                            </div>
                            @include('new-theme.components.error1',['error' => 'start_time'])
                        </div>

                        <div class="col-lg-6">
                            {{Form::label('end_time',__('End Event Time'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                <img src="/new-theme/icons/clock.svg" class="iconImg" />
                                {{ Form::text('end_time', '09:00 am', ['readonly' => 'readonly', 'class' =>
                                'time-pickable']) }}
                            </div>
                            @include('new-theme.components.error1',['error' => 'end_time'])
                        </div>

                        <div class="col-lg-6">
                            {{Form::label('lectures',__('The Lectures'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                {{Form::text('lectures',null,array('class'=>'','placeholder'=>__('Enter Lectures')))}}
                            </div>
                            @include('new-theme.components.error1',['error' => 'lectures'])
                        </div>
                        <div class="col-lg-6">
                            {{Form::label('Location',__('Location'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                {{Form::text('location',null,array('class'=>'','placeholder'=>__('Enter Location')))}}
                            </div>
                            @include('new-theme.components.error1',['error' => 'Location'])
                        </div>
                        <div class="col-lg-6">
                            <label for="">{{ __('Event photo') }}</label>
                            <div class="uploadFileBoxS2" style="height: 180px">
                                    <div class="uploadFileBoxContent">
                                        <div class="title" id="fileName">{{ __('Upload Your File') }}</div>
                                        <div class="des">
                                            {{ __('Browse and choose the files you want to upload') }}
                                            
                                        </div>
                                        <div class="uploadInput">
                                            <img src="/new-theme/icons/uploadS1.svg" alt="" />
                                            <input type="file" name="photo" onchange="getFileData(this);" />
                                        </div>
                                        <div class="fileSize" id="fileSize">{{ __('Max file size: 28mb') }}</div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            {{Form::label('about',__('About'),['class' => 'form-label'])}}
                            <div class="inputS1">
                                {{Form::textarea('about',null,array('class'=>'','placeholder'=>__('Enter About Event') ,'style'=>'height:180px'   ))}}
                            </div>
                            @include('new-theme.components.error1',['error' => 'about'])
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex align end gap-15 orders ">
                <a href="{{ route('event.index') }}">
                    <button class='buttonS1 rejected' type="button">
                        {{ __('Cancel') }}
                    </button>
                </a>
                <button class='buttonS1 primary' type="submit">
                    {{ __('save') }}
                </button>
            </div>

        </form>
    </div>



</div>
@endsection