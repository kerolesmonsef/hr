@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
@endpush


@section('content')
    <div class="addPerformancePage">
        <div class="pageS1">

            <a href='{{ Route('performance.index') }}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('Add New') }}</h3>
                    </div>
                </div>
            </a>

            <form action="{{ route('performance.store') }}" method="post" class="formS1 inputsS1">
                @csrf

                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">

                            <div class="col-lg-6">
                                <label for="datepicker" class="form-label">{{ __('Employee Name') }}</label>
                                <div class="inputS1">
                                    <select name="employee_id" id="performanceEmployee" required>
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee['name' . $lang] }}</option>
                                        @endforeach
                                    </select>
                                    @include('new-theme.components.error1', ['error' => 'employee_id'])
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{ __('Performance Type') }}</label>
                                <div class="inputS1">
                                    <select id="performancePeriod" name="performance_period_id" required>
                                        <option value="">{{ __('Choose') }}</option>
                                        @foreach ($performance_periods as $period)
                                            <option value="{{ $period->id }}">{{ $period['name' . $lang] }}</option>
                                        @endforeach
                                    </select>
                                    @include('new-theme.components.error1', [
                                        'error' => 'performance_period_id',
                                    ])
                                </div>
                            </div>




                        </div>
                    </div>
                </div>






                <div id="performance_factors">

                </div>

                <div class="flex align end gap-15 orders">
                    <a href='{{ Route('performance.index') }}'>
                    <button class='buttonS1 rejected' type="button">
                        {{ __('Cancel') }}
                    </button>
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            function fetch_data(query) {
                $.ajax({
                    url: "{{ route('performance.create_ajax') }}",
                    data: {
                        "search": query
                    },
                    success: function(data) {
                        $('#performance_factors').html('');
                        $('#performance_factors').html(data.search);
                    }
                })
            }

            $(document).on('change', '#performancePeriod', function() {
                var query = $('#performancePeriod').val();
                fetch_data(query);
            });
        });

        $(document).on('change', '.performanceRate', function() {
            $(this).parents('.card-s').find(".points-s").val($(this).val());
            total_rate();
        });

        function total_rate(){
            var count = 0;
            var total = 0;
            $('.points-s').each(function(){
                var value = parseInt($(this).val());
                if(value != 0){
                    count++;
                    total += value;
                }
            });

            var total_stars = count != 0 ? total / count : 0;
            $('#total_points').val(total);
            $('#total_rate').val(total_stars);
            $(".starsView").css("--rating",total_stars);
        }
    </script>
@endpush
