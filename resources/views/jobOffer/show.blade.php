@extends('layouts.admin')

@section('page-title')
{{ __('Job offers') }}
@endsection
@php
    $documentPath = asset(Storage::url('uploads/cvs'));
@endphp
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
                                <div class="card-header align-items-center py-5 ">
                                    <!--begin::Card body-->
                                    <!--begin::Card-->
                                    <div class="card" style="width:100%;">
                                        {{ Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>{{ __('Job offers') }}</h2>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body pt-0 pb-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="ibox">
                                                        <!--modal -->
                                                        @include('jobOffer.modalDetails')
                                                        <!--modal -->
                                                        <div class="ibox-content py-0">
                                                            @if (count($companyJobRequest->job_requests) != 0)
                                                                <table
                                                                    class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                                                    id="kt_datatable_example">
                                                                    <thead>
                                                                        <tr
                                                                            class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                                            <th class="min-w-100px">{{ __('Name') }}</th>
                                                                            <th class="min-w-100px">{{ __('Email') }}</th>
                                                                            <th class="min-w-100px">{{ __('Phone') }}</th>
                                                                            <th class="min-w-100px">{{ __('CV') }}</th>
                                                                            <th class="min-w-100px">{{ __('Action') }}
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="fw-semibold text-gray-600">
                                                                        @foreach ($companyJobRequest->job_requests as $job_request)
                                                                            <tr>
                                                                                <td>{{ $job_request->name }}</td>
                                                                                <td>{{ $job_request->email }}</td>
                                                                                <td>{{ $job_request->phone }}</td>
                                                                                <td>
                                                                                    @if (!empty($job_request->cv))
                                                                                        <a href="{{ url('storage/'.$job_request->cv)  }}"
                                                                                            download>
                                                                                            <i class="fa fa-download"></i>
                                                                                        </a>

                                                                                        <a href="{{ url('storage/'.$job_request->cv)  }}"
                                                                                            target="_blank">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </a>
                                                                                    @else
                                                                                        <p>-</p>
                                                                                    @endif
                                                                                </td>
                                                                                <td class="Action text-center">
                                                                                    <span>
                                                                                        <button
                                                                                            data-item="{{ $job_request }}"
                                                                                            type="button"
                                                                                            class="btn btn-icon btn-active-light-danger w-30px h-30px open-modal"
                                                                                            data-bs-toggle="modal"
                                                                                            data-bs-target="#myModal">
                                                                                            <i class="fa fa-eye"></i>
                                                                                        </button>
                                                                                        <button type="button"
                                                                                            class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px"
                                                                                            data-toggle="tooltip"
                                                                                            data-original-title="{{ __('Delete') }}"><i
                                                                                                class="fa fa-trash"></i></button>
                                                                                        {!! Form::open([
                                                                                            'method' => 'DELETE',
                                                                                            'route' => ['company-document-upload.destroy', $job_request->id],
                                                                                            'id' => 'delete-form-' . $job_request->id,
                                                                                        ]) !!}
                                                                                        {!! Form::close() !!}
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
                                        {{ Form::close() }}
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
    <script>
        $('.open-modal').click(function() {
            var data = $(this).data('item');
            var fields = data.field;
            fields = JSON.parse(fields);
            var fields_result = '';
            for (var i = 0; i < fields.length; i++) {
                fields_result +=
                    '<span style="display:inline-block;margin:5px;" class="p-3 mb-2 bg-success text-white">' +
                    fields[i] + '</span>';
            }
            $('#myModal').find('.name').text(data.name);
            $('#myModal').find('.email').text(data.email);
            $('#myModal').find('.phone').text(data.phone);
            $('#myModal').find('.age').text(data.age);
            $('#myModal').find('.findus').text(data.findus);
            $('#myModal').find('.field').html(fields_result);
            $('#myModal').find('.interview_day').text(data.interview_day);
            $('#myModal').find('.message').text(data.message);
            var link = "{{ url('storage'    ) }}" +'/' + data.cv ;
            $('#myModal').find('.download-link').attr('href', link);


            $('#myModal').find('.address').text(data.address);
            $('#myModal').find('.education').text(data.education);
            $('#myModal').find('.experience').text(data.experience);
            $('#myModal').find('.linkedin_profile').text(data.linkedin_profile);
            $('#myModal').find('.join_us_date').text(data.join_us_date);
            $('#myModal').find('.salary').text(data.salary);
            $('#myModal').find('.english_rate').text(data.english_rate);

        })
    </script>
    @if ($companyJobRequest->job_requests->count() != 0)
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
                        document.getElementById('delete-form-{{ $job_request->id }}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif
@endpush
