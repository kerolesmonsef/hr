    {{ Form::hidden('employee_id',$employeeId, array()) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('name', __('Name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('name', '', array('class' => 'form-control','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="form-group  col-md-6">
            {{ Form::label('purchase_date', __('Purchase Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('purchase_date','', array('class' => 'form-control datepicker')) }}
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('supported_date', __('Support Until'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('supported_date','', array('class' => 'form-control datepicker')) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::textarea('description', '', array('class' => 'form-control')) }}
        </div>
        <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
    </div>
    
