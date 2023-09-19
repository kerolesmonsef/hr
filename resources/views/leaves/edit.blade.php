<div class="card bg-none card-box">
    {{Form::model($leave,array('route' => array('leaves.update', $leave->id), 'method' => 'PUT')) }}
        <div class="card bg-none mb-4 card-box">
            <div style="padding: 5%" style="padding: 5%" class="row">
                <input type="hidden" name="type" value="leave">
                <input type="hidden" name="request_type" value="edit">
                <div class="form-group col-lg-12 col-md-12">
                    {{Form::label('employee_id',__('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::select('employee_id',$employees,null,array('class'=>'form-control'))}}
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('start_date',__('Start Date'))}}
                        {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('end_date',__('End Date'))}}
                        {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
                    </div>
                </div>

                <div class="form-group col-lg-6 col-md-6">
                    {{Form::label('leave_type_id',__('Leave Type'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::select('leave_type_id',$leavetypes,null,array('class'=>'form-control'))}}
                </div>

                <div class="form-group col-lg-6 col-md-6">
                    {{Form::label('replacement_employee_id',__('replacementemployee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                    {{Form::select('replacement_employee_id',$employees,null,array('class'=>'form-control'))}}
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {{Form::label('leave_reason',__('Leave Reason'))}}
                        {{Form::text('leave_reason',null,array('class'=>'form-control'))}}
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
                <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
            </div>
        </div>
    {{Form::close()}}
</div>

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
