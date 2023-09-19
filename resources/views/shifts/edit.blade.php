{{Form::open(array('url'=> route('shifts.update' , [$shift]),'method'=>'put'))}}
<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('shift', __('shifts'),['class'=>'form-control-label']) }}
            {{ Form::select('shift_id', $employee_shifts,$shift->shift_id, array('class' => 'form-control ')) }}
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('location', __('Location'),['class'=>'form-control-label']) }}
            {{ Form::select('location_id', $employee_location,$shift->location_id, array('class' => 'form-control')) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <input type="submit" value="{{__('Edit')}}" class="btn btn-primary">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
    </div>
</div>
{{Form::close()}}
