@extends('new-theme.layout.layout1')
@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}"/>
@endpush
@section('content')
    <div class="evaluationFormPage">
        <div class="pageS1">
            <div class="pageS1">

                <div >
                    <div class='heading mb-4'>
                        <div class='flex align gap-15'>
                            <img src='/hrm/src/icons/arrowLeft.svg' alt=''/>
                            <h3>@lang("Job Offer Form")</h3>
                        </div>
                    </div>
                </div>

                <div class="drawerS1">
                    <div class="sectionDDS1">
                        <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                             aria-controls="employeeInformation">
                            <div class="ant-collapse flex align between mb-4">
                                <div class="flex align gap-15 ant-collapse-header" aria-expanded="true"
                                     aria-disabled="false" role="button" tabindex="0">
                                    <div class="ant-collapse-expand-icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 19.25C15.1086 19.25 19.25 15.1086 19.25 10C19.25 4.89137 15.1086 0.75 10 0.75C4.89137 0.75 0.75 4.89137 0.75 10C0.75 15.1086 4.89137 19.25 10 19.25Z"
                                                stroke="#001B19" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path d="M7.59 11L10 9L12.41 11" stroke="#001B19" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span class="ant-collapse-header-text">
                                        <h3>@lang("Personal Information")</h3>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class='sectionS1 mb-4'>
                            <div class="collapse show" id="employeeInformation">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Name")</h5>
                                            <p>{{ $user->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Date Of Birth")</h5>
                                            <p>{{ $user->date_of_birth }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Gender")</h5>
                                            <p>@lang($user->gender)</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Nationality")</h5>
                                            <p>{{ $user->nationality?->{"name".$lang} }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("CV")</h5>
                                            <a href="{{ $user->getCvUrl() }}">
                                                @lang("click to Download")
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    
                    <div class="sectionDDS1">
                        <div data-bs-toggle="collapse" data-bs-target="#locationInformation" aria-expanded="true"
                             aria-controls="locationInformation">
                            <div class="ant-collapse flex align between mb-4">
                                <div class="flex align gap-15 ant-collapse-header" aria-expanded="true"
                                     aria-disabled="false" role="button" tabindex="0">
                                    <div class="ant-collapse-expand-icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 19.25C15.1086 19.25 19.25 15.1086 19.25 10C19.25 4.89137 15.1086 0.75 10 0.75C4.89137 0.75 0.75 4.89137 0.75 10C0.75 15.1086 4.89137 19.25 10 19.25Z"
                                                stroke="#001B19" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path d="M7.59 11L10 9L12.41 11" stroke="#001B19" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span class="ant-collapse-header-text">
                                        <h3>@lang("Location Information")</h3>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class='sectionS1 mb-4'>
                            <div class="collapse show" id="locationInformation">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Country")</h5>
                                            <p>{{ $user->country }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("City")</h5>
                                            <p>{{ $user->city }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Area")</h5>
                                            <p>@lang($user->area)</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="sectionDDS1">
                        <div data-bs-toggle="collapse" data-bs-target="#contactInformation" aria-expanded="true"
                             aria-controls="contactInformation">
                            <div class="ant-collapse flex align between mb-4">
                                <div class="flex align gap-15 ant-collapse-header" aria-expanded="true"
                                     aria-disabled="false" role="button" tabindex="0">
                                    <div class="ant-collapse-expand-icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 19.25C15.1086 19.25 19.25 15.1086 19.25 10C19.25 4.89137 15.1086 0.75 10 0.75C4.89137 0.75 0.75 4.89137 0.75 10C0.75 15.1086 4.89137 19.25 10 19.25Z"
                                                stroke="#001B19" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path d="M7.59 11L10 9L12.41 11" stroke="#001B19" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span class="ant-collapse-header-text">
                                        <h3>@lang("Contact Information")</h3>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class='sectionS1 mb-4'>
                            <div class="collapse show" id="contactInformation">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Phone")</h5>
                                            <p>{{ $user->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Email")</h5>
                                            <p>{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    
                    <div class="sectionDDS1">
                        <div data-bs-toggle="collapse" data-bs-target="#studyInformation" aria-expanded="true"
                             aria-controls="studyInformation">
                            <div class="ant-collapse flex align between mb-4">
                                <div class="flex align gap-15 ant-collapse-header" aria-expanded="true"
                                     aria-disabled="false" role="button" tabindex="0">
                                    <div class="ant-collapse-expand-icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10 19.25C15.1086 19.25 19.25 15.1086 19.25 10C19.25 4.89137 15.1086 0.75 10 0.75C4.89137 0.75 0.75 4.89137 0.75 10C0.75 15.1086 4.89137 19.25 10 19.25Z"
                                                stroke="#001B19" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path d="M7.59 11L10 9L12.41 11" stroke="#001B19" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <span class="ant-collapse-header-text">
                                        <h3>@lang("Study Information")</h3>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class='sectionS1 mb-4'>
                            <div class="collapse show" id="studyInformation">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Qualification")</h5>
                                            <p>{{ $user->qualification?->institute_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Field Of Study")</h5>
                                            <p>{{ $user->field_of_study }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("University")</h5>
                                            <p>{{ $user->university }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Graduation Year")</h5>
                                            <p>{{ $user->graduation_year }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Grade")</h5>
                                            <p>{{ $user->grade }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Portfolio Link")</h5>
                                            <p>{{ $user->portfolio_link }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("CV")</h5>
                                            <a href="{{ $user->getCvUrl() }}">
                                                @lang("click to Download")
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>


                <div class="drawerS1">
                    @foreach(($user->job_offer->sections ?? []) as $section)


                        <div class="sectionDDS1">
                            <div data-bs-toggle="collapse" data-bs-target="#sectionId-{{ $section->id }}" aria-expanded="true"
                                 aria-controls="sectionId">
                                <div class="ant-collapse flex align between mb-4">
                                    <div class="flex align gap-15 ant-collapse-header" aria-expanded="true"
                                         aria-disabled="false" role="button" tabindex="0">
                                        <div class="ant-collapse-expand-icon">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10 19.25C15.1086 19.25 19.25 15.1086 19.25 10C19.25 4.89137 15.1086 0.75 10 0.75C4.89137 0.75 0.75 4.89137 0.75 10C0.75 15.1086 4.89137 19.25 10 19.25Z"
                                                    stroke="#001B19" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path d="M7.59 11L10 9L12.41 11" stroke="#001B19" stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>

                                        </div>
                                        <span class="ant-collapse-header-text">
                                        <h3>{{ $section->title }}</h3>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class='sectionS2 mb-4'>

                                <div class="collapse show" id="sectionId-{{ $section->id }}">

                                    @foreach($section->questions as $question)
                                        @include("new-theme.job-offers.components.question-answer")
                                    @endforeach

                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>


                <div class='sectionS1'>
                    <div class="row">
                        <div class="col-lg-6">
                            <label  class="form-label"> @lang("Total Points")</label>
                            <div class="inputS1">
                                <input type="number" value="{{ $offerService->getUserRate($user,"points") }}" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="discountMonthly" class="form-label">@lang("Overall Rating")</label>
                            <div class="rating">
                                {!! generateStarRating($offerService->getUserRate($user),['ul_class'=>'flex align gap-1']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sectionS1">
                    <form class="row" method="post" method="{{ route('job-offer-user.update',$user) }}">
                        @csrf
                        @method("put")
                        <div class="col-lg-6">
                            <label class="form-label">@lang("InterView Date From")</label>
                            @include("new-theme.components.error1",['error'=>'interview_from'])
                            <div class="inputS1">
                                <input type="datetime-local" name="interview_from" value="{{ old('interview_from',$user->interview_from) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">@lang("InterView Date To")</label>
                            @include("new-theme.components.error1",['error'=>'interview_to'])
                            <div class="inputS1">
                                <input type="datetime-local" name="interview_to" value="{{ old('interview_to',$user->interview_to) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="inputS1">
                                <button class="buttonS1 primary w-100 mt-4" type="submit">
                                    @lang("save")
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
