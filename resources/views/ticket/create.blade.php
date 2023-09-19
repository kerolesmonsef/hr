    {{Form::open(array('url'=>'ticket','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('title_ar',__('Subject_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::text('title_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Ticket Subject arabic')))}}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('title',__('Subject'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Ticket Subject')))}}
                </div>
            </div>

        </div>
    </div>
    @if(auth()->user()->type!='employee')
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{Form::label('employee_id',__('Ticket for Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::select('employee_id',$employees,null,array('class'=>'form-control ','placeholder'=>__('Select Employee')))}}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('priority',__('Priority'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                <select name="priority" id="" class="form-control">
                    <option value="low">{{__('Low')}}</option>
                    <option value="medium">{{__('Medium')}}</option>
                    <option value="high">{{__('High')}}</option>
                    <option value="critical">{{__('critical')}}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('end_date',__('End Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description_ar',__('Description_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::textarea('description_ar',null,array('class'=>'form-control','placeholder'=>__('Ticket Description arabic')))}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Ticket Description')))}}
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
