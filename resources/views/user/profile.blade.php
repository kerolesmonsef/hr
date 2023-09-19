@extends('layouts.admin')
@section('page-title')
    {{__('My profile')}}
@endsection
@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

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
                                        <h3 class="fw-bold m-0"> {{__('My profile')}}</h3>
                                    </div> 
                                    <!--end::Card title-->
                                </div>

                                <!--begin::Form-->
                                {{Form::model($userDetail,array('route' => array('update.account'), 'method' => 'post', 'enctype' => "multipart/form-data"))}}
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                {{Form::label('name',__('Name'),array('class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'))}}
                                                {{Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter User Name')))}}
                                                @error('name')
                                                    <span class="invalid-name" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                {{Form::label('email',__('Email'),array('class' => 'd-flex align-items-center fs-6 fw-semibold mb-2'))}}
                                                {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))}}
                                                @error('email')
                                                    <span class="invalid-email" role="alert">
                                                        <strong class="text-danger">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="choose-file">
                                                    <label for="avatar">
                                                        <div>{{__('Choose file here')}}</div>
                                                        <input type="file" class="form-control" id="avatar" name="profile" data-filename="profiles">
                                                    </label>
                                                    <p class="profiles"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 text-right">
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
