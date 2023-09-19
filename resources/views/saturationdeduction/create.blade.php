    {{Form::open(array('url'=>'saturationdeduction','method'=>'post'))}}
    {{ Form::hidden('employee_id',$employee->id, array()) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('deduction_option', __('Deduction Options*'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::select('deduction_option',$deduction_options,null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('title', __('Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{Form::label('date',__('Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('date',date('Y-m-d'),array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-md-6">
            <div class="form-group">
                {{ Form::label('percent', __('Deduction Percent')) }}
                {{ Form::text('percent',null, array('class' => 'form-control ','onkeyup' => 'calculateDeductionPercent('.$employee->id.')','required'=>'required')) }}
            </div>
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
