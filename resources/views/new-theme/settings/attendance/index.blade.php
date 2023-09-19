@extends('new-theme.layout.layout1')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <script  type="module"  src="/new-theme/js/mapPlaces.js"></script>


    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<style>
    .custom-tag{
        width: 100%;
        padding: 0 7px;
        min-height: 50px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }
</style>
@endpush



@section('content')
    <div class="attendancePage">
        <div class="pageS1">
            @component('new-theme.settings.attendance.components.tabs') 
                    @include('new-theme.settings.attendance.components.attendance')
                    @slot('active' , 'attendance-m')
            @endcomponent
        </div>
    </div>
@endsection


@push('script')
        <!-- Multiple Select -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('#multipleSelectWeekVacations').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });

        $('#multipleSelectIpAddress').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
        });
    </script>


    <!-- google -->

    {{--  <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI_RMou3a6VxOpnnIp-oXR5XX9vowQYLg&callback=initAutocomplete&libraries=places&v=weekly"
         defer></script>  --}}
    
    <script>
        const switchInput = (event, inputId) => {
            let getInput = document.getElementById(inputId);

            if (event.target.checked) {
                getInput.removeAttribute('disabled')
                getInput.classList.remove("disabled")
                tagsInput.setDisabled(false);
            } else {
                getInput.setAttribute('disabled', true)
                getInput.classList.add("disabled")
                tagsInput.removeAllTags();
                tagsInput.setDisabled(true);
            }
        }

        const switchInput3 = (event, inputId) => {
            let getInput = document.getElementById(inputId);

            if (event.target.checked) {
                tagsInput.setDisabled(false);
            } else {
                tagsInput.removeAllTags();
                tagsInput.setDisabled(true);
            }
        }
        const switchInput2 = (event, inputId) => {
            let getInput = document.getElementById(inputId);

            if (event.target.checked) {
                getInput.style.display = "block";
            } else {
                getInput.style.display = "none";
            }
        }
    </script>


        <script src="https://unpkg.com/@yaireo/tagify"></script>
        <script src="https://unpkg.com/@yaireo/tagify@3.1.0/dist/tagify.polyfills.min.js"></script>

        <script>
            // The DOM element you wish to replace with Tagify
            var input = document.querySelector('.custom-tag');

            // initialize Tagify on the above input node reference
            tagsInput =  new Tagify(input);
        </script>
@endpush
