@extends('new-theme.layout.layout1', ['showSettingMenu' => true])

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}" />
@endpush

@section('content')
    <div class="branchesPage">
        <div class="pageS1">
            @component('new-theme.settings.salary.components.tabs')
                @slot('active', 'salary')
                <div class="tab-pane fade show active" id="salary" role="tabpanel" aria-labelledby="salary-tab">
                    <form action="{{ route('salary_setting.store') }}" class="formS1" method="post">
                        @csrf

                        <div class="sectionS2">
                            <div class="head withBorder flex align between">
                                <h3 class='small'>@lang('insurance Settings')</h3>
                                <div class="inputS1 m-0" style="width: 100px">
                                    
                                </div>
                            </div>
                        </div>
                        @include('new-theme.settings.salary.components.saudi')
                    </form>
                </div>
            @endcomponent
        </div>
    </div>
@endsection

