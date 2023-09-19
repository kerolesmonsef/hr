<!DOCTYPE html>
@php
    $company = App\Models\User::find($companyJobRequest->created_by);
@endphp
<html dir='{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}'>

<head>
    <title>{{ $company != null ? $company->name . ' - ' . __('New vacancy') : __('New vacancy') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');

        :root {
            font-family: 'Varela Round', sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.4;
            color: white;
            margin: 0;
        }

        /* mobile friendly alternative to using background-attachment: fixed */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: -1;
            background: var(--color-darkblue);
            background-image: linear-gradient(15deg,
                    rgba(58, 58, 158, 0.8),
                    rgba(136, 136, 26, 0.7)),
                url({{ url('job.png') }});
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .astric{
            color:#f00;
        }

        h1 {
            font-weight: 400;
            line-height: 1.2;
        }

        p {
            font-size: 1.125rem;
        }

        h1,
        p {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        label {
            display: flex;
            align-items: center;
            font-size: 1.125rem;
            margin-bottom: 0.5rem;
        }

        input,
        button,
        select,
        textarea {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button {
            border: none;
        }

        .container {
            width: 100%;
            margin: 3.125rem auto 0 auto;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 550px;
            }
        }

        .header {
            padding: 0 0.625rem;
            margin-bottom: 1.875rem;
        }

        .description {
            font-style: italic;
            font-weight: 200;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
        }

        .clue {
            margin-left: 0.25rem;
            font-size: 0.9rem;
            color: #e4e4e4;
        }

        .text-center {
            text-align: center;
        }

        /* form */

        form {
            background: navy;
            padding: 2.5rem 0.625rem;
            border-radius: 0.25rem;
        }

        @media (min-width: 480px) {
            form {
                padding: 2.5rem;
            }
        }

        .form-group {
            margin: 0 auto 1.25rem auto;
            padding: 0.25rem;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 2.375rem;
            padding: 0.375rem 0.75rem;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #70bdgg;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .input-radio,
        .input-checkbox {
            display: inline-block;
            margin-right: 0.625rem;
            min-height: 1.25rem;
            min-width: 1.25rem;
            margin-left: 6px;
            margin-right: 6px;
            display: inline-block;
        }

        .input-textarea {
            min-height: 120px;
            width: 100%;
            padding: 0.625rem;
            resize: vertical;
        }

        .submit-button {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background: Green;
            color: White;
            border-radius: 2px;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css"
        integrity="sha512-giQeaPns4lQTBMRpOOHsYnGw1tGVzbAIHUyHRgn7+6FmiEgGGjaG0T2LZJmAPMzRCl+Cug0ItQ2xDZpTmEc+CQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />





</head>

<body>
    <div class="container">
        <header class="header">
            <h1 id="title" class="text-center"> {{ $company != null ? $company->name : __('New vacancy') }}</h1>
            <p id="description" class="description-text-center" style="text-align: center !important;">
                {{ __('This vacancy wil expire in ') }}
                {{ Carbon\Carbon::createFromFormat('Y-m-d', $companyJobRequest->end_date)->format('Y/m/d') }}</p>
        </header>
        @if ($message = Session::get('success'))
            <form>
                <div
                    style="padding: 1rem;margin-bottom: 1rem;border: 1px solid transparent;border-radius: 0.25rem;background-color: #68C934;border-color: #53a02a;color: #fff;padding:15px 10px;text-align:center;">
                    <i style="width:30px;height:30px;border-radius:50%;background:#359e09;padding:10px;"
                        class="fa fa-check"></i>
                    <p>{{ $message }}</p>
                </div>
            </form>
        @endif
        @if (!session()->has('success'))
        {{--  @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif  --}}
            <form id="survey-form" method="post" action="{{ route('vacancies.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="company_job_request_id" value="{{ $companyJobRequest->id }}" />
                <div class="form-group">
                    <label id="name-label" for="name">{{ __('Name') }}  <span class='astric'>*</span></label>
                    <input type="text" name="name" id="name" class="form-control"
                        placeholder="{{ __('Enter your name') }}" required />

                    @error('name')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="email-label" for="email">{{ __('Email') }}  <span class='astric'>*</span></label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="{{ __('Enter your email') }}" required />
                    @error('email')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="phone-label" for="phone">{{ __('Phone') }}  <span class='astric'>*</span></label>
                    <input type="tel" name="phone" id="phone" class="form-control"
                        placeholder="{{ __('Enter your phone') }} +996 12345678" required />
                    @error('phone')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="number-label" for="number">{{ __('Age') }}  <span class='astric'>*</span></label>
                    <input type="number" name="age" id="number" min="18" max="100"
                        class="form-control" placeholder="{{ __('Enter your age') }}" />
                    @error('age')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="address-label" for="address">{{ __('Address') }}  <span class='astric'>*</span></label>
                    <input type="text" name="address" id="address" class="form-control"
                        placeholder="{{ __('Enter your address') }}" required />
                    @error('address')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="education-label" for="education">{{ __('Education') }}  <span class='astric'>*</span></label>
                    <input type="text" name="education" id="education" class="form-control"
                        placeholder="{{ __('Answer') }}" required />
                    @error('education')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="profile-label" for="profile">{{ __('Linkedin profile') }}</label>
                    <input type="text" name="linkedin_profile" id="profile" class="form-control"
                        placeholder="{{ __('Answer') }}"  />
                    @error('linkedin_profile')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="experience-label" for="experience">{{ __('Years of experience') }}  <span class='astric'>*</span></label>
                    <input type="text" name="experience" id="experience" class="form-control"
                        placeholder="{{ __('Answer') }}" required />
                    @error('experience')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="join_us_date-label"
                        for="join_us_date">{{ __('When are you ready to join us ?') }}  <span class='astric'>*</span></label>
                    <input type="date" name="join_us_date" id="join_us_date datepicker" class="form-control"
                        placeholder="{{ __('Answer') }}" required />
                    @error('join_us_date')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="salary-label" for="number">{{ __('Expected salary') }}  <span class='astric'>*</span></label>
                    <input type="number" name="salary" id="salary"
                        class="form-control" placeholder="{{ __('Answer') }}" />
                    @error('salary')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <p>{{ __('How do you rate yourself in spoken and written English?') }}  <span class='astric'>*</span></p>
                    <label>
                        <input name="english_rate" value="1" type="radio" class="input-radio" />1</label>
                    <label>
                        <input name="english_rate" value="2" type="radio" class="input-radio" />2</label>
                    <label><input name="english_rate" value="3" type="radio" class="input-radio" />3</label>
                    <label><input name="english_rate" value="4" type="radio" class="input-radio" /> 4</label>
                    <label><input name="english_rate" value="5" type="radio" class="input-radio" /> 5</label>
                    @error('findus')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <p>{{ __('Work hours') }}  <span class='astric'>*</span></p>
                    <select id="dropdown" name="role" class="form-control" required>
                        <option disabled selected value>{{ __('Select') }}</option>
                        <option value="internship">Internship</option>
                        <option value="full">Full Time Job</option>
                        <option value="part">Part Time Job</option>
                        <option value="other">Other</option>
                    </select>
                    @error('role')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <p>{{ __('How did you find out about us?') }}  <span class='astric'>*</span></p>
                    <label>
                        <input name="findus" value="facebook" type="radio" class="input-radio" />Facebook</label>
                    <label>
                        <input name="findus" value="linkedin" type="radio" class="input-radio" />Linkedin</label>
                    <label><input name="findus" value="twitter" type="radio"
                            class="input-radio" />Twitter</label>
                    <label><input name="findus" value="indeed" type="radio" class="input-radio" /> Indeed</label>
                    @error('findus')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>

                <div class="form-group">
                    <p>
                        {{ __('What day of the week are you most likely to meet for an interview?') }}  <span class='astric'>*</span>
                    </p>
                    <select id="most-like" name="interview_day" class="form-control" required>
                        <option disabled selected value>{{ __('Select') }}</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    @error('interview_day')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>

                <div class="form-group">
                    <p>
                        {{ __('Which position are you interested in ?') }}  <span class='astric'>*</span>
                    </p>
                    <label><input name="field[]" value="Senior Frontend Developer" type="checkbox"
                            class="input-checkbox" />Senior Frontend Developer</label>
                    <label>
                        <input name="field[]" value="Senior Backend Developer" type="checkbox"
                            class="input-checkbox" />Senior Backend Developer</label>
                    <label><input name="field[]" value="Senior Frontend Developer" type="checkbox"
                            class="input-checkbox" />Mid-Level Backend Developer</label>
                    <label><input name="field[]" value="Mid-Level Backend Developer" type="checkbox"
                            class="input-checkbox" />Challenges</label>
                    <label><input name="field[]" value="Senior Java Developer" type="checkbox"
                            class="input-checkbox" />Senior Java Developer</label>
                    <label><input name="field[]" value="Java Engineer Developer" type="checkbox"
                            class="input-checkbox" />Java Engineer Developer</label>
                    <label><input name="field[]" value="Mid-Level Frontend Developer" type="checkbox"
                            class="input-checkbox" />Mid-Level Frontend Developer</label>
                    <label><input name="field[]" value="Senior Android Engineer" type="checkbox"
                            class="input-checkbox" />Senior Android Engineer</label>
                    <label><input name="field[]" value="Full Stack Web Developer" type="checkbox"
                            class="input-checkbox" />Full Stack Web Developer</label>
                    <label><input name="field[]" value="iOS Developers" type="checkbox" class="input-checkbox" />iOS
                        Developers</label>
                    <label><input name="field[]" value="WordPress Developer" type="checkbox"
                            class="input-checkbox" />WordPress Developer</label>
                    <label><input name="field[]" value="Mobile Developer" type="checkbox"
                            class="input-checkbox" />Mobile Developer</label>
                    <label><input name="field[]" value="PHP  Developer" type="checkbox" class="input-checkbox" />PHP
                        Developer</label>
                    <label><input name="field[]" value="UI UX Designer" type="checkbox" class="input-checkbox" />UI
                        UX Designer</label>
                    <label><input name="field[]" value="Digital Marketing Manager" type="checkbox"
                            class="input-checkbox" />Digital Marketing Manager</label>
                    <label><input name="field[]" value="Digital Marketing Specialist" type="checkbox"
                            class="input-checkbox" />Digital Marketing Specialist</label>
                    <label><input name="field[]" value="Social Media Specialist" type="checkbox"
                            class="input-checkbox" />Social Media Specialist</label>
                    <label><input name="field[]" value="Community Manager" type="checkbox"
                            class="input-checkbox" />Community Manager</label>
                    <label><input name="field[]" value="SEO Specialist" type="checkbox" class="input-checkbox" />SEO
                        Specialist</label>
                    <label><input name="field[]" value="SEM specialist" type="checkbox" class="input-checkbox" />SEM
                        specialist</label>
                    <label><input name="field[]" value="Copywriter" type="checkbox"
                            class="input-checkbox" />Copywriter</label>
                    <label><input name="field[]" value="Content Creator" type="checkbox"
                            class="input-checkbox" />Content Creator</label>
                    <label><input name="field[]" value="Graphic Designer" type="checkbox"
                            class="input-checkbox" />Graphic Designer</label>
                    <label><input name="field[]" value="Motion Graphic" type="checkbox"
                            class="input-checkbox" />Motion Graphic</label>
                    <label><input name="field[]" value="Business Development" type="checkbox"
                            class="input-checkbox" />Business Development</label>
                    <label><input name="field[]" value="Media Buyer" type="checkbox" class="input-checkbox" />Media
                        Buyer</label>
                    <label><input name="field[]" value="Sales Manager" type="checkbox"
                            class="input-checkbox" />Sales Manager</label>
                    <label><input name="field[]" value="Sales Executive" type="checkbox"
                            class="input-checkbox" />Sales Executive</label>
                    <label><input name="field[]" value="Telesales Representative" type="checkbox"
                            class="input-checkbox" />Telesales Representative</label>
                    <label><input name="field[]" value="Customer Service Representative" type="checkbox"
                            class="input-checkbox" />Customer Service Representative</label>
                    <label><input name="field[]" value="Business Developer" type="checkbox"
                            class="input-checkbox" />Business Developer</label>
                    <label><input name="field[]" value="Accountant" type="checkbox"
                            class="input-checkbox" />Accountant</label>
                    <label><input name="field[]" value="Administrative Secretary" type="checkbox"
                            class="input-checkbox" />Administrative Secretary</label>
                    <label><input name="field[]" value="Other" type="checkbox"
                            class="input-checkbox" />Other</label>

                    @error('field')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <label id="number-label" for="number">{{ __('Upload Cv') }}  <span class='astric'>*</span></label>
                    <input type="file" name="cv" required />
                    @error('cv')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>

                <div class="form-group">
                    <p>{{ __('Any comments or suggestions?') }}</p>
                    <textarea id="comments" class="input-textarea" name="message"
                        placeholder="{{ __('Enter your comment here...') }}"></textarea>
                    @error('message')
                        <label style="display: block;color:#f00;">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" id="submit" class="submit-button">
                        {{ __('Apply for job') }}
                    </button>
                </div>
            </form>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"
        integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</body>
</html>
