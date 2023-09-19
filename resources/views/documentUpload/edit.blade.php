    {{Form::model($ducumentUpload,array('route' => array('document-upload.update', $ducumentUpload->id), 'method' => 'PUT','enctype' => "multipart/form-data")) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <select class="form-control" name="document_id" id="document_id" placeholder="{{ __('Select document type') }}">
                    <option value="">{{__('Select document type')}}</option>
                    @foreach($documents as $document)
                        <option value="{{ $document->id }}" {{ $document->id == $ducumentUpload->document_id ? 'selected' : '' }}>{{ $document->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <select class="form-control" name="employee_id" id="employee_id" placeholder="{{ __('Select employee') }}">
                    <option value="">{{__('Select employee')}}</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == $ducumentUpload->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('exp_date',__('Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('exp_date',$ducumentUpload->exp_date,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('document',__('Document'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                <div class="choose-file form-group">
                    <label for="document" class="form-control-label">
                        <div>{{__('Choose file here')}}</div>
                        <input type="file" class="form-control" name="document[]" multiple id="document" data-filename="document_update">
                    </label>
                    <p class="document_update"></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-6">
            <div class="form-group">
                {{Form::label('role',__('Role'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('role',$roles,null,array('class'=>'form-control'))}}
            </div>
        </div>
        <div class="row">
            @foreach ($ducumentUpload->ducumentuploadimages as $ducumentuploadimage )
            <div class="col-3">
                <div>
                    <div>
                        <a target="_blank" href="{{url('storage/uploads/documentUpload/'.$ducumentuploadimage->image)  }}"><img style="width:100%;" src="{{url('storage/uploads/documentUpload/'.$ducumentuploadimage->image)  }}" /></a>
                    </div>
                    <a href="{{url('storage/uploads/documentUpload/'.$ducumentuploadimage->image)  }}" class=""  class="btn btn-icon btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Download')}}"><i class="fa fa-download"></i></a>
                    <a href="#" class="ducument-upload-image-delete" data-url="{{ route('document-upload-image.delete' , [$ducumentuploadimage->id]) }}" class="btn btn-icon btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description', __('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                {{ Form::textarea('description',null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}



