<?php

$inputType = $question['type'] == "multi_select" ? "checkbox" : "radio";
?>
<div class="row gx-5">
    <div class="col-lg-6 mt-1 mb-2">
        <label for="employeeName" class="form-label">@lang('Answer')</label>
    </div>


    <div class="col-lg-6 mt-1 mb-2">
        <label for="employeeName" class="form-label">@lang('Points')</label>
    </div>
    @foreach ($question['multi_select'] as $optionIndex => $item)
            <?php $itemPrefix = "$prefix.multi_select.$optionIndex"; ?>
        <div class="col-lg-6 mt-1 mb-2">
            <div class="answerS1 flex align between">
                <div class="inputCheckbox">

                    <div class="inputS1">
                        <input type="{{ $inputType }}" checked placeholder="@lang('Enter Option Description')">
                    </div>
                </div>
                <div class="inputS1 answer w-100">
                    <input class="w-100" wire:model="{{ $itemPrefix . '.name' }}" type="text"
                           placeholder="@lang('Enter Option Description')">
                </div>


                <div
                    wire:click="deleteQuestionOption({{ $sectionIndex }} , {{ $questionIndex }} , {{ $optionIndex }})">
                    <img style="cursor: pointer" src="{{ asset('new-theme/icons/all/delete.svg') }}">
                </div>


            </div>
        </div>


        <div class="col-lg-6 mt-1 mb-2">
            <div class="points">
                <div class="inputS1">
                    <input class="w-100" wire:model="{{ $itemPrefix . '.point' }}" type="number" placeholder="points"
                           name="choice1">
                </div>
            </div>
        </div>
    @endforeach


    <div class="col-lg-12">
        <div class="inputCheckbox addNewOption">
            <button wire:click="addQuestionOption({{ $sectionIndex }} , {{ $questionIndex }})" class="buttonS2 noBG "
                    type="button">
                <img src="{{ asset('new-theme/icons/plus-3.svg') }}">
                @lang('Add New option')
            </button>
        </div>
    </div>

</div>
