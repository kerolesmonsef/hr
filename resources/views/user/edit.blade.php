    {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
            {!! Form::label('name', __('Name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
            {!! Form::text('name', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>

        <div class="form-group col-lg-6 col-md-6">
            {!! Form::label('email', __('Email'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
            {!! Form::text('email', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>

        <div class="form-group col-lg-6 col-md-6">
            {!! Form::label('password', __('Password'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="col-md-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {!! Form::close() !!}
