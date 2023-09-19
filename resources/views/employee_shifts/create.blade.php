    {{Form::open(array('url'=>'employee_shifts','method'=>'post'))}}
    <div class="row">

        <div class="col-6">
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

        <div class="col-6">
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

        <div class="form-group col-md-12">
            <div  class="form-group">
                {!! Form::label('shift_days', __('shift_days'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                <select required="required" class="form-control select2" multiple name="shift_days[]">
                    @foreach ($days as $key => $day)
                        <option value="{{$key}}">{{ $day }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('shift_startdate',__('shift_startdate'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::date('shift_startdate',null,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('shift_starttime',__('shift_starttime'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::time('shift_starttime',null,array('class'=>'form-control '))}}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('shift_endtime',__('shift_endtime'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::time('shift_endtime',null,array('class'=>'form-control '))}}
            </div>
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
