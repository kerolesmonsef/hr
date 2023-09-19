    {{Form::open(array('url'=>'meeting','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch_id',__('Branch'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                <select class="form-control" name="branch_id" id="branch_id" placeholder="Select Branch">
                    <option value="">{{__('Select Branch')}}</option>
                    <option value="0">{{__('All Branch')}}</option>
                    @foreach($branch as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('department_id',__('Department'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                <select class="form-control select2" name="department_id[]" id="department_id" placeholder="Select Department" multiple>

                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('employee_id',__('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                <select class="form-control select2" name="employee_id[]" id="employee_id" placeholder="Select Employee" multiple>

                </select>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Meeting Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Meeting Title')))}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('url',__('Meeting url'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('url',null,array('class'=>'form-control','placeholder'=>__('Enter Meeting url')))}}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('date',__('Meeting Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('time',__('Meeting Time'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('time',null,array('class'=>'form-control timepicker'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('note',__('Meeting Note'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::textarea('note',null,array('class'=>'form-control','placeholder'=>__('Enter Meeting Note')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}

    <script>
        $(function () {
            $(".gregorian-date , .datepicker").flatpickr({
            format:'YYYY-M-D',
            showSwitcher: false,
            hijri:false,
            useCurrent: true,
            });
        });
    </script>
