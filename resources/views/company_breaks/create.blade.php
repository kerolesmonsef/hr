    {{Form::open(array('url'=>'company-breaks','method'=>'post'))}}
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    {{Form::label('start_time',__('Start time'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::time('start_time',null,array('class'=>'form-control'))}}
                    @error('start_time')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    {{Form::label('end_time',__('End time'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::time('end_time',null,array('class'=>'form-control'))}}
                    @error('end_time')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
                <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
            </div>
        </div>
    {{Form::close()}}
