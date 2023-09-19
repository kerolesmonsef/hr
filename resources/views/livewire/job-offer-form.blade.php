<?php
$method = "storeJobOffer";

if ($jobOfferId) $method = "updateJobOffer";
?>
<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <form wire:submit.prevent="{{ $method }}" class="formS1 inputsS1" action="{{ route('job-offers.store') }}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <div class='sectionS2'>
            <div class='content p-4'>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="jobTitle" class="form-label">{{ __('Job Title') }}</label>
                        <div class="inputS1">
                            <input required name="title" wire:model="data.title" id="jobTitle"
                                   placeholder="@lang('Enter Job Title')">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="jobType" class="form-label">{{ __('Job Type') }}</label>
                        <div class="inputS1">
                            <select wire:model="data.job_type" id="jobType">
                                <option value="Full Time">@lang("Full Time")</option>
                                <option value="Part Time">@lang("Part Time")</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="location" class="form-label">{{ __('Location') }}</label>
                        <div class="inputS1">
                            <input required wire:model="data.location" id="location"
                                   placeholder="@lang('Location')">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="experience" class="form-label">{{ __('Experience') }}</label>
                        <div class="inputS1">
                            <input required wire:model="data.experience" id="experience"
                                   placeholder="@lang('Enter Experience years')">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="careerLevel" class="form-label">{{ __('Career Level') }}</label>
                        <div class="inputS1">
                            <input required wire:model="data.career_level" id="careerLevel"
                                   placeholder="@lang('Enter Career Level')">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="careerLevel" class="form-label">@lang("Education Level")</label>
                        <div class="inputS1">
                            <input required wire:model="data.education_level" id=""
                                   placeholder="@lang("Enter Education Level")">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Salary') }} </label>
                        <div class="inputS1">
                            <input required wire:model="data.salary" placeholder="@lang("Enter Salary")">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class="form-label">{{ __('Position Count') }} </label>
                        <div class="inputS1">
                            <input required wire:model="data.positions_count"
                                   placeholder="@lang("Enter Position Count")">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="datepicker" class="form-label">@lang("Start Date")</label>
                        @include("new-theme.components.error1",['error'=>'data.start_date'])
                        <div class="inputS1 noHeight">
                            <img src="/new-theme/icons/date.svg" class="iconImg"/>
                            <input required type="date" wire:model="data.start_date"
                                   placeholder="@lang('Enter Publish Date')" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="datepicker" class="form-label">{{ __('End Date') }}</label>
                        @include("new-theme.components.error1",['error'=>'data.end_date'])
                        <div class="inputS1 noHeight">
                            <img src="/new-theme/icons/date.svg" class="iconImg"/>
                            <input required type="date" wire:model="data.end_date" placeholder="@lang('Enter End Date')"
                                   autocomplete="off"/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="status" class="form-label">{{ __('Status') }}</label>
                        <div class="inputS1">
                            <select name="status" wire:model="data.status">
                                <option value="pending" >{{ __('Pending') }}</option>
                                <option value="approved">{{ __('Approved') }}</option>
                                <option value="rejected">{{ __('Rejected') }}</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <label for="job_description" class="form-label">{{ __('Job Description') }}</label>
                        <div class="inputS1">
                            <textarea  wire:model="data.job_description"
                                      id="job_description"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <label for="job_requirement" class="form-label">{{ __('Job Requirement') }}</label>
                        <div class="inputS1">

                            <textarea  wire:model="data.job_requirement"
                                      id="job_requirement"></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="newSection" data-spy="affix" data-offset-top="197">
            <h3>@lang("Job Offer Details")</h3>
        </div>

        <?php
        $canEdit = true;
        if ($jobOfferId and ($jobOffer = \App\Models\CompanyJobRequest::find($jobOfferId))) {
            $canEdit = $jobOffer->users()->count() == 0;
        }
        ?>
        @if($canEdit)

            @include("livewire.componentns.livewireSectionRepeater")

        @endif

        <div class="flex align end gap-15 orders ">
            <a href="{{ route('job-offers.index') }}" class='buttonS1 rejected'>
                {{ __('Cancel') }}
            </a>
            <button class='buttonS1 primary' type="submit">
                {{ __('Save') }}
            </button>
        </div>

    </form>
</div>
