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
                        <h3>Add New Folder </h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="" method="post">

                <div class='sectionS2'>
                    <div class='content p-4'>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="folderName" class="form-label">Folder Name</label>
                                <div class="inputS1">
                                    <input type="text" value="" id="folderName" placeholder="Enter Folder Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="date" class="form-label">Date</label>
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    <input type="text" vlaue="001/02/2023" placeholder="Set The Type" autocomplete="off"
                                        name="daterange" class="datePickerBasic">
                                </div>
                            </div>
                            <div>
                                <label for="companyName" class="form-label">Company Logo</label>
                                <div class="uploadFileBox" id="addFolderId">
                                    <div class="uploadFileBoxContent flex align gap-3">
                                        <div class="uploadInput">
                                            <img src="/new-theme/icons/upload.svg" alt="" />
                                            <input type="file" onchange="onUploadFilePreviewCard(this,'addFolderId');" />
                                        </div>
                                        <div class="title">Upload File</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex align end gap-15 orders ">
                    <button class='buttonS1 rejected'>
                        Cancel
                    </button>
                    <button class='buttonS1 primary' type="submit">
                        Save
                    </button>
                </div>

            </form>
        </div>



    </div>
@endsection
