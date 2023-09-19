
    {{Form::open(array('url'=>'question_category','method'=>'post'))}}
    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Title in arabic'))}}
                {{Form::text('title', null,array('class'=>'form-control','placeholder'=>__('Title in arabic')))}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title_ar',__('Title in english'))}}
                {{Form::text('title_ar', null ,array('class'=>'form-control','placeholder'=>__('Title in english')))}}
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


