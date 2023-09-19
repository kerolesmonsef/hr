    {{Form::open(array('url'=>'payer','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('payer_name',__('Payer Name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('payer_name',null,array('class'=>'form-control','placeholder'=>__('Enter Payer Name')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('contact_number',__('Contact Number'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('contact_number',null,array('class'=>'form-control','placeholder'=>__('Enter Contact Number')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
