    {{ Form::model($employee, array('route' => array('employee.salary.update', $employee->id), 'method' => 'POST')) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('salary_type', __('Payslip Type*'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::select('salary_type',$payslip_type,null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('salary', __('Salary'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('salary',null, array('class' => 'form-control ','required'=>'required')) }}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Save Change')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
