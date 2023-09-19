    {{Form::model($Absence,array('route' => array('absence.update', $Absence->id), 'method' => 'PUT')) }}
    <div class="card-body p-0">
        <div class="row">

        <div class="form-group col-md-6">
            {{ Form::label('type', __('Absent Type'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select class="form-control" name="type">
                <option value="A" @if($Absence->type == 'A') selected @endif> A - غياب بإذن </option>
                <option value="X" @if($Absence->type == 'X') selected @endif> X - غياب بدون إذن</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('number_of_days', __('Number of days'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            {{ Form::number('number_of_days',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
        </div>

        <div class="form-group col-md-6">
            {{Form::label('start_date',__('Start Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}

