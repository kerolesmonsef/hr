@extends('layouts.admin')
@section('page-title')
    {{__('Manage Language')}}
@endsection
@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('create.language') }}" class="btn btn-primary btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create New Language')}}">
                <i class="fa fa-plus"></i> {{__('Create')}}
            </a>
        </div>
        @if($currantLang != (!empty(env('default_language')) ? env('default_language') : 'en'))
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#!" class="btn btn-xs btn-icon icon-left btn-danger width-auto" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').' | '.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$currantLang}}').submit();">
                    <i class="fa fa-trash"></i> {{ __('Delete')}}
                </a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang],'id'=>'delete-form-'.$currantLang]) !!}
                {!! Form::close() !!}
            </div>
        @endif
    </div>
@endsection
@section('content')

<div id="kt_app_content" class="app-content flex-column-fluid mt-4">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#home"> {{ __('Labels')}} </a>
                    </li>
                <!--end:::Tab item-->

                <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#profile"> {{ __('Messages')}} </a>
                    </li>
                <!--end:::Tab item-->
            </ul>

            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">

                <!--begin:::Tab pane-->
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-12">
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
                                <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                    <p>{{$errors}}</p>
                                    @csrf
                                    <div class="row">
                                        @foreach($arrLabel as $name => $value)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="">{{$name}} </label>
                                                    <input type="text" class="form-control" name="label[{{$name}}]" value="{{$value}}">
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12 text-right">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->


                <!--begin:::Tab pane-->
                <div class="tab-pane fade show" id="profile" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-12">
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
                                <form method="post" action="{{route('store.language.data',[$currantLang])}}">
                                    @csrf
                                    <div class="row">
                                        @foreach($arrMessage as $fileName => $fileValue)
                                            <div class="col-lg-12">
                                                <h3>{{ucfirst($fileName)}}</h3>
                                            </div>
                                            @foreach($fileValue as $label => $value)
                                                @if(is_array($value))
                                                    @foreach($value as $label2 => $value2)
                                                        @if(is_array($value2))
                                                            @foreach($value2 as $label3 => $value3)
                                                                @if(is_array($value3))
                                                                    @foreach($value3 as $label4 => $value4)
                                                                        @if(is_array($value4))
                                                                            @foreach($value4 as $label5 => $value5)
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}.{{$label5}}</label>
                                                                                        <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}][{{$label5}}]" value="{{$value5}}">
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @else
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}.{{$label4}}</label>
                                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}][{{$label4}}]" value="{{$value4}}">
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}.{{$label3}}</label>
                                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}][{{$label3}}]" value="{{$value3}}">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">{{$fileName}}.{{$label}}.{{$label2}}</label>
                                                                    <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}][{{$label2}}]" value="{{$value2}}">
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{$fileName}}.{{$label}}</label>
                                                            <input type="text" class="form-control" name="message[{{$fileName}}][{{$label}}]" value="{{$value}}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                    <div class="col-lg-12 text-right">
                                        <input type="submit" value="{{__('Save Change')}}" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
            </div>


        </div>
    </div>
</div>

@endsection

