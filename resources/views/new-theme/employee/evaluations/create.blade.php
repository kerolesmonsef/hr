@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
      @livewireStyles
    <wireui:scripts />
{{--    <script src="{{ asset("new-theme/js/alpinejs.min.js") }}" defer></script>--}}
{{--    <script src="{{ asset("new-theme/js/tailwindcss3.2.6.js") }}"></script>--}}
@endpush


@section('content')
    <div class="addEvaluationPage">
        <div class="pageS1">

            <a href='{{ route("evaluation.index") }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3> {{ __('Create') }}</h3>
                    </div>
                </div>
            </a>

            @livewire('evaluation-form',[
                'evaluation'=> $evaluation ?? ''
            ])
{{--            @livewire('test')--}}
            
        </div>
    </div>
@endsection


@push('script')
    @livewireScripts
@endpush