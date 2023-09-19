<div class="card bg-none card-box">
    {{Form::model($evaluation,array('route' => array('evaluation.update', $evaluation->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('employee_id', __('Select employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select class="form-control employee select_two" name="employee_id" data-control="select2">
                @foreach ($employees as $employee)
                    <option {{ $evaluation -> employee_id == $employee -> id ? "selected" : "" }} value="{{ $employee->id }}" >{{ app()->isLocale('en') ?  $employee->name : $employee->name_ar }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('type', __('Status'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select class="form-control select_two " name="status">
                <option  {{ $evaluation -> status == 'pending' ? 'selected' : '' }}  value="pending"> {{ __('Active')}} </option>
                <option {{ $evaluation -> status == 'completed' ? 'selected' : '' }} value="completed"> {{ __('Not active')}} </option>
            </select>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('type', __('Type'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select class="form-control select_two" name="type">
                <option {{  $evaluation -> type == 'monthly' ? 'selected' : '' }} value="monthly" > {{ __('Monthly')}} </option>
                <option {{  $evaluation -> quarter == 'quarter' ? 'selected' : ''  }} value="quarter" > {{ __('Quarter')}} </option>
                <option {{  $evaluation -> type == 'semi' ? 'selected' : ''  }} value="semi" > {{ __('Semi')}} </option>
                <option {{  $evaluation -> type == 'yearly' ? 'selected' : ''  }} value="yearly" > {{ __('Yearly')}} </option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>

<script>
    $(document).ready(function() {
        $('.select_two').select2({
            dropdownParent: $('#commonModal')
        });
    });
</script>
