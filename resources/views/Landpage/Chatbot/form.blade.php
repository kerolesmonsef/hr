@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        {{--  @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif  --}}

        <form method="POST" action="{{ $case == 'update' ? route('landpage.landchatbot.update', ['id' => $row->id]) : route('landpage.landchatbot.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="question" class="required form-label">{{ __('landpage.English question') }}</label>
                        <input name="question" value="{{ $case == 'update' ? $row->question : old('question') }}" id="titleEn" type="text" class="form-control"  />
                        @error('question')
                            <label for="question" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="question_ar" class="required form-label">{{ __('landpage.Arabic question') }}</label>
                        <input name="question_ar" value="{{ $case == 'update' ? $row->question_ar : old('question_ar') }}" id="question_ar" type="text" class="form-control"  />
                        @error('question_ar')
                            <label for="question_ar" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12" >
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="answer" class="form-label">{{ __('landpage.English answer') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="answer" class="form-control" >{{ $case == 'update' ? $row->answer : old('answer') }}</textarea>
                        </div>
                        @error('answer')
                            <label for="answer" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>

                </div>
                <div class="col-md-12" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="answer_ar" class="form-label">{{ __('landpage.Arabic answer') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="answer_ar" class="form-control" >{{ $case == 'update' ? $row->answer_ar : old('answer_ar') }}</textarea>
                        </div>
                        @error('answer_ar')
                            <label for="answer_ar" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror

                    </div>
                </div>

            <div class="mb-10">
                <button style="float: right;" class="btn btn-primary btn-sm">{{ __('landpage.Save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
