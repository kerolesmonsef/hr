
{{Form::model($break,array('route' => array('company-breaks.update', $break->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('start_time',__('Start time'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::time('start_time',Carbon\Carbon::createFromFormat('h:i a' , $break->start_time)->format('H:i') ,array('class'=>'form-control'))}}
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
                {{Form::time('end_time',Carbon\Carbon::createFromFormat('h:i a' , $break->end_time)->format('H:i') ,array('class'=>'form-control'))}}
                @error('end_time')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
{{Form::close()}}

