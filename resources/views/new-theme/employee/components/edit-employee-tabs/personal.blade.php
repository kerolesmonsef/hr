<div class="tab-pane fade  show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
    <form class="formS1" method="post" action="{{ route('employee.update', $employee) }}">
        @method('put')
        @csrf

        <div class='sectionS2'>
            <div class="head withBorder">
                <h3 class='small'>@lang('Personal details') </h3>
            </div>

            <div class="content ">

                <div class="row personalSection1 mb-4">
                    <div class="col-12  col-xl-8">
                        <div class="row">
                            <div class="col-12 col-xl-8">
                                <label for="emp-name" class="form-label">@lang('Name')</label>
                                <div class="inputS1">
                                    <input name="name" type="text" id="emp-name"
                                           value="{{ old('name', $employee->name) }}" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-12 col-xl-8">
                                <label for="emp-name-ar" class="form-label">@lang('Name Ar')</label>
                                <div class="inputS1">
                                    <input name="name_ar" type="text" id="emp-name-ar"
                                           value="{{ old('name_ar', $employee->name_ar) }}" placeholder="Enter Name">
                                </div>
                                @include('new-theme.components.error1', ['error' => 'dob'])
                            </div>
                            <div class="col-12 col-xl-8">
                                <label for="datepicker" class="form-label">@lang('Date of Birth')</label>
                                <div class="inputS1">
                                    <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg"/>
                                    <input type="text" name="dob" class="datePickerBasic" id="demo-1"
                                           value="{{ old('dob', front_date($employee->dob)) }}">
                                </div>
                                @include('new-theme.components.error1', ['error' => 'dob'])
                            </div>
                        </div>
                    </div>

                    <div class="col-12  col-xl-4 ">
                        <div class="uploadPhoto">
                            <div class="uploadIcon">
                                <img src="{{ asset('new-theme/icons/edit.svg') }}" alt="user"/>
                            </div>
                            <img src="{{ asset('new-theme/icons/userS2.svg') }}" id="outputImge" alt="user"/>
                            <input type="file" onchange="onUploadFilePreviewCard2(event,'outputImge')"/>
                        </div>
                    </div>

                </div>
                <div class="row">


                    <div class="col-sm-12 col-md-6">
                        <div>
                            <label for="emp-gender" class="form-label">@lang('Gender')</label>
                            <div class="inputS1">
                                <select name="gender" id="emp-gender">
                                    <option {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}
                                            value="Male">@lang('Male')</option>
                                    <option {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}
                                            value="Female">@lang('Female')</option>
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
                                        <option
                                            {{ old('nationality_id', $employee->nationality_id) == $nationality->id ? 'selected' : '' }}
                                            value="{{ $nationality->id }}">{{ $nationality->{'name' . $lang} }}
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
                                       value="{{ old('address', $employee->address) }}" placeholder="@lang('Address')"
                                       autocomplete="off"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div>
                            <label for="emp-email" class="form-label">@lang('Email')</label>
                            <div class="inputS1">
                                <input name="email" type="email" id="emp-email"
                                       value="{{ old('email', $employee->email) }}" placeholder="Set The Email"
                                       autocomplete="off"/>
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
                                           value="{{ old('phone', $employee->phone) }}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div>
                            <label for="religion" class="form-label">@lang('Religion')</label>
                            <div class="inputS1">
                                <select id="emp-gender" name="religion">
                                    <option {{ old('religion', $employee->religion) == '1' ? 'selected' : '' }}
                                            value="1">@lang('Muslim')</option>
                                    <option {{ old('religion', $employee->religion) == '2' ? 'selected' : '' }}
                                            value="1">@lang('Christian')</option>
                                    <option {{ old('religion', $employee->religion) == '0' ? 'selected' : '' }}
                                            value="0">@lang('Other')</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6">
                        <div>
                            <label for="emp-socialStatus" class="form-label">@lang('Social Status')</label>
                            <div class="inputS1">
                                <select id="emp-socialStatus" name="social_status">
                                    <option
                                        {{ old('social_status', $employee->social_status) == '1' ? 'selected' : '' }}
                                        value="1">@lang('Married')</option>
                                    <option
                                        {{ old('social_status', $employee->social_status) == '0' ? 'selected' : '' }}
                                        value="0">@lang('Single')</option>
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
                                <label class="form-check" for="nationalID">
                                    <input class="  EmployeeIDCheck" value="nationalID" type="radio"
                                           name="flexRadioDefault" id="nationalID">
                                    <label class="form-check-label" for="nationalID">
                                        @lang('ID')
                                    </label>
                                </label>
                            </div>

                            <div class="col-12 col-lg-4 col-xl-3">
                                <label class="form-check" for="passport">
                                    <input class=" EmployeeIDCheck" value="passport" type="radio"
                                           name="flexRadioDefault" id="passport">
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
                                   value="{{ $employee->national_id }}" placeholder="@lang('ID')"
                                   autocomplete="off"/>
                        </div>
                    </div>

                    <div style="display: none" class="col-md-12" id="passportContent">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label for="passport_number" class="form-label">@lang('Passport number')</label>
                                <div class="inputS1">
                                    <input type="text" id="passport_number" name="passport_number"
                                           value="{{ $employee->passport_number }}"
                                           placeholder="@lang('Residence number')"
                                           autocomplete="off"/>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <label for="place_of_issuance_of_passport"
                                       class="form-label">@lang('Place of issuance of Passport')</label>
                                <div class="inputS1">
                                    <input type="text" name="place_of_issuance_of_passport"
                                           id="place_of_issuance_of_passport"
                                           value="{{ $employee->place_of_issuance_of_passport }}"
                                           placeholder="@lang('Place of issuance of Passport')" autocomplete="off"/>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <label for="passport_issuance_date_gregorian"
                                       class="form-label">@lang('Passport issuance date')</label>
                                <div class="inputS1">
                                    <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg"/>
                                    <input id="passport_issuance_date_gregorian" type="text"
                                           name="passport_issuance_date_gregorian"
                                           value="{{ $employee->passport_issuance_date_gregorian }}"
                                           class="datePickerBasic" autocomplete="off"/>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <label for="passport_issuance_expirydate_gregorian" class="form-label">
                                    @lang('Passport issuance expirydate')</label>
                                <div class="inputS1">
                                    <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg"/>
                                    <input id="passport_issuance_expirydate_gregorian"
                                           name="passport_issuance_expirydate_gregorian" type="text"
                                           value="{{ $employee->passport_issuance_expirydate_gregorian }}"
                                           class="datePickerBasic" autocomplete="off"/>
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
                            <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg"/>
                            <input type="text"
                                   value="{{ old('Join_date_gregorian', front_date($employee->Join_date_gregorian)) }}"
                                   placeholder="Set The Time" class="datePickerBasic" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="emp-jobtitle_id" class="form-label">@lang('Job Title')</label>
                        <div class="inputS1">
                            <select id="emp-jobtitle_id" name="jobtitle_id">
                                @foreach (\App\Models\Jobtitle::all() as $jobTitle)
                                    <option
                                        {{ old('jobtitle_id', $employee->jobtitle_id) == $jobTitle->id ? 'selected' : '' }}
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
                                        {{ old('branch_id', $employee->branch_id) == $branch->id ? 'selected' : '' }}
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
                                        {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}
                                        value="{{ $department->id }}">{{ $department->{'name' . $lang} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="employee_id" class="form-label">@lang('ID')</label>
                        <div class="inputS1">
                            <input type="text" id="employee_id" name="employee_id"
                                   value="{{ old('employee_id', $employee->employee_id) }}" placeholder="Set The ID"
                                   autocomplete="off"/>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="shift" class="form-label">@lang('shifts')</label>
                        <div class="inputS1">
                            <select id="directManager" name="shift">
                                @foreach ($employee_shifts as $shift)
                                    <option {{ $shift->id == $employee->shift ? 'selected' : '' }}
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
                                    <option {{ $emp->id == $employee->direct_manager ? 'selected' : '' }}
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
                                    <option {{ $employee->user && $employee->user->hasRole($role) ? 'selected' : '' }}
                                            value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='sectionS1 mb-4'>
            <div class="row">

                <div class="col-sm-12 col-md-6">
                    <label class="form-label">@lang('Do you want to finger print out the company')</label>
                    <div class="row">

                        <div class="col-sm-12 col-md-6">
                            <label class="form-check" for="yes2">
                                <input class="  fingerprintOutCampany" type="radio" value="1"
                                       name="fingerprint_out_campany" id="yes2"
                                    {{ $employee->fingerprint_out_campany == 1 ? 'selected' : '' }}>
                                <label class="form-check-label" for="yes2">
                                    @lang('Yes')
                                </label>
                            </label>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <label class="form-check" for="no2">
                                <input class="  fingerprintOutCampany" type="radio" value="0"
                                       name="fingerprint_out_campany" id="no2"
                                    {{ $employee->fingerprint_out_campany == 0 ? 'selected' : '' }}>
                                <label class="form-check-label" for="no2">
                                    @lang('No')
                                </label>
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class='sectionS1 FingerCompanyContent'>
            <div class="flex align between mb-3">
                <label class='small'>@lang('finger print out the company location') </label>
                <button class="buttonS1 primary" type="button" data-bs-toggle="modal"
                        id="openFingerPrintModalButton"
                        data-bs-target="#fingerPrinteModal">
                    <svg width="21" height="18" viewBox="0 0 21 18" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M2.58081 9C2.58081 8.68934 2.86969 8.4375 3.22603 8.4375H17.4209C17.7772 8.4375 18.0661 8.68934 18.0661 9C18.0661 9.31066 17.7772 9.5625 17.4209 9.5625H3.22603C2.86969 9.5625 2.58081 9.31066 2.58081 9Z"
                              fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10.3235 2.25C10.6798 2.25 10.9687 2.50184 10.9687 2.8125V15.1875C10.9687 15.4982 10.6798 15.75 10.3235 15.75C9.96711 15.75 9.67824 15.4982 9.67824 15.1875V2.8125C9.67824 2.50184 9.96711 2.25 10.3235 2.25Z"
                              fill="white"/>
                    </svg>
                    @lang('Add New')
                </button>
            </div>

            <div class="content">
                <div class="companyLocations">
                    @foreach($employee->finger_print_locations as $finger_print_location)
                            <?php
                            $uuid = \Illuminate\Support\Str::random(8);
                            ?>
                        <div class="location flex align between">
                            <input type="hidden" name="locations[{{ $uuid }}][lat_long]"
                                   value="{{$finger_print_location->lat}},{{$finger_print_location->long}}">
                            <input type="hidden" name="locations[{{ $uuid }}][name]"
                                   value="{{$finger_print_location->title}}">
                            <h5>{{ $finger_print_location->title }}</h5>
                            <img src="/assets/icons/red_close.svg" alt="" class="closeLocation">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex align end gap-15 orders  my-5">
            <button class="buttonS1 rejected">
                @lang('Cancel')
            </button>
            <button class="buttonS1 primary" type="submit">
                @lang('Save')
            </button>
        </div>

    </form>
</div>

<div class="modal fade customeModal" id="fingerPrinteModal" tabindex="-1" aria-labelledby="fingerPrinteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="formS1">
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang('Add New Location')</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div>
                                <label for="ID" class="form-label">{{__('Title')}}</label>
                                <div class="inputS1">
                                    <input type="text" id="locationName" value=""
                                           placeholder="Enter title name " autocomplete="off"/>
                                </div>
                            </div>

                            {{-- <label for="ID" class="form-label">@lang('Location on map')</label> --}}

                            <div class="googleMapS1">
                                {{-- <input id="pac-input" class="controls" type="text" placeholder="Search Box" /> --}}
                                {{Form::hidden('lat','24.7305650',array('class'=>'form-control' , 'id' => 'lat'))}}
                                {{Form::hidden('lon','46.6555170',array('class'=>'form-control' , 'id' => 'lon'))}}
                                <div style="width: 100%;height: 300px;" id="map"></div>
                            </div>

                            <div class="flex align end gap-15 orders  mt-5 mb-4">
                                <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    @lang('Cancel')
                                </button>
                                <button class="buttonS1 primary addLocationButton" type="submit">
                                    @lang('Save')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>

        $(document).on('change', '.EmployeeIDCheck', function () {
            var check = $(this).val();
            if (check == 'nationalID') {
                $('#NationalIDContent').css('display', 'block');
                $('#passportContent').css('display', 'none');
            } else {
                $('#NationalIDContent').css('display', 'none');
                $('#passportContent').css('display', 'block');
            }
        });

        $(document).on('change', '.fingerprintOutCampany', function () {
            var fingercheck = $(this).val();
            if (fingercheck == 1) {
                $('.FingerCompanyContent').css('display', 'block');
            } else {
                $('.FingerCompanyContent').css('display', 'none');
            }
        });
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_foD6VvulHSpxKYjtgehkQ_UoVGHH64Y&callback=initMap&libraries=places,geometry"></script>
    <script>


        let locationComponent = ({name, lat_long}) => {
            return `<div class="location flex align between">
                            <input type="hidden" name="locations[sl8WBxw3][lat_long]" value="${lat_long}">
                            <input type="hidden" name="locations[sl8WBxw3][name]" value="${name}">
                            <h5>${name}</h5>
                            <img src="/assets/icons/red_close.svg" alt="" class="closeLocation">
                        </div>`;
        };

        $(document).on("click", ".closeLocation", function () {
            $(this).parent().remove();
        });

        $(document).on("click", ".addLocationButton", function () {
            let locationName = $("#locationName").val();
            if (locationName == "") {
                alert("Please enter location name");
                return false;
            }
            $(".companyLocations").append(locationComponent({
                name: locationName,
                lat_long: `${$("#lat").val()},${$("#lon").val()}`
            }));
            $("#fingerPrinteModal").modal("hide");
        });


        function initMap() {
            var latlng = new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lon").value);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });


            google.maps.event.addListener(marker, 'dragend', function (a) {
                $("#lat").val(a.latLng.lat());
                $("#lon").val(a.latLng.lng());

            });
        };

        // var input1 = document.querySelector("#kt_tagify_1");
        // new Tagify(input1);
    </script>
@endpush
