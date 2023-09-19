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

        <form method="POST" action="{{ $case == 'update' ? route('landpage.blog.update', ['id' => $row->id]) : route('landpage.blog.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="titleEn" class="required form-label">{{ __('landpage.English title') }}</label>
                        <input name="titleEn" value="{{ $case == 'update' ? $row->titleEn : old('titleEn') }}" id="titleEn" type="text" class="form-control"  />
                        @error('titleEn')
                            <label for="titleEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="titleAr" class="required form-label">{{ __('landpage.Arabic title') }}</label>
                        <input name="titleAr" value="{{ $case == 'update' ? $row->titleAr : old('titleAr') }}" id="titleAr" type="text" class="form-control"  />
                        @error('titleAr')
                            <label for="titleAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
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


                <div class="col-md-1">
                    <label style="display: block;margin-bottom:9px;">{{ __('landpage.Icon') }}</label>
                    <a href="{{ $case == 'update' ?  url('storage/'.$row->image) :  'icon'    }}">
                        <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img src="{{ $case == 'update' ?  url('storage/'.$row->image) :  'icon'    }}" alt="icon">
                        </div>
                    </a>
                </div>
                <hr>
                <h3>{{ __('landpage.Seo section') }}</h3>
                <div class="col-md-6" >
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="metaTitleEn" class="form-label">{{ __('landpage.English meta title') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="metaTitleEn" class="form-control" >{{ $case == 'update' ? $row->metaTitleEn : old('metaTitleEn') }}</textarea>
                        </div>
                        @error('metaTitleEn')
                            <label for="metaTitleEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="metaTitleAr" class="form-label">{{ __('landpage.Arabic meta title') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="metaTitleAr" class="form-control" >{{ $case == 'update' ? $row->metaTitleAr : old('metaTitleAr') }}</textarea>
                        </div>
                        @error('metaTitleAr')
                            <label for="metaTitleAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6" >
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="metaDescriptionEn" class="form-label">{{ __('landpage.English meta description') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="metaDescriptionEn" class="form-control" >{{ $case == 'update' ? $row->metaDescriptionEn : old('metaDescriptionEn') }}</textarea>
                        </div>
                        @error('metaDescriptionEn')
                            <label for="metaDescriptionEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="metaDescriptionAr" class="form-label">{{ __('landpage.Arabic meta description') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="metaDescriptionAr" class="form-control" >{{ $case == 'update' ? $row->metaDescriptionAr : old('metaDescriptionAr') }}</textarea>
                        </div>
                        @error('metaDescriptionAr')
                            <label for="metaDescriptionAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6" >
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="metakeyEn" class="form-label">{{ __('landpage.English meta key words') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="metakeyEn" class="form-control" >{{ $case == 'update' ? $row->metakeyEn : old('metakeyEn') }}</textarea>
                        </div>
                        @error('metakeyEn')
                            <label for="metakeyEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="metakeyAr" class="form-label">{{ __('landpage.Arabic meta key words') }} </label>
                            <textarea style="resize:vertical" rows="10"  name="metakeyAr" class="form-control" >{{ $case == 'update' ? $row->metakeyAr : old('metakeyAr') }}</textarea>
                        </div>
                        @error('metakeyAr')
                            <label for="metakeyAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6" >
                    <div class="mb-10">
                        <label class="form-label">{{ __('landpage.English meta tag words') }}</label>
                        <input data-role="tagsinput" name="metaTagEn"  value="{{ $case == 'update' ? $row->metaTagEn : old('metaTagEn') }}" id="metaTagEn"  class="form-control" />
                    </div>
                    @error('metaTagEn')
                        <label for="metaTagEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-md-6" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <label class="form-label">{{ __('landpage.Arabic meta tag words') }}</label>
                        <input data-role="tagsinput" name="metaTagAr"  value="{{ $case == 'update' ? $row->metaTagAr : old('metaTagAr') }}" id="metaTagAr"  class="form-control" />
                    </div>
                    @error('metaTagAr')
                        <label for="metaTagAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                    @enderror
                </div>
            <div class="mb-10">
                <button style="float: right;" class="btn btn-primary btn-sm">{{ __('landpage.Save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
