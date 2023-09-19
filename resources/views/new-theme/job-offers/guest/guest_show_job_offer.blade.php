<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>HRM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600;700&display=swap"
          rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400&display=swap" rel="stylesheet"/>
    <!--  -->
    <link rel="stylesheet" href="{{ url('new-theme/styles/guestJobOffer/global.css') }}"/>
    <link rel="stylesheet" href="{{ url('new-theme/styles/guestJobOffer/sections.css') }}"/>
    <link rel="stylesheet" href="{{ url('new-theme/styles/guestJobOffer/apply.css') }}"/>
    <!--  -->
    <link rel="stylesheet" href="{{ asset("css/flatpickr.min.css") }}"/>
    <link rel="stylesheet" href="{{ asset("css/bs-stepper.min.css") }}"/>

</head>

<body>
<div class="applyPage">
    <div class="containerS1">
        <div class="headerApp">
            <div class="row g-4">
                <div class="col-sm-4 col-lg-3">
                    <div class="logo">
                        <img src="{{ asset('new-theme/icons/logo2.svg') }}" alt=""/>
                    </div>
                </div>
                <div class="col-sm-8 col-lg-9">
                    <form action="">
                        <div class="search">
                            <input type="text" placeholder="Search...."/>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect width="24" height="24" fill="white"/>
                                <path
                                    d="M11 20.75C5.62 20.75 1.25 16.38 1.25 11C1.25 5.62 5.62 1.25 11 1.25C11.41 1.25 11.75 1.59 11.75 2C11.75 2.41 11.41 2.75 11 2.75C6.45 2.75 2.75 6.45 2.75 11C2.75 15.55 6.45 19.25 11 19.25C15.55 19.25 19.25 15.55 19.25 11C19.25 10.59 19.59 10.25 20 10.25C20.41 10.25 20.75 10.59 20.75 11C20.75 16.38 16.38 20.75 11 20.75Z"
                                    fill="#868686"/>
                                <path
                                    d="M20 5.75H14C13.59 5.75 13.25 5.41 13.25 5C13.25 4.59 13.59 4.25 14 4.25H20C20.41 4.25 20.75 4.59 20.75 5C20.75 5.41 20.41 5.75 20 5.75Z"
                                    fill="#868686"/>
                                <path
                                    d="M17 8.75H14C13.59 8.75 13.25 8.41 13.25 8C13.25 7.59 13.59 7.25 14 7.25H17C17.41 7.25 17.75 7.59 17.75 8C17.75 8.41 17.41 8.75 17 8.75Z"
                                    fill="#868686"/>
                                <path
                                    d="M20.1601 22.79C20.0801 22.79 20.0001 22.78 19.9301 22.77C19.4601 22.71 18.6101 22.39 18.1301 20.96C17.8801 20.21 17.9701 19.46 18.3801 18.89C18.7901 18.32 19.4801 18 20.2701 18C21.2901 18 22.0901 18.39 22.4501 19.08C22.8101 19.77 22.7101 20.65 22.1401 21.5C21.4301 22.57 20.6601 22.79 20.1601 22.79ZM19.5601 20.49C19.7301 21.01 19.9701 21.27 20.1301 21.29C20.2901 21.31 20.5901 21.12 20.9001 20.67C21.1901 20.24 21.2101 19.93 21.1401 19.79C21.0701 19.65 20.7901 19.5 20.2701 19.5C19.9601 19.5 19.7301 19.6 19.6001 19.77C19.4801 19.94 19.4601 20.2 19.5601 20.49Z"
                                    fill="#868686"/>
                            </svg>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="pageS1">
            <div id="stepper" class="bs-stepper">
                <div class="bs-stepper-header">
                    <div class="step" icon='fa-check' data-target="#test-l-1" id="1">
                        <button type="button" class="btn step-trigger">
                            <span class="bs-stepper-circle">01</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#test-l-2" id="2">
                        <button type="button" class="btn step-trigger">
                            <span class="bs-stepper-circle">02</span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#test-l-3" id="3">
                        <button type="button" class="btn step-trigger">
                            <span class="bs-stepper-circle">03</span>
                        </button>
                    </div>
                </div>
                <form class="bs-stepper-content" method="post"
                      action="{{ route("job-offer.guest.answer",$offer->form_link) }}" enctype="multipart/form-data">
                    @csrf

                    <div id="test-l-1" class="content">
                        <div class="sectionS1">
                            <div class="head">
                                <h3>Personal Info</h3>
                            </div>
                            <div class="contentSS1">
                                <div class="row gy-3">
                                    <div class="col-lg-6">
                                        <label for="">Name</label>
                                        @include("new-theme.components.error1",['error'=>'name'])
                                        <div class="inputS1">
                                            <input name="name" value="{{ old('name') }}" type="text"
                                                   placeholder="Enter Your Name"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="dateofbirth">Date of birth</label>
                                        @include("new-theme.components.error1",['error'=>'date_of_birth'])
                                        <div class="inputS1">

                                            <input type="date" value="{{ old('date_of_birth') }}" name="date_of_birth"
                                                   id="dateofbirth"/>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24"
                                                 fill="none">
                                                <path d="M8 2V5" stroke="#868686" stroke-width="1.5"
                                                      stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 2V5" stroke="#868686" stroke-width="1.5"
                                                      stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3.5 9.09H20.5" stroke="#868686" stroke-width="1.5"
                                                      stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path
                                                    d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path d="M15.6947 13.7H15.7037" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M15.6947 16.7H15.7037" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M11.9955 13.7H12.0045" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M11.9955 16.7H12.0045" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M8.29431 13.7H8.30329" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M8.29431 16.7H8.30329" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="emp-gender">Gender</label>
                                        <div class="inputS1">
                                            <select name="gender" id="emp-gender">
                                                <option
                                                    {{ old('gender') == "Male" ? "selected": "" }} value="Male">@lang('Male')</option>
                                                <option
                                                    {{ old('gender') == "Female" ? "selected": "" }} value="Female">@lang('Female')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Nationality</label>
                                        <div class="inputS1">
                                            <select name="nationality_id">
                                                @foreach (\App\Models\Nationality::all() as $nationality)
                                                    <option
                                                        {{ old('nationality_id') == $nationality->id ? 'selected' : '' }}
                                                        value="{{ $nationality->id }}">{{ $nationality->{'name'} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sectionS1">
                            <div class="head">
                                <h3>Location Info</h3>
                            </div>
                            <div class="contentSS1">
                                <div class="row gy-3">
                                    <div class="col-lg-6">
                                        <label for="">Country</label>
                                        @include("new-theme.components.error1",['error'=>'country'])
                                        <div class="inputS1">
                                            <input type="text" name="country" placeholder="Enter your country"
                                                   value="{{ old("country") }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">City</label>
                                        @include("new-theme.components.error1",['error'=>'city'])
                                        <div class="inputS1">
                                            <input type="text" name="city" value="{{ old("city") }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Area</label>
                                        @include("new-theme.components.error1",['error'=>'area'])
                                        <div class="inputS1">
                                            <input type="text" name="area" value="{{ old("area") }}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sectionS1">
                            <div class="head">
                                <h3>Contact Info</h3>
                            </div>
                            <div class="contentSS1">
                                <div class="row gy-3">
                                    <div class="col-lg-6">
                                        <label for="">Phone Number</label>
                                        @include("new-theme.components.error1",['error'=>'phone'])
                                        <div class="inputS1">
                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                   placeholder="Enter your Phone number"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">E-mail</label>
                                        @include("new-theme.components.error1",['error'=>'email'])
                                        <div class="inputS1">
                                            <input type="text" name="email" value="{{ old("email") }}"
                                                   placeholder="Enter your e-mail"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="actions">
                            <button type="button" class="buttonS1" onclick="stepper.next()">Next</button>
                        </div>

                    </div>
                    <div id="test-l-2" class="content">

                        <div class="sectionS1">
                            <div class="head">
                                <h3>Professional Info</h3>
                            </div>
                            <div class="contentSS1">
                                <div class="row gy-3">
                                    <div class="col-lg-6">
                                        <label for="">Qualifications</label>
                                        <div class="inputS1">
                                            <select name="qualification_id">
                                                @foreach (\App\Models\Qualification::all() as $qualification)
                                                    <option
                                                        {{ old('qualification_id') == $qualification->id ? 'selected' : '' }}
                                                        value="{{ $qualification->id }}">{{ $qualification->institute_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="dateofbirth">Field Of Study</label>
                                        @include("new-theme.components.error1",['error'=>'field_of_study'])
                                        <div class="inputS1">
                                            <input type="text" name="field_of_study" value="{{ old('field_of_study') }}"
                                                   placeholder="Enter your Field Of Study"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">University</label>
                                        @include("new-theme.components.error1",['error'=>'university'])
                                        <div class="inputS1">
                                            <input type="text" name="university" value="{{ old('university') }}"
                                                   placeholder="Enter your university"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Graduation Year</label>
                                        @include("new-theme.components.error1",['error'=>'graduation_year'])
                                        <div class="inputS1">
                                            <input type="text" name="graduation_year"
                                                   value="{{ old('graduation_year') }}"
                                                   placeholder="Enter your Graduation Year"/>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24"
                                                 fill="none">
                                                <path d="M8 2V5" stroke="#868686" stroke-width="1.5"
                                                      stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 2V5" stroke="#868686" stroke-width="1.5"
                                                      stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3.5 9.09H20.5" stroke="#868686" stroke-width="1.5"
                                                      stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path
                                                    d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                                    stroke="#868686" stroke-width="1.5" stroke-miterlimit="10"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                                <path d="M15.6947 13.7H15.7037" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M15.6947 16.7H15.7037" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M11.9955 13.7H12.0045" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M11.9955 16.7H12.0045" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M8.29431 13.7H8.30329" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M8.29431 16.7H8.30329" stroke="#868686" stroke-width="1.5"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Grade</label>
                                        @include("new-theme.components.error1",['error'=>'grade'])
                                        <div class="inputS1">
                                            <input type="text" name="grade" value="{{ old('grade') }}"
                                                   placeholder="Enter your Grade GPA"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Link of your portfolio </label>
                                        @include("new-theme.components.error1",['error'=>'portfolio_link'])
                                        <div class="inputS1">
                                            <input type="text" name="portfolio_link" value="{{ old('portfolio_link') }}"
                                                   placeholder="Enter your portfolio link"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sectionS1">
                            <div class="contentSS1">
                                <label>Upload Your CV</label>
                                <div class="uploadFileBox" id="addFolderId">
                                    <div class="uploadFileBoxContent">
                                        <div class="title">Upload Your File</div>
                                        <div class="dataType">Supported files: .docx, .doc or .pdf</div>
                                        <div class="uploadInput">
                                            <img src="{{ asset('new-theme/icons/upload.svg') }}" alt=""/>
                                            <input type="file" name="cv"
                                                   onchange="onUploadFilePreviewCard(this,'addFolderId');"/>
                                        </div>
                                        <div class="maxSize">Max file size: 28MB</div>
                                        @include("new-theme.components.error1",['error'=>'cv'])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="actions">
                            <button type="button" class="buttonS2" onclick="stepper.previous()">Back</button>
                            <button type="button" class="buttonS1" onclick="stepper.next()">Next</button>
                        </div>


                    </div>
                    <div id="test-l-3" class="content">

                        <div class="row">
                            @foreach($offer->sections as $section)
                                <div class="col-lg-6">
                                    <div class="sectionS1 withBorderTop">
                                        <div class="head">
                                            {{ $section->title }}
                                        </div>
                                        <div>
                                            @foreach($section->questions as $question)
                                                @include("new-theme.job-offers.guest.question")
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="actions">
                            <button type="button" class="buttonS2" onclick="stepper.previous()">Back</button>
                            <button type="submit" class="buttonS1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Submit
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal modalS2 fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="Img">
                    <img src="{{ asset('new-theme/icons/succes.svg') }}" alt=""/>
                </div>
                <h4>You have submitted this job successfully!</h4>
                <p>You will be contacted as soon as possible</p>
            </div>
        </div>
    </div>
</div>

<!--  -->
<script src="{{ asset("js/bootstrap.bundle.min.js") }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="{{ asset("js/jquery-3.6.1.min.js") }}"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="{{ asset("js/bs-stepper.min.js") }}"></script>

<!--  -->
<script src="{{ assert("js/flatpickr") }}"></script>
<script src="/erp/js/datePicker.js"></script>

<script>
    var stepperNode = document.querySelector('#stepper'),
        steps = document.querySelectorAll('.step'),
        stepper = new Stepper(document.querySelector('#stepper'));

    stepperNode.addEventListener('show.bs-stepper', function (event) {
        console.warn('show.bs-stepper', event)
    })
    stepperNode.addEventListener('shown.bs-stepper', function (event) {
        console.warn('shown.bs-stepper', event)
    });
    stepperNode.addEventListener('show.bs-stepper', function (event) {

        $(steps).each(function (i, step) {
            if (step.getAttribute('id') < event.detail.indexStep) {
                step.classList.add('done');
                $('.done button span').html(`<svg xmlns="http://www.w3.org/2000/svg" width="21" height="15" viewBox="0 0 21 15" fill="none">
           <path d="M1 7.5L7.32588 14L20 1" stroke="#066163" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
           </svg>`)

            }
        });
    })
</script>
</body>

</html>