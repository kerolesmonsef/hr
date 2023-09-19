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
                        <!--begin::Heading-->
                        <h1 class="fw-bold mb-5">{{ __('Leaves') }}</h1>

                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <!--begin::Primary button-->
                            @can('Create Employee')
                                @if (isset($parent))
                                    <a href="#"
                                        data-url="{{ route('request_types.create') }}?id={{ request()->get('id') }}"
                                        data-ajax-popup="true" data-title="{{ __('Create New') }}"
                                        class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}
                                    </a>
                                @else
                                    <a href="#"
                                        data-url="{{ route('leaves.create')}}"
                                        data-ajax-popup="true" data-title="{{ __('Create New') }}"
                                        class="btn btn-sm fw-bold btn-primary">{{ __('Create') }}
                                    </a>
                                @endif
                            @endcan
                            <!--end::Primary button-->
                        </div>

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
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                        height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
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
                                        <button type="button" class="btn btn-primary" data-kt-menu-trigger="click"
                                            data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" width="12" height="2" rx="1"
                                                        transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor">
                                                    </rect>
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
                                        <table class="table align-middle border rounded table-row-dashed fs-6 g-5"
                                            id="kt_datatable_example">
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                    @if (auth()->user()->type != 'employee')
                                                        <th class="min-w-100px">{{ __('Employee') }}</th>
                                                    @endif
                                                    <th class="min-w-100px">{{ __('Leave Type') }}</th>
                                                    <th class="min-w-100px">{{ __('Applied On') }}</th>
                                                    <th class="min-w-100px">{{ __('Start Date') }}</th>
                                                    <th class="min-w-100px">{{ __('End Date') }}</th>
                                                    <th class="min-w-100px">{{ __('Total Days') }}</th>

                                                    <th class="min-w-100px">{{ __('status') }}</th>
                                                    @if(request('status') == 'approved' || request('status') == 'approvedWithDeduction')
                                                        <th class="min-w-100px">{{ __('Take advantage of airline tickets') }}</th>
                                                    @endif
                                                    <th class="min-w-150px">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fw-semibold text-gray-600">
                                                @foreach ($leaves as $leave)
                                                    <tr>
                                                        @if (auth()->user()->type != 'employee')
                                                            <td>{{ $leave->employee ? $leave->employee->name : '' }}
                                                            </td>
                                                        @endif
                                                        <td>{{ !empty(auth()->user()->getLeaveType($leave->leave_type_id)) ? auth()->user()->getLeaveType($leave->leave_type_id)->title : '' }}
                                                        </td>
                                                        <td>{{ auth()->user()->dateFormat($leave->applied_on) }}</td>
                                                        <td>{{ auth()->user()->dateFormat($leave->start_date) }}</td>
                                                        <td>{{ auth()->user()->dateFormat($leave->end_date) }}</td>
                                                        @php
                                                            $startDate = new \DateTime($leave->start_date);
                                                            $endDate = new \DateTime($leave->end_date);
                                                            $total_leave_days = !empty($startDate->diff($endDate)) ? $startDate->diff($endDate)->days + 1 : 0;
                                                        @endphp
                                                        <td>{{ $total_leave_days }}</td>
                                                        <td>
                                                            @if ($leave->status == 'pending')
                                                                <div class="badge badge-pill badge-warning">
                                                                    {{ $leave->status }}
                                                                </div>

                                                                    @if ($leave->status == 'Pending')
                                                                            <a href="#"
                                                                                data-url="{{ URL::to('leave/' . $leave->id . '/edit') }}"
                                                                                data-size="lg" data-ajax-popup="true"
                                                                                data-title="{{ __('Edit Leave') }}"
                                                                                class="edit-icon btn btn-success"
                                                                                data-toggle="tooltip"
                                                                                data-original-title="{{ __('Edit') }}"><i
                                                                                    class="fa fa-edit"></i></a>
                                                                    @endif
                                                                    <!-- reject Modal -->
                                                                    <div class="modal fade" id="rejectModel" tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">Modal title</h5>
                                                                                    <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="reject-leave" action="#"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">

                                                                                                    <input placeholder=""
                                                                                                        type="text"
                                                                                                        class="form-control"
                                                                                                        name="admin_message" />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" form="reject-leave"
                                                                                        class="btn btn-primary">Save
                                                                                        changes</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- reject Modal -->


                                                                    <!-- accept Modal -->
                                                                    <div class="modal fade" id="acceptModel" tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">{{ __('Accepting leave requests') }}</h5>
                                                                                    <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="accept-leave" action="#"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="deduction-status" style="margin-bottom:10px;"> موافقة مع
                                                                                                        الخصم(%)</label>
                                                                                                    <input type="checkbox"
                                                                                                        id="deduction-status"
                                                                                                        data-deduction="{{ $leave->leaveType->deduction }}" />
                                                                                                    <input
                                                                                                        placeholder="نسبة الخصم (20 %)"
                                                                                                        type="number"
                                                                                                        min="0"
                                                                                                        step="0.01"
                                                                                                        class="form-control"
                                                                                                        name="deduction"
                                                                                                        disabled />
                                                                                                    <div>
                                                                                                        <label style="margin-top:15px;display:block;">{{ __('Take advantage of airline tickets') }}</label>
                                                                                                        <hr>
                                                                                                        <label for="no_both">{{ __('He did not take advantage of the flights') }}</label>
                                                                                                        <input id="no_both"  type="radio" name="ticket_flight_status" value="no_both" checked/>
                                                                                                        <hr>
                                                                                                        <label for="go">{{ __('Going only') }}</label>
                                                                                                        <input id="go" type="radio" name="ticket_flight_status" value="go" />
                                                                                                        <hr>
                                                                                                        <label for="back">{{ __('Back only') }}</label>
                                                                                                        <input id="back" type="radio" name="ticket_flight_status" value="back" />
                                                                                                        <hr>
                                                                                                        <label for="go_back">{{ __('Going and coming back') }}</label>
                                                                                                        <input id="go_back" type="radio" name="ticket_flight_status" value="go_back" />
                                                                                                        <hr>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                                                    <button type="submit" form="accept-leave"
                                                                                        class="btn btn-primary">{{ __('Save changes') }}</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- accept Modal -->
                                                                        <a href="#"
                                                                            class="btn btn-icon btn-active-light-success w-30px h-30px open-accept-leave"
                                                                            data-action="{{ route('leave.approve', ['id' => $leave->id]) }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#acceptModel"><i class="fa fa-check-circle" aria-hidden="true" data-original-title="accept"></i>
                                                                        </a>
                                                                        <a href="#"
                                                                            class="open-reject-leave btn btn-icon btn-active-light-danger w-30px h-30px"
                                                                            data-action="{{ route('leave.reject', ['id' => $leave->id]) }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#rejectModel"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                        </a>

                                                            @elseif($leave->status == 'approved')
                                                                <div class="badge badge-pill badge-success">
                                                                    {{ $leave->status }}</div>
                                                            @elseif($leave->status == 'rejected')
                                                                <div class="badge badge-pill badge-danger">
                                                                    {{ $leave->status }}</div>
                                                            @elseif($leave->status == 'approvedWithDeduction')
                                                                <div class="badge badge-pill badge-success">
                                                                    {{ $leave->status }}</div>
                                                            @endif
                                                        </td>

                                                        @if(request('status') == 'approved' || request('status') == 'approvedWithDeduction')
                                                            <td>
                                                                @if($leave->ticket_flight_status == 'no_both')
                                                                        {{ __('He did not take advantage of the flights') }}
                                                                @elseif($leave->ticket_flight_status == 'go')
                                                                        {{ __('Going only') }}
                                                                @elseif($leave->ticket_flight_status == 'back')
                                                                        {{ __('Back only') }}
                                                                @elseif($leave->ticket_flight_status == 'go_back')
                                                                        {{ __('Going and coming back') }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td class="text-right action-btns">
                                                            @if ($leave->status == 'pending')
                                                                <span>
                                                                        <a href="#" class="btn btn-icon btn-active-light-success w-30px h-30px" data-url="{{ route('leaves.edit', $leave->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit') }}" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                                                                        <button type="button" class="btn btn-icon confirm-delete btn-active-light-danger w-30px h-30px" data-toggle="tooltip" data-original-title="{{__('Delete')}}" ><i class="fa fa-trash"></i></button>
                                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['leaves.destroy', $leave->id],'id'=>'delete-form-'.$leave->id]) !!}
                                                                        {!! Form::close() !!}
                                                                </span>
                                                            @else
                                                                -
                                                            @endif
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
        <!--end::Content-->
    </div>
