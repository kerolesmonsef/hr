<script src="{{asset('admin/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
<script src="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="{{asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
<script src="{{asset('admin/assets/js/custom/utilities/modals/create-account.js')}}"></script>
<script src="{{asset('admin/assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/intro.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/utilities/modals/create-app.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/utilities/modals/new-target.js')}}"></script>
<script src="{{asset('admin/assets/js/custom/utilities/modals/users-search.js')}}"></script>
<script src="{{asset('admin/assets/js/bootstrap-hijri-datepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugins/ckeditor/ckeditor.js')}}"></script>

<!--end::Custom Javascript-->

@stack('script-page')

@if($message = Session::get('success'))
    <script>
        Swal.fire({
            text: "{{$message}}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "{{__('messages.Ok')}}",
            customClass: {
                confirmButton: "btn btn-success"
            }
        });
    </script>
@endif

@if($errormessage = Session::get('error'))
    <script>
        Swal.fire({
            text: "{{$errormessage}}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "{{__('messages.Ok')}}",
            customClass: {
                confirmButton: "btn btn-danger"
            },
        });
    </script>
@endif

<script>
    // Class definition
    var KTDatatablesExample = function () {
        // Shared variables
        var table;
        var datatable;

        // Private functions
        var initDatatable = function () {
            // Set date data order
            const tableRows = table.querySelectorAll('tbody tr');

            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable = $(table).DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });
        }

        // Hook export buttons
        var exportButtons = () => {
            const documentTitle = 'Customer Orders Report';
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    {
                        extend: 'copyHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'excelHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'csvHtml5',
                        title: documentTitle
                    },
                    {
                        extend: 'pdfHtml5',
                        title: documentTitle
                    }
                ]
            }).container().appendTo($('#kt_datatable_example_buttons'));

            // Hook dropdown menu click event to datatable export buttons
            const exportButtons = document.querySelectorAll('#kt_datatable_example_export_menu [data-kt-export]');
            exportButtons.forEach(exportButton => {
                exportButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Get clicked export value
                    const exportValue = e.target.getAttribute('data-kt-export');
                    const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                    // Trigger click event on hidden datatable export buttons
                    target.click();
                });
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = () => {
            const filterSearch = document.querySelector('[data-kt-filter="search"]');
            filterSearch.addEventListener('keyup', function (e) {
                datatable.search(e.target.value).draw();
            });
        }

        // Public methods
        return {
            init: function () {
                table = document.querySelector('#kt_datatable_example');

                if ( !table ) {
                    return;
                }

                initDatatable();
                exportButtons();
                handleSearchDatatable();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesExample.init();
    });

    $(".datepicker,.gregorian-date").flatpickr();


    $(".timepicker").flatpickr({
        noCalendar: true,
        enableTime: true,
        dateFormat: 'h:i K'
    });

        $(function () {
            $(".gregorian-date , .datepicker").hijriDatePicker({
            format:'YYYY-M-D',
            showSwitcher: false,
            hijri:false,
            useCurrent: true,
            });
        });

        $(function () {
            $(".hijri-date-input , .datepicker").hijriDatePicker({
            hijriFormat:'iYYYY-iM-iD',
            showSwitcher: true,
            hijri:true,
            useCurrent: true,
            });
        });

        for(let i = 1; i <= 18; i++){
            $('#hijri_'+i).on('dp.change', function (arg) {

                if (!arg.date) {
                return;
                };

                let date = arg.date;
                $('#gregorian_'+i).val(date.format("YYYY-M-D"));
            });

            $('#gregorian_'+i).on('dp.change', function (arg) {

                if (!arg.date) {
                return;
                };

                let date = arg.date;
                $('#hijri_'+i).val(date.format("iYYYY-iM-iD"));
            });
        }



    var url = window.location.pathname,
    urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
    // now grab every link from the navigation

    $('.menu-item a').each(function(){
        if(urlRegExp.test(this.href.replace(/\/$/,''))){
            $(this).addClass('active');
            $(this).parents('.menu-item').addClass('hover');
            $(this).parents('.menu-item').addClass('show');
        }
    });

</script>

<script src="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script>
    $('.confirm-btn-delete').click(function(e){
        e.preventDefault();
        Swal.fire({
            html: `{{ __("landpage.Are you sure to delete this item ?") }}`,
            icon: "info",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "{{ __('landpage.Confirm') }}",
            cancelButtonText: "{{ __('landpage.Cancel') }}",
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: 'btn btn-primary'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('data-url');
            }
        });
        return false;
    });
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    });
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor2')
        // bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    });
</script>
