    {{Form::model($warning,array('route' => array('warning.update', $warning->id), 'method' => 'PUT')) }}
    <div class="row">
        @if(auth()->user()->type != 'employee')
            <div class="form-group col-md-6 col-lg-6">
                {{ Form::label('warning_by', __('Warning By'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{ Form::select('warning_by', $employees,null, array('class' => 'form-control ','required'=>'required')) }}
            </div>
        @endif
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('warning_to',__('Warning To'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::select('warning_to',$employees,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {{Form::label('subject',__('Subject'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('subject',null,array('class'=>'form-control'))}}
        </div>
         <div class="form-group col-lg-6 col-md-6">
            {{Form::label('subject_ar',__('Subject_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('subject_ar',null,array('class'=>'form-control'))}}
        </div>
        <div class="form-group col-lg-12 col-md-12">
            {{Form::label('warning_date',__('Warning Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::text('warning_date',null,array('class'=>'form-control datepicker'))}}
        </div>
        <div class="form-group col-lg-12">
            {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))}}
        </div>
         <div class="form-group col-lg-12">
            {{Form::label('description_ar',__('Description_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description_ar',null,array('class'=>'form-control','placeholder'=>__('Enter Description arabic')))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
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
    </script>
