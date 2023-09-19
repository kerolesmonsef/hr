@extends('layouts.admin')
@section('page-title')
{{__('Account Setting')}}
@endsection

@section('content')
    <div id="kt_app_content" class="mt-10 app-content flex-column-fluid">
        <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-12">

                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0"> {{__('Account Setting')}} </h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>

                                <!--begin::Form-->
                                {{Form::model($userDetail,array('route' => array('update.password'), 'method' => 'post'))}}
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                {{Form::label('current_password',__('Current Password'),array('class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'))}}
                                                {{Form::password('current_password',array('class'=>'form-control','placeholder'=>__('Enter Current Password')))}}
                                                @error('current_password')
                                                <span class="invalid-current_password" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                {{Form::label('new_password',__('New Password'),array('class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'))}}
                                                {{Form::password('new_password',array('class'=>'form-control','placeholder'=>__('Enter New Password')))}}
                                                @error('new_password')
                                                    <span class="invalid-new_password" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {{Form::label('confirm_password',__('Re-type New Password'),array('class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'))}}
                                                {{Form::password('confirm_password',array('class'=>'form-control','placeholder'=>__('Enter Re-type New Password')))}}
                                                @error('confirm_password')
                                                <span class="invalid-confirm_password" role="alert">
                                                    <strong class="text-danger">{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mt-4 text-right">
                                            <input type="submit" value="{{__('Save Changes')}}" class="btn btn-primary">
                                        </div>
                                    </div>
                                {{Form::close()}}
                                <!--end::Form-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
        <!--end::Content container-->
    </div>
@endsection