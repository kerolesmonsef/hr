<?php
$saveMethod = $evaluationId ? 'updateEvaluation' : 'storeEvaluation';
?>
<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <form wire:submit.prevent="{{ $saveMethod }}" class="formS1 inputsS1">
        <div class='sectionS2'>
            <div class="head withBorder">
                <h3 class='small'>{{ __('Evaluation Form') }}</h3>
            </div>
            <div class='content'>
                <div class="row gx-5">
                    <div class="col-lg-6">
                        <label for="title" class="form-label">{{ __('Title') }}</label>
                        @include('new-theme.components.error1', ['error' => 'data.title'])
                        <div class="inputS1">
                            <input wire:model="data.title" type="text" id="title" placeholder=''>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="employee_id" class="form-label">{{ __('Employees') }}</label>
                        @include('new-theme.components.error1', ['error' => 'data.employee_id'])
                        <div class="inputS1">
                            <select style="height: 100px"  wire:model="data.employee_id"
                                name="employee_id" multiple id="employee_id">
                                <option value="all">All</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ app()->isLocale('en') ? $employee->name : $employee->name_ar }}
                                    </option>
                                @endforeach
                            </select>




                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                        <div class="inputS1">

                            <img src="/new-theme/icons/date.svg" class="iconImg" />
                            @include("new-theme.components.error1", ["error" => "data.start_date"])
                            <input wire:model="data.start_date" id="start_date" type="date" placeholder="Enter Date"
                                name="datepicker" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                        @include("new-theme.components.error1", ["error" => "data.end_date"])
                        <div class="inputS1">

                            <img src="/new-theme/icons/date.svg" class="iconImg" />
                            <input wire:model="data.end_date" id="end_date" type="date" placeholder="Enter Date"
                                name="datepicker" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="type" class="form-label">{{ __('Type') }}</label>
                        <div class="inputS1">
                            <select wire:model="data.type" id="type" name="type">
                                <option value="yearly">{{ __('Yearly') }}</option>
                                <option value="semi">{{ __('Semi') }}</option>
                                <option value="quarter">{{ __('Quarter') }}</option>
                                <option value="monthly">{{ __('Monthly') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="newSection" data-spy="affix" data-offset-top="197">
            <h3>{{__("Evaluation Details")}}</h3>
        </div>

        @include('livewire.componentns.livewireSectionRepeater')


        <div class="flex align end gap-15">
            <a href="{{ route('evaluation.index') }}" class='buttonS1 rejected'>
                {{ __('Cancel') }}
            </a>
            <button class='buttonS1 primary' type="submit">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
