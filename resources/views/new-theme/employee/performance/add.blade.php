@foreach ($performanceFactors as $key => $performanceFactor)
    <div id="performaneSections">
        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class="small">{{ __('Performance Factor') }} {{ $key + 1 }}</h3>

            </div>
            <div class='content p-4'>
                <div class="row card-s">
                    <div class="col-lg-6 ">
                        <label for="performanceFactor" class="form-label">{{ __('Performance Factor') }}</label>
                        <div class="inputS1">
                            <input type="text" name="performance[{{ $key }}][factor]"
                                value="{{ $performanceFactor->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="code" class="form-label">{{ __('Rating') }}</label>
                        <div class="flex align gap-2 wrap">
                            <div class="form-check">
                                <input class="performanceRate" type="radio" value="5"
                                    name="performance[{{ $key }}][option]" id="id1{{ $key }}">
                                <label class="form-check-label" for="id1{{ $key }}">
                                    {{ __('Excellent') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="performanceRate" type="radio" value="4"
                                    name="performance[{{ $key }}][option]" id="id2{{ $key }}">
                                <label class="form-check-label" for="id2{{ $key }}">
                                    {{ __('Very good') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="performanceRate" type="radio" value="3"
                                    name="performance[{{ $key }}][option]" id="id3{{ $key }}">
                                <label class="form-check-label" for="id3{{ $key }}">
                                    {{ __('Good') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="performanceRate" type="radio" value="2"
                                    name="performance[{{ $key }}][option]" id="id4{{ $key }}">
                                <label class="form-check-label" for="id4{{ $key }}">
                                    {{ __('Fair') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="performanceRate" type="radio" value="1"
                                    name="performance[{{ $key }}][option]" id="id5{{ $key }}">
                                <label class="form-check-label" for="id5{{ $key }}">
                                    {{ __('Poor') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="amount" class="form-label">{{ __('Points') }}</label>
                        <div class="inputS1">
                            <input class="points-s" type="number" value="0" id="points{{ $key }}"
                                name="performance[{{ $key }}][points]" required readonly />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="note_{{ $key }}" class="form-label">{{ __('Notes') }}</label>

                        <div class="inputS1">
                            <input type="text" id="note_{{ $key }}"
                                name="performance[{{ $key }}][notes]">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endforeach


<div class='sectionS2'>
    <div class='content p-4'>
        <div class="row card-s">
            <div class="col-lg-6">
                <label for="name" class="form-label"> {{__('Total Points')}}</label>
                <div class="inputS1">
                    <input type="number" step="any" readonly  id="total_points" value=""/>
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
