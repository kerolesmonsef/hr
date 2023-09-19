    {{Form::open(array('url'=>'category','method'=>'post'))}}
    <div class="row">
        <div class="col-12">
            <div class="col-12">
                <div class="form-group">
                    {{Form::label('name_ar',__('Name_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::text('name_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Name arabic')))}}
                    @error('name_ar')
                    <span class="invalid-name" role="alert">
                        <strong class="text-danger">{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                {{Form::label('name',__('Name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                @error('name')
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
