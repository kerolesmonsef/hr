    {{Form::open(array('route'=>array('job.on.board.store',$id),'method'=>'post'))}}
    <div class="row">
        @if($id==0)
            <div class="form-group col-md-12">
                {{Form::label('application',__('Interviewer'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('application',$applications,null,array('class'=>'form-control ','required'=>'required'))}}
            </div>
        @endif
        <div class="form-group col-md-12">
            {!! Form::label('joining_date', __('Joining Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
            {!! Form::text('joining_date', null, ['class' => 'form-control datepicker']) !!}
        </div>
        <div class="form-group col-md-12">
            {{Form::label('status',__('Status'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
            {{Form::select('status',$status,null,array('class'=>'form-control select2'))}}
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}


