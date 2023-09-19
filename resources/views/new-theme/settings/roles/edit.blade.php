@extends('new-theme.layout.layout2')

@push('styles')
<link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}" />
@endpush


@section('content')
<div class="addRolePage">
    <div class="pageS1">

        <div class='heading mb-4'>
            <div class='flex align gap-15'>
                <a href='/settings/roles'>
                    <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                </a>
                <h3>{{ __('Edit Role') }}</h3>
            </div>
        </div>


        <form method="post" action="{{ route('roles.update',$role) }}">
            @method('PUT')
            @csrf
            @include('new-theme.settings.roles.form')
        </form>



    </div>

</div>
@endsection

@push('script')
<script>
    var selectAll = (event) => {

        event.preventDefault();

        $(event.target).parent().parent().siblings().children().children(":last-child").each(function(_, ele) {
            $(ele).children().each(function(_, btn) {
                $("input:checkbox").prop('checked', true)
            })
        });

    }

    var deSelectAll = (event) => {

        event.preventDefault();

        $(event.target).parent().parent().siblings().children().children(":last-child").each(function(_, ele) {
            $(ele).children().each(function(_, btn) {
                $("input:checkbox").prop('checked', false)
            })
        });

    }


    var select = (event) => {

        event.preventDefault();

        $(event.target).parent().parent().siblings().children().each(function(_, ele) {
            $(ele).children("input:checkbox").prop('checked', true)
        });

    }

    var deSelect = (event) => {

        event.preventDefault();

        $(event.target).parent().parent().siblings().children().each(function(_, ele) {
            $(ele).children("input:checkbox").prop('checked', false)
        });

    }

</script>
@endpush
