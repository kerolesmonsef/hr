@extends('layouts.admin')
@section('page-title')
    {{ __('Employee') }}
@endsection

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid mt-4">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="flex-lg-row-fluid ms-lg-15">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                            href="#personal">{{ __('Personal') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#organization_info">{{ __('Organization') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#financial">{{ __('Financial') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#assets">{{ __('assets') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#statistics">{{ __('Statistics') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#documents">{{ __('Documents') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#attendance">{{ __('attendance') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#breaks">{{ __('Breaks') }}</a>
                    </li>
                    <!--end:::Tab item-->


                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#healthInsurance">{{ __('Medical insurance') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    @if ($employee->nationality_type == 0)
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#printcontract">{{ __('Print contract') }}</a>
                        </li>
                        <!--end:::Tab item-->
                    @endif

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#printrecievework">{{ __('Print recieve work') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#leaveCredit">{{ __('Leave credit') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#employeeShifts">{{ __('employee_shifts') }}</a>
                    </li>
                    <!--end:::Tab item-->

                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                            href="#fingerPrintLocation">{{ __('Finger print location') }}</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->

                <!--begin:::Tab content-->
                <div class="tab-content" id="myTabContent">
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade show active" id="personal" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            {{ Form::model($employee, ['route' => ['employee.update', $employee->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            <div class="card col-md-12">

                                <div class="row">
                                    <h5 class="col-md-12">{{ __('general_information') }}</h5>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('name_ar', __('Name_ar'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('name_ar', old('name_ar'), ['class' => 'form-control wizard-required']) !!}
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('name', __('Name'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('name', old('name'), ['class' => 'form-control wizard-required']) !!}
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('employee_id', __('Employee ID'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('employee_id', $employeesId, ['class' => 'form-control ', 'disabled' => 'disabled']) !!}
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    <div class="form-group col-md-3 ">
                                        {{ Form::label('nationality_type', __('nationality_type'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('nationality_type', ['0' => __('non_saudi'), '1' => __('saudi')], null, ['class' => 'form-control wizard-required', 'id' => 'nationality_type']) }}
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <div id="nationality"
                                            style="display:{{ $employee->nationality_type == 1 ? 'none' : 'block' }} ">
                                            {{ Form::label('nationality_id', __('nationality'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                            {{ Form::select('nationality_id', $nationalities, null, ['class' => 'form-control wizard-required']) }}
                                        </div>
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    <div
                                        class="form-group @if (auth()->user()->type != 'employee') col-md-4 @else col-md-6 @endif">
                                        {!! Form::label('email', __('Email'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::email('email', old('email'), ['class' => 'form-control wizard-required']) !!}
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    <div
                                        class="form-group @if (auth()->user()->type != 'employee') col-md-4 @else col-md-6 @endif">
                                        {!! Form::label('phone', __('Phone'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('phone', old('phone'), ['class' => 'form-control wizard-required']) !!}
                                        <div class="wizard-form-error"></div>
                                    </div>

                                    @if (auth()->user()->type != 'employee')
                                        <div class="form-group col-md-4">
                                            {!! Form::label('password', __('Password'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                            {!! Form::password('password', ['class' => 'form-control']) !!}
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <fieldset>
                                                <legend>
                                                    {{ __('Do you want to register in the list of users') }}
                                                </legend>

                                                <div class="form-check abc-radio abc-radio-info form-check-inline">
                                                    <input class=" " type="radio" id="inlineRadio1"
                                                        value="1" name="user_register"
                                                        @if ($employee->user_register == 1) checked="" @endif>
                                                    <label class="form-check-label" for="inlineRadio1"> {{ __('yes') }}
                                                    </label>
                                                </div>

                                                <div class="form-check abc-radio form-check-inline">
                                                    <input class=" " type="radio" id="inlineRadio2"
                                                        value="0" name="user_register"
                                                        @if ($employee->user_register == 0) checked="" @endif>
                                                    <label class="form-check-label" for="inlineRadio2">
                                                        {{ __('no') }} </label>
                                                </div>

                                                


                                            </fieldset>
                                        </div>
                                    @endif

                                </div>

                                <div class="form-group col-md-6">
                                    <fieldset>
                                        <legend>
                                            {{ __('Do you want to finger print out the company') }}
                                        </legend>

                                        <div class="form-check abc-radio abc-radio-info form-check-inline">
                                            <input class=" " type="radio" id="inlineRadio1"
                                                value="1" name="fingerprint_out_campany"
                                                @if ($employee->fingerprint_out_campany == 1) checked="" @endif>
                                            <label class="form-check-label" for="inlineRadio1"> {{ __('yes') }}
                                            </label>
                                        </div>

                                        <div class="form-check abc-radio form-check-inline">
                                            <input class=" " type="radio" id="inlineRadio2"
                                                value="0" name="fingerprint_out_campany"
                                                @if ($employee->fingerprint_out_campany == 0) checked="" @endif>
                                            <label class="form-check-label" for="inlineRadio2">
                                                {{ __('no') }} </label>
                                        </div>

                                        


                                    </fieldset>
                                </div>

                                <div class="optional-toggle">

                                </div>

                                <div class="row">
                                    <h6 class="col-md-12">{{ __('employee_identification') }}</h6>

                                    <div class="form-group col-md-3">
                                        {{ Form::label('gender', __('Gender'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('gender', ['Male' => __('Male'), 'Female' => __('Female')], null, ['class' => 'form-control']) }}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {{ Form::label('social_status', __('social_status'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('social_status', ['1' => __('married'), '0' => __('single'), '2' => __('divorced')], null, ['class' => 'form-control']) }}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {{ Form::label('religion', __('Religion'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('religion', ['1' => __('muslim'),'2' => __('Christian'), '0' => __('Other')], null, ['class' => 'form-control']) }}
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('dob', __('Date of Birth'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                            {!! Form::text('dob', $employee->dob ?? now(), ['class' => 'form-control gregorian-date']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('department_id', __('Department'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('department_id', $departments, null, ['class' => 'form-control required']) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('jobtitle_id', __('jobtitle'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('jobtitle_id', $jobtitles, null, ['class' => 'form-control ']) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('out_of_saudia', __('out_of_saudia'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('out_of_saudia', ['1' => __('yes'), '0' => __('no')], null, ['class' => 'form-control']) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::label('employer_phone', __('employer_phone'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('employer_phone', old('employer_phone'), ['class' => 'form-control']) !!}
                                    </div>

                                </div>

                                <div class="row">
                                    <h6 class="col-md-12">{{ __('ID_qama_details') }}</h6>
                                    <div class="form-group col-md-3">
                                        {!! Form::label('residence_number', __('residence_number'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('residence_number', old('residence_number'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('place_of_issuance_of_ID_residence', __('place_of_issuance_of_ID_residence'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('place_of_issuance_of_ID_residence', old('place_of_issuance_of_ID_residence'), [
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('iqama_issuance_date_Hijri', __('iqama_issuance_date_Hijri'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('iqama_issuance_date_Hijri', old('iqama_issuance_date_Hijri') ?? now(), [
                                            'id' => 'hijri_4',
                                            'class' => 'form-control hijri-date-input',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('iqama_issuance_date_gregorian', __('iqama_issuance_date_gregorian'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('iqama_issuance_date_gregorian', $employee->iqama_issuance_date_gregorian ?? now(), [
                                            'id' => 'gregorian_4',
                                            'class' => 'form-control gregorian-date',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('iqama_issuance_expirydate_Hijri', __('iqama_issuance_expirydate_Hijri'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('iqama_issuance_expirydate_Hijri', $employee->iqama_issuance_expirydate_Hijri ?? now(), [
                                            'id' => 'hijri_5',
                                            'class' => 'form-control hijri-date-input',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('iqama_issuance_expirydate_gregorian', __('iqama_issuance_expirydate_gregorian'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('iqama_issuance_expirydate_gregorian', $employee->iqama_issuance_expirydate_gregorian ?? now(), [
                                            'id' => 'gregorian_5',
                                            'class' => 'form-control gregorian-date',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('iqama_attachment', __('add_attachment'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::file('iqama_attachment', old('iqama_attachment'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <h6 class="col-md-12">{{ __('Passport_details') }}</h6>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('passport_number', __('passport_number'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('passport_number', old('passport_number'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('place_of_issuance_of_passport', __('place_of_issuance_of_passport'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('place_of_issuance_of_passport', old('place_of_issuance_of_passport'), [
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('passport_issuance_date_gregorian', __('passport_issuance_date_gregorian'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('passport_issuance_date_gregorian', $employee->passport_issuance_date_gregorian ?? now(), [
                                            'class' => 'form-control gregorian-date',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('passport_issuance_expirydate_gregorian', __('passport_issuance_expirydate_gregorian'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text(
                                            'passport_issuance_expirydate_gregorian',
                                            $employee->passport_issuance_expirydate_gregorian ?? now(),
                                            ['class' => 'form-control gregorian-date'],
                                        ) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('passport_attachment', __('add_attachment'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::file('passport_attachment', old('passport_attachment'), ['class' => 'form-control']) !!}
                                    </div>

                                </div>

                                <div class="row">
                                    <h6 class="col-md-12">{{ __('Address_in_saudia') }}</h6>
                                    <div class="form-group col-md-3">
                                        {!! Form::label('building_number', __('building_number'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('building_number', old('building_number'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('street_name', __('Street_name'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('street_name', old('street_name'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('region', __('region'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('region', old('region'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('city', __('city'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('city', old('city'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('country', __('Country'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('country', old('country'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('postal_code', __('postal_code'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('postal_code', old('postal_code'), ['class' => 'form-control']) !!}
                                    </div>

                                </div>

                                <div class="row">
                                    <h6 class="col-md-12">{{ __('Address_in_mother_country') }}</h6>
                                    <div class="form-group col-md-6">
                                        {!! Form::label('Address', __('Address'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('address', old('address'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('mother_city', __('city'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('mother_city', old('mother_city'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('mother_country', __('Country'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                        {!! Form::text('mother_country', old('mother_country'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <h6 class="col-md-12">{{ __('Emergency_contact') }}</h6>
                                    <div class="form-group col-md-3">
                                        {!! Form::label('emergency_contact_name', __('Name'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('emergency_contact_name', old('emergency_contact_name'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('emergency_contact_relationship', __('relationship'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('emergency_contact_relationship', old('emergency_contact_relationship'), [
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('emergency_contact_address', __('Address'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('emergency_contact_address', old('emergency_contact_address'), ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-md-3">
                                        {!! Form::label('emergency_contact_phone', __('Phone'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('emergency_contact_phone', old('emergency_contact_phone'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->type != 'employee')
                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" value="{{ __('Update') }}"
                                            class="btn btn-primary radius-10px float-right">
                                    </div>
                                </div>
                            @endif
                            {!! Form::close() !!}
                        </div>
                        <!--end::Card-->

                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('family_members') }}</h1>

                                                @if (auth()->user()->type != 'employee')
                                                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                        <!--begin::Primary button-->
                                                        <a href="#"
                                                            data-url="{{ route('followers.add', $employee->id) }}"
                                                            data-ajax-popup="true" data-title="{{ __('Create New') }}"
                                                            class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}
                                                        </a>
                                                        <!--end::Primary button-->
                                                    </div>
                                                @endif

                                                <!--end::Heading-->

                                                <!--begin::Block-->
                                                <div class="py-5">
                                                    <!--begin::Card-->
                                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                        <!--begin::Card header-->
                                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                            <!--begin::Card title-->
                                                            <div class="card-title">
                                                                <!--begin::Search-->
                                                                <div
                                                                    class="d-flex align-items-center position-relative my-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                    <span
                                                                        class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="17.0365"
                                                                                y="15.1223" width="8.15546"
                                                                                height="2" rx="1"
                                                                                transform="rotate(45 17.0365 15.1223)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    <input type="text" data-kt-filter="search"
                                                                        class="form-control form-control-solid w-250px ps-14"
                                                                        placeholder="{{ __('Search') }}">
                                                                </div>
                                                                <!--end::Search-->
                                                            </div>
                                                            <!--end::Card title-->

                                                            <!--begin::Card toolbar-->
                                                            <div
                                                                class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                                <!--begin::Export dropdown-->
                                                                <button type="button" class="btn btn-primary"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.3" width="12"
                                                                                height="2" rx="1"
                                                                                transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                                fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    {{ __('Export') }}
                                                                </button>
                                                                <!--begin::Menu-->
                                                                <div id="kt_datatable_example_export_menu"
                                                                    data-kt-menu="true"
                                                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                </div>
                                                                <!--end::Menu-->
                                                                <!--end::Export dropdown-->
                                                                <!--begin::Hide default export buttons-->
                                                                <div id="kt_datatable_example_buttons" class="d-none">
                                                                </div>
                                                                <!--end::Hide default export buttons->
                                                                                </div>
                                                                                <!==end::Card toolbar-->
                                                            </div>
                                                            <!--end::Card header-->
                                                            <br><br>

                                                            <!--begin::Card body-->
                                                            <div class="card-body">
                                                                <!--begin::Table-->
                                                                <table
                                                                    class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                    id="kt_datatable_example">
                                                                    <thead>
                                                                        <tr
                                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                            <th class="min-w-100px">{{ __('Name') }}
                                                                            </th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('residence_number') }}</th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('passport_number') }}</th>
                                                                            <th class="min-w-100px">{{ __('Attachment') }}
                                                                            </th>
                                                                            @if (auth()->user()->type != 'employee')
                                                                                <th class="min-w-100px">
                                                                                    {{ __('Action') }}</th>
                                                                            @endif
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="fw-semibold text-gray-600">
                                                                        @foreach ($employeeFollowers as $Follower)
                                                                            @php
                                                                                $documentPath = asset(Storage::url('uploads/documentUpload'));
                                                                            @endphp
                                                                            <tr>
                                                                                <td>{{ $Follower->name }}</td>
                                                                                <td>{{ $Follower->residence_number }}</td>
                                                                                <td>{{ $Follower->passport_number }}</td>
                                                                                <td>
                                                                                    @if (!empty($Follower->documents))
                                                                                        <a href="{{ $documentPath . '/' . $Follower->documents }}"
                                                                                            target="_blank">
                                                                                            <i class="fa fa-download"></i>
                                                                                        </a>
                                                                                    @else
                                                                                        <p>-</p>
                                                                                    @endif
                                                                                </td>
                                                                                @if (auth()->user()->type != 'employee')
                                                                                    <td class="text-right">
                                                                                        <a href="#"
                                                                                            class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                            data-url="{{ URL::to('followers/' . $Follower->id . '/edit') }}"
                                                                                            data-size="lg"
                                                                                            data-ajax-popup="true"
                                                                                            data-title="{{ __('Edit') }}"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Edit') }}"><i
                                                                                                class="fa fa-edit"></i></a>
                                                                                        <button type="button"
                                                                                            class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Delete') }}"><i
                                                                                                class="fa fa-trash"></i></button>
                                                                                        {!! Form::open([
                                                                                            'method' => 'DELETE',
                                                                                            'route' => ['followers.destroy', $Follower->id],
                                                                                            'id' => 'follower-form-' . $Follower->id,
                                                                                        ]) !!}
                                                                                        {!! Form::close() !!}
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end::Card body-->
                                                        </div>
                                                        <!--end::Card-->
                                                    </div>
                                                    <!--end::Block-->
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>

                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('qualifications') }}</h1>

                                                @if (auth()->user()->type != 'employee')
                                                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                        <!--begin::Primary button-->
                                                        <a href="#"
                                                            data-url="{{ route('qualifications.add', $employee->id) }}"
                                                            data-ajax-popup="true" data-title="{{ __('Create New') }}"
                                                            class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}
                                                        </a>
                                                        <!--end::Primary button-->
                                                    </div>
                                                @endif

                                                <!--end::Heading-->

                                                <!--begin::Block-->
                                                <div class="py-5">
                                                    <!--begin::Card-->
                                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                        <!--begin::Card header-->
                                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                            <!--begin::Card title-->
                                                            <div class="card-title">
                                                                <!--begin::Search-->
                                                                <div
                                                                    class="d-flex align-items-center position-relative my-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                    <span
                                                                        class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="17.0365"
                                                                                y="15.1223" width="8.15546"
                                                                                height="2" rx="1"
                                                                                transform="rotate(45 17.0365 15.1223)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    <input type="text" data-kt-filter="search"
                                                                        class="form-control form-control-solid w-250px ps-14"
                                                                        placeholder="{{ __('Search') }}">
                                                                </div>
                                                                <!--end::Search-->
                                                            </div>
                                                            <!--end::Card title-->

                                                            <!--begin::Card toolbar-->
                                                            <div
                                                                class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                                <!--begin::Export dropdown-->
                                                                <button type="button" class="btn btn-primary"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.3" width="12"
                                                                                height="2" rx="1"
                                                                                transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                                fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    {{ __('Export') }}
                                                                </button>
                                                                <!--begin::Menu-->
                                                                <div id="kt_datatable_example_export_menu"
                                                                    data-kt-menu="true"
                                                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                </div>
                                                                <!--end::Menu-->
                                                                <!--end::Export dropdown-->
                                                                <!--begin::Hide default export buttons-->
                                                                <div id="kt_datatable_example_buttons" class="d-none">
                                                                </div>
                                                                <!--end::Hide default export buttons->
                                                                                    </div>
                                                                                    <!==end::Card toolbar-->
                                                            </div>
                                                            <!--end::Card header-->
                                                            <br><br>

                                                            <!--begin::Card body-->
                                                            <div class="card-body">
                                                                <!--begin::Table-->
                                                                <table
                                                                    class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                    id="kt_datatable_example">
                                                                    <thead>
                                                                        <tr
                                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                            <th class="min-w-100px">{{ __('major') }}
                                                                            </th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('quakification_degree') }}</th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('institute_name') }}</th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('study_length') }}</th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('graduation_date') }}</th>
                                                                            @if (auth()->user()->type != 'employee')
                                                                                <th class="min-w-100px">
                                                                                    {{ __('Action') }}</th>
                                                                            @endif
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="fw-semibold text-gray-600">
                                                                        @foreach ($qualifications as $qualification)
                                                                            <tr>
                                                                                <td>{{ $qualification->major }}</td>
                                                                                <td>{{ $qualification->degree }}</td>
                                                                                <td>{{ $qualification->institute_name }}
                                                                                </td>
                                                                                <td>{{ $qualification->study_length }}</td>
                                                                                <td>{{ $qualification->graduation_date }}
                                                                                </td>
                                                                                @if (auth()->user()->type != 'employee')
                                                                                    <td class="text-right">
                                                                                        <a href="#"
                                                                                            class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                            data-url="{{ URL::to('qualifications/' . $qualification->id . '/edit') }}"
                                                                                            data-size="lg"
                                                                                            data-ajax-popup="true"
                                                                                            data-title="{{ __('Edit') }}"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Edit') }}"><i
                                                                                                class="fa fa-edit"></i></a>
                                                                                        <button type="button"
                                                                                            class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Delete') }}"><i
                                                                                                class="fa fa-trash"></i></button>
                                                                                        {!! Form::open([
                                                                                            'method' => 'DELETE',
                                                                                            'route' => ['qualifications.destroy', $qualification->id],
                                                                                            'id' => 'qualification-form-' . $qualification->id,
                                                                                        ]) !!}
                                                                                        {!! Form::close() !!}
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end::Card body-->
                                                        </div>
                                                        <!--end::Card-->
                                                    </div>
                                                    <!--end::Block-->
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                    </div>
                    <!--end:::Tab pane-->
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="employeeShifts" role="tabpanel">
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('shifts') }}</h1>
                                                @if (auth()->user()->type != 'employee')
                                                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                        <!--begin::Primary button-->
                                                        <a href="#"
                                                            data-url="{{ route('shifts.create', ['id' => $employee->user_id]) }}"
                                                            data-ajax-popup="true" data-title="{{ __('Create New') }}"
                                                            class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}
                                                        </a>
                                                        <!--end::Primary button-->
                                                    </div>
                                                @endif
                                                <!--end::Heading-->
                                                <!--begin::Block-->
                                                <div class="py-5">
                                                    <!--begin::Card-->
                                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                        <!--begin::Card header-->
                                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                            <!--begin::Card title-->
                                                            <div class="card-title">
                                                                <!--begin::Search-->
                                                                <div
                                                                    class="d-flex align-items-center position-relative my-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                    <span
                                                                        class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="17.0365"
                                                                                y="15.1223" width="8.15546"
                                                                                height="2" rx="1"
                                                                                transform="rotate(45 17.0365 15.1223)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    <input type="text" data-kt-filter="search"
                                                                        class="form-control form-control-solid w-250px ps-14"
                                                                        placeholder="{{ __('Search') }}">
                                                                </div>
                                                                <!--end::Search-->
                                                            </div>
                                                            <!--end::Card title-->

                                                            <!--begin::Card toolbar-->
                                                            <div
                                                                class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                                <!--begin::Export dropdown-->
                                                                <button type="button" class="btn btn-primary"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.3" width="12"
                                                                                height="2" rx="1"
                                                                                transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                                fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    {{ __('Export') }}
                                                                </button>
                                                                <!--begin::Menu-->
                                                                <div id="kt_datatable_example_export_menu"
                                                                    data-kt-menu="true"
                                                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                </div>
                                                                <!--end::Menu-->
                                                                <!--end::Export dropdown-->
                                                                <!--begin::Hide default export buttons-->
                                                                <div id="kt_datatable_example_buttons" class="d-none">
                                                                </div>
                                                                <!--end::Hide default export buttons->
                                                                                    </div>
                                                                                    <!==end::Card toolbar-->
                                                            </div>
                                                            <!--end::Card header-->
                                                            <br><br>

                                                            <!--begin::Card body-->
                                                            <div class="card-body">
                                                                <!--begin::Table-->
                                                                <table
                                                                    class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                    id="kt_datatable_example">
                                                                    <thead>
                                                                        <tr
                                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                            <th class="min-w-100px">{{ __('shifts') }}
                                                                            </th>
                                                                            <th class="min-w-100px">{{ __('Location') }}
                                                                            </th>
                                                                            <th class="min-w-100px">{{ __('Action') }}
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="fw-semibold text-gray-600">
                                                                        @foreach ($shifts as $shift)
                                                                            <tr>
                                                                                <td>{{ app()->isLocale('ar') ? $shift->shift_parent->name_ar : $shift->shift_parent->name }}
                                                                                </td>
                                                                                <td>{{ app()->isLocale('ar') ? $shift->place->name_ar : $shift->place->name }}
                                                                                </td>
                                                                                @if (auth()->user()->type != 'employee')
                                                                                    <td class="text-right">
                                                                                        <a href="#"
                                                                                            class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                            data-url="{{ route('shifts.edit', [$shift]) }}"
                                                                                            data-size="lg"
                                                                                            data-ajax-popup="true"
                                                                                            data-title="{{ __('Edit') }}"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Edit') }}"><i
                                                                                                class="fa fa-edit"></i></a>
                                                                                        <button type="button"
                                                                                            class="btn btn-icon delete-shift btn-active-light-danger w-30px h-30px"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Delete') }}"><i
                                                                                                class="fa fa-trash"></i></button>
                                                                                        {!! Form::open([
                                                                                            'method' => 'DELETE',
                                                                                            'route' => ['shifts.destroy', $shift->id],
                                                                                            'id' => 'e-shifts-form-' . $shift->id,
                                                                                        ]) !!}
                                                                                        {!! Form::close() !!}
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end::Card body-->
                                                        </div>
                                                        <!--end::Card-->
                                                    </div>
                                                    <!--end::Block-->
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                    </div>
                    <!--end:::Tab pane-->
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="organization_info" role="tabpanel">
                        <div class="card p-4 mb-6 mb-xl-12">
                            {{ Form::model($employee, ['route' => ['employee.update', $employee->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                            <input type="hidden" name="update_organization_info">

                            <div class="row">
                                <h5 class="col-md-12">{{ __('general_information') }}</h5>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('Join_date_gregorian', __('Join_date_gregorian'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('Join_date_gregorian', $employee->Join_date_gregorian, [
                                            'id' => 'gregorian_1',
                                            'class' => 'form-control gregorian-date',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('Join_date_hijri', __('Join_date_hijri'), [
                                            'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                        ]) !!}
                                        {!! Form::text('Join_date_hijri', old('Join_date_hijri'), [
                                            'id' => 'hijri_1',
                                            'class' => 'form-control hijri-date-input',
                                        ]) !!}
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    {{ Form::label('jobtitle_id', __('jobtitle'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                    {{ Form::select('jobtitle_id', $jobtitles, null, ['class' => 'form-control  select2']) }}
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('work_time', __('job_type'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('work_time', $job_types, null, ['class' => 'form-control  select2']) }}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('labor_hire_company', __('labor_hire_company'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                        {{ Form::select('labor_hire_company', $laborCompanies, null, ['class' => 'form-control']) }}
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    {{ Form::label('branch_id', __('Branch'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                    {{ Form::select('branch_id[]', $branches, $employee->branches->pluck('id'), ['class' => 'form-control select2 branch_ids', 'multiple', 'data-control' => 'select2']) }}
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('direct_manager', __('direct_manager'), ['class' => 'form-control-label']) }}
                                        {{ Form::select('direct_manager', $employees, null, ['class' => 'form-control ','placeholder' => __('No direct manager')]) }}
                                    </div>
                                </div>

                            </div>

                            @if (auth()->user()->type != 'employee')
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <input type="submit" value="{{ __('Update') }}"
                                            class="btn btn-primary radius-10px">
                                    </div>
                                </div>
                            @endif
                            {!! Form::close() !!}
                        </div>

                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('probation_periods_duration') }}</h1>
                                                <!--end::Heading-->

                                                @if ($employee->employee_on_probation == 1)
                                                    @if ($employee->probation_periods_status != 1)
                                                        @if (auth()->user()->type != 'employee')
                                                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                                <a href="#"
                                                                    class="confirm-delete btn btn-primary mt-4"
                                                                    data-toggle="tooltip">
                                                                    {{ __('finish_trial_period') }}
                                                                </a>
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['employee.destroy', $employee->id],
                                                                    'id' => 'finish_probationDuration-form-' . $employee->id,
                                                                ]) !!}
                                                                <input type="hidden" name="finish_probationDuration">
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <!--begin::Block-->
                                                    <div class="py-5">
                                                        <!--begin::Card-->
                                                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                            <!--begin::Card header-->
                                                            <div
                                                                class="card-header align-items-center py-5 gap-2 gap-md-5">

                                                                <!--begin::Card title-->
                                                                <div class="card-title">
                                                                    <!--begin::Search-->
                                                                    <div
                                                                        class="d-flex align-items-center position-relative my-1">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                        <span
                                                                            class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                            <svg width="24" height="24"
                                                                                viewbox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect opacity="0.5" x="17.0365"
                                                                                    y="15.1223" width="8.15546"
                                                                                    height="2" rx="1"
                                                                                    transform="rotate(45 17.0365 15.1223)"
                                                                                    fill="currentColor"></rect>
                                                                                <path
                                                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                                    fill="currentColor"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <!--end::Svg Icon-->
                                                                        <input type="text" data-kt-filter="search"
                                                                            class="form-control form-control-solid w-250px ps-14"
                                                                            placeholder="{{ __('Search') }}">
                                                                    </div>
                                                                    <!--end::Search-->
                                                                </div>
                                                                <!--end::Card title-->

                                                                <!--begin::Card toolbar-->
                                                                <div
                                                                    class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                                    <!--begin::Export dropdown-->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-kt-menu-trigger="click"
                                                                        data-kt-menu-placement="bottom-end">
                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                                        <span class="svg-icon svg-icon-2">
                                                                            <svg width="24" height="24"
                                                                                viewbox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect opacity="0.3" width="12"
                                                                                    height="2" rx="1"
                                                                                    transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                                    fill="currentColor"></rect>
                                                                                <path
                                                                                    d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                                    fill="currentColor"></path>
                                                                                <path opacity="0.3"
                                                                                    d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                                    fill="currentColor"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <!--end::Svg Icon-->
                                                                        {{ __('Export') }}
                                                                    </button>
                                                                    <!--begin::Menu-->
                                                                    <div id="kt_datatable_example_export_menu"
                                                                        data-kt-menu="true"
                                                                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                    </div>
                                                                    <!--end::Menu-->
                                                                    <!--end::Export dropdown-->
                                                                    <!--begin::Hide default export buttons-->
                                                                    <div id="kt_datatable_example_buttons" class="d-none">
                                                                    </div>
                                                                    <!--end::Hide default export buttons->
                                                                                                </div>
                                                                                                <!==end::Card toolbar-->
                                                                </div>
                                                                <!--end::Card header-->

                                                                <!--begin::Card body-->
                                                                <div class="card-body">
                                                                    <!--begin::Table-->
                                                                    <table
                                                                        class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                        id="kt_datatable_example">
                                                                        <thead>
                                                                            <tr
                                                                                class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_startdate_gregorian') }}
                                                                                </th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_enddate_gregorian') }}
                                                                                </th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('Status') }}</th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('Details') }}</th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('Action') }}</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="fw-semibold text-gray-600">
                                                                            <tr>
                                                                                <td>{{ Carbon\Carbon::parse($employee->Join_date_gregorian)->format('d-m-Y') }}
                                                                                </td>
                                                                                <td>{{ Carbon\Carbon::parse($employee->Join_date_gregorian)->addDays($employee->probation_periods_duration)->format('d-m-Y') }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($employee->probation_periods_status == 1)
                                                                                        {{ __('passed_trial_period') }}
                                                                                    @else
                                                                                        {{ __('under_trial_period') }}
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    {{ __('current_period') }}
                                                                                    {{ $employee->probation_periods_duration }}
                                                                                    {{ __('days') }}
                                                                                </td>
                                                                                <td class="text-right">
                                                                                    @if ($employee->probation_periods_status != 1)
                                                                                        <a href="#"
                                                                                            class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                            data-url="{{ URL::to('probation_periods/' . $employee->id) }}"
                                                                                            data-size="lg"
                                                                                            data-ajax-popup="true"
                                                                                            data-title="{{ __('Edit') }}"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Edit') }}"><i
                                                                                                class="fa fa-edit"></i></a>
                                                                                    @endif

                                                                                    <button type="button"
                                                                                        class="btn btn-icon confirm-delete-duration btn-active-light-danger w-30px h-30px"
                                                                                        data-toggle="tooltip"
                                                                                        data-original-title="{{ __('Delete') }}"><i
                                                                                            class="fa fa-trash"></i></button>
                                                                                    {!! Form::open([
                                                                                        'method' => 'DELETE',
                                                                                        'route' => ['employee.destroy', $employee->id],
                                                                                        'id' => 'delete-duration-form-' . $employee->id,
                                                                                    ]) !!}
                                                                                    <input type="hidden"
                                                                                        name="delete-duration">
                                                                                    {!! Form::close() !!}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <!--end::Table-->
                                                                </div>
                                                                <!--end::Card body-->

                                                            </div>
                                                            <!--end::Card-->
                                                        </div>
                                                        <!--end::Block-->
                                                    </div>
                                                    <!--end::Block-->
                                                @else
                                                    <div class="text-center">
                                                        <h5 class="text-center">
                                                            {{ __('not_probationary_period_for_this_employee') }} </h5>
                                                        @if (auth()->user()->type != 'employee')
                                                            <a id="btn-anchor" href="#"
                                                                data-url="{{ URL::to('probation_periods/' . $employee->id) }}"
                                                                data-size="lg" data-ajax-popup="true"
                                                                data-title="{{ __('Add_trial_period') }}"
                                                                class="btn btn-sm fw-bold btn-primary mb-4"
                                                                data-toggle="tooltip" data-original-title="">
                                                                {{ __('Add_trial_period') }} </a>
                                                        @endif
                                                    </div>
                                                @endif

                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>

                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('contract_duration') }}</h1>
                                                <!--end::Heading-->
                                                @if ($employeeContract)
                                                    <!--begin::Block-->
                                                    <div class="py-5">
                                                        <!--begin::Card-->
                                                        <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                            <!--begin::Card header-->
                                                            <div
                                                                class="card-header align-items-center py-5 gap-2 gap-md-5">

                                                                <!--begin::Card title-->
                                                                <div class="card-title">
                                                                    <!--begin::Search-->
                                                                    <div
                                                                        class="d-flex align-items-center position-relative my-1">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                        <span
                                                                            class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                            <svg width="24" height="24"
                                                                                viewbox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect opacity="0.5" x="17.0365"
                                                                                    y="15.1223" width="8.15546"
                                                                                    height="2" rx="1"
                                                                                    transform="rotate(45 17.0365 15.1223)"
                                                                                    fill="currentColor"></rect>
                                                                                <path
                                                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                                    fill="currentColor"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <!--end::Svg Icon-->
                                                                        <input type="text" data-kt-filter="search"
                                                                            class="form-control form-control-solid w-250px ps-14"
                                                                            placeholder="{{ __('Search') }}">
                                                                    </div>
                                                                    <!--end::Search-->
                                                                </div>
                                                                <!--end::Card title-->

                                                                <!--begin::Card toolbar-->
                                                                <div
                                                                    class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                                    <!--begin::Export dropdown-->
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-kt-menu-trigger="click"
                                                                        data-kt-menu-placement="bottom-end">
                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                                        <span class="svg-icon svg-icon-2">
                                                                            <svg width="24" height="24"
                                                                                viewbox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect opacity="0.3" width="12"
                                                                                    height="2" rx="1"
                                                                                    transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                                    fill="currentColor"></rect>
                                                                                <path
                                                                                    d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                                    fill="currentColor"></path>
                                                                                <path opacity="0.3"
                                                                                    d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                                    fill="currentColor"></path>
                                                                            </svg>
                                                                        </span>
                                                                        <!--end::Svg Icon-->
                                                                        {{ __('Export') }}
                                                                    </button>
                                                                    <!--begin::Menu-->
                                                                    <div id="kt_datatable_example_export_menu"
                                                                        data-kt-menu="true"
                                                                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                        <!--begin::Menu item-->
                                                                        <div class="menu-item px-3">
                                                                            <a href="#" class="menu-link px-3"
                                                                                data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                                        </div>
                                                                        <!--end::Menu item-->
                                                                    </div>
                                                                    <!--end::Menu-->
                                                                    <!--end::Export dropdown-->
                                                                    <!--begin::Hide default export buttons-->
                                                                    <div id="kt_datatable_example_buttons" class="d-none">
                                                                    </div>
                                                                    <!--end::Hide default export buttons->
                                                                                                </div>
                                                                                                <!==end::Card toolbar-->
                                                                </div>
                                                                <!--end::Card header-->

                                                                <!--begin::Card body-->
                                                                <div class="card-body">
                                                                    <!--begin::Table-->
                                                                    <table
                                                                        class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                        id="kt_datatable_example">
                                                                        <thead>
                                                                            <tr
                                                                                class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_type') }}</th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_duration') }}</th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_startdate_gregorian') }}
                                                                                </th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_startdate_Hijri') }}
                                                                                </th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_enddate_gregorian') }}
                                                                                </th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_enddate_Hijri') }}
                                                                                </th>
                                                                                <th class="min-w-100px">
                                                                                    {{ __('contract_document') }}</th>
                                                                                @if (auth()->user()->type != 'employee')
                                                                                    @if (Gate::check('Edit Employee'))
                                                                                        <th class="min-w-100px">
                                                                                            {{ __('Action') }}</th>
                                                                                    @endif
                                                                                @endif
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="fw-semibold text-gray-600">
                                                                            <tr>

                                                                                <td>{{ $employeeContract->contract_type == 1 ? __('limited_time') : __('unlimited_time') }}
                                                                                </td>
                                                                                <td>{{ $employeeContract->contract_duration }}
                                                                                    {{ __('year') }}</td>
                                                                                <td>{{ $employeeContract->contract_startdate }}
                                                                                </td>
                                                                                <td>{{ $employeeContract->contract_startdate_hijri }}
                                                                                </td>
                                                                                <td>{{ $employeeContract->contract_enddate }}
                                                                                </td>
                                                                                <td>{{ $employeeContract->contract_enddate_hijri }}
                                                                                </td>
                                                                                <td>
                                                                                    @if (!empty($employeeContract->contract_document))
                                                                                        <a href=" {{ asset(Storage::url('uploads/document/' . $employeeContract->contract_document)) }}"
                                                                                            target="_blank">
                                                                                            <i class="fa fa-download"></i>
                                                                                        </a>
                                                                                    @else
                                                                                        <p>-</p>
                                                                                    @endif
                                                                                </td>
                                                                                @if (auth()->user()->type != 'employee')
                                                                                    <td class="text-right">
                                                                                        @if ($employee->probation_periods_status != 1)
                                                                                            <a href="#"
                                                                                                class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                                data-url="{{ URL::to('contracts/' . $employeeContract->id . '/edit') }}"
                                                                                                data-size="lg"
                                                                                                data-ajax-popup="true"
                                                                                                data-title="{{ __('Edit') }}"
                                                                                                data-toggle="tooltip"
                                                                                                data-original-title="{{ __('Edit') }}"><i
                                                                                                    class="fa fa-edit"></i></a>
                                                                                        @endif

                                                                                        <button type="button"
                                                                                            class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Delete') }}"><i
                                                                                                class="fa fa-trash"></i></button>
                                                                                        {!! Form::open([
                                                                                            'method' => 'DELETE',
                                                                                            'route' => ['contracts.destroy', $employeeContract->id],
                                                                                            'id' => 'delete-contract-form-' . $employeeContract->id,
                                                                                        ]) !!}
                                                                                        {!! Form::close() !!}
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <!--end::Table-->
                                                                </div>
                                                                <!--end::Card body-->

                                                            </div>
                                                            <!--end::Card-->
                                                        </div>
                                                        <!--end::Block-->
                                                    </div>
                                                    <!--end::Block-->
                                                @else
                                                    <div class="text-center">
                                                        <h5 class="text-center"> {{ __('No_contract_added') }} </h5>
                                                        @if (auth()->user()->type != 'employee')
                                                            <a id="btn-anchor" href="#"
                                                                data-url="{{ URL::to('contract/create/' . $employee->id) }}"
                                                                data-size="lg" data-ajax-popup="true"
                                                                data-title="{{ __('Add_Contract') }}"
                                                                class="btn btn-sm fw-bold btn-primary mb-4"
                                                                data-toggle="tooltip"
                                                                data-original-title="{{ __('Add_Contract') }}">
                                                                {{ __('Add_Contract') }} </a>
                                                        @endif
                                                    </div>
                                                @endif

                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>

                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="financial" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="card">
                                {{ Form::model($employee, ['route' => ['employee.update', $employee->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                                @csrf
                                <input type="hidden" name="update_financial_info">
                                <div class="card col-md-12">
                                    <div class="row">
                                        <h5 class="col-md-12">{{ __('Financial') }}</h5>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::label('salary', __('basic_salary'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                                {!! Form::text('salary', old('salary'), ['class' => 'form-control wizard-required']) !!}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>



                                        <div class="col-md-12 paymentDetails">
                                            {{ Form::label('Payment_details', __('Payment_details'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cash" value="cash"
                                                        @if ($employee->payment_type == 'cash') checked @endif
                                                        name="payment_type" class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="cash">{{ __('cash') }}</label>
                                                </div>
                                            </div>

                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="bank" value="bank"
                                                        @if ($employee->payment_type == 'bank') checked @endif
                                                        name="payment_type" class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="bank">{{ __('bank') }}</label>
                                                </div>
                                            </div>

                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="cheque" value="cheque"
                                                        @if ($employee->payment_type == 'cheque') checked @endif
                                                        name="payment_type" class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="cheque">{{ __('cheque') }}</label>
                                                </div>
                                            </div>

                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="international_transfer"
                                                        @if ($employee->payment_type == 'international_transfer') checked @endif
                                                        value="international_transfer" name="payment_type"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="international_transfer">{{ __('international_transfer') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="display:none;" id="paymentContent" class="col-md-12">
                                            <div style="display:none;" id="bankDetails" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div style="margin-top: 15%;" class="form-group">
                                                            {{ Form::label('employee_account_type', __('employee_account_type'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                            {{ Form::select('employee_account_type', ['0' => __('IBAN')], null, ['class' => 'form-control ', 'id' => 'employee_account_type']) }}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div style="display:none;" id="IBAN_number_info"
                                                            class="form-group">
                                                            {!! Form::label('IBAN_number', __('IBAN_number'), [
                                                                'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                            ]) !!}
                                                            {!! Form::text('bank_IBAN_number', old('bank_IBAN_number'), ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div id="salary_card_number_info" class="form-group">
                                                            {!! Form::label('salary_card_number', __('salary_card_number'), [
                                                                'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                            ]) !!}
                                                            {!! Form::text('salary_card_number', old('salary_card_number'), ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div class="form-group">
                                                            {{ Form::label('bank_id', __('bank_name'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                            {{ Form::select('bank_id', $banks, null, ['class' => 'form-control ']) }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div style="display:none;padding: 2%;" id="internationalTransferDetails"
                                                class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {{ Form::label('bank_name', __('bank_name'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('bank_name', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('account_holder_name', __('account_holder_name'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('account_holder_name', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('account_holder_name_ar', __('account_holder_name_ar'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('account_holder_name_ar', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('branch_location', __('branch_name'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('branch_location', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('branch_location_ar', __('branch_name_ar'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('branch_location_ar', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('swift_code', __('swift_code'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('swift_code', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('sort_code', __('sort_code'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('sort_code', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('bank_country', __('country'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('bank_country', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('account_number', __('bank_account_number'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('account_number', null, ['class' => 'form-control ']) }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ Form::label('IBAN_number', __('IBAN_number'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                        {{ Form::text('IBAN_number', null, ['class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="optional-toggle">

                                        </div>

                                        <div class="row">
                                            <h6 class="col-md-12">{{ __('insurance') }}</h6>

                                            <div class="form-group col-md-4">
                                                {!! Form::label('insurance_number', __('insurance_number'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::text('insurance_number', old('insurance_number'), ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                {!! Form::label('policy_number', __('Policy_number'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::text('policy_number', old('policy_number'), ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                {!! Form::label('insurance_startdate', __('insurance_startdate'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::text('insurance_startdate', $employee->insurance_startdate, [
                                                    'class' => 'form-control gregorian-date',
                                                ]) !!}
                                            </div>



                                            <div class="form-group col-md-4">
                                                {!! Form::label('cost', __('Cost'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}
                                                {!! Form::text('cost', old('cost'), ['class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                {!! Form::label('availability_health_insurance_council', __('availability_health_insurance_council'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::text('availability_health_insurance_council', $employee->availability_health_insurance_council, [
                                                    'class' => 'form-control gregorian-date',
                                                ]) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                {!! Form::label('health_insurance_council_startdate', __('health_insurance_council_startdate'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::text('health_insurance_council_startdate', $employee->health_insurance_council_startdate, [
                                                    'class' => 'form-control gregorian-date',
                                                ]) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                {!! Form::label('insurance_document', __('add_attachment'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::file('insurance_document', ['class' => 'form-control']) !!}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @if (auth()->user()->type != 'employee')
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="submit" value="{{ __('Update') }}"
                                                class="btn btn-primary radius-10px float-right">
                                        </div>
                                    </div>
                                @endif
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="assets" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('assets') }}</h1>

                                                @if (auth()->user()->type != 'employee')
                                                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                        <!--begin::Primary button-->
                                                        <a href="#"
                                                            data-url="{{ route('account-assets.create') }}?employee_id={{ $employee->id }}"
                                                            data-ajax-popup="true" data-title="{{ __('Create New') }}"
                                                            class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}
                                                        </a>
                                                        <!--end::Primary button-->
                                                    </div>
                                                @endif

                                                <!--end::Heading-->

                                                <!--begin::Block-->
                                                <div class="py-5">
                                                    <!--begin::Card-->
                                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                        <!--begin::Card header-->
                                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                            <!--begin::Card title-->
                                                            <div class="card-title">
                                                                <!--begin::Search-->
                                                                <div
                                                                    class="d-flex align-items-center position-relative my-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                    <span
                                                                        class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="17.0365"
                                                                                y="15.1223" width="8.15546"
                                                                                height="2" rx="1"
                                                                                transform="rotate(45 17.0365 15.1223)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    <input type="text" data-kt-filter="search"
                                                                        class="form-control form-control-solid w-250px ps-14"
                                                                        placeholder="{{ __('Search') }}">
                                                                </div>
                                                                <!--end::Search-->
                                                            </div>
                                                            <!--end::Card title-->

                                                            <!--begin::Card toolbar-->
                                                            <div
                                                                class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                                <!--begin::Export dropdown-->
                                                                <button type="button" class="btn btn-primary"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.3" width="12"
                                                                                height="2" rx="1"
                                                                                transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                                fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    {{ __('Export') }}
                                                                </button>
                                                                <!--begin::Menu-->
                                                                <div id="kt_datatable_example_export_menu"
                                                                    data-kt-menu="true"
                                                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                </div>
                                                                <!--end::Menu-->
                                                                <!--end::Export dropdown-->
                                                                <!--begin::Hide default export buttons-->
                                                                <div id="kt_datatable_example_buttons" class="d-none">
                                                                </div>
                                                                <!--end::Hide default export buttons->
                                                                                        </div>
                                                                                        <!==end::Card toolbar-->
                                                            </div>
                                                            <!--end::Card header-->
                                                            <br><br>

                                                            <!--begin::Card body-->
                                                            <div class="card-body">
                                                                <!--begin::Table-->
                                                                <table
                                                                    class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                    id="kt_datatable_example">
                                                                    <thead>
                                                                        <tr
                                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                            <th class="min-w-100px"> {{ __('Name') }}
                                                                            </th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('Purchase Date') }}</th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('Support Until') }}</th>
                                                                            <th class="min-w-100px"> {{ __('Amount') }}
                                                                            </th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('Description') }}</th>
                                                                            @if (Gate::check('Edit Assets') || Gate::check('Delete Assets'))
                                                                                <th class="min-w-100px">
                                                                                    {{ __('Action') }}</th>
                                                                            @endif
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="fw-semibold text-gray-600">
                                                                        @foreach ($assets as $asset)
                                                                            <tr>
                                                                                <td class="font-style">
                                                                                    {{ $asset->name }}</td>
                                                                                <td class="font-style">
                                                                                    {{ auth()->user()->dateFormat($asset->purchase_date) }}
                                                                                </td>
                                                                                <td class="font-style">
                                                                                    {{ auth()->user()->dateFormat($asset->supported_date) }}
                                                                                </td>
                                                                                <td class="font-style">
                                                                                    {{ auth()->user()->priceFormat($asset->amount) }}
                                                                                </td>
                                                                                <td class="font-style">
                                                                                    {{ $asset->description }}</td>
                                                                                @if (auth()->user()->type != 'employee')
                                                                                    @if (Gate::check('Edit Assets') || Gate::check('Delete Assets'))
                                                                                        <td class="text-right">
                                                                                            @can('Edit Assets')
                                                                                                <a href="#"
                                                                                                    class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                                    data-url="{{ route('account-assets.edit', $asset->id) }}"
                                                                                                    data-size="lg"
                                                                                                    data-ajax-popup="true"
                                                                                                    data-title="{{ __('Edit') }}"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-original-title="{{ __('Edit') }}"><i
                                                                                                        class="fa fa-edit"></i></a>
                                                                                            @endcan

                                                                                            @can('Delete Assets')
                                                                                                <button type="button"
                                                                                                    class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-original-title="{{ __('Delete') }}"><i
                                                                                                        class="fa fa-trash"></i></button>
                                                                                                {!! Form::open([
                                                                                                    'method' => 'DELETE',
                                                                                                    'route' => ['account-assets.destroy', $asset->id],
                                                                                                    'id' => 'delete-asset-form-' . $asset->id,
                                                                                                ]) !!}
                                                                                                {!! Form::close() !!}
                                                                                            @endcan
                                                                                        </td>
                                                                                    @endif
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end::Card body-->
                                                        </div>
                                                        <!--end::Card-->
                                                    </div>
                                                    <!--end::Block-->
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="statistics" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('Statistics') }}</h1>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <!--begin::Card Body-->
                                                        <div
                                                            class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700 mb-5">
                                                            @push('style')
                                                                <style>
                                                                    .newchart {
                                                                        height: 60vh;
                                                                        position: relative
                                                                    }

                                                                    .chartcolumn {
                                                                        width: 70px;
                                                                        display: inline-block;
                                                                        margin-right: 10px;
                                                                        margin-left: 10px;
                                                                        position: relative;
                                                                    }

                                                                    .columnone {
                                                                        background: #D2F9C5;
                                                                    }

                                                                    .columntwo {
                                                                        background: #F68472;
                                                                    }

                                                                    .columnthree {
                                                                        background: #75D1E0;
                                                                    }

                                                                    .columnfour {
                                                                        background: #FFE074;
                                                                    }

                                                                    .spancolumn {
                                                                        position: absolute;
                                                                        bottom: 50px;
                                                                        left: 0;
                                                                        transform: rotate(-90deg);
                                                                        display: flex;
                                                                        margin-top: 37px;
                                                                    }
                                                                </style>
                                                            @endpush
                                                            <div class="newchart">
                                                                @php
                                                                    $totaldelay = $employee->getEmployeeDelays(0, 15) + $employee->getEmployeeDelays(16, 30) + $employee->getEmployeeDelays(31, 60) + $employee->getEmployeeDelays(61, null);
                                                                    $totalovertime = $employee->getEmployeeOverTimes(0, 15) + $employee->getEmployeeOverTimes(16, 30) + $employee->getEmployeeOverTimes(31, 60) + $employee->getEmployeeOverTimes(61, null);
                                                                    $totalabsence = count($absences);
                                                                    $totalleaves = count($employee->getCurrentYearLeaves());
                                                                @endphp
                                                                <div
                                                                    style="height: 100%;bottom: 0;left: 0;display: flex;justify-content: flex-end;align-items: flex-end;overflow:hidden;">
                                                                    <div class="chartcolumn columnone"
                                                                        style="height:{{ $totaldelay * 10 == 0 ? 5 : $totaldelay * 10 }}%">
                                                                        <span class="spancolumn">{{ __('Delay') }}
                                                                            <strong
                                                                                style="font-weight: 700;margin-inline-start: 7px;">{{ $totaldelay }}</strong>
                                                                        </span>
                                                                    </div>
                                                                    <div class="chartcolumn columntwo"
                                                                        style="height:{{ $totalovertime * 10 == 0 ? 5 : $totalovertime * 10 }}%">
                                                                        <span
                                                                            class="spancolumn">{{ __('Attendance OverTime') }}
                                                                            <strong
                                                                                style="font-weight: 700;margin-inline-start: 7px;">{{ $totalovertime }}</strong></span>
                                                                    </div>
                                                                    <div class="chartcolumn columnthree"
                                                                        style="height:{{ $totalabsence * 10 == 0 ? 5 : $totalabsence * 10 }}%;">
                                                                        <span class="spancolumn">{{ __('Absence') }}
                                                                            <strong
                                                                                style="font-weight: 700;margin-inline-start: 7px;">{{ $totalabsence }}</strong></span>
                                                                    </div>
                                                                    <div class="chartcolumn columnfour"
                                                                        style="height:{{ $totalleaves * 10 == 0 ? 5 : $totalleaves * 10 }}%">
                                                                        <span class="spancolumn">{{ __('Leaves') }}
                                                                            <strong
                                                                                style="font-weight: 700;margin-inline-start: 7px;">{{ $totalleaves }}</strong></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--begin::Card Body-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card card-docs flex-row-fluid mb-2">
                                                            <!--begin::Card Body-->
                                                            <div
                                                                class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                                                <!--begin::Section-->
                                                                <div class="py-0 text-center">
                                                                    <!--begin::Heading-->
                                                                    <h4 class="fw-bold mb-5"> {{ __('Delays') }} </h4>

                                                                    <!--end::Heading-->

                                                                    <!--begin::Block-->
                                                                    <div class="py-5">
                                                                        <!--begin::Card-->
                                                                        <div
                                                                            class="card card-p-0 card-flush border-0 bg-transparent">
                                                                            <!--begin::Card header-->
                                                                            <div
                                                                                class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                                                <!--begin::Card body-->
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="project-info d-flex text-sm">

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 0 - 15 m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeDelays(0, 15) }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 16 - 30 m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeDelays(16, 30) }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 31 - 60 m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeDelays(31, 60) }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 61 - ... m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeDelays(61, null) }}
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <!--end::Card body-->
                                                                            </div>
                                                                            <!--end::Card-->
                                                                        </div>
                                                                        <!--end::Block-->
                                                                    </div>
                                                                    <!--end::Section-->
                                                                </div>
                                                                <!--end::Card Body-->
                                                            </div>
                                                            <!--end::Card-->
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="card card-docs flex-row-fluid mb-2">
                                                            <!--begin::Card Body-->
                                                            <div
                                                                class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                                                <!--begin::Section-->
                                                                <div class="py-0 text-center">
                                                                    <!--begin::Heading-->
                                                                    <h4 class="fw-bold mb-5">
                                                                        {{ __('Attendance OverTime') }} </h4>

                                                                    <!--end::Heading-->

                                                                    <!--begin::Block-->
                                                                    <div class="py-5">
                                                                        <!--begin::Card-->
                                                                        <div
                                                                            class="card card-p-0 card-flush border-0 bg-transparent">
                                                                            <!--begin::Card header-->
                                                                            <div
                                                                                class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                                                <!--begin::Card body-->
                                                                                <div class="card-body">
                                                                                    <div
                                                                                        class="project-info d-flex text-sm">

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 0 - 15 m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeOverTimes(0, 15) }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 16 - 30 m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeOverTimes(16, 30) }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 31 - 60 m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeOverTimes(31, 60) }}
                                                                                            </div>
                                                                                        </div>

                                                                                        <div
                                                                                            class="project-info-inner mr-3 col-3">
                                                                                            <b class="m-0"> 61 - ... m
                                                                                            </b>
                                                                                            <div
                                                                                                class="project-amnt pt-1">
                                                                                                {{ $employee->getEmployeeOverTimes(61, null) }}
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <!--end::Card body-->
                                                                            </div>
                                                                            <!--end::Card-->
                                                                        </div>
                                                                        <!--end::Block-->
                                                                    </div>
                                                                    <!--end::Section-->
                                                                </div>
                                                                <!--end::Card Body-->
                                                            </div>
                                                            <!--end::Card-->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="card card-docs flex-row-fluid mb-2">
                                                            <!--begin::Card Body-->
                                                            <div
                                                                class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                                                <!--begin::Section-->
                                                                <div class="py-0">
                                                                    <!--begin::Heading-->
                                                                    <h1 class="fw-bold mb-5">{{ __('Absences') }}</h1>



                                                                    <!--end::Heading-->

                                                                    <!--begin::Block-->
                                                                    <div class="py-5">
                                                                        <!--begin::Card-->
                                                                        <div
                                                                            class="card card-p-0 card-flush border-0 bg-transparent">
                                                                            <!--begin::Card header-->
                                                                            <div
                                                                                class="card-header align-items-center py-5 gap-2 gap-md-5">




                                                                                <!--begin::Card body-->
                                                                                <div class="card-body">
                                                                                    <!--begin::Table-->
                                                                                    <table
                                                                                        class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                                        id="kt_datatable_example">
                                                                                        <thead>
                                                                                            <tr
                                                                                                class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                                                <th class="min-w-100px">
                                                                                                    {{ __('Absent Type') }}
                                                                                                </th>
                                                                                                <th class="min-w-100px">
                                                                                                    {{ __('Number of days') }}
                                                                                                </th>
                                                                                                <th class="min-w-100px">
                                                                                                    {{ __('Start Date') }}
                                                                                                </th>
                                                                                                <th class="min-w-100px">
                                                                                                    {{ __('Action') }}
                                                                                                </th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody
                                                                                            class="fw-semibold text-gray-600">
                                                                                            @foreach ($absences as $absence)
                                                                                                <tr>
                                                                                                    <td>{{ $absence->leave != null ? (app()->isLocale('en') ? $absence->leave->leaveType->title : $absence->leave->leaveType->title_ar) : '' }}
                                                                                                    </td>
                                                                                                    <td>{{ $absence->number_of_days }}
                                                                                                    </td>
                                                                                                    <td>{{ $absence->start_date }}
                                                                                                    </td>
                                                                                                    <td
                                                                                                        class="Action text-center">
                                                                                                        <span>
                                                                                                            @can('Edit
                                                                                                                Overtime')
                                                                                                                <a href="#"
                                                                                                                    class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                                                    data-url="{{ URL::to('absence/' . $absence->id . '/edit') }}"
                                                                                                                    data-size="lg"
                                                                                                                    data-ajax-popup="true"
                                                                                                                    data-title="{{ __('Edit') }}"
                                                                                                                    data-toggle="tooltip"
                                                                                                                    data-original-title="{{ __('Edit') }}"><i
                                                                                                                        class="fa fa-edit"></i></a>
                                                                                                            @endcan

                                                                                                            @can('Delete
                                                                                                                Overtime')
                                                                                                                <button
                                                                                                                    type="button"
                                                                                                                    class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px"
                                                                                                                    data-toggle="tooltip"
                                                                                                                    data-original-title="{{ __('Delete') }}"><i
                                                                                                                        class="fa fa-trash"></i></button>
                                                                                                                {!! Form::open([
                                                                                                                    'method' => 'DELETE',
                                                                                                                    'route' => ['absence.destroy', $absence->id],
                                                                                                                    'id' => 'absence-delete-form-' . $absence->id,
                                                                                                                ]) !!}
                                                                                                                {!! Form::close() !!}
                                                                                                            @endcan

                                                                                                        </span>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!--end::Table-->
                                                                                </div>
                                                                                <!--end::Card body-->
                                                                            </div>
                                                                            <!--end::Card-->
                                                                        </div>
                                                                        <!--end::Block-->
                                                                    </div>
                                                                    <!--end::Section-->
                                                                </div>
                                                                <!--end::Card Body-->
                                                            </div>
                                                            <!--end::Card-->
                                                        </div>
                                                    </div>

                                                </div>

                                                <!--end::Heading-->


                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="documents" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
                                <!--begin::Container-->
                                <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                                    <!--begin::Card-->
                                    <div class="card card-docs flex-row-fluid mb-2">
                                        <!--begin::Card Body-->
                                        <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                            <!--begin::Section-->
                                            <div class="py-0">
                                                <!--begin::Heading-->
                                                <h1 class="fw-bold mb-5">{{ __('Documents') }}</h1>

                                                @if (auth()->user()->type != 'employee')
                                                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                        <!--begin::Primary button-->
                                                        <a href="#"
                                                            data-url="{{ route('document-upload.create') }}?employee_id={{ $employee->id }}"
                                                            data-ajax-popup="true" data-title="{{ __('Create New') }}"
                                                            class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}
                                                        </a>
                                                        <!--end::Primary button-->
                                                    </div>
                                                @endif

                                                <!--end::Heading-->

                                                <!--begin::Block-->
                                                <div class="py-5">
                                                    <!--begin::Card-->
                                                    <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                        <!--begin::Card header-->
                                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                            <!--begin::Card title-->
                                                            <div class="card-title">
                                                                <!--begin::Search-->
                                                                <div
                                                                    class="d-flex align-items-center position-relative my-1">
                                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                    <span
                                                                        class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.5" x="17.0365"
                                                                                y="15.1223" width="8.15546"
                                                                                height="2" rx="1"
                                                                                transform="rotate(45 17.0365 15.1223)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    <input type="text" data-kt-filter="search"
                                                                        class="form-control form-control-solid w-250px ps-14"
                                                                        placeholder="{{ __('Search') }}">
                                                                </div>
                                                                <!--end::Search-->
                                                            </div>
                                                            <!--end::Card title-->

                                                            <!--begin::Card toolbar-->
                                                            <div
                                                                class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                                <!--begin::Export dropdown-->
                                                                <button type="button" class="btn btn-primary"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg width="24" height="24"
                                                                            viewbox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <rect opacity="0.3" width="12"
                                                                                height="2" rx="1"
                                                                                transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                                fill="currentColor"></rect>
                                                                            <path
                                                                                d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                                fill="currentColor"></path>
                                                                            <path opacity="0.3"
                                                                                d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                    {{ __('Export') }}
                                                                </button>
                                                                <!--begin::Menu-->
                                                                <div id="kt_datatable_example_export_menu"
                                                                    data-kt-menu="true"
                                                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                    <!--begin::Menu item-->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3"
                                                                            data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                                    </div>
                                                                    <!--end::Menu item-->
                                                                </div>
                                                                <!--end::Menu-->
                                                                <!--end::Export dropdown-->
                                                                <!--begin::Hide default export buttons-->
                                                                <div id="kt_datatable_example_buttons" class="d-none">
                                                                </div>
                                                                <!--end::Hide default export buttons->
                                                                                        </div>
                                                                                        <!==end::Card toolbar-->
                                                            </div>
                                                            <!--end::Card header-->
                                                            <br><br>

                                                            <!--begin::Card body-->
                                                            <div class="card-body">
                                                                <!--begin::Table-->
                                                                <table
                                                                    class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                    id="kt_datatable_example">
                                                                    <thead>
                                                                        <tr
                                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                            <th class="min-w-100px">{{ __('Name') }}
                                                                            </th>
                                                                            <th class="min-w-100px">{{ __('Document') }}
                                                                            </th>
                                                                            <th class="min-w-100px">{{ __('Role') }}
                                                                            </th>
                                                                            <th class="min-w-100px">
                                                                                {{ __('Description') }}</th>
                                                                            @if (Gate::check('Edit Document') || Gate::check('Delete Document'))
                                                                                <th class="min-w-100px">
                                                                                    {{ __('Action') }}</th>
                                                                            @endif
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="fw-semibold text-gray-600">
                                                                        @foreach ($documents as $document)
                                                                            @php
                                                                                $documentPath = asset(Storage::url('uploads/documentUpload'));
                                                                                $roles = \Spatie\Permission\Models\Role::find($document->role);
                                                                            @endphp
                                                                            <tr>
                                                                                <td>{{ $document->name }}</td>
                                                                                <td>
                                                                                    @if (!empty($document->document))
                                                                                        <a href="{{ $documentPath . '/' . $document->document }}"
                                                                                            download>
                                                                                            <i class="fa fa-download"></i>
                                                                                        </a>

                                                                                        <a href="{{ $documentPath . '/' . $document->document }}"
                                                                                            target="_blank">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </a>
                                                                                    @else
                                                                                        <p>-</p>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ !empty($roles) ? $roles->name : 'All' }}
                                                                                </td>
                                                                                <td>{{ $document->description }}</td>
                                                                                @if (auth()->user()->type != 'employee')
                                                                                    @if (Gate::check('Edit Document') || Gate::check('Delete Document'))
                                                                                        <td class="text-right">
                                                                                            @can('Edit Document')
                                                                                                <a href="#"
                                                                                                    class="btn btn-icon btn-active-light-success w-30px h-30px"
                                                                                                    data-url="{{ route('document-upload.edit', $document->id) }}"
                                                                                                    data-size="lg"
                                                                                                    data-ajax-popup="true"
                                                                                                    data-title="{{ __('Edit') }}"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-original-title="{{ __('Edit') }}"><i
                                                                                                        class="fa fa-edit"></i></a>
                                                                                            @endcan

                                                                                            @can('Delete Document')
                                                                                                <button type="button"
                                                                                                    class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-original-title="{{ __('Delete') }}"><i
                                                                                                        class="fa fa-trash"></i></button>
                                                                                                {!! Form::open([
                                                                                                    'method' => 'DELETE',
                                                                                                    'route' => ['document-upload.destroy', $document->id],
                                                                                                    'id' => 'delete-document-form-' . $document->id,
                                                                                                ]) !!}
                                                                                                {!! Form::close() !!}
                                                                                            @endcan
                                                                                        </td>
                                                                                    @endif
                                                                                @endif
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end::Card body-->
                                                        </div>
                                                        <!--end::Card-->
                                                    </div>
                                                    <!--end::Block-->
                                                </div>
                                                <!--end::Section-->
                                            </div>
                                            <!--end::Card Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Container-->
                                </div>
                                <!--end::Content-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="attendance" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="card">
                                <h2 class="text-center">{{ __('attendance') }}</h2>
                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="table-responsive py-4 attendance-table-responsive">
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="active">{{ __('Name') }}</th>
                                                            @foreach ($dates as $date)
                                                                <th>{{ explode('/', $date)[2] }}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($employeesAttendance as $attendance)
                                                            <tr>
                                                                <td>{{ $attendance['name'] }}</td>
                                                                @foreach ($attendance['status'] as $key => $status)
                                                                    <td>
                                                                        @if ($status == 'P')
                                                                            <span style="color:#28a745!important"> <b> P
                                                                                </b> </span>
                                                                        @elseif(in_array(explode('-', $key)[1], explode(',', $setting->week_vacations ?? '')))
                                                                            <span style="color:#424443!important"> <b> O
                                                                                </b> </span>
                                                                        @elseif(in_array(date('Y-m-d', strtotime(explode('-', $key)[0])), $holidays ?? []))
                                                                            <span style="color:#377424!important"> <b> H
                                                                                </b> </span>
                                                                        @elseif($status == 'A')
                                                                            <span style="color:#990001!important"> <b> A
                                                                                </b> </span>
                                                                        @elseif($status == 'V')
                                                                            <span style="color:#786301!important"> <b> V
                                                                                </b> </span>
                                                                        @elseif($status == 'S')
                                                                            <span style="color:#C09000!important"> <b> S
                                                                                </b> </span>
                                                                        @elseif($status == 'X')
                                                                            <span style="color:#CC4025!important"> <b> X
                                                                                </b> </span>
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->


                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="breaks" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="card">
                                <h2 class="text-center">{{ __('Breaks') }}</h2>
                                <div class="row">
                                    <div class="col">
                                        <div class="card">

                                            <div class="table-responsive py-4 attendance-table-responsive">
                                                <table class="table table-striped mb-0" id="dataTable-1">
                                                    <thead>
                                                        <tr>
                                                            <th class="active">{{ __('Date') }}</th>
                                                            <th>{{ __('Time from - Time To') }}</th>
                                                            <th>{{ __('Start time') }}</th>
                                                            <th>{{ __('End time') }}</th>
                                                            <th>{{ __('Delay in minutes') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $company_breaks = App\Models\CompanyBreak::get();
                                                        @endphp
                                                        @foreach ($dates as $date)
                                                            @foreach ($company_breaks as $company_break)
                                                                <tr>
                                                                    <td>{{ $date }}</td>
                                                                    <td style="">
                                                                        <p style="display:inline-block;">
                                                                            {{ $company_break->start_time }}</p> - <p
                                                                            style="display:inline-block;">
                                                                            {{ $company_break->end_time }}</p>
                                                                    </td>
                                                                    @php
                                                                        $employee_break = $employee
                                                                            ->employee_breaks()
                                                                            ->where('break_id', $company_break->id)
                                                                            ->where(\DB::raw('date(created_at)'), Carbon\Carbon::createFromFormat('Y/m/d', $date)->format('Y-m-d'))
                                                                            ->first();
                                                                    @endphp
                                                                    <td>{{ $employee_break != null && $employee_break->start_time ? $employee_break->start_time : 'O' }}
                                                                    </td>
                                                                    <td>{{ $employee_break != null && $employee_break->end_time ? $employee_break->end_time : 'O' }}
                                                                    </td>
                                                                    @if ($employee_break != null && $employee_break->end_time != null)
                                                                        @if (Carbon\Carbon::createFromFormat('h:i a', $employee_break->end_time)->gte(
                                                                                Carbon\Carbon::createFromFormat('h:i a', $company_break->end_time)))
                                                                            <td>{{ Carbon\Carbon::createFromFormat('h:i a', $employee_break->end_time)->diffInMinutes(Carbon\Carbon::createFromFormat('h:i a', $company_break->end_time)) }}
                                                                                {{ __('Minutes') }}</td>
                                                                        @else
                                                                            <td>0 {{ __('Minutes') }} </td>
                                                                        @endif
                                                                    @else
                                                                        <td> O </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="healthInsurance" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="card">
                                {{ Form::model($employee, ['route' => ['employee.update', $employee->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                                @csrf
                                <div class="card col-md-12">
                                    <div class="row">
                                        <h5 class="col-md-12">{{ __('Medical insurance') }}</h5>
                                        <div class="col-md-6">
                                            <input type="hidden" name="update_mdeical_insurance" value="1" />
                                            <div class="form-group">
                                                {!! Form::label('medical_insurance_number', __('Insurance number'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::text('medical_insurance_number', old('mediacl_insurance_number'), [
                                                    'class' => 'form-control wizard-required',
                                                ]) !!}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('medical_insurance_card_number', __('Insurance card number'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::text('medical_insurance_card_number', old('mediacl_insurance_card_number'), [
                                                    'class' => 'form-control wizard-required',
                                                ]) !!}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('medical_insurance_start_date', __('Insurance start date'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::datetime('medical_insurance_start_date', old('mediacl_insurance_start_date'), [
                                                    'class' => 'form-control wizard-required datepicker flatpickr-input active',
                                                    'readonly' => 'readonly',
                                                ]) !!}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('medical_insurance_end_date', __('Insurance end date'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::datetime('medical_insurance_end_date', old('mediacl_insurance_end_date'), [
                                                    'class' => 'form-control wizard-required datepicker flatpickr-input active',
                                                    'readonly' => 'readonly',
                                                ]) !!}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('medical_blood_type', __('Blood type'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                {{ Form::select('medical_blood_type', ['O−' => 'O−', 'O+' => 'O+', 'A−' => 'A−', 'A+' => 'A+', 'B−' => 'B−', 'B+' => 'B+', 'AB−' => 'AB−', 'AB+' => 'AB+'], null, ['class' => 'form-control ', 'id' => '', 'placeholder' => __('Select blood type')]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('medical_insurance_type', __('Insurance type'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                {{ Form::select('medical_insurance_type', ['public' => 'public', 'private' => 'private'], null, ['class' => 'form-control ', 'id' => 'insurance_type', 'placeholder' => __('Select insurance type')]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {!! Form::label('medical_cover_ratio', __('Cover ratio'), [
                                                    'class' => 'd-flex align-items-center fs-6 fw-semibold mb-2',
                                                ]) !!}
                                                {!! Form::number('medical_cover_ratio', old('medical_cover_ratio'), [
                                                    'class' => 'form-control wizard-required',
                                                    'min' => 1,
                                                ]) !!}
                                            </div>
                                            <div class="wizard-form-error"></div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('insurance_company_id', __('Insurance company'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}
                                                {{ Form::select('insurance_company_id', $insurance_companies->pluck('name', 'id'), null, ['class' => 'form-control ', 'id' => '', 'placeholder' => __('Select company')]) }}
                                            </div>
                                        </div>




                                        <div class="col-md-12" style="margin-bottom:15px;">
                                            <div class="d-flex radio-check">
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="checkbox" id="medical_insurance_policy"
                                                        value="1" @if ($employee->medical_insurance_policy == 1) checked @endif
                                                        name="medical_insurance_policy" class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="mediacl_insurance_policy">{{ __('He has a life insurance policy ?') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="optional-toggle">

                                        </div>
                                    </div>
                                </div>

                                @if (auth()->user()->type != 'employee')
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="submit" value="{{ __('Update') }}"
                                                class="btn btn-primary radius-10px float-right">
                                        </div>
                                    </div>
                                @endif
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->

                    @if ($employee->nationality_type == 0)
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="printcontract" role="tabpanel">
                            <!--begin::Card-->
                            <div class="card p-4 mb-6 mb-xl-12">
                                <div class="card">
                                    {{ Form::model($employee) }}
                                    @csrf
                                    <div class="card col-md-12">
                                        <div class="row">
                                            <h5 class="col-md-12">{{ __('Print contract') }}</h5>

                                            <div class="col-md-12" style="margin-bottom:15px;">
                                                <textarea id="editor1" style="">
                                                        {{ $employee->$contract_template }}
                                                    </textarea>
                                            </div>
                                            <div class="optional-toggle">

                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end:::Tab pane-->
                    @endif

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="printrecievework" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card p-4 mb-6 mb-xl-12">
                            <div class="card">
                                {{ Form::model($employee) }}
                                @csrf
                                <div class="card col-md-12">
                                    <div class="row">
                                        <h5 class="col-md-12">{{ __('Print recieve work') }}</h5>

                                        <div class="col-md-12" style="margin-bottom:15px;">
                                            <textarea id="editor2" style="">
                                                    {{ $receipt_of_work_template }}
                                                </textarea>
                                        </div>
                                        <div class="optional-toggle">

                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="leaveCredit" role="tabpanel">
                        <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                            <!--begin::Card-->
                            <div class="card card-docs flex-row-fluid mb-2">
                                <!--begin::Card Body-->
                                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                    <!--begin::Section-->
                                    <div class="py-0">
                                        <!--begin::Heading-->
                                        <h1 class="fw-bold mb-5"> {{ __('Leave credit') }}</h1>
                                        <!--end::Heading-->
                                        <!--begin::Block-->
                                        <div class="py-5">
                                            <!--begin::Card-->
                                            <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                <!--begin::Card header-->
                                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                    <!--begin::Card title-->
                                                    <div class="card-title">
                                                        <!--begin::Search-->
                                                        <div class="d-flex align-items-center position-relative my-1">
                                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                                <svg width="24" height="24" viewbox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="17.0365" y="15.1223"
                                                                        width="8.15546" height="2" rx="1"
                                                                        transform="rotate(45 17.0365 15.1223)"
                                                                        fill="currentColor"></rect>
                                                                    <path
                                                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                            <input type="text" data-kt-filter="search"
                                                                class="form-control form-control-solid w-250px ps-14"
                                                                placeholder="{{ __('Search') }}">
                                                        </div>
                                                        <!--end::Search-->
                                                    </div>
                                                    <!--end::Card title-->

                                                    <!--begin::Card toolbar-->
                                                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                        <!--begin::Export dropdown-->
                                                        <button type="button" class="btn btn-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                                            <span class="svg-icon svg-icon-2">
                                                                <svg width="24" height="24" viewbox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.3" width="12" height="2"
                                                                        rx="1"
                                                                        transform="matrix(0 -1 -1 0 12.75 19.75)"
                                                                        fill="currentColor"></rect>
                                                                    <path
                                                                        d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z"
                                                                        fill="currentColor"></path>
                                                                    <path opacity="0.3"
                                                                        d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                            {{ __('Export') }}
                                                        </button>
                                                        <!--begin::Menu-->
                                                        <div id="kt_datatable_example_export_menu" data-kt-menu="true"
                                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-export="copy">{{ __('Copy to clipboard') }}</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-export="excel">{{ __('Export as Excel') }}</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-export="csv">{{ __('Export as CSV') }}</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-kt-export="pdf">{{ __('Export as PDF') }}</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                        <!--end::Export dropdown-->
                                                        <!--begin::Hide default export buttons-->
                                                        <div id="kt_datatable_example_buttons" class="d-none"></div>
                                                        <!--end::Hide default export buttons->
                                                                    </div>
                                                                    <!==end::Card toolbar-->
                                                    </div>
                                                    <!--end::Card header-->
                                                    <br><br>

                                                    <!--begin::Card body-->
                                                    <div class="card-body">
                                                        <!--begin::Table-->
                                                        <table
                                                            class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                            id="kt_datatable_example">
                                                            <thead>
                                                                <tr
                                                                    class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                    <th class="min-w-100px">{{ __('Name') }}</th>
                                                                    <th class="min-w-100px">{{ __('Leave credit') }}
                                                                    </th>
                                                                    @foreach ($leaveTypes as $leaveType)
                                                                        <th class="min-w-100px">
                                                                            {{ app()->isLocale('en') ? $leaveType->title : $leaveType->title_ar }}
                                                                        </th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fw-semibold text-gray-600">
                                                                <tr class="">
                                                                    <td class="font-style">
                                                                        {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                                                    </td>
                                                                    <td>{{ $leaves_credit }} {{ __('Days') }}</td>
                                                                    @foreach ($leaveTypes as $leaveType)
                                                                        <td>{{ $employee->getCurrentYearLeaves()->whereIn('status', ['approved', 'approvedWithDeduction'])->where('leave_type_id', $leaveType->id)->sum('total_leave_days') }}
                                                                            {{ __('Days') }}</td>
                                                                    @endforeach
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Card-->
                                            </div>
                                            <!--end::Block-->
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Card Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Container-->
                        </div>
                    </div>
                    <!--end:::Tab pane-->

                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="fingerPrintLocation" role="tabpanel">
                        <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
                            <!--begin::Card-->
                            <div class="card card-docs flex-row-fluid mb-2">
                                <!--begin::Card Body-->
                                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                                    <!--begin::Section-->
                                    <div class="py-0">
                                        <!--begin::Heading-->
                                        <h1 class="fw-bold mb-5"> {{ __('Leave credit') }}</h1>
                                        <!--end::Heading-->
                                        <!--begin::Block-->
                                        <div class="py-5">
                                            <!--begin::Card-->
                                            <div class="card card-p-0 card-flush border-0 bg-transparent">
                                                <!--begin::Card header-->
                                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                    <!--begin::Card title-->
                                                    <div class="card-title">
                                                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                             <a href="#" data-url="{{ route('employee-finger-print.create',['employee_id' => $employee -> id]) }}" data-ajax-popup="true" data-title="انشاء جديد " class="btn btn-sm fw-bold btn-primary">انشاء </a>
                                                        </div>
                                                    </div>
                                                    <!--end::Card title-->
                                                    <!--begin::Card body-->
                                                    <div class="card-body">
                                                        <!--begin::Table-->
                                                        <table
                                                            class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                            id="kt_datatable_example">
                                                            <thead>
                                                                <tr
                                                                    class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                    <th class="min-w-100px">{{ __('Title') }}</th>
                                                                    <th class="min-w-100px">{{ __('Longitude') }}</th>
                                                                    <th class="min-w-100px">{{ __('Latitude') }}</th>
                                                                    <th class="min-w-100px">{{ __('Actions') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fw-semibold text-gray-600">
                                                                @foreach ($employee -> finger_print_locations as $finger_location )
                                                                <tr class="">
                                                                    <td class="font-style">{{ $finger_location -> title }}</td>
                                                                    <td>{{ $finger_location -> long }}</td>
                                                                    <td>{{ $finger_location -> lat }}</td>
                                                                    <td class="Action text-center">
                                                                        <span>
                                                                            @can('Edit Branch')
                                                                                <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ route('employee-finger-print.edit' , $finger_location -> id) }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                            @endcan
                                                                            @can('Delete Branch')
                                                                                <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['employee-finger-print.destroy', $finger_location->id],'id'=>'delete-form-'.$finger_location-> id]) !!}
                                                                                {!! Form::close() !!}
                                                                            @endcan
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        <!--end::Table-->
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Card-->
                                            </div>
                                            <!--end::Block-->
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Card Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Container-->
                        </div>
                    </div>
                    <!--end:::Tab pane-->
                </div>
                <!--end:::Tab content-->
            </div>
        </div>
    </div>
@endsection

@push('script-page')

    <script>
        $('.confirm-delete').click(function(e){
            e.preventDefault();
            Swal.fire({
                html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                icon: "info",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "{{ __('messages.Ok') }}",
                cancelButtonText: "{{ __('Cancel') }}",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                  $(this).next('form').submit();
                }
            });
            return false;
        });
    </script>
    



    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            var i = {{ $employee->empAllowance->count() }};
            $(document).on('click', '#add_allowances_btn', function() {
                i++;
                var trContent = '<tr id="row' + i +
                    '" style="height:80px;"><td>{{ Form::label('allowance_option', __('Allowance_type'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) }}{{ Form::select('allowance_option[]', $allowance_options, null, ['class' => 'form-control wizard-required']) }}</td><td>{!! Form::label('amount', __('amount'), ['class' => 'd-flex align-items-center fs-6 fw-semibold mb-2']) !!}{!! Form::text('amount[]', old('amount'), ['class' => 'form-control wizard-required']) !!}</td><td><div class="styles_tableAction__3jBnD"><svg id="' +
                    i +
                    '" class="remove_allowances_btn" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg" data-testid="undefined-deleteIcon"><path fill-rule="evenodd" clip-rule="evenodd" d="M7 0H3V2H0V3H10V2H7V0ZM2 4H8V10H2V4Z" fill="#4B6C89"></path></svg></div></td></tr>';
                $('#allowance_body').append(trContent);
            });

            $(document).on('click', '.remove_allowances_btn', function() {
                i--;
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });
        });

        $(document).on('change', '#employee_account_type', function() {
            if ($(this).val() == 0) {
                $('#salary_card_number_info').css('display', 'block');
                $('#IBAN_number_info').css('display', 'none');
            } else {
                $('#salary_card_number_info').css('display', 'none');
                $('#IBAN_number_info').css('display', 'block');
            }
        });

        $(document).on('change', 'input[name=payment_type]', function() {

            if ($(this).val() == 'cash' || $(this).val() == 'cheque') {
                $('#paymentContent').css('display', 'none');
            } else if ($(this).val() == 'bank') {
                $('#paymentContent').css('display', 'block');
                $('#bankDetails').css('display', 'block');
                $('#internationalTransferDetails').css('display', 'none');
            } else if ($(this).val() == 'international_transfer') {
                $('#paymentContent').css('display', 'block');
                $('#bankDetails').css('display', 'none');
                $('#internationalTransferDetails').css('display', 'block');
            }
        });

        window.onload = (event) => {
            var paymentType = $('input[name=payment_type]:checked').val();
            if (paymentType == 'cash' || paymentType == 'cheque') {
                $('#paymentContent').css('display', 'none');
            } else if (paymentType == 'bank') {
                $('#paymentContent').css('display', 'block');
                $('#bankDetails').css('display', 'block');
                $('#internationalTransferDetails').css('display', 'none');
            } else if (paymentType == 'international_transfer') {
                $('#paymentContent').css('display', 'block');
                $('#bankDetails').css('display', 'none');
                $('#internationalTransferDetails').css('display', 'block');
            }

            var employee_account_type = $('#employee_account_type').val();
            if (employee_account_type == 0) {
                $('#salary_card_number_info').css('display', 'block');
                $('#IBAN_number_info').css('display', 'none');
            } else {
                $('#salary_card_number_info').css('display', 'none');
                $('#IBAN_number_info').css('display', 'block');
            }

        };

        $(document).on('change', '#nationality_type', function() {
            var nationality_type = $(this).val();
            if (nationality_type == 1) {
                $('#nationality').css('display', 'none');
            } else {
                $('#nationality').css('display', 'block');
            }
        });
    </script>

    @if ($employeeFollowers->count() != 0)
        <script>
            $('.confirm-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('follower-form-{{ $Follower->id }}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif

    @if ($qualifications->count() != 0)
        <script>
            $('.confirm-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('qualification-form-{{ $qualification->id }}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif

    @if ($shifts->count() != 0)
        <script>
            $('.delete-shift').click(function(e) {
                var form = $(this).next('form');
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
                return false;
            });
        </script>
    @endif

    @if ($assets->count() != 0)
        <script>
            $('.confirm-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-asset-form-{{ $asset->id }}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif

    @if ($documents->count() != 0)
        <script>
            $('.confirm-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-document-form-{{ $document->id }}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif

    @if ($employee->employee_on_probation == 1 && $employee->probation_periods_status != 1)
        <script>
            $(document).ready(function() {
                $('.branch_ids').select2();
            });

            $('.confirm-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('finish_probationDuration-form-{{ $employee->id }}').submit()
                    }
                });
                return false;
            });
        </script>

        <script>
            $('.confirm-delete-duration').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-duration-form-{{ $employee->id }}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif

    @if ($employeeContract)
        <script>
            $('.confirm-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `{{ __('Are You Sure?') . ' ' . __('This action can not be undone. Do you want to continue?') }}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('messages.Ok') }}",
                    cancelButtonText: "{{ __('Cancel') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-contract-form-{{ $employeeContract->id }}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif

    <script>
        $(function() {
            $(".gregorian-date , .datepicker").hijriDatePicker({
                format: 'YYYY-M-D',
                showSwitcher: false,
                hijri: false,
                useCurrent: true,
            });
        });

        $(function() {
            $(".hijri-date-input , .datepicker").hijriDatePicker({
                hijriFormat: 'iYYYY-iM-iD',
                showSwitcher: true,
                hijri: true,
                useCurrent: true,
            });
        });

        for (let i = 1; i <= 18; i++) {
            $('#hijri_' + i).on('dp.change', function(arg) {

                if (!arg.date) {
                    return;
                };

                let date = arg.date;
                $('#gregorian_' + i).val(date.format("YYYY-M-D"));
            });

            $('#gregorian_' + i).on('dp.change', function(arg) {

                if (!arg.date) {
                    return;
                };

                let date = arg.date;
                $('#hijri_' + i).val(date.format("iYYYY-iM-iD"));
            });
        }
    </script>

@endpush
