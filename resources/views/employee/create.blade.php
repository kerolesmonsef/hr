@extends('layouts.admin')
@section('page-title')
    {{__('Create Employee')}}
@endsection

@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid" data-select2-id="select2-data-kt_app_content">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl" data-select2-id="select2-data-kt_app_content_container">
        <!--begin::Form-->

        <!--begin::Page title-->
        <div class="page-title d-flex flex-column py-3 py-lg-6 justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{__('Create Employee')}}</h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->

        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif

        {{Form::open(array('route'=>array('employee.store'), 'id' => 'form','class' => 'wizard-big','method'=>'post','enctype'=>'multipart/form-data'))}}
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general"></a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->

                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{__('general_information')}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {!! Form::label('name_ar', __('Name_ar'),['class'=>'form-control-label']) !!}
                                            {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control','required' ]) !!}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {!! Form::label('name', __('Name'),['class'=>'form-control-label']) !!}
                                            {!! Form::text('name', old('name'), ['class' => 'form-control','required']) !!}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {!! Form::label('employee_id', __('Employee ID'),['class'=>'form-control-label']) !!}
                                            {!! Form::text('employee_id', $employeesId, ['class' => 'form-control '  ,'disabled'=>'disabled']) !!}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{ Form::label('nationality_type', __('nationality_type'),['class'=>'form-control-label']) }}
                                            {{ Form::select('nationality_type', [ "0" => __('non_saudi') , "1" => __('saudi') ],null, array('class' => 'form-control required' ,'id' => 'nationality_type')) }}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div id="nationality" >
                                                {{ Form::label('nationality_id', __('nationality'),['class'=>'form-control-label']) }}
                                                {{ Form::select('nationality_id', $nationalities,null, array('class' => 'form-control required' )) }}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {!! Form::label('email', __('Email'),['class'=>'form-control-label']) !!}
                                            {!! Form::email('email',old('email'), ['class' => 'form-control','required']) !!}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {!! Form::label('phone', __('Phone'),['class'=>'form-control-label']) !!}
                                            {!! Form::text('phone',old('phone'), ['class' => 'form-control','required']) !!}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {!! Form::label('password', __('Password'),['class'=>'form-control-label']) !!}
                                            {!! Form::password('password', ['class' => 'form-control','required']) !!}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <fieldset>
                                                <legend>
                                                    {{__('Do you want to register in the list of users')}}
                                                </legend>

                                                <div class="form-check abc-radio abc-radio-info form-check-inline">
                                                    <input class=" " type="radio" id="inlineRadio1" value="1" name="user_register" checked="">
                                                    <label class="form-check-label" for="inlineRadio1"> {{__('yes')}} </label>
                                                </div>

                                                <div class="form-check abc-radio form-check-inline">
                                                    <input class=" " type="radio" id="inlineRadio2" value="0" name="user_register">
                                                    <label class="form-check-label" for="inlineRadio2"> {{__('no')}} </label>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->

                            <!--begin::Media-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{__('job_information')}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('Join_date_gregorian', __('Join_date_gregorian'),['class'=>'form-control-label']) !!}
                                                {!! Form::text('Join_date_gregorian', old('Join_date_gregorian') , ['id' => 'gregorian_1' ,'required' => 'required' ,'class' => 'form-control gregorian-date']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('Join_date_hijri', __('Join_date_hijri'),['class'=>'form-control-label']) !!}
                                                {!! Form::text('Join_date_hijri', old('Join_date_hijri') , ['id' => 'hijri_1' ,'required' => 'required' ,'class' => 'form-control hijri-date-input']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            {{ Form::label('department_id', __('Department'),['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                            {{ Form::select('department_id', $departments,null, array('class' => 'form-control ')) }}
                                        </div>

                                        <div class="form-group col-md-4">
                                            {{ Form::label('jobtitle_id', __('jobtitle'),['class'=>'form-control-label']) }}
                                            {{ Form::select('jobtitle_id', $jobtitles,null, array('class' => 'form-control ' ,'required' => 'required')) }}
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('work_time', __('job_type'),['class'=>'form-control-label']) }}
                                                {{ Form::select('work_time', $job_types,null, array('class' => 'form-control ')) }}
                                            </div>
                                        </div>



                                        <div class="form-group col-md-12">
                                            {{ Form::label('branch_id', __('Branch'),['class'=>'form-control-label']) }}
                                            {{ Form::select('branch_id[]', $branches , null , array('class' => 'form-control' ,'multiple' ,'data-control' => "select2")) }}
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('direct_manager', __('direct_manager'),['class'=>'form-control-label']) }}
                                                {{ Form::select('direct_manager', $employees,null, array('class' => 'form-control ' )) }}
                                            </div>
                                        </div>

                                        <h5 class="col-md-12">{{__('contract_details')}}</h5>

                                        <div class="col-md-9">
                                            <div class="row">

                                                <div style="" class="form-group col-md-12">
                                                    {{ Form::label('contract_type', __('contract_type'),['class'=>'form-control-label']) }}
                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="with_contract" checked value="1" name="contract_type" class="custom-control-input">
                                                            <label class="custom-control-label" for="with_contract">{{__('limited_time')}}</label>

                                                            <input type="radio" id="without_contract" value="0" name="contract_type" class="custom-control-input">
                                                            <label class="custom-control-label" for="without_contract">{{__('Without contract')}}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="display:flex;" class="form-group col-md-12 contract_duration_section">
                                                    {{ Form::label('contract_duration', __('contract_duration'),['class'=>'form-control-label']) }}
                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="1year" value="1" checked name="contract_duration" class="custom-control-input">
                                                            <label class="custom-control-label" for="1year">{{__('1year')}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="2year" value="2" name="contract_duration" class="custom-control-input">
                                                            <label class="custom-control-label" for="2year">{{__('2year')}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="customduration"  value="0" name="contract_duration" class="custom-control-input">
                                                            <label class="custom-control-label" for="customduration">{{__('customduration')}}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    {{ Form::label('Is_the_employee_on_probation', __('Is_the_employee_on_probation'),['class'=>'form-control-label']) }}
                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="yes" value="1" name="employee_on_probation" class="custom-control-input">
                                                            <label class="custom-control-label" for="yes">{{__('yes')}}</label>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex radio-check">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="no" value="0" checked name="employee_on_probation" class="custom-control-input">
                                                            <label class="custom-control-label" for="no">{{__('no')}}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" style="display:none;"  id= "ContractDuration">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <div id="contract_startdate" class="form-group">
                                                                {!! Form::label('contract_startdate', __('contract_startdate_gregorian'),['class'=>'form-control-label']) !!}
                                                                {!! Form::text('contract_startdate', old('contract_startdate') ?? now(), ['id' => 'gregorian_2' ,'class' => 'form-control gregorian-date']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <div id="contract_startdate" class="form-group">
                                                                {!! Form::label('contract_startdate_Hijri', __('contract_startdate_Hijri'),['class'=>'form-control-label']) !!}
                                                                {!! Form::text('contract_startdate_Hijri', old('contract_startdate_Hijri') ?? now(), ['id' => 'hijri_2' , 'class' => 'form-control hijri-date-input']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <div id="contract_enddate" class="form-group">
                                                                {!! Form::label('contract_enddate', __('contract_enddate_gregorian'),['class'=>'form-control-label']) !!}
                                                                {!! Form::text('contract_enddate', old('contract_enddate') ?? now(), ['id' => 'gregorian_3' ,'class' => 'form-control gregorian-date']) !!}
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <div id="contract_startdate" class="form-group">
                                                                {!! Form::label('contract_enddate_Hijri', __('contract_enddate_Hijri'),['class'=>'form-control-label']) !!}
                                                                {!! Form::text('contract_enddate_Hijri', old('contract_enddate_Hijri') ?? now(), ['id' => 'hijri_3' ,'class' => 'form-control hijri-date-input']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6" style="display:none;" id="probation_input_duration">
                                                    <div class="form-group">
                                                        {{ Form::label('probation_periods_duration', __('probation_periods_duration'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('probation_periods_duration', old('probation_periods_duration'), array('class' => 'form-control' , 'value' => '90')) }}
                                                    </div>
                                                    <div class="wizard-form-error"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Media-->

                            <!--begin::Pricing-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{__('salary_and_allowances')}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::label('salary', __('basic_salary'),['class'=>'form-control-label']) !!}
                                                {!! Form::text('salary', old('salary'), ['class' => 'form-control required']) !!}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="col-md-12 paymentDetails">
                                            {{ Form::label('Payment_details', __('Payment_details'),['class'=>'form-control-label']) }}
                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cash" value="cash" checked name="payment_type" class="custom-control-input">
                                                    <label class="custom-control-label" for="cash">{{__('cash')}}</label>
                                                </div>
                                            </div>

                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="bank" value="bank" name="payment_type" class="custom-control-input">
                                                    <label class="custom-control-label" for="bank">{{__('bank')}}</label>
                                                </div>
                                            </div>

                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cheque" value="cheque" name="payment_type" class="custom-control-input">
                                                    <label class="custom-control-label" for="cheque">{{__('cheque')}}</label>
                                                </div>
                                            </div>

                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="international_transfer" value="international_transfer" name="payment_type" class="custom-control-input">
                                                    <label class="custom-control-label" for="international_transfer">{{__('international_transfer')}}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="display:none;" id="paymentContent" class="col-md-12">
                                            <div style="display:none;" id="bankDetails" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div style="margin-top: 15%;" class="form-group">
                                                            {{ Form::label('employee_account_type', __('employee_account_type'),['class'=>'form-control-label']) }}
                                                            {{ Form::select('employee_account_type', [ "0" => __('salary_card') , "1" => __('bank_account') ],null, array('class' => 'form-control ' ,'id' => 'employee_account_type')) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div style="display:none;" id="IBAN_number_info" class="form-group">
                                                            {!! Form::label('IBAN_number', __('IBAN_number'),['class'=>'form-control-label']) !!}
                                                            {!! Form::text('IBAN_number', old('IBAN_number'), ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div id="salary_card_number_info" class="form-group">
                                                            {!! Form::label('salary_card_number', __('salary_card_number'),['class'=>'form-control-label']) !!}
                                                            {!! Form::text('salary_card_number', old('salary_card_number'), ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div class="form-group">
                                                            {{ Form::label('bank_id', __('bank_name'),['class'=>'form-control-label']) }}
                                                            {{ Form::select('bank_id', $banks,null, array('class' => 'form-control ')) }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div style="display:none;padding: 2%;" id="internationalTransferDetails" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {{ Form::label('bank_name', __('bank_name'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('bank_name',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('account_holder_name', __('account_holder_name'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('account_holder_name',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('account_holder_name_ar', __('account_holder_name_ar'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('account_holder_name_ar',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('branch_location', __('branch_name'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('branch_location',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('branch_location_ar', __('branch_name_ar'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('branch_location_ar',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('swift_code', __('swift_code'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('swift_code',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('sort_code', __('sort_code'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('sort_code',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('bank_country', __('country'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('bank_country',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('account_number', __('bank_account_number'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('account_number',null, array('class' => 'form-control ')) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('IBAN_number', __('IBAN_number'),['class'=>'form-control-label']) }}
                                                        {{ Form::text('IBAN_number',null, array('class' => 'form-control')) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Pricing-->

                            <!--begin::Pricing-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{__('annual_leave_entitlement')}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="col-md-12 ">
                                        <div class="form-group col-md-12">
                                            {{ Form::label('annual_leave_entitlement', __('current_annual_leave_entitlement'),['class'=>'form-control-label']) }}
                                            {!! Form::text('annual_leave_entitlement', old('annual_leave_entitlement'), ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-12 ">
                                        <div class="form-group col-md-12">
                                            {{ Form::label('previous_annual_leave_entitlement', __('previous_annual_leave_entitlement'),['class'=>'form-control-label']) }}
                                            {!! Form::text('previous_annual_leave_entitlement', old('previous_annual_leave_entitlement'), ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Pricing-->

                            {{--  <!--begin::Pricing-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{__('shifts')}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('shift', __('shifts'),['class'=>'form-control-label']) }}
                                                {{ Form::select('shift', $employee_shifts,null, array('class' => 'form-control ')) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('location', __('Location'),['class'=>'form-control-label']) }}
                                                {{ Form::select('location', $employee_location,null, array('class' => 'form-control')) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Pricing-->  --}}
                        </div>
                    </div>
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->

                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                        <span class="indicator-label">{{__('Save')}}</span>
                        <span class="indicator-progress">
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
        {{Form::close()}}
    </div>
</div>

@endsection

@push('script-page')
    <script>

        $(document).ready(function () {
            var d_id = $('#department_id').val();
        });

        $(document).ready(function () {
            for(let i = 1; i <= 18; i++){
                $('#hijri_1'+i).on('dp.change', function (arg) {

                    if (!arg.date) {
                    return;
                    };

                    let date = arg.date;
                    $('#gregorian_'+i).val(date.format("YYYY-M-D"));
                });
                $('#gregorian_'+i).on('dp.change', function (arg) {

                    if (!arg.date) {
                    return;
                    };

                    let date = arg.date;
                    $('#hijri_'+i).val(date.format("iYYYY-iM-iD"));
                });
                }
        });

        $(document).on('change', 'select[name=department_id]', function () {
            var department_id = $(this).val();
        });

        $(document).on('change', '#nationality_type', function () {
            var nationality_type = $(this).val();
            if(nationality_type == 1)
            {
                $('#nationality').css('display','none');
            }else{
                $('#nationality').css('display','block');
            }
        });

        $(document).on('change', '#driving_license', function () {
            var driving_license = $(this).val();
            if(driving_license == 0)
            {
                $('.driving_license_info').css('display','none');
            }else{
                $('.driving_license_info').css('display','block');
            }
        });

        $(document).on('change', 'input[name=contract_duration]', function () {
            if($(this).val() == 0)
            {
                $('#ContractDuration').css('display','block');
            }else{
                $('#ContractDuration').css('display','none');
            }
        });

        $(document).on('change', 'input[name=employee_on_probation]', function () {
            if($(this).val() == 1)
            {
                $('#probation_input_duration').css('display','block');
                $('#probation_periods_duration').addClass('required');
            }else{
                $('#probation_input_duration').css('display','none');
                $('#probation_periods_duration').removeClass('required');
            }
        });

        $(document).on('change', '#medical_insurance', function () {
            var medical_insurance = $(this).val();
            if(medical_insurance == 0)
            {
                $('#insurance_startdate').css('display','none');
                $('#insurance_enddate').css('display','none');
            }else{
                $('#insurance_startdate').css('display','block');
                $('#insurance_enddate').css('display','block');
            }
        });

        $(document).on('change', '#worker', function () {
            var worker = $(this).val();
            if(worker == 0)
            {
                $('#worker_startdate').css('display','none');
                $('#worker_enddate').css('display','none');
            }else{
                $('#worker_startdate').css('display','block');
                $('#worker_enddate').css('display','block');
            }
        });

        $(document).on('change' ,'#employee_account_type', function() {
            if($(this).val() == 0)
            {
                $('#salary_card_number_info').css('display','block');
                $('#IBAN_number_info').css('display','none');
            }else{
                $('#salary_card_number_info').css('display','none');
                $('#IBAN_number_info').css('display','block');
            }
        });

        $(document).on('change', 'input[name=payment_type]', function () {
            if($(this).val() == 'cash' || $(this).val() == 'cheque')
            {
                $('#paymentContent').css('display','none');
            }else if($(this).val() == 'bank'){
                $('#paymentContent').css('display','block');
                $('#bankDetails').css('display','block');
                $('#internationalTransferDetails').css('display','none');
            }else if($(this).val() == 'international_transfer'){
                $('#paymentContent').css('display','block');
                $('#bankDetails').css('display','none');
                $('#internationalTransferDetails').css('display','block');
            }
        });

        $('input[name="contract_type"]').click(function(){
            if( $(this).val() == 0 ){
                $('.contract_duration_section').hide();
            }else{
                $('.contract_duration_section').show();
            }
        })


        $('#name').on('keyup change' , function(){
            $('#account_holder_name').val($(this).val());
        });

        $('#name_ar').on('change' , function(){
            $('#account_holder_name_ar').val($(this).val());
        });
    </script>
@endpush


