    {{Form::open(array('url'=> route('work_from_home_request.store'),'method'=>'post'))}}
    <div class="row">
        <div class="form-group col-md-12">
            <div class="form-group">
                {!! Form::label('employee_id', __('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                <select required="required" class="form-control"  name="employee_id">
                    @foreach ($employees as $key => $employee)
                        <option value="{{ $employee -> id }}">{{ $employee ->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-12">
            <div class="form-group">
                {!! Form::label('status', __('Status'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                <select required="required" class="form-control"  name="status">
                        <option value="pending">pending</option>
                        <option value="approved">approved</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{Form::label('date',__('date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::date('date',null ,array('class'=>'form-control'))}}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {{Form::label('reason',__('Reason'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('reason',null ,array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                @error('reason')
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
