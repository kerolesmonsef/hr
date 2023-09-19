    {{Form::open(array('url'=>'event','method'=>'post'))}}

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('branch_id',__('Branch'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    <select class="form-control" name="branch_id" id="branch_id" placeholder="{{__('Select Branch')}}">
                        <option value="">{{__('Select Branch')}}</option>
                        <option value="0">{{__('All Branch')}}</option>
                        @foreach($branch as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('department_id',__('Department'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    <select class="form-control select2" name="department_id[]" id="department_id" placeholder="{{__('Select Department')}}" multiple>

                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('employee_id',__('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    <select class="form-control select2" name="employee_id[]" id="employee_id" placeholder="{{__('Select Employee')}}" multiple>

                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{Form::label('title_ar',__('Enter Event Title arabic'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                        {{Form::text('title_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Event Title arabic')))}}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('title',__('Event Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Event Title')))}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{Form::label('start_date',__('Event start Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::date('start_date',null,array('class'=>'form-control datepicker'))}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{Form::label('end_date',__('Event End Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::date('end_date',null,array('class'=>'form-control datepicker'))}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{Form::label('time',__('Event Time'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::time('time',null,array('class'=>'form-control datepicker'))}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    {{Form::label('color',__('Event Select Color'),['class'=>'form-control-label d-block mb-3'])}}
                    <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                        <label class="btn bg-info active"><input type="radio" name="color" value="#00B8D9" checked></label>
                        <label class="btn bg-warning"><input type="radio" name="color" value="#FFAB00"></label>
                        <label class="btn bg-danger"><input type="radio" name="color" value="#FF5630"></label>
                        <label class="btn bg-success"><input type="radio" name="color" value="#36B37E"></label>
                        <label class="btn bg-secondary"><input type="radio" name="color" value="#EFF2F7"></label>
                        <label class="btn bg-primary"><input type="radio" name="color" value="#051C4B"></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('description_ar',__('Enter Event Description arabic'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::textarea('description_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Event Description arabic')))}}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('description',__('Event Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Event Description')))}}
                </div>
            </div>

            <div class="col-12">
                <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
                <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
            </div>
        </div>

    {{Form::close()}}


