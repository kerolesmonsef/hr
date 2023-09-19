@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
@endpush


@section('content')
    <div class="addPerformancePage">
        <div class="pageS1">

            <a href='/employees/evaluations'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>Add / Edit Performance Form</h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="" method="post">

                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class="form-label">Employee Name</label>
                                <div class="inputS1">
                                    <select>
                                        <option value=" Employee Name">Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="code" class="form-label">Code</label>
                                <div class="inputS1">
                                    <input type="text" id="code" placeholder='Enter Code'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="jobTitle" class="form-label">Job Title</label>
                                <div class="inputS1">
                                    <input type="text" value="" id="jobTitle" placeholder="Enter Job Title" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="amount" class="form-label">Branch</label>
                                <div class="inputS1">
                                    <select>
                                        <option value=" Employee Name">Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="datepicker" class="form-label">Department</label>
                                <div class="inputS1">
                                    <select>
                                        <option value=" Employee Name">Name</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="datepicker" class="form-label">Evaluation Type</label>
                                <div class="inputS1">
                                    <select>
                                        <option value=" Employee Name">Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='heading flex align between my-4'>
                    <h3>Performance Form</h3>
                    <button class='buttonS1 primary' type="button" id="addNew">
                        <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.580872 7C0.580872 6.68934 0.869747 6.4375 1.22609 6.4375H15.4209C15.7773 6.4375 16.0662 6.68934 16.0662 7C16.0662 7.31066 15.7773 7.5625 15.4209 7.5625H1.22609C0.869747 7.5625 0.580872 7.31066 0.580872 7Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.32352 0.25C8.67986 0.25 8.96874 0.50184 8.96874 0.8125V13.1875C8.96874 13.4982 8.67986 13.75 8.32352 13.75C7.96717 13.75 7.6783 13.4982 7.6783 13.1875V0.8125C7.6783 0.50184 7.96717 0.25 8.32352 0.25Z"
                                fill="white" />
                        </svg>
                        Add New
                    </button>
                </div>

                <div id="performaneSections">
                    <div class='sectionS2'>
                        <div class="head withBorder flex align between">
                            <h3 class="small">Performance 1</h3>
                            <div>
                                <img src="/new-theme/icons/delete.svg" alt="delete">
                            </div>
                        </div>
                        <div class='content p-4'>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="performanceFactor" class="form-label">Performance Factor</label>
                                    <div class="inputS1">
                                        <select>
                                            <option value=" Employee Name">Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="code" class="form-label">Rating</label>
                                    <div class="flex align gap-2 wrap">
                                        <div class="form-check">
                                            <input class=" " type="radio" name="flexRadioDefault"
                                                id="id1">
                                            <label class="form-check-label" for="id1">
                                                Excellent
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class=" " type="radio" name="flexRadioDefault"
                                                id="id2">
                                            <label class="form-check-label" for="id2">
                                                Good
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class=" " type="radio" name="flexRadioDefault"
                                                id="id3">
                                            <label class="form-check-label" for="id3">
                                                Satisfactory
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class=" " type="radio" name="flexRadioDefault"
                                                id="id4">
                                            <label class="form-check-label" for="id4">
                                                Fair
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class=" " type="radio" name="flexRadioDefault"
                                                id="id5">
                                            <label class="form-check-label" for="id5">
                                                Poor
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="amount" class="form-label">Points</label>
                                    <div class="inputS1">
                                        <input type="number" value="" id="jobTitle" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="discountMonthly" class="form-label">Nots</label>
                                    <div class="inputS1">
                                        <input type="text" id="discountMonthly" placeholder=''>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class='sectionS2'>
                    <div class='content p-4'>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="performanceFactor" class="form-label"> Total Points</label>
                                <div class="inputS1">
                                    <input type="number" value="30" id="jobTitle" placeholder="Enter Job Title" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="discountMonthly" class="form-label">Overall Rating</label>
                                <div class="rating">
                                    <div class="overallRate">
                                        <input type="text" name="overallRate" value="" id="overallRate">
                                    </div>
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5"
                                            onclick="getRateValue(event)" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4"
                                            onclick="getRateValue(event)" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3"
                                            onclick="getRateValue(event)" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2"
                                            onclick="getRateValue(event)" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1"
                                            onclick="getRateValue(event)" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex align end gap-15 orders ">
                    <button class='buttonS1 rejected' type="button">
                        Cancel
                    </button>
                    <button class='buttonS1 primary' type="submit">
                        Save
                    </button>
                </div>

            </form>




        </div>
    </div>
@endsection
