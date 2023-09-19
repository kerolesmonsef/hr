@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/document-library.css') }}" />
@endpush


@section('content')
    <div class="addDocumentLibraryPage">
        <div class="pageS1">

            <a href='/document-ibrary/index'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Create') }}</h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="{{ route('library.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="folderName" class="form-label">{{ __('Name') }}</label>
                                <div class="inputS1">
                                    <input only="png" name ="name" type="text" value="{{ old('name') }}" id="folderName" placeholder="">
                                </div>
                                @include("new-theme.components.error1",['error' => "name"])
                            </div>
                            <div class="col-lg-6">
                                <label for="companyName" class="form-label">@lang("Upload File")</label>
                                <div class="uploadFileBox" id="addFolderId">
                                    <div class="uploadFileBoxContent flex align gap-3">
                                        <div class="uploadInput">
                                            <img src="/new-theme/icons/upload.svg" alt="" />

                                            <input type="file" name="documents[]"  />
                                        </div>
                                        <div class="title">@lang("Upload File")</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex align end gap-15">
                    <a href="{{ route('library.index') }}" class='buttonS1 rejected'>
                        {{ __('Cancel') }}
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>



    </div>
@endsection
