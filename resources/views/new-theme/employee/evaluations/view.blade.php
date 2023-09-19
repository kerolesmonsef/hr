@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
@endpush


@section('content')
    <div class="evaluationFormPage">
        <div class="pageS1">

            <a href='/employees/evaluations'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>Evaluation Form</h3>
                    </div>
                </div>
            </a>

            <div class="drawerS1">
                <div class="sectionDDS1">
                    <div data-bs-toggle="collapse" data-bs-target="#employeeInformation" aria-expanded="true"
                        aria-controls="employeeInformation">
                        <div class="ant-collapse flex align between mb-4">
                            <div class="flex align gap-15 ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                role="button" tabindex="0">
                                <div class="ant-collapse-expand-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 19.25C15.1086 19.25 19.25 15.1086 19.25 10C19.25 4.89137 15.1086 0.75 10 0.75C4.89137 0.75 0.75 4.89137 0.75 10C0.75 15.1086 4.89137 19.25 10 19.25Z"
                                            stroke="#001B19" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7.59 11L10 9L12.41 11" stroke="#001B19" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <span class="ant-collapse-header-text">
                                    <h3>Employee information</h3>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class='sectionS1 mb-4'>

                        <div class="collapse show" id="employeeInformation">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="employeeCard flex align between">
                                        <h5>Employee Name</h5>
                                        <p>Ahmed mohamed</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="employeeCard flex align between">
                                        <h5>code</h5>
                                        <p>123456</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="employeeCard flex align between">
                                        <h5>Job Title</h5>
                                        <p>Ui/UX Designers</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="employeeCard flex align between">
                                        <h5>Branch</h5>
                                        <p>Cairo</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="employeeCard flex align between">
                                        <h5>Department</h5>
                                        <p>programming</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>




            <div class="drawerS1">
                <div class="sectionDDS1">
                    <div data-bs-toggle="collapse" data-bs-target="#sectionId" aria-expanded="true"
                        aria-controls="sectionId">
                        <div class="ant-collapse flex align between mb-4">
                            <div class="flex align gap-15 ant-collapse-header" aria-expanded="true" aria-disabled="false"
                                role="button" tabindex="0">
                                <div class="ant-collapse-expand-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 19.25C15.1086 19.25 19.25 15.1086 19.25 10C19.25 4.89137 15.1086 0.75 10 0.75C4.89137 0.75 0.75 4.89137 0.75 10C0.75 15.1086 4.89137 19.25 10 19.25Z"
                                            stroke="#001B19" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M7.59 11L10 9L12.41 11" stroke="#001B19" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                                <span class="ant-collapse-header-text">
                                    <h3>Section 1</h3>
                                </span>
                            </div>
                        </div>
                    </div>



                    <div class='sectionS2 mb-4'>

                        <div class="collapse show" id="sectionId">

                            <div class="question">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="employeeCard">
                                            <h5 class="mb-4">where you can generate such text or many other texts in
                                                addition to increasing ?</h5>
                                            <div class="inputS1">
                                                <textarea readonly>This text was generated from the Arabic text generator, where you can generate such text or many other texts in addition to increasing the number of characters generated by the application.</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="employeeCard flex align gap-3">
                                            <h5>Points</h5>
                                            <p>3/5</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="question">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="employeeCard">
                                            <h5 class="mb-4">where you can generate such text or many other texts in
                                                addition to increasing ?</h5>
                                            <div class="flex align gap-3">
                                                <div class="inputCheckbox">
                                                    <input type="checkbox" name="choiceOne" id="choiceOne" checked
                                                        disabled>
                                                    <label for="choiceOne" class="mb-0">Choice 1</label>
                                                </div>
                                                <div class="inputCheckbox">
                                                    <input type="checkbox" name="choiceTwo" id="choiceTwo" disabled>
                                                    <label for="choiceTwo" class="mb-0">Choice 2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="employeeCard flex align gap-3">
                                            <h5>Points</h5>
                                            <p>3/5</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="question">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="employeeCard">
                                            <h5 class="mb-4">where you can generate such text or many other texts in
                                                addition to increasing ?</h5>
                                            <div class="inputS1">
                                                <textarea readonly>This text was generated from the Arabic text generator, where you can generate such text or many other texts in addition to increasing the number of characters generated by the application.</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="employeeCard flex align gap-3">
                                            <h5>Points</h5>
                                            <p>3/5</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="question">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="employeeCard">
                                            <h5 class="mb-4">where you can generate such text or many other texts in
                                                addition to increasing ?</h5>
                                            <div class="flex align gap-3">
                                                <div class="inputCheckbox">
                                                    <input type="checkbox" name="choiceOne" id="choiceOne" checked
                                                        disabled>
                                                    <label for="choiceOne" class="mb-0">Choice 1</label>
                                                </div>
                                                <div class="inputCheckbox">
                                                    <input type="checkbox" name="choiceTwo" id="choiceTwo" disabled>
                                                    <label for="choiceTwo" class="mb-0">Choice 2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="employeeCard flex align gap-3">
                                            <h5>Points</h5>
                                            <p>3/5</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>




            <div class='sectionS1'>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="performanceFactor" class="form-label"> Total Points</label>
                        <div class="inputS1">
                            <input type="number" value="30" id="jobTitle" readonly />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="discountMonthly" class="form-label">Overall Rating</label>
                        <div class="rating">
                            <ul class="flex align gap-1">
                                <li><img src="/new-theme/icons/star.svg" alt="" /></li>
                                <li><img src="/new-theme/icons/star.svg" alt="" /></li>
                                <li><img src="/new-theme/icons/star.svg" alt="" /></li>
                                <li><img src="/new-theme/icons/star.svg" alt="" /></li>
                                <li><img src="/new-theme/icons/emptyStar.svg" alt="" /></li>
                                <li>(4:0)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
