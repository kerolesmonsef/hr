@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ url('new-theme/styles/news.css') }}" />
@endpush

@section('content')
    <div class="addNewsPage">
        <div class="pageS1">

            <a href='{{ route('news.index') }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>@lang("Add new News")</h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="{{ route("news.store") }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="Title" class="form-label">@lang("Title")</label>
                                @include("new-theme.components.error1",['error'=>'title'])
                                <div class="inputS1">
                                    <input name="title" value="{{ old('title') }}" type="text" id="Title" placeholder='@lang("Enter News Title")'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="dateAndTime" class="form-label">@lang("Date")</label>
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    <input type="text" value="{{ old('date', front_date(now())) }}" name="date"
                                           class="datePickerRange" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label for="description" class="form-label">@lang("Description")</label>
                                @include("new-theme.components.error1",['error'=>'description'])
                                <div class="inputS1">
                                    <textarea name="description" placeholder="@lang("Enter Description")" class="scroll" style="height: 150px">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="logo" class="form-label">@lang("Logo")</label>
                                @include("new-theme.components.error1",['error'=>'logo'])
                                <div class="uploadFileBox" id="logoImage">
                                    <div class="uploadFileBoxContent">
                                        <div class="title" id="logo">@lang("Upload Your File")</div>
                                        <div class="des">
                                            @lang("Browse and choose the files you want to upload")
                                        </div>
                                        <div class="uploadInput">
                                            <img src="/new-theme/icons/uploadS1.svg" alt="" />
                                            <input name="logo" type="file" />
                                        </div>
                                        <div class="fileSize" id="fileSize">@lang("Max file size:") 2MB</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="logo" class="form-label">@lang("News photo")</label>
                                @include("new-theme.components.error1",['error'=>'photo'])
                                <div class="uploadFileBox" id="coverPhoto">
                                    <div class="uploadFileBoxContent">
                                        <div class="title" id="newsPhoto">@lang("Upload Your File")</div>
                                        <div class="des">
                                            @lang("Browse and choose the files you want to upload")
                                        </div>
                                        <div class="uploadInput">
                                            <img src="/new-theme/icons/uploadS1.svg" alt="" />
                                            <input name="photo" type="file" />
                                        </div>
                                        <div class="fileSize" id="fileSize">@lang("Max file size:") 2MB</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex align end gap-15">
                    <a href="{{ route('news.index')  }}" class='buttonS1 rejected' type="button">
                        {{  __('Cancel') }}
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        {{__('Save')}}
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
@push('script')
@endpush
