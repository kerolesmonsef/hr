    {{Form::model($training,array('route' => array('training.update', $training->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('branch',$branches,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('trainer_option',__('Trainer Option'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('trainer_option',$options,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('training_type',__('Training Type'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('training_type',$trainingTypes,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('trainer',__('Trainer'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('trainer',$trainers,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('training_cost',__('Training Cost'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('training_cost',null,array('class'=>'form-control','step'=>'0.01','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('employee',__('Employee'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('employee',$employees,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('start_date',__('Start Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('end_date',__('End Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="form-group col-lg-12">
            {{Form::label('description_ar',__('Description_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description_ar',null,array('class'=>'form-control','placeholder'=>__('Description_ar')))}}
        </div>
        <div class="form-group col-lg-12">
            {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Description')))}}
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
