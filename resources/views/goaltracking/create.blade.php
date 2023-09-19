    {{Form::open(array('url'=>'goaltracking','method'=>'post'))}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('branch',__('Branch'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('branch',$brances,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('goal_type',__('GoalTypes'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('goal_type',$goalTypes,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('start_date',__('Start Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('start_date',null,array('class' => 'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('end_date',__('End Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('end_date',null,array('class' => 'form-control datepicker'))}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('subject_ar',__('Subject_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('subject_ar',null,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('subject',__('Subject'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('subject',null,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('target_achievement',__('Target Achievement'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('target_achievement',null,array('class'=>'form-control'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description_ar',__('Description_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::textarea('description_ar',null,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::textarea('description',null,array('class'=>'form-control'))}}
            </div>
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
