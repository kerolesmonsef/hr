@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
@endpush


@section('content')
    <div class="employess">
        <div class="pageS1">

            <a href='/hrm/pages/employees/shifts.php'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Create') }}</h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="{{ route('employee-shifts.store') }}" method="post">
                @csrf
                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <div class="inputS1">
                                    <input name="name" value="{{ old('name') }}" type="text" id="employeeName"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{ __('Arabic Name') }}</label>
                                <div class="inputS1">
                                    <input name="name_ar" value="{{ old('name_ar') }}" type="text" id="employeeName"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="shift_starttime" class="form-label">{{ __('Clock In') }}</label>
                                <div class="inputS1">
                                    <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                    <input value="{{ old('shift_starttime') }}" name="shift_starttime" class="time-pickable"
                                        id="shift_starttime">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="shift_endtime" class="form-label">{{ __('Clock Out') }}</label>
                                <div class="inputS1">
                                    <img src="{{ url('new-theme/images/clock.svg') }}" class="iconImg" />
                                    <input value="{{ old('shift_endtime') }}" name="shift_endtime" class="time-pickable"
                                        id="shift_endtime">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex align end gap-15 orders ">
                    <button class='buttonS1 rejected'>
                        {{ __('Cancel') }}
                    </button>
                    <button class='buttonS1 primary'>
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>



    </div>
    </div>
@endsection

@push('script')
    <script>
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