@endsection

@push('script-page')
    <script>
        // Get relevant element
        $('.open-reject-leave').click(function() {
            var action = $(this).data('action');
            $('#reject-leave').attr('action', action);
        });

        $('.open-accept-leave').click(function() {
            var action = $(this).data('action');
            $('#accept-leave').attr('action', action);
        });

        $("#deduction-status").change(function() {
            var deduction = $(this).data('deduction');
            if (this.checked) {
                $(this).next('input').prop("disabled", false);
                $('#accept-leave').find('input[name="deduction"]').val(deduction);

            } else {
                $(this).next('input').prop("disabled", true);
                $('#accept-leave').find('input[name="deduction"]').val('');
            }
        });

        $(document).on('change', '#employee_id', function() {
            var employee_id = $(this).val();

            $.ajax({
                url: '{{ route('leave.jsoncount') }}',
                type: 'POST',
                data: {
                    "employee_id": employee_id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {

                    $('#leave_type_id').empty();
                    $('#leave_type_id').append(
                        '<option value="">{{ __('Select Leave Type') }}</option>');

                    $.each(data, function(key, value) {

                        if (value.total_leave >= value.days) {
                            $('#leave_type_id').append('<option value="' + value.id +
                                '" disabled>' + value.title + '&nbsp(' + value.total_leave +
                                '/' + value.days + ')</option>');
                        } else {
                            $('#leave_type_id').append('<option value="' + value.id + '">' +
                                value.title + '&nbsp(' + value.total_leave + '/' + value
                                .days + ')</option>');
                        }
                    });

                }
            });
        });
    </script>

    @if($leaves->count() != 0)
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
                        document.getElementById('delete-form-{{$leave->id}}').submit()
                    }
                });
                return false;
            });
        </script>
    @endif
@endpush
