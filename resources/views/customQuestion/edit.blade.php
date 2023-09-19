<div class="card bg-none card-box">
    {{Form::model($customQuestion,array('route' => array('custom-question.update', $customQuestion->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('question',__('Question'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('question',null,array('class'=>'form-control','placeholder'=>__('Enter question')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('is_required',__('Is Required'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{ Form::select('is_required', $is_required,null, array('class' => 'form-control ','required'=>'required')) }}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
