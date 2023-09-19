    {{Form::model($accountlist,array('route' => array('accountlist.update', $accountlist->id), 'method' => 'PUT')) }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('account_name',__('Account Name'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('account_name',null,array('class'=>'form-control','placeholder'=>__('Enter Account Name')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('initial_balance',__('Initial Balance'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('initial_balance',null,array('class'=>'form-control','placeholder'=>__('Enter Initial Balance')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('account_number',__('Account Number'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('account_number',null,array('class'=>'form-control','placeholder'=>__('Enter Account Number')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('branch_code',__('Branch Code'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('branch_code',null,array('class'=>'form-control','placeholder'=>__('Enter Branch Code')))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('bank_branch',__('Bank Branch'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('bank_branch',null,array('class'=>'form-control','placeholder'=>__('Enter Bank Branch')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Update')}}" class="btn btn-primary">
            <input type="button" value="{{__('Cancel')}}" class="btn btn-white" data-bs-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
