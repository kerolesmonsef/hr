    {{ Form::open(array('route' => array('timesheet.store'))) }}
    <div class="row">
        @if(auth()->user()->type != 'employee')
            <div class="form-group col-md-12">
                {{ Form::label('employee_id', __('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                {!! Form::select('employee_id', $employees, null,array('class' => 'form-control font-style ','required'=>'required')) !!}
            </div>
        @endif
        <div class="form-group col-md-6">
            {{ Form::label('date', __('Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('hours', __('Hours'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('hours', '', array('class' => 'form-control','required'=>'required','step'=>'0.01')) }}
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('remark', __('Remark'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {!! Form::textarea('remark', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
         <div class="form-group  col-md-12">
            {{ Form::label('remark', __('Remark_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {!! Form::textarea('remark_ar', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
