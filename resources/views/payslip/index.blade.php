@extends('layouts.admin')
@section('page-title')
    {{__('Payslip')}}
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
                    <h1 class="fw-bold mb-5">{{__('Payslip')}}</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <!--begin::Filter menu-->
                            <div class="m-0">
                                <!--begin::Menu toggle-->
                                <a href="#" style="width:100% !important;" class="btn btn-block btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{__('Filter')}}</a>
                                <!--end::Menu toggle-->
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_62fb49906e46a" style="">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">{{__('Filter Options')}}</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        {{Form::open(array('route'=>array('payslip.store'),'method'=>'POST','class'=>'w-100','id'=>'payslip_form'))}}
                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">{{__('Select Month')}}:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <div class="btn-box">
                                                        {{Form::select('month',$month,null,array('class'=>'form-control month select2' ))}}
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10">
                                                <!--begin::Label-->
                                                <label class="form-label fw-semibold">{{__('Select Year')}}:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <div class="btn-box">
                                                        {{Form::select('year',$year,null,array('class'=>'form-control year select2' ))}}
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button  onclick="document.getElementById('timesheet_filter').submit(); return false;" class="btn btn-sm btn-primary"> {{__('Generate Payslip')}} </button>
                                            </div>
                                            <!--end::Actions-->
                                        {{ Form::close() }}
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                            </div>
                        <!--end::Filter menu-->
                        </div>
                        <div class="col-md-4">
                            <!--begin::Primary button-->
                            @can('Create Pay Slip')
                                <a id="payrollpdf" target="_blank" href="#" class="btn btn-info w-100 btn-icon-only width-auto">
                                    {{ __('Monthly payroll Log') }} <i class="fa fa-file-pdf-o"></i>
                                </a>


                            @endcan
                        <!--end::Primary button-->
                        </div>
                        <div class="col-md-4">
                            <!--begin::Primary button-->
                            @can('Create Pay Slip')


                                <a id="payrollbarpdf" target="_blank" href="#" class="btn btn-info w-100 btn-icon-only width-auto">
                                    {{ __('salary bar') }} <i class="fa fa-file-pdf-o"></i>
                                </a>
                            @endcan
                        <!--end::Primary button-->
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">



                    </div>

                    <div class="card-header mt-4">
                        <div class="d-flex justify-content-between w-100">
                            <h6 class="float-right col-3 mt-4 p-1">{{__('Find Employee Payslip')}}</h6>

                            <div class="float-right col-2 p-1">
                                <select class="form-control month_date select2" name="year" tabindex="-1" aria-hidden="true">
                                    @foreach($months as $k=>$mon)
                                        <option value="{{$k}}" @if(date("m") == $k) selected @endif>{{$mon}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="float-right col-2 p-1">
                                {{Form::select('year',$years,date('Y'),array('class'=>'form-control year_date select2'))}}
                            </div>

                            <div class="float-right col-2 p-1">
                                {{Form::select('year',['0,1' => __('All') , '1' => __('with Contract') , '0' => __('without contract')],date('Y'),array('class'=>'form-control contract_type select2'))}}
                            </div>

                            @can('Create Pay Slip')
                                <button type="button" class="btn btn-primary col-3 float-right search mt-2 h-40px" id="bulk_payment">{{__('Bulk Payment')}}</button>
                            @endcan

                        </div>
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
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Search')}}">
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--end::Card title-->

                                <!--begin::Card toolbar-->
                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                    <!--begin::Export dropdown-->
                                    <button type="button" class="btn btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr091.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(0 -1 -1 0 12.75 19.75)" fill="currentColor"></rect>
                                            <path d="M12.0573 17.8813L13.5203 16.1256C13.9121 15.6554 14.6232 15.6232 15.056 16.056C15.4457 16.4457 15.4641 17.0716 15.0979 17.4836L12.4974 20.4092C12.0996 20.8567 11.4004 20.8567 11.0026 20.4092L8.40206 17.4836C8.0359 17.0716 8.0543 16.4457 8.44401 16.056C8.87683 15.6232 9.58785 15.6554 9.9797 16.1256L11.4427 17.8813C11.6026 18.0732 11.8974 18.0732 12.0573 17.8813Z" fill="currentColor"></path>
                                            <path opacity="0.3" d="M18.75 15.75H17.75C17.1977 15.75 16.75 15.3023 16.75 14.75C16.75 14.1977 17.1977 13.75 17.75 13.75C18.3023 13.75 18.75 13.3023 18.75 12.75V5.75C18.75 5.19771 18.3023 4.75 17.75 4.75L5.75 4.75C5.19772 4.75 4.75 5.19771 4.75 5.75V12.75C4.75 13.3023 5.19771 13.75 5.75 13.75C6.30229 13.75 6.75 14.1977 6.75 14.75C6.75 15.3023 6.30229 15.75 5.75 15.75H4.75C3.64543 15.75 2.75 14.8546 2.75 13.75V4.75C2.75 3.64543 3.64543 2.75 4.75 2.75L18.75 2.75C19.8546 2.75 20.75 3.64543 20.75 4.75V13.75C20.75 14.8546 19.8546 15.75 18.75 15.75Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    {{__('Export')}}</button>
                                    <!--begin::Menu-->
                                    <div id="kt_datatable_example_export_menu" data-kt-menu="true" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="copy">{{__('Copy to clipboard')}}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="excel">{{__('Export as Excel')}}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="csv">{{__('Export as CSV')}}</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-export="pdf">{{__('Export as PDF')}}</a>
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

                                <!--begin::Card body-->
                                <div class="card-body">
                                    <!--begin::Table-->
                                    <table id="payslipTable" class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                                <th class="min-w-100px">{{__('Id')}}</th>
                                                <th class="min-w-100px">{{__('Employee Id')}}</th>
                                                <th class="min-w-100px">{{__('Name')}}</th>
                                                <th class="min-w-100px">{{__('Payroll Type') }}</th>
                                                <th class="min-w-100px">{{__('Salary') }}</th>
                                                <th class="min-w-100px">{{__('Net Salary') }}</th>
                                                <th class="min-w-100px">{{__('Status') }}</th>
                                                <th class="min-w-100px">{{__('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
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
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#payslipTable').DataTable({
                "aoColumnDefs": [
                    {
                        "aTargets": [6],
                        "mData": null,
                        "mRender": function (data, type, full) {
                            var month = $(".month_date").val();
                            var year  = $(".year_date").val();
                            var contract_type = $(".contract_type").val();
                            var datePicker = year + '-' + month;
                            var id = data[0];

                            if (data[6] == 'Paid')
                                return '<div class="badge badge-pill badge-success"><a href="#" class="text-white">' + data[6] + '</a></div>';
                            else
                                return '<div class="badge badge-pill badge-danger"><a href="#" class="text-white">' + data[6] + '</a></div>';
                        }
                    },
                    {
                        "aTargets": [7],
                        "mData": null,
                        "mRender": function (data, type, full) {
                            var month = $(".month_date").val();
                            var year = $(".year_date").val();
                            var datePicker = year + '-' + month;

                            var id = data[0];
                            var payslip_id = data[7];

                            var clickToPaid = '';
                            var employee_receipt = '';
                            var payslip = '';
                            var view = '';
                            var edit = '';
                            var deleted = '';
                            var form = '';

                            if(data[6] != 0) {
                                var payslip = '<a href="#" data-url="{{ url('payslip/pdf/') }}/' + id + '/' + datePicker + '" data-size="md-pdf"  data-ajax-popup="true" class="btn btn-icon btn-active-light-warning w-30px h-30px" data-title="{{__('Employee Payslip')}}"><i class="fa fa-eye"></i></a> ';
                            }

                            if (data[6] == "UnPaid" && data[7] != 0) {
                                clickToPaid = '<a href="{{ url('payslip/paysalary/') }}/' + id + '/' + datePicker + '"  class="btn btn-icon btn-active-light-success w-30px h-30px"> <i class="fa fa-credit-card"></i> </a>  ';
                            }



                            employee_receipt = '<a target="_blank" href="{{ url('payslip/employeePayrollbarpdf/') }}/' + payslip_id + '/' + month + '/' + year + '"  class="btn btn-icon btn-active-light-success w-30px h-30px"><i class="fa fa-file-pdf"></i></a> ';

                            var url = '{{ route("payslip.delete", ":id") }}';
                            url = url.replace(':id', payslip_id);

                            @if(auth()->user()->type!='employee')
                            if (data[7] != 0) {
                                deleted = '<a href="#"  data-url="' + url + '" class="payslip_delete btn btn-icon btn-active-light-danger w-30px h-30px" ><i class="fa fa-trash"></i></a>';
                            }
                            @endif

                            return view + payslip + clickToPaid + edit + deleted + form + employee_receipt;
                        }
                    },
                ]
            });

            function callback() {
                var month         = $(".month_date").val();
                var year          = $(".year_date").val();
                var contract_type = $(".contract_type").val();

                var datePicker = year + '-' + month;
                var route      = "{{ route('payslip.exportExcel',['monthValue','yaerValue','type']) }}";
                var url        = route.replace('monthValue' ,month);
                url            = url.replace('yaerValue' ,year);
                url            = url.replace('type' ,contract_type);
                $('#payrollexport').attr('href' , url);

                var route2 = "{{ route('payslip.Payrollpdf',['monthValue','yaerValue','type']) }}";
                var url2   = route2.replace('monthValue' ,month);
                url2       = url2.replace('yaerValue' ,year);
                url2       = url2.replace('type' ,contract_type);
                $('#payrollpdf').attr('href' , url2);

                var route3 = "{{ route('payslip.Payrollbarpdf',['monthValue','yaerValue','type']) }}";
                var url3   = route3.replace('monthValue' ,month);
                url3       = url3.replace('yaerValue' ,year);
                url3       = url3.replace('type' ,contract_type);
                $('#payrollbarpdf').attr('href' , url3);

                $.ajax({
                    url: '{{route('payslip.search_json')}}',
                    type: 'POST',
                    data: {
                        "datePicker": datePicker,"contract_type" : contract_type, "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {

                        table.rows().remove().draw();
                        table.rows.add(data).draw();
                        table.column(0).visible(false);
                        $('[data-toggle="tooltip"]').tooltip();

                        if (!(data)) {
                            show_toastr('error', 'Employee payslip not found ! please generate first.', 'error');
                        }
                    },
                    error: function (data) {

                    }
                });
            }

            callback();

            $(document).on("change", ".month_date,.year_date,.contract_type ", function () {
                callback();
            });

            //bulkpayment Click
            $(document).on("click", "#bulk_payment", function () {
                var month = $(".month_date").val();
                var year = $(".year_date").val();
                var datePicker = year + '_' + month;
            });

            $(document).on('click', '#bulk_payment', 'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]', function () {
                var month = $(".month_date").val();
                var year = $(".year_date").val();
                var datePicker = year + '-' + month;

                var title = 'Bulk Payment';
                var size = 'md';
                var url = 'payslip/bulk_pay_create/' + datePicker;

                // return false;

                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $.ajax({
                    url: url,
                    success: function (data) {

                        // alert(data);
                        // return false;
                        if (data.length) {
                            $('#commonModal .modal-body').html(data);
                            $("#commonModal").modal('show');
                            // common_bind();
                        } else {
                            show_toastr('Error', 'Permission denied.');
                            $("#commonModal").modal('hide');
                        }
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        show_toastr('Error', data.error);
                    }
                });
            });

            $(document).on("click", ".payslip_delete", function () {
                var confirmation = confirm("are you sure you want to delete this payslip?");
                var url = $(this).data('url');
                if (confirmation) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "JSON",
                        success: function (data) {

                            show_toastr('Success', 'Payslip successfully deleted', 'success');

                            setTimeout(function () {
                                location.reload();
                            }, 800)


                        },

                    });

                }
            });

        });
    </script>
@endpush


