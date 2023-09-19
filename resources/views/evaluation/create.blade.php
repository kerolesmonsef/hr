
    {{Form::open(array('url'=>'evaluation','method'=>'post'))}}
    <div class="row">
        <div class="form-group col-md-12">
            {{ Form::label('employee_id', __('Select employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select class="form-control employee select_two" name="employee_id" data-control="select2">
                <option value="-1">{{ __('All') }}</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ app()->isLocale('en') ?  $employee->name : $employee->name_ar }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('type', __('Status'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select class="form-control select_two" name="status">
                <option value="pending" selected> {{ __('Active')}} </option>
                <option value="completed"> {{ __('Not active')}} </option>
            </select>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('type', __('Type'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
            <select class="form-control select_two" name="type">
                <option value="monthly" selected> {{ __('Monthly')}} </option>
                <option value="quarter" selected> {{ __('Quarter')}} </option>
                <option value="semi" selected> {{ __('Semi')}} </option>
                <option value="yearly" selected> {{ __('Yearly')}} </option>
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

    <script>
        $(function () {
            $(".gregorian-date , .datepicker").flatpickr({
            format:'YYYY-M-D',
            showSwitcher: false,
            hijri:false,
            useCurrent: true,
            });
        });
        $(document).ready(function() {
            $('.select_two').select2({
                dropdownParent: $('#commonModal')
            });
        });
    </script>

