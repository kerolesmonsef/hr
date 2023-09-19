@extends('layouts.admin')
@section('page-title')
    {{__('Settings')}}
@endsection
@php
    $logo               = asset(Storage::url('uploads/logo/'));
    $company_logo       = Utility::getValByName('company_logo');
    $company_small_logo = Utility::getValByName('company_small_logo');
    $company_favicon    = Utility::getValByName('company_favicon');
@endphp

@push('script-page')
    <script>
        $(document).on('change', '.email-template-checkbox', function () {
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {

                },
            });
        });
    </script>
@endpush

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid mt-4">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#business-setting">{{__('Business Setting')}}</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#system-setting">{{__('System Setting')}}</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#company-setting">{{__('Company Setting')}}</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#slate-setting">{{__('Company slate')}}</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#company-documents">{{__('Company Documents')}}</a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">

                <!--begin:::Tab pane-->
                <div class="tab-pane fade show active" id="business-setting" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-12">
                        {{Form::model($settings,array('route'=>'business.setting','method'=>'POST','enctype' => "multipart/form-data"))}}
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
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <h4 class="small-title">{{__('Logo')}}</h4>
                                        <div class="card setting-card setting-logo-box">
                                            <div class="logo-content">
                                                <img style="width:100%;" src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')}}" class="big-logo">
                                            </div>
                                            <div class="choose-file mt-5">
                                                <label for="company_logo">
                                                    <div>{{__('Choose file here')}}</div>
                                                    <input type="file" class="form-control" name="company_logo" id="company_logo" data-filename="edit-logo">
                                                </label>
                                                <p class="edit-logo"></p>
                                            </div>

                                            @error('company_logo')
                                            <span class="invalid-logo" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <h4 class="small-title">{{__('Favicon')}}</h4>
                                        <div class="card setting-card setting-logo-box">
                                            <div class="logo-content">
                                                <img style="width:100%;" src="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" class="small-logo">
                                            </div>
                                            <div class="choose-file mt-5">
                                                <label for="company_favicon">
                                                    <div>{{__('Choose file here')}}</div>
                                                    <input type="file" class="form-control" name="company_favicon" id="company_favicon" data-filename="edit-favicon">
                                                </label>
                                                <p class="edit-favicon"></p>
                                            </div>
                                            @error('company_favicon')
                                            <span class="invalid-logo" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <h4 class="small-title">{{__('Settings')}}</h4>
                                        <div class="card setting-card setting-logo-box">
                                            <div class="form-group">
                                                {{Form::label('title_text',__('Title Text'),['class'=>'form-control-label text-dark']) }}
                                                {{Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))}}
                                                @error('title_text')
                                                <span class="invalid-title_text" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-lg-12 col-sm-12 col-md-12">
                                                <label for="metakeyword" class="form-control-label text-dark">Meta Keywords</label>
                                                <textarea class="form-control" rows="4" cols="8" value="{{isset($settings['metakeyword'])  ? $settings['metakeyword'] : ''}}" name="metakeyword"  id="metakeyword" style="resize: vertical; height: 100px;">{{ isset($settings['metakeyword'])? $settings['metakeyword'] : '' }}</textarea>
                                           </div>

                                           <div class="col-lg-12 col-sm-12 col-md-12">
                                            <label for="metadesc" class="form-control-label text-dark">Meta Description</label>
                                            <textarea class="form-control" rows="4" cols="8" value="{{isset($settings['metadesc'])  ? $settings['metadesc'] : ''}}" name="metadesc"  id="metadesc" style="resize: vertical; height: 100px;">{{isset($settings['metadesc'])  ? $settings['metadesc'] : ''}}</textarea>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 text-right">
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"><input type="submit" style="width:100%;" value="{{__('Save Change')}}" class="btn btn-primary radius-10px"></div>
                                            <div class="col-md-4"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                        {{Form::close()}}
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->

                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="system-setting" role="tabpanel">
                    <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-12">
                            {{Form::model($settings,array('route'=>'system.settings','method'=>'post'))}}
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{__('System Settings')}} dsd</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            {{Form::label('site_currency',__('Currency *'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('site_currency',null,array('class'=>'form-control font-style'))}}

                                            @error('site_currency')
                                                <span class="invalid-site_currency" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6">
                                            {{Form::label('',__('Country'),['class'=>'form-control-label text-dark'])}}
                                            <select type="text" name="country" class="form-control "  data-control="select2" id="timezone">
                                                    <option value="Saudi Arabia" {{($settings['country']== 'Saudi Arabia')? 'selected' : '' }}>Saudi Arabia</option>
                                                    <option value="Egypt" {{($settings['country']== 'Egypt')? 'selected' : '' }}>Egypt</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('site_currency_symbol',__('Currency Symbol *'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('site_currency_symbol',null,array('class'=>'form-control'))}}
                                            @error('site_currency_symbol')
                                            <span class="invalid-site_currency_symbol" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label text-dark" for="example3cols3Input">{{__('Currency Symbol Position')}}</label>
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-12">
                                                        <div class="d-flex radio-check">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="pre_symbol" name="site_currency_symbol_position" class="custom-control-input" value="pre" @if($settings['site_currency_symbol_position'] == 'pre') checked @endif>
                                                                <label class="custom-control-label" for="pre_symbol">{{__('Pre')}}</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="post_symbol" name="site_currency_symbol_position" class="custom-control-input" value="post" @if($settings['site_currency_symbol_position'] == 'post') checked @endif>
                                                                <label class="custom-control-label" for="post_symbol">{{__('Post')}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="site_date_format" class="form-control-label text-dark">{{__('Date Format')}}</label>
                                            <select type="text" name="site_date_format" class="form-control select2" id="site_date_format">
                                                <option value="M j, Y" @if(@$settings['site_date_format'] == 'M j, Y') selected="selected" @endif>Jan 1,2015</option>
                                                <option value="d-m-Y" @if(@$settings['site_date_format'] == 'd-m-Y') selected="selected" @endif>d-m-y</option>
                                                <option value="m-d-Y" @if(@$settings['site_date_format'] == 'm-d-Y') selected="selected" @endif>m-d-y</option>
                                                <option value="Y-m-d" @if(@$settings['site_date_format'] == 'Y-m-d') selected="selected" @endif>y-m-d</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="site_time_format" class="form-control-label text-dark">{{__('Time Format')}}</label>
                                            <select type="text" name="site_time_format" class="form-control select2" id="site_time_format">
                                                <option value="g:i A" @if(@$settings['site_time_format'] == 'g:i A') selected="selected" @endif>10:30 PM</option>
                                                <option value="g:i a" @if(@$settings['site_time_format'] == 'g:i a') selected="selected" @endif>10:30 pm</option>
                                                <option value="H:i" @if(@$settings['site_time_format'] == 'H:i') selected="selected" @endif>22:30</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('employee_prefix',__('Employee Prefix'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('employee_prefix',null,array('class'=>'form-control'))}}
                                            @error('employee_prefix')
                                            <span class="invalid-employee_prefix" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 text-right">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            {{Form::close()}}
                        </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->

                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="company-setting" role="tabpanel">
                    <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-12">
                            {{Form::model($settings,array('route'=>'company.settings','method'=>'post'))}}
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{__('Company Setting')}}</h2>
                                        </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_name *',__('Company Name *'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_name',null,array('class'=>'form-control font-style'))}}
                                            @error('company_name')
                                                <span class="invalid-company_name" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_address',__('Address'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_address',null,array('class'=>'form-control font-style'))}}
                                            @error('company_address')
                                                <span class="invalid-company_address" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_city',__('City'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_city',null,array('class'=>'form-control font-style'))}}
                                            @error('company_city')
                                                <span class="invalid-company_city" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_state',__('State'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_state',null,array('class'=>'form-control font-style'))}}
                                            @error('company_state')
                                                <span class="invalid-company_state" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            {{Form::label('company_zipcode',__('Zip/Post Code'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_zipcode',null,array('class'=>'form-control'))}}
                                            @error('company_zipcode')
                                                <span class="invalid-company_zipcode" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group  col-md-6">
                                            {{Form::label('company_country',__('Country'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_country',null,array('class'=>'form-control font-style'))}}
                                            @error('company_country')
                                                <span class="invalid-company_country" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('company_telephone',__('Telephone'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_telephone',null,array('class'=>'form-control'))}}
                                            @error('company_telephone')
                                                <span class="invalid-company_telephone" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('company_email',__('System Email *'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_email',null,array('class'=>'form-control'))}}
                                            @error('company_email')
                                                <span class="invalid-company_email" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-md-4">
                                            {{Form::label('commercial_registration_no',__('commercial_registration_no'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('commercial_registration_no',null,array('class'=>'form-control'))}}
                                            @error('commercial_registration_no')
                                                <span class="invalid-commercial_registration_no" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            {{Form::label('tax_number',__('tax_number'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('tax_number',null,array('class'=>'form-control'))}}
                                            @error('tax_number')
                                                <span class="invalid-tax_number" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            {{Form::label('insurance_number',__('insurance_number'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('insurance_number',null,array('class'=>'form-control'))}}
                                            @error('insurance_number')
                                                <span class="invalid-insurance_number" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group col-md-6">
                                            {{Form::label('company_email_from_name',__('Email (From Name) *'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_email_from_name',null,array('class'=>'form-control font-style'))}}
                                            @error('company_email_from_name')
                                                <span class="invalid-company_email_from_name" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            {{Form::label('company_start_time',__('Company Start Time *'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_start_time',null,array('class'=>'form-control timepicker_format'))}}
                                            @error('company_start_time')
                                                <span class="invalid-company_start_time" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3">
                                            {{Form::label('company_end_time',__('Company End Time *'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_end_time',null,array('class'=>'form-control timepicker_format'))}}
                                            @error('company_end_time')
                                                <span class="invalid-company_end_time" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('company_grace_period',__('Company Grace Period'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_grace_period',null,array('class'=>'form-control'))}}
                                            @error('company_grace_period')
                                                <span class="invalid-company_grace_period" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('company_grace_period_befor',__('Company Grace Period Before'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_grace_period_befor',null,array('class'=>'form-control'))}}
                                            @error('company_grace_period_befor')
                                                <span class="invalid-company_grace_period_befor" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('company_grace_period_end_before',__('company_grace_period_end_before'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_grace_period_end_before',null,array('class'=>'form-control'))}}
                                            @error('company_grace_period_end_before')
                                                <span class="invalid-company_grace_period_end_before" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            {{Form::label('company_grace_period_end_after',__('company_grace_period_end_after'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('company_grace_period_end_after',null,array('class'=>'form-control'))}}
                                            @error('company_grace_period_end_after')
                                                <span class="invalid-company_grace_period_end_after" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12">
                                            {{Form::label('ip_address',__('ip Address'),['class'=>'form-control-label text-dark']) }}
                                            {{Form::text('ip_address',null,array('class'=>'form-control', 'id' => 'kt_tagify_1'))}}
                                            @error('ip_address')
                                                <span class="invalid-ip_address" role="alert">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            {{Form::label('',__('Timezone'),['class'=>'form-control-label text-dark'])}}
                                            <select type="text" name="timezone" class="form-control "  data-control="select2" id="timezone">
                                                <option value="">{{__('Select Timezone')}}</option>
                                                @foreach($timezones as $k=>$timezone)
                                                    <option value="{{$k}}" {{($settings['timezone']==$k)?'selected':''}}>{{$timezone}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="timezone">{{__('company_map_location')}}</label>
                                                {{Form::hidden('lat',$settings['lat'] ? $settings['lat'] :   '24.7305650',array('class'=>'form-control' , 'id' => 'lat'))}}
                                                {{Form::hidden('lon',$settings['lon'] ? $settings['lon'] : '46.6555170',array('class'=>'form-control' , 'id' => 'lon'))}}
                                                <div style="width: 100%;height: 300px;" id="map"></div>
                                            </div>
                                        </div>

                                        <div class="col-12 text-right">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            {{Form::close()}}
                        </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->

                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="slate-setting" role="tabpanel">
                    <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-12">
                            {{ Form::open(['route' => 'slate.setting','id'=>'slate-setting','method'=>'post','enctype' => "multipart/form-data" ,'class'=>'d-contents']) }}
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{__('Company slate')}}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                            <div class="card setting-card setting-logo-box">

                                                <div class="choose-file mt-5">
                                                    <label for="company_file_ar">
                                                        <div>{{__('Choose company slate file in arabic')}}</div>
                                                        <input type="file" class="form-control" name="file_ar" id="company_file_ar">
                                                    </label>

                                                    @error('file_ar')
                                                        <span class="invalid-logo" role="alert">
                                                            <small class="text-danger">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="choose-file mt-5">
                                                    <label for="company_file">
                                                        <div>{{__('Choose company slate file')}}</div>
                                                        <input type="file" class="form-control" name="file" id="company_file">
                                                    </label>

                                                    @error('file')
                                                        <span class="invalid-logo" role="alert">
                                                            <small class="text-danger">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12  text-right">
                                        <input type="submit" value="{{__('Save Changes')}}" class="btn-submit btn btn-primary text-white">
                                    </div>
                                </div>
                                <!--end::Card body-->
                            {{Form::close()}}
                        </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->

                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="company-documents" role="tabpanel">
                    <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-12">
                            {{Form::model($settings,array('route'=>'business.setting','method'=>'POST','enctype' => "multipart/form-data"))}}
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h2>{{__('Company Documents')}}</h2>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0 pb-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="ibox">
                                                @can('Create Document')
                                                    <div class="text-center">
                                                        <a id="btn-anchor" href="#" data-url="{{ route('company-document-upload.create') }}" data-size="lg" data-ajax-popup="true" data-title="" class="btn btn-info mb-4" data-toggle="tooltip" data-original-title=""> {{__('Add_document')}} </a>
                                                    </div>
                                                @endcan

                                                <div class="ibox-content py-0">
                                                    @if(count($documents) != 0)
                                                        <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                                            <thead>
                                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                    <th class="min-w-100px">{{__('Name')}}</th>
                                                                    <th class="min-w-100px">{{__('Document')}}</th>
                                                                    <th class="min-w-100px">{{__('Description')}}</th>
                                                                    @if(Gate::check('Edit Document') || Gate::check('Delete Document'))
                                                                        <th class="min-w-100px">{{ __('Action') }}</th>
                                                                    @endif
                                                                </tr>
                                                            </thead>
                                                            <tbody class="fw-semibold text-gray-600">
                                                                @foreach($documents as $document)
                                                                    @php
                                                                        $documentPath=asset(Storage::url('uploads/companydocumentUpload'));
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $document->name }}</td>
                                                                        <td>
                                                                            @if(!empty($document->document))
                                                                                <a href="{{$documentPath.'/'.$document->document}}" download>
                                                                                    <i class="fa fa-download"></i>
                                                                                </a>

                                                                                <a href="{{$documentPath.'/'.$document->document}}" target="_blank">
                                                                                    <i class="fa fa-eye"></i>
                                                                                </a>
                                                                            @else
                                                                                <p>-</p>
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $document->description }}</td>
                                                                        <td class="Action text-center">
                                                                            <span>
                                                                                @can('Edit Branch')
                                                                                    <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ route('company-document-upload.edit',$document->id)}}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Document')}}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                                @endcan
                                                                                @can('Delete Branch')
                                                                                    <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}"><i class="fa fa-trash"></i></button>
                                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['company-document-upload.destroy', $document->id],'id'=>'delete-form-'.$document->id]) !!}
                                                                                    {!! Form::close() !!}
                                                                                @endcan
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>
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
            <!--end:::Tab content-->
        </div>
    </div>
</div>
@endsection


@push('script-page')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_foD6VvulHSpxKYjtgehkQ_UoVGHH64Y&callback=initMap&libraries=places,geometry"></script>
    <script>
        @if($documents->count() != 0)
            $('.confirm-delete').click(function(e){
                e.preventDefault();
                Swal.fire({
                    html: `{{__('Are You Sure?').' '.__('This action can not be undone. Do you want to continue?')}}`,
                    icon: "info",
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: "{{__('messages.Ok')}}",
                    cancelButtonText: "{{__('Cancel')}}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: 'btn btn-danger'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-{{$document->id}}').submit()
                    }
                });
                return false;
            });
        @endif

        function initMap() {
            var latlng = new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lon").value);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });

            // Try HTML5 geolocation.
            // if (navigator.geolocation) {
            //         navigator.geolocation.getCurrentPosition(function(position) {
            //         var pos = {
            //             lat: position.coords.latitude,
            //             lng: position.coords.longitude
            //         };
            //         map.setCenter(pos);
            //         marker.setPosition(pos);
            //         document.getElementById("lat").value = pos.lat;
            //         document.getElementById("lon").value = pos.lng;
            //         }, function() {
            //         handleLocationError(true, map.getCenter());
            //         });
            // } else {
            //     // Browser doesn't support Geolocation
            //     handleLocationError(false, map.getCenter());
            // }

            google.maps.event.addListener(marker, 'dragend', function(a) {
            document.getElementById("lat").value = a.latLng.lat().toFixed(6);
            document.getElementById("lon").value = a.latLng.lng().toFixed(6);
            });
        };

        var input1 = document.querySelector("#kt_tagify_1");
        new Tagify(input1);
    </script>
@endpush
