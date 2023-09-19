    {{Form::open(array('url'=>'library','method'=>'post', 'enctype' => "multipart/form-data"))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('name',__('English name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('name',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('name',__('Arabic name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('name_ar',null,array('class'=>'form-control','required'=>'required'))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
