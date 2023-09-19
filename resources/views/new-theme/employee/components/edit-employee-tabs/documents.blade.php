<div class="tab-pane show active" id="documents" role="tabpanel" aria-labelledby="documents-tab">
    <form class="formS1" method="post" enctype="multipart/form-data" action="{{ route('employee.updateDocuments', $employee) }}">
        @method('put')
        @csrf

        @foreach ($documentTypes as $key => $type)
        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{$type['name'.$lang]}}</h3>
            </div>


            <div class="content">
                <div class="row">
                    @foreach($type->documents as $document)
                        @if($document->employeeDocument)
                            <div class="col-12 col-lg-6">
                                <label>{{$document['name'.$lang]}}</label>
                                <div class="filePreviewCard flex align mb-4" style="width: 100%">
                                    <div class="filePreview" style="width: 100%">
                                        <div class="icon">
                                            <img src="/new-theme/icons/folder.svg" alt="" />
                                        </div>
                                        <div class="info flex align between">
                                            <div>
                                                <h4>file attachment</h4>
                                                <p>127.15Kb</p>
                                            </div>
                                            <div class="flex align gap-3">
                                                <img src="{{ asset('new-theme/icons/view.svg') }}" class="iconImg" />
                                                <img src="{{ asset('new-theme/icons/delete.svg') }}" class="iconImg" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-lg-6">
                                <label>{{$document['name'.$lang]}}</label>
                                <div class="uploadFileBox" id="uploadFileBox{{$document->id}}">
                                    <div class="uploadFileBoxContent flex align gap-3">
                                        <div class="uploadInput">
                                            <img src="/new-theme/icons/upload.svg" alt="" />
                                            <input type="file" name="files['{{str_replace(" ","_",$document->name)}}']" onchange="onUploadFilePreviewCard(this,'uploadFileBox{{$document->id}}','{{__('Upload File')}}');" />
                                        </div>
                                        <div class="title">{{__('Upload File')}}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
        @endforeach
        

        <div class="flex align end gap-15 mt-5 mb-4">
            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                {{__('Cancel')}}
            </button>
            <button class="buttonS1 primary" type="submit">
                {{__('Save')}}
            </button>
        </div>
    </form>

</div>

