@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/joboffers.css') }}" />
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />

    @livewireStyles
@endpush

@section('content')
    <div class="containerS1 ">

        <div class="addJobofferPage addEvaluationPage">
            <div class="pageS1">

                <a href='{{ route('job-offers.index') }}'>
                    <div class='heading mb-4'>
                        <div class='flex align gap-15'>
                            <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                            <h3>{{ __('Create') }}</h3>
                        </div>
                    </div>
                </a>

                @livewire("job-offer-form",[
                    'offer'=> $offer ?? ''
                ])
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
    <script src="{{ asset("js/monthSelect.js") }}"></script>
    <script src="{{ asset("js/flatpickr.js") }}"></script>
    <script>
        ClassicEditor.create(document.querySelector("#editor")).catch((error) => {})
    </script>
    @livewireScripts


    <!-- onUpload file -->
    <script>
        function getFileData(myFile) {
            let file = myFile.files[0];
            const fileName = document.getElementById("fileName")

            fileName.innerHTML = `Uploaded ${file.name}`
        }
    </script>
@endpush
