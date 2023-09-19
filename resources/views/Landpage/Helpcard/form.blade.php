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

        <form method="POST" action="{{ $case == 'update' ? route('landpage.landhelpcard.update', ['id' => $row->id]) : route('landpage.landhelpcard.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="titleAr" class="required form-label">{{ __('landpage.Arabic title') }}</label>
                        <input name="titleAr" value="{{ $case == 'update' ? $row->titleAr : old('titleAr') }}" id="titleAr" type="text" class="form-control" placeholder="Enter blog title in arabic" />
                        @error('titleAr')
                            <label for="titleAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="titleEn" class="required form-label">{{ __('landpage.English title') }}</label>
                        <input name="titleEn" value="{{ $case == 'update' ? $row->titleEn : old('titleEn') }}" id="titleEn" type="text" class="form-control" placeholder="Enter blog title in english" />
                        @error('titleEn')
                            <label for="titleEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
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
                <div class="col-md-11">
                    <div class="mb-10">
                        <label for="image" class="required form-label">{{ __('landpage.Icon') }}</label>
                        <input name="image"  id="image"
                            type="file" class="form-control"  />
                        @error('image')
                            <label for="image" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
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
