@extends('layouts.admin')
@section('page-title')
    {{__('Settings')}}
@endsection

@php
    $logo = asset(Storage::url('uploads/logo/'));
    $lang = \App\Models\Utility::getValByName('default_language');
@endphp

@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid mt-4">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#business-setting"> {{__('Site Setting')}} </a>
                    </li>
                <!--end:::Tab item-->

                <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" href="{{asset('manage-language/'.app()->getLocale())}}">{{__('Manage Language')}}</a>
                    </li>
                <!--end:::Tab item-->
            </ul>

            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">

                <!--begin:::Tab pane-->
                <div class="tab-pane fade show active" id="business-setting" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-12">
                        {{Form::model($settings,array('url'=>'settings','method'=>'POST','enctype' => "multipart/form-data"))}}
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{__('Business settings')}}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body pt-0 pb-5">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6 col-md-6">
                                        <h4 class="small-title">{{__('Logo')}}</h4>
                                        <div class="card setting-card setting-logo-box">
                                            <div class="logo-content">
                                                <img src="{{$logo.'/logo.png'}}" width="120" class="big-logo" alt=""/>
                                            </div>
                                            <div class="choose-file mt-5">
                                                <label for="logo">
                                                    <div>{{__('Choose file here')}}</div>
                                                    <input type="file" class="form-control" name="logo" id="logo" data-filename="edit-logo">
                                                </label>
                                                <p class="edit-logo"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6 col-md-6">
                                        <h4 class="small-title">{{__('Landing Page Logo')}}</h4>
                                        <div class="card setting-card setting-logo-box">
                                            <div class="col-12">
                                                <div class="logo-content">
                                                    <img src="{{$logo.'/landing_logo.png'}}"  width="120" class="landing-logo" alt=""/>
                                                </div>
                                                <div class="choose-file mt-4">
                                                    <label for="landing-logo">
                                                        <div>{{__('Choose file here')}}</div>
                                                        <input type="file" class="form-control" name="landing_logo" id="landing-logo" data-filename="edit-landing-logo">
                                                    </label>
                                                    <p class="edit-landing-logo"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6 col-md-6">
                                        <h4 class="small-title">{{__('Favicon')}}</h4>
                                        <div class="card setting-card setting-logo-box">
                                            <div class="logo-content">
                                                <img src="{{$logo.'/favicon.png'}}"  width="120" class="small-logo" alt=""/>
                                            </div>
                                            <div class="choose-file mt-5">
                                                <label for="small-favicon">
                                                    <div>{{__('Choose file here')}}</div>
                                                    <input type="file" class="form-control" name="favicon" id="small-favicon" data-filename="edit-favicon">
                                                </label>
                                                <p class="edit-favicon"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-6 col-md-6">
                                        <h4 class="small-title">{{__('Settings')}}</h4>
                                            <div class="form-group">
                                                {{Form::label('default_language',__('Default Language'),array('class' => 'd-flex align-items-center fs-6 fw-semibold mb-2')) }}
                                                <div class="changeLanguage">
                                                    <select name="default_language" id="default_language" class="form-control select2">
                                                        @foreach(\App\Models\Utility::languages() as $language)
                                                            <option @if($lang == $language) selected @endif value="{{$language }}">{{Str::upper($language)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-lg-12 text-right">
                                        <input type="submit" value="{{__('Save Changes')}}" class="btn-submit btn btn-primary">
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                        {{Form::close()}}
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
            </div>


        </div>
    </div>
</div>
@endsection


