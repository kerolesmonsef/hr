@extends('new-theme.layout.layout3')

@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href='{{ Route('document.index') }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Update') }}</h3>
                    </div>
                </div>
            </a>

            <form class="formS1" method="post" action="{{ route('document.update',$document->id) }}">
                @csrf
                @method('PUT')
                <div class='sectionS2'>
                    <div class='content p-4'>
                        @include('new-theme.settings.document.form')
                    </div>
                </div>

                <div class="flex align end gap-15 orders ">
                    <a class="buttonS1 rejected" href="{{ Route('document.index') }}">
                        {{ __('Cancel') }}
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

