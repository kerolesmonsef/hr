@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Leave') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Leave')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('leaves.create') }}" class="btn btn-primary btn-icon-only width-auto"
                    data-ajax-popup="true" data-title="{{ __('Create Leaves Type') }}">
                    <i class="fa fa-plus"></i> {{ __('Create') }}
                </a>
            </div>
        @endcan
    </div>
@endsection

@section('content')
    <div class="docs-content mt-10 d-flex flex-column flex-column-fluid" id="kt_docs_content">
        <!--begin::Container-->
        <div class="container d-flex flex-column flex-lg-row" id="kt_docs_content_container">
            <!--begin::Card-->
            <div class="card card-docs flex-row-fluid mb-2">
                <!--begin::Card Body-->
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <!--begin::Section-->
                    <div class="py-0">
                        <!--begin::Block-->
                        <div class="py-5">
                            <!--begin::Card-->
                            <div class="card card-p-0 card-flush border-0 bg-transparent">
                                <!--begin::Card header-->
                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                    <!--begin::Card body-->
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
@endsection
@push('script-page')
@if($documents->count() != 0)
        <script>
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
        </script>
    @endif
@endpush

