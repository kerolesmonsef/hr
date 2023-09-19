@extends('new-theme.layout.layout1')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/employess.css') }}" />
    <script src="{{ assert("new-theme/js/mapPlaces.js") }}"></script>
@endpush

@section('content')

<div class="employeesDetails">
    <div class="pageS1">
        <form class="formS1" method="post" action="{{ route('employee.store') }}" enctype="multipart/form-data">
            @csrf
            <div class='sectionS2'>
                <div class="head withBorder">
                    <h3 class='small'>@lang('Add New') </h3>
                </div>

                <div class="content ">

                    <div class="row personalSection1 mb-4">
                        <div class="col-12 col-xl-8">
                            <div class="row">
                                <div class="col-12 col-xl-8">
                                    <label for="emp-name" class="form-label">@lang('Name')</label>
                                    @include('new-theme.components.error1', ['error' => 'name'])
                                    <div class="inputS1">
                                        <input name="name" type="text" id="emp-name"
                                            value="{{ old("name") }}" placeholder="@lang('Name')">
                                    </div>
                                </div>
                                <div class="col-12 col-xl-8">
                                    <label for="emp-name-ar" class="form-label">@lang('Name Ar')</label>
                                    @include('new-theme.components.error1', ['error' => 'name_ar'])
                                    <div class="inputS1">
                                        <input name="name_ar" type="text" id="emp-name-ar"
                                               value="{{ old("name_ar") }}"  placeholder="@lang('Name Ar')">
                                    </div>
                                </div>
                                <div class="col-12 col-xl-8">
                                    <label for="datepicker" class="form-label">@lang('Date of Birth')</label>
                                    <div class="inputS1">
                                        <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                                        <input type="text" name="dob" class="datePickerBasic" id="demo-1"
                                            value="">
                                    </div>
                                    @include('new-theme.components.error1', ['error' => 'dob'])
                                </div>
                            </div>
                        </div>

                        <div class="col-12  col-xl-4 ">
                            <div class="uploadPhoto">
                                <div class="uploadIcon">
                                    <img src="{{ asset('new-theme/icons/edit.svg') }}" alt="user" />
                                </div>
                                <img src="{{ asset('new-theme/icons/userS2.svg') }}" alt="user" />
                                <input type="file" name="profile" />
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="emp-gender" class="form-label">@lang('Gender')</label>
                                <div class="inputS1">
                                    <select name="gender" id="emp-gender">
                                        <option {{ old('gender') == "Male" ? "selected": "" }} value="Male">@lang('Male')</option>
                                        <option {{ old('gender') == "Female" ? "selected": "" }} value="Female">@lang('Female')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="emp-nationality" class="form-label">@lang('Nationality')</label>
                                <div class="inputS1">
                                    <select id="emp-nationality" name="nationality_id">
                                        @foreach (\App\Models\Nationality::all() as $nationality)
                                            <option {{ old("nationality_id") == $nationality->id ? "selected" : "" }} value="{{ $nationality->id }}">{{ $nationality->{'name' . $lang} }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="emp-address" class="form-label">@lang('Address')</label>
                                <div class="inputS1">
                                    <input type="text" name="address" id="emp-address"
                                        value="" placeholder="@lang('Address')"
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="emp-email" class="form-label">@lang('Email')</label>
                                @include('new-theme.components.error1', ['error' => 'name'])
                                <div class="inputS1">
                                    <input name="email" type="email" id="emp-email"
                                        value="{{ old("password") }}" placeholder="@lang('Email')"
                                        autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="emp-password" class="form-label">@lang('Password')</label>
                                @include('new-theme.components.error1', ['error' => 'name'])
                                <div class="inputS1">
                                    <input name="password" type="password" id="emp-password"
                                           value="" placeholder="@lang('Password')"
                                           autocomplete="off" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="emp-phone" class="form-label">@lang('Phone')</label>
                                <div class="inputS1">
                                    <div class="input-group phoneInput">
                                        <select>
                                            <option value=" +20">+20</option>
                                        </select>
                                        <input id="emp-phone" type="tel" name="phone"
                                            value="{{ old('phone') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="religion" class="form-label">@lang('Religion')</label>
                                <div class="inputS1">
                                    <select id="emp-gender" name="religion">
                                        <option {{ old('religion') == '1' ? "selected" : "" }} value="1">@lang('Muslim')</option>
                                        <option {{ old('religion') == '2' ? "selected" : "" }}  value="2">@lang('Christian')</option>
                                        <option {{ old('religion') == '0' ? "selected" : "" }}  value="0">@lang('Other')</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div>
                                <label for="emp-socialStatus" class="form-label">@lang('Social Status')</label>
                                <div class="inputS1">
                                    <select id="emp-socialStatus" name="social_status">
                                        <option {{ old('social_status') == '1' ? "selected" : "" }}  value="1">@lang('Married')</option>
                                        <option {{ old('social_status') == '0' ? "selected" : "" }} value="0">@lang('Single')</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class='sectionS2'>
                <div class="head withBorder">
                    <h3 class='small'>@lang('ID details') </h3>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="row">
                                
                                <div class="col-12 col-lg-4 col-xl-3">
                                    <label class="form-check" for="id1">
                                        <input class="EmployeeIDCheck" value="nationalID" type="radio" name="flexRadioDefault" id="nationalID">
                                        <label class="form-check-label" for="nationalID">
                                            @lang('ID')
                                        </label>
                                    </label>
                                </div>

                                <div class="col-12 col-lg-4 col-xl-3">
                                    <label class="form-check" for="id2">
                                        <input class="EmployeeIDCheck" value="passport" type="radio" name="flexRadioDefault" id="passport">
                                        <label class="form-check-label" for="passport">
                                            @lang('passport')
                                        </label>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div id="NationalIDContent" class="col-sm-12 col-md-12">
                            <label for="national_id" class="form-label">@lang('ID')</label>
                            <div class="inputS1">
                                <input type="text" id="national_id" name="national_id" selected
                                    value="{{ old('national_id') }}" placeholder="@lang('ID')"
                                    autocomplete="off" />
                            </div>
                        </div>

                        <div style="display: none" class="col-md-12" id="passportContent">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="passport_number" class="form-label">@lang('Passport number')</label>
                                    <div class="inputS1">
                                        <input type="text" id="passport_number" name="passport_number"
                                            value="{{ old('passport_number') }}"
                                            placeholder="@lang('Passport number')" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="place_of_issuance_of_passport" class="form-label">@lang('Place of issuance of Passport')</label>
                                    <div class="inputS1">
                                        <input type="text" name="place_of_issuance_of_passport" id="place_of_issuance_of_passport"
                                            value="{{ old('place_of_issuance_of_passport') }}"
                                            Pplaceholder="@lang('Place of issuance of Passport')" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="passport_issuance_date_gregorian" class="form-label">@lang('Passport issuance date')</label>
                                    <div class="inputS1">
                                        <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                                        <input id="passport_issuance_date_gregorian" type="text"
                                            name="passport_issuance_date_gregorian"
                                            value="{{ old('passport_issuance_date_gregorian') }}"
                                            class="datePickerBasic" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="passport_issuance_expirydate_gregorian" class="form-label">
                                        @lang('Passport issuance expirydate')</label>
                                    <div class="inputS1">
                                        <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                                        <input id="passport_issuance_expirydate_gregorian" name="passport_issuance_expirydate_gregorian"
                                            type="text"
                                            value="{{ old('passport_issuance_expirydate_gregorian') }}"
                                            class="datePickerBasic" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class='sectionS2'>
                <div class="head withBorder">
                    <h3 class='small'>@lang('Company Details')</h3>
                </div>

                <div class="content">
                    <div class="row">

                        <div class="col-sm-12 col-md-6">
                            <label for="datepicker" class="form-label">@lang('Join date') </label>
                            <div class="inputS1">
                                <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                                <input type="text"
                                    value="{{ old('Join_date_gregorian') }}"
                                    placeholder="@lang('Join date')" class="datePickerBasic" autocomplete="off" />
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="emp-jobtitle_id" class="form-label">@lang('Job Title')</label>
                            <div class="inputS1">
                                <select id="emp-jobtitle_id" name="jobtitle_id">
                                    @foreach (\App\Models\Jobtitle::all() as $jobTitle)
                                        <option
                                            value="{{ $jobTitle->id }}">{{ $jobTitle->{'name' . $lang} }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="branch_id" class="form-label">@lang('Branch')</label>
                            <div class="inputS1">
                                <select id="branch_id" name="branch_id">
                                    @foreach (\App\Models\Branch::all() as $branch)
                                        <option
                                            value="{{ $branch->id }}">{{ $branch->{'name' . $lang} }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="department_id" class="form-label">@lang('Department')</label>
                            <div class="inputS1">
                                <select id="department_id" name="department_id">
                                    @foreach (\App\Models\Department::all() as $department)
                                        <option
                                        value="{{ $department->id }}">{{ $department->{'name' . $lang} }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="shift" class="form-label">@lang('shifts')</label>
                            <div class="inputS1">
                                <select id="directManager" name="shift">
                                    @foreach ($employee_shifts as $shift)
                                        <option
                                            value="{{ $shift->id }}">{{ $shift['name' . $lang] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="directManager" class="form-label">@lang('Direct Manager')</label>
                            <div class="inputS1">
                                <select id="directManager" name="direct_manager">
                                    @foreach ($employees as $emp)
                                        <option
                                            value="{{ $emp->id }}">{{ $emp['name' . $lang] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label for="role" class="form-label">@lang('Role')</label>
                            <div class="inputS1">
                                <select id="role" name="role_id">
                                    @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                        <option
                                            value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex align end gap-15 orders  my-5">
                <a href="{{ route("employee.index") }}" class="buttonS1 rejected">
                    @lang('Cancel')
                </a>
                <button class="buttonS1 primary" type="submit">
                    @lang('Save')
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
    <script>
        $(document).on('change', '.EmployeeIDCheck', function() {
            var check = $(this).val();
            if(check == 'nationalID')
            {
                $('#NationalIDContent').css('display','block');
                $('#passportContent').css('display','none');
            }else{
                $('#NationalIDContent').css('display','none');
                $('#passportContent').css('display','block');
            }
        });
    </script>
@endpush
