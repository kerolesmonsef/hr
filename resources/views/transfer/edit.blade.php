    {{Form::model($transfer,array('route' => array('transfer.update', $transfer->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-lg-6 col-md-6 ">
            {{ Form::label('employee_id', __('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{ Form::select('employee_id', $employees,null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('branch_id',__('Branch'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::select('branch_id',$branches,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('department_id',__('Department'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::select('department_id',$departments,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('transfer_date',__('Transfer Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('transfer_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-lg-12">
            {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
         <div class="form-group col-lg-12">
            {{Form::label('description_ar',__('Description_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
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
