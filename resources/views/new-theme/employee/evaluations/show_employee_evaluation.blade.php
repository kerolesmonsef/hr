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
                            <h3>@lang("Evaluation Form")</h3>
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
                                        <h3>@lang("Employee information")</h3>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class='sectionS1 mb-4'>

                            <div class="collapse show" id="employeeInformation">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Employee Name")</h5>
                                            <p>{{ $evaluation->employee->{"name".$lang} }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("code")</h5>
                                            <p>{{ $evaluation->employee->id }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Job Title")</h5>
                                            <p>{{ $evaluation->employee?->jobtitle?->{"name".$lang} }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Branch")</h5>
                                            <p>{{ $evaluation->employee?->branch?->{"name".$lang} }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="employeeCard flex align between">
                                            <h5>@lang("Department")</h5>
                                            <p>{{ $evaluation->employee?->department?->{"name".$lang} }}</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>


                <div class="drawerS1">
                    @foreach(($evaluation->parent?->sections ?? []) as $section)
                        
                   
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
                                        <h3>Section 1</h3>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class='sectionS2 mb-4'>

                            <div class="collapse show" id="sectionId-{{ $section->id }}">
                                
                                @foreach($section->questions as $question)
                                    @include("new-theme.employee.evaluations.components.question")
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
                                <input type="number" value="{{ $evaluationService->getEmployeeRate($evaluation->parent,$evaluation->employee,'points') }}" readonly/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="discountMonthly" class="form-label">@lang("Overall Rating")</label>
                            <div class="rating">
                                {!! generateStarRating($evaluationService->getEmployeeRate($evaluation->parent,$evaluation->employee),['ul_class'=>'flex align gap-1']) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
