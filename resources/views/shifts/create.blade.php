{{Form::open(array('url'=>'shifts','method'=>'post'))}}
<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="employee_id" value="{{ request()->id }}" />
        <div class="form-group">
            {{ Form::label('shift', __('shifts'),['class'=>'form-control-label']) }}
            {{ Form::select('shift_id', $employee_shifts,null, array('class' => 'form-control ')) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('location', __('Location'),['class'=>'form-control-label']) }}
            {{ Form::select('location_id', $employee_location,null, array('class' => 'form-control')) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
        <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
    </div>
</div>

{{Form::close()}}
