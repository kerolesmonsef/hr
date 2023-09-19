    {{Form::open(array('url'=>'company-policy','method'=>'post', 'enctype' => "multipart/form-data"))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('branch',$branch,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('title',__('Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
         <div class="col-md-6">
            <div class="form-group">
                {{Form::label('title_ar',__('Title_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title_ar',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description', __('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{ Form::textarea('description',null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description_ar', __('Description_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{ Form::textarea('description_ar',null, array('class' => 'form-control')) }}
            </div>
        </div>
        <div class="col-md-12">
            {{Form::label('attachment',__('Attachment'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            <div class="choose-file form-group">
                <label for="attachment" class="form-control-label">
                    <div>{{__('Choose file here')}}</div>
                    <input type="file" class="form-control" name="attachment" id="attachment" data-filename="attachment_create">
                </label>
                <p class="attachment_create"></p>
            </div>
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
