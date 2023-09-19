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

        <form method="POST" action="{{ $case == 'update' ? route('landpage.landsaycard.update', ['id' => $row->id]) : route('landpage.landsaycard.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="name" class="required form-label">{{ __('landpage.Name') }}</label>
                        <input name="name" value="{{ $case == 'update' ? $row->name : old('name') }}" id="name"
                            type="text" class="form-control"  />
                        @error('name')
                            <label for="name" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="created_at" class="required form-label">{{ __('landpage.Date') }}</label>
                        <input name="created_at" step="any" value="{{ $case == 'update' ? $row->created_at : old('created_at') }}" id="created_at"
                            type="datetime-local" class="form-control"  />
                        @error('created_at')
                            <label for="created_at" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="descriptionAr" class="form-label">{{ __('landpage.Arabic description') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="descriptionAr" class="form-control" >{{ $case == 'update' ? $row->descriptionAr : old('descriptionAr') }}</textarea>
                        </div>
                        @error('descriptionAr')
                            <label for="descriptionAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror

                    </div>
                </div>
                <div class="col-md-12" >
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="descriptionEn" class="form-label">{{ __('landpage.English description') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="descriptionEn" class="form-control" >{{ $case == 'update' ? $row->descriptionEn : old('descriptionEn') }}</textarea>
                        </div>
                        @error('descriptionEn')
                            <label for="descriptionEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
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
