@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
@endpush


@section('content')
    <div class="addPerformancePage">
        <div class="pageS1">

            <a href='{{Route('performance.index')}}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{__('Update')}}</h3>
                    </div>
                </div>
            </a>

            <form action="{{ route('performance.update',$performance->id) }}" method="post" class="formS1 inputsS1">
                @method('PATCH')
                @csrf

                {{-- <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">

                            <div class="col-lg-6">
                                <label for="datepicker" class="form-label">{{__('Employee Name')}}</label>
                                <div class="inputS1">
                                    <select name="employee_id" id="performanceEmployee" required>
                                        <option value="">{{__('Choose')}}</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}" @if($employee->id == $performance->employee_id) selected @endif>{{$employee['name'.$lang]}}</option>
                                        @endforeach
                                    </select>
                                    @include('new-theme.components.error1', ['error' => 'employee_id'])
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="name" class="form-label">{{__('Performance Type')}}</label>
                                <div class="inputS1">
                                    <select id="performancePeriod" name="performance_period_id" required>
                                        <option value="">{{__('Choose')}}</option>
                                        @foreach($performance_periods as $period)
                                            <option value="{{$period->id}}" @if($period->id == $performance->performance_period_id) selected @endif>{{$period['name'.$lang]}}</option>
                                        @endforeach
                                    </select>
                                    @include('new-theme.components.error1', ['error' => 'performance_period_id'])
                                </div>
                            </div>

                        </div>
                    </div>
                </div> --}}

                <div id="performance_factors">
                    @foreach($performanceDetails as $key => $performanceFactor)
                    <input type="hidden" name="performance[{{$key}}][id]" value="{{$performanceFactor->id}}">
                    <div id="performaneSections">
                        <div class='sectionS2'>
                            <div class="head withBorder flex align between">
                                <h3 class="small">{{__('Performance Factor')}} {{$key+1}}</h3>
                        
                            </div>
                            <div class='content p-4'>
                                <div class="row card-s">
                                    <div class="col-lg-6 ">
                                        <label for="performanceFactor" class="form-label">{{__('Performance Factor')}}</label>
                                        <div class="inputS1">
                                            <input type="text" name="performance[{{$key}}][performance_factor]" value="{{$performanceFactor->performance_factor}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="code" class="form-label">{{__('Rating')}}</label>
                                        <div class="flex align gap-2 wrap">
                                            <div class="form-check flex align ">
                                                <input class="radioInput" type="radio" value="5" @if($performanceFactor->points == 5) checked @endif name="performance[{{$key}}][option]"
                                                    id="id1{{$key}}">
                                                <label class="form-check-label mb-0" for="id1{{$key}}">
                                                    {{__('Excellent')}}
                                                </label>
                                            </div>
                                            <div class="form-check flex align ">
                                                <input class="radioInput" type="radio" value="4" @if($performanceFactor->points == 4) checked @endif name="performance[{{$key}}][option]"
                                                    id="id2{{$key}}">
                                                <label class="form-check-label mb-0" for="id2{{$key}}">
                                                    {{__('Good')}}
                                                </label>
                                            </div>
                                            <div class="form-check flex align ">
                                                <input class="radioInput" type="radio" value="3" @if($performanceFactor->points == 3) checked @endif name="performance[{{$key}}][option]"
                                                    id="id3{{$key}}">
                                                <label class="form-check-label mb-0" for="id3{{$key}}">
                                                    {{__('Satisfactory')}}
                                                </label>
                                            </div>
                                            <div class="form-check flex align ">
                                                <input class="radioInput" type="radio" value="2" @if($performanceFactor->points == 2) checked @endif name="performance[{{$key}}][option]"
                                                    id="id4{{$key}}">
                                                <label class="form-check-label mb-0" for="id4{{$key}}">
                                                    {{__('Fair')}}
                                                </label>
                                            </div>
                                            <div class="form-check flex align ">
                                                <input class="radioInput" type="radio" value="1" @if($performanceFactor->points == 1) checked @endif name="performance[{{$key}}][option]"
                                                    id="id5{{$key}}">
                                                <label class="form-check-label mb-0" for="id5{{$key}}">
                                                    {{__('Poor')}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col-lg-6">
                                        <label for="amount" class="form-label">{{__('Points')}}</label>
                                        <div class="inputS1">
                                            <input class="points-s" type="number" value="{{$performanceFactor->points}}" id="points{{$key}}"  name="performance[{{$key}}][points]" required readonly />
                                        </div>
                                    </div>
                
                                    <div class="col-lg-6">
                                        <label for="note_{{$key}}" class="form-label">{{__('Notes')}}</label>
                
                                        <div class="inputS1">
                                            <input type="text" id="note_{{$key}}" value="{{$performanceFactor->notes}}" name="performance[{{$key}}][notes]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>

                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row card-s">
                            <div class="col-lg-6">
                                <label for="name" class="form-label"> {{__('Total Points')}}</label>
                                <div class="inputS1">
                                    <input type="number"  readonly step="any" id="total_points" value=""/>
                                    <input type="hidden" name="rate" id="total_rate" value="">
                                </div>
                            </div>
                
                            <div class="col-lg-6">
                                <label for="discountMonthly" class="form-label">{{__('Overall Rating')}}</label>
                                <div class="rating">
                                    <div class="starsView" style="--rating: 0;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="flex align end gap-15 orders">
                    <a href='{{ Route('performance.index') }}'>
                    <button class='buttonS1 rejected' type="button">
                        {{ __('Cancel') }}
                    </button>
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        {{__('Save')}}
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

        $(document).on('change','.radioInput',function () {
            $(this).parents('.card-s').find(".points-s").val($(this).val());
            total_rate();
        });

        total_rate();

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
