{{Form::open(array('url'=>'deposit','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('account_id',__('Account'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('account_id',$accounts,null,array('class'=>'form-control ','placeholder'=>__('Choose Account')))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('amount',__('Amount'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::number('amount',null,array('class'=>'form-control','placeholder'=>__('Amount'),'step'=>'0.01'))}}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('date',__('Date'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('income_category_id',__('Category'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('income_category_id',$incomeCategory,null,array('class'=>'form-control ','placeholder'=>__('Choose A Category')))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('payer_id',__('Payer'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('payer_id',$payers,null,array('class'=>'form-control select2'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('payment_type_id',__('Payment Method'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::select('payment_type_id',$paymentTypes,null,array('class'=>'form-control ','placeholder'=>__('Choose Payment Method')))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('referal_id',__('Ref#'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::text('referal_id',null,array('class'=>'form-control'))}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description',__('Description'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'])}}
                {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Description')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn btn-primary">
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
