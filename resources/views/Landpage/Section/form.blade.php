@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('landpage.section.update' , ['id' => $row->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                @if(in_array($row->key , ['termSection','privacySection','homeSection','purposeSection','aboutSection','cloudSection','helpSection','planSection','saySection','blogSection','priceSection','demoSection','contactSection','getTouchSection','sliderSection']))
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="titleEn" class="required form-label">{{ __('landpage.English title') }}</label>
                        <input name="titleEn" value="{{ $case == 'update' ? $row->titleEn : old('titleEn') }}" id="titleEn"
                            type="text" class="form-control"  />
                        @error('titleEn')
                            <label for="titleEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <label for="titleAr" class="required form-label">{{ __('landpage.Arabic title') }}</label>
                        <input name="titleAr" value="{{ $case == 'update' ? $row->titleAr : old('titleEn') }}" id="titleAr"
                            type="text" class="form-control"  />
                        @error('titleAr')
                            <label for="titleAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                @endif

                @if(in_array($row->key , ['privacySection','termSection','getTouchSection','footerSection','homeSection','purposeSection','aboutSection','cloudSection','planSection','priceSection','demoSection','sliderSection']))
                <div class="col-md-12">
                    <div class="mb-10">
                        <div class="rounded  ">
                            <label for="descriptionEn" class="form-label">{{ __('landpage.English description') }} </label>
                            <textarea id="editor1" style="resize:vertical" rows="10" id="descriptionEn" name="descriptionEn" class="form-control" >{{ $case == 'update' ? $row->descriptionEn : old('descriptionEn') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="direction: rtl;text-align:right;">
                    <div class="mb-10">
                        <div class="rounded">
                            <label for="descriptionAr" class="form-label">{{ __('landpage.Arabic description') }} </label>
                            <textarea id="editor2" style="resize:vertical" rows="10"  name="descriptionAr" class="form-control" >{{ $case == 'update' ? $row->descriptionAr : old('descriptionAr') }}</textarea>
                        </div>
                    </div>
                </div>
                @endif


                @if(in_array($row->key , ['getTouchSection','homeSection','purposeSection','aboutSection','helpSection','demoSection']))
                <div class="col-md-11">
                    <div class="mb-10">
                        <label for="image" class="required form-label">{{ __('landpage.Image') }}</label>
                        <input name="image" value="{{ $case == 'update' ? $row->image : old('image') }}" id="image"
                            type="file" class="form-control"  />
                        @error('image')
                            <label for="navlogo" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>


                <div class="col-md-1">
                    <label style="display: block;margin-bottom:9px;">{{ __('landpage.Image') }}</label>
                    <a href="{{ url('storage/'.$row->image) }}">
                        <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img src="{{ url('storage/'.$row->image) }}" alt="user">
                        </div>
                    </a>
                </div>
                @endif


                @if(in_array($row->key , ['termSection','homeSection','aboutSection','blogSection','planSection','demoSection' ,'contactSection'] ))
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
                            <label for="metaTitleAr" class="form-label">{{ __('landpage.English meta title') }} </label>
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
                        <div class="rounded ">
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
                @endif
            </div>
            <div class="mb-10">
                <button style="float: right;" class="btn btn-primary btn-sm">{{ __('landpage.Save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
