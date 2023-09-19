    {{Form::model($jobCategory,array('route' => array('job-category.update', $jobCategory->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title_ar',__('Title_ar'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title_ar',null,array('class'=>'form-control','placeholder'=>__('Enter category title arabic')))}}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Title'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter category title')))}}
            </div>
        </div>

        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
