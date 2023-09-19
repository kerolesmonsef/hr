<div class="card bg-none card-box">
    {{Form::model($cat,array('route' => array('question_category.update', $cat->id), 'method' => 'PUT')) }}



    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Title in english'))}}
                {{Form::text('title', $cat->title ,array('class'=>'form-control','placeholder'=>__('Title in english')))}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title_ar',__('Title in arabic'))}}
                {{Form::text('title_ar', $cat->title_ar ,array('class'=>'form-control','placeholder'=>__('Title in arabic')))}}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>

