@php
    $week_vacations = explode(',', $setting['week_vacations']);
    //    $ip_address = explode(',', $setting['ip_address']);
@endphp
<div class="tab-pane fade show active" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
    <form method="POST" action="{{ route('s-attendance.update',auth()->user()->creatorId()) }}" class="formS1">
        @csrf
        @method('put')
        <div class='sectionS1 mb-4'>
            <div class="content">
                <div class="inputS1 mb-0" style="width: fit-content;">
                    <select style=" font-weight: bold">
                        <option value="">Cairo Branch</option>
                    </select>
                </div>
            </div>
        </div>
        <div class='sectionS2'>
            <div class="head withBorder flex align between">
                <h3 class='small'>{{ __('Attendance Time') }}</h3>
            </div>
            <div class="content">
                <div class="row">
                    <input type="hidden" name="lat" id="lat" value="{{ old('lat', $setting['lat']) }}" />
                    <input type="hidden"name="lon" id="lon" value="{{ old('lon', $setting['lon']) }}" />
                    <div class="col-lg-6">
                        <label for="startTime" class="form-label">{{__("Company Start Time")}} *</label>
                        <div class="inputS1">
                            <img src="/new-theme/icons/clock.svg" class="iconImg" />
                            <input value="{{ old('company_start_time', $setting['company_start_time']) }}" required
                                name="company_start_time" class="time-pickable" id="startTime"
                                placeholder="Enter Company Start Time" readonly />
                        </div>
                        @include('new-theme.components.error1', ['error' => 'company_start_time'])
                    </div>
                    <div class="col-lg-6">
                        <label for="endTime" class="form-label">{{ __('Company End Time') }} *</label>
                        <div class="inputS1">
                            <img src="/new-theme/icons/clock.svg" class="iconImg" />
                            <input value="{{ old('company_end_time', $setting['company_end_time']) }}" required
                                name="company_end_time" class="time-pickable" id="endTime"
                                placeholder="Enter Company End Time" readonly />
                        </div>
                        @include('new-theme.components.error1', ['error' => 'company_end_time'])
                    </div>
                    <div class="col-lg-6">
                        <label for="gracePeriodAfter" class="form-label">{{ __('Finger Print After Start') }}</label>
                        <div class="inputS1">
                            <input value="{{ old('company_grace_period', $setting['company_grace_period']) }}"
                                name="company_grace_period" type="number" id="gracePeriodAfter" value="2"
                                placeholder='Enter Company Grace Period Before'>
                        </div>
                        @include('new-theme.components.error1', ['error' => 'company_grace_period'])
                    </div>
                    <div class="col-lg-6">
                        <label for="gracePeriodBefore" class="form-label">{{ __('Finger Print Before Start') }}</label>
                        <div class="inputS1">
                            <input
                                value="{{ old('company_grace_period_befor', $setting['company_grace_period_befor']) }}"
                                type="number" name="company_grace_period_befor" id="gracePeriodBefore" value="2"
                                placeholder='Enter Company Grace Period Before'>
                        </div>
                        @include('new-theme.components.error1', ['error' => 'company_grace_period_befor'])
                    </div>

                    <div class="col-lg-6">
                        <label for="periodEndAfter" class="form-label">{{ __('Finger Print After End') }}</label>
                        <div class="inputS1">
                            <input
                                value="{{ old('company_grace_period_end_after', $setting['company_grace_period_end_after']) }}"
                                name="company_grace_period_end_after" type="number"
                                name="company_grace_period_end_after" id="periodEndAfter" value="2"
                                placeholder='Enter Company grace period end After'>
                        </div>
                        @include('new-theme.components.error1', [
                            'error' => 'company_grace_period_end_after',
                        ])
                    </div>

                    <div class="col-lg-6">
                        <label for="periodEndBefore" class="form-label">{{ __('Finger Print Before End') }}</label>
                        <div class="inputS1">
                            <input
                                value="{{ old('company_grace_period_end_before', $setting['company_grace_period_end_before']) }}"
                                name="company_grace_period_end_before" type="number" id="periodEndBefore"
                                value="2" placeholder='Enter Company grace period end before'>
                        </div>
                        @include('new-theme.components.error1', [
                            'error' => 'company_grace_period_end_before',
                        ])
                    </div>


                    <div class="col-lg-6">
                        <label for="breaksStartTime" class="form-label">{{ __('Breaks Start Time') }}</label>
                        <div class="inputS1">
                            <img src="/new-theme/icons/clock.svg" class="iconImg" />
                            <input value="{{ old('break_start_time', $setting['break_start_time']) }}"
                                name="break_start_time" class="time-pickable" id="breaksStartTime"
                                placeholder="Enter Breaks Start Time" readonly />
                        </div>
                        @include('new-theme.components.error1', ['error' => 'break_start_time'])
                    </div>
                    <div class="col-lg-6">
                        <label for="breaksEndTime" class="form-label">{{ __('Breaks End Time') }}</label>
                        <div class="inputS1">
                            <img src="/new-theme/icons/clock.svg" class="iconImg" />
                            <input value="{{ old('break_end_time', $setting['break_end_time']) }}"
                                name="break_end_time" class="time-pickable" id="breaksEndTime"
                                placeholder="Enter Breaks End Time" readonly />
                        </div>
                        @include('new-theme.components.error1', ['error' => 'break_end_time'])
                    </div>

                    <div class="col-lg-6">
                        <label for="workHours" class="form-label">{{ __('Work Hours') }}</label>
                        <div class="inputS1">
                            <input value="{{ old('work_hours', $setting['work_hours']) }}" name="work_hours"
                                type="number" id="workHours" value="2" placeholder='Enter Work Hours'>
                        </div>
                        @include('new-theme.components.error1', ['error' => 'work_hours'])
                    </div>

                    <div class="col-lg-6">
                        <label for="weekVacations" class="form-label">{{ __('Week Vacations') }}</label>
                        <div class="inputS1 multipleSelect removeSearch">
                            <select multiple name="week_vacations[]" class="form-select" id="multipleSelectWeekVacations" data-placeholder="Choose anything" multiple>
                                <option {{ in_array('friday', $week_vacations) ? 'selected' : '' }} value="friday">Friday</option>
                                <option {{ in_array('saturday', $week_vacations) ? 'selected' : '' }} value="saturday">Saturday</option>
                                <option {{ in_array('sunday', $week_vacations) ? 'selected' : '' }} value="sunday">Sunday</option>
                                <option {{ in_array('monday', $week_vacations) ? 'selected' : '' }} value="monday">Monday</option>
                                <option {{ in_array('tuesday', $week_vacations) ? 'selected' : '' }} value="tuesday">Tuesday</option>
                                <option {{ in_array('wednesday', $week_vacations) ? 'selected' : '' }} value="wednesday">Wednesday</option>
                                <option {{ in_array('thursday', $week_vacations) ? 'selected' : '' }} value="thursday">Thursday</option>
                            </select>
                        </div>
                        @include('new-theme.components.error1', ['error' => 'week_vacations'])
                    </div>

                    <div class="col-lg-6">
                        <div class="flex align gap-3" style="margin-bottom: 10px">
                            <label for="ipAddress" class="m-0">{{ __('Ip Address') }}</label>
                            <div class="form-switch m-0">
                                <input class="form-check-input" type="checkbox" id="ipAddress" checked
                                    onChange="switchInput3(event, 'multipleSelectIpAddressTags')"
                                    name="required_ip_address">
                            </div>
                        </div>

                        <div class="inputS1">
                            <input name='ip_address' value="{{ $setting['ip_address'] }}" class="custom-tag"
                                id="multipleSelectIpAddressTags">

                            {{--                            <select multiple name="ip_address[]" class="form-select" id="multipleSelectIpAddress" --}}
                            {{--                                data-placeholder="Choose anything" multiple> --}}
                            {{--                                <option {{ in_array('d0:21:f9:5a:32:45', $ip_address) ? 'selected' : '' }} --}}
                            {{--                                    value="d0:21:f9:5a:32:45">d0:21:f9:5a:32:45</option> --}}
                            {{--                                <option {{ in_array('d0:21:f9:5a:32:45', $ip_address) ? 'selected' : '' }} --}}
                            {{--                                    value="d0:21:f9:5a:32:45">d0:21:f9:5a:32:45</option> --}}
                            {{--                                <option {{ in_array('d0:21:f9:5a:32:45', $ip_address) ? 'selected' : '' }} --}}
                            {{--                                    value="d0:21:f9:5a:32:45">d0:21:f9:5a:32:45</option> --}}
                            {{--                                <option {{ in_array('d0:21:f9:5a:32:45', $ip_address) ? 'selected' : '' }} --}}
                            {{--                                    value="d0:21:f9:5a:32:45">d0:21:f9:5a:32:45</option> --}}
                            {{--                            </select> --}}
                        </div>
                        @include('new-theme.components.error1', ['error' => 'ip_address'])
                    </div>

                    <div class="col-lg-6">
                        <label for="permissionMonthlyLimit" class="form-label">{{ __('Permission Monthly Limit') }}
                        </label>
                        <div class="inputS1">
                            <input name="permissions_monthly_limit" type="number" id="permissionMonthlyLimit"
                                value="2" placeholder='Enter Permission monthly limit'>
                        </div>
                        @include('new-theme.components.error1', ['error' => 'permissions_monthly_limit'])
                    </div>
                    <div class="col-lg-6">
                        <div class="flex align gap-3" style="margin-bottom: 10px">
                            <label for="timeZone" class="m-0">{{ __('Time zone') }}</label>
                            {{--                            <div class="form-switch m-0"> --}}
                            {{--                                <input class="form-check-input" type="checkbox" role="switch" checked --}}
                            {{--                                    id="timeZone" onChange="switchInput(event, 'timeZoneSelect')"> --}}
                            {{--                            </div> --}}
                        </div>
                        <div class="inputS1">
                            <select name="time_zone" id="timeZoneSelect">
                                <option {{ old('time_zone', $setting['time_zone']) == 'Etc/GMT+12' ? 'selected' : '' }}
                                    value="Etc/GMT+12">(GMT-12:00) International Date Line West
                                </option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Pacific/Midway' ? 'selected' : '' }}
                                    value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Pacific/Honolulu' ? 'selected' : '' }}
                                    value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                                <option {{ old('time_zone', $setting['time_zone']) == 'US/Alaska' ? 'selected' : '' }}
                                    value="US/Alaska">(GMT-09:00) Alaska</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Los_Angeles' ? 'selected' : '' }}
                                    value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)
                                </option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Tijuana' ? 'selected' : '' }}
                                    value="America/Tijuana">(GMT-08:00) Tijuana, Baja California
                                </option>
                                <option {{ old('time_zone', $setting['time_zone']) == 'US/Arizona' ? 'selected' : '' }}
                                    value="US/Arizona">(GMT-07:00) Arizona</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Chihuahua' ? 'selected' : '' }}
                                    value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan
                                </option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'US/Mountain' ? 'selected' : '' }}
                                    value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)
                                </option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Managua' ? 'selected' : '' }}
                                    value="America/Managua">(GMT-06:00) Central America</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Mexico_City' ? 'selected' : '' }}
                                    value="US/Central">(GMT-06:00) Central Time (US & Canada)</option>
                                <option value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City,
                                    Monterrey</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Canada/Saskatchewan' ? 'selected' : '' }}
                                    value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                <option {{ old('time_zone', $setting['time_zone']) == '' ? 'selected' : '' }}
                                    value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco
                                </option>
                                <option {{ old('time_zone', $setting['time_zone']) == 'US/Eastern' ? 'selected' : '' }}
                                    value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'US/East-Indiana' ? 'selected' : '' }}
                                    value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Canada/Atlantic' ? 'selected' : '' }}
                                    value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                                <option {{ old('time_zone', $setting['time_zone']) == '' ? 'selected' : '' }}
                                    value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Manaus' ? 'selected' : '' }}
                                    value="America/Manaus">(GMT-04:00) Manaus</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Santiago' ? 'selected' : '' }}
                                    value="America/Santiago">(GMT-04:00) Santiago</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Canada/Newfoundland' ? 'selected' : '' }}
                                    value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Sao_Paulo' ? 'selected' : '' }}
                                    value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Argentina/Buenos_Aires' ? 'selected' : '' }}
                                    value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires,
                                    Georgetown</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Godthab' ? 'selected' : '' }}
                                    value="America/Godthab">(GMT-03:00) Greenland</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Montevideo' ? 'selected' : '' }}
                                    value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'America/Noronha' ? 'selected' : '' }}
                                    value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Atlantic/Cape_Verde' ? 'selected' : '' }}
                                    value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Atlantic/Azores' ? 'selected' : '' }}
                                    value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Africa/Casablanca' ? 'selected' : '' }}
                                    value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia,
                                    Reykjavik</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Etc/Greenwich' ? 'selected' : '' }}
                                    value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin,
                                    Edinburgh, Lisbon, London</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Amsterdam' ? 'selected' : '' }}
                                    value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome,
                                    Stockholm, Vienna</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Belgrade' ? 'selected' : '' }}
                                    value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest,
                                    Ljubljana, Prague</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Brussels' ? 'selected' : '' }}
                                    value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid,
                                    Paris</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Sarajevo' ? 'selected' : '' }}
                                    value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw,
                                    Zagreb</option>


                                <option value="Africa/Lagos"
                                    {{ old('time_zone', $setting['time_zone']) == 'Africa/Lagos' ? 'selected' : '' }}>
                                    (GMT+01:00) West Central Africa
                                </option>
                                <option value="Asia/Amman"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Amman' ? 'selected' : '' }}>
                                    (GMT+02:00) Amman
                                </option>
                                <option value="Europe/Athens"
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Athens' ? 'selected' : '' }}>
                                    (GMT+02:00) Athens, Bucharest, Istanbul
                                </option>
                                <option value="Asia/Beirut"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Beirut' ? 'selected' : '' }}>
                                    (GMT+02:00) Beirut
                                </option>
                                <option value="Africa/Cairo"
                                    {{ old('time_zone', $setting['time_zone']) == 'Africa/Cairo' ? 'selected' : '' }}>
                                    (GMT+02:00) Cairo
                                </option>
                                <option value="Africa/Harare"
                                    {{ old('time_zone', $setting['time_zone']) == 'Africa/Harare' ? 'selected' : '' }}>
                                    (GMT+02:00) Harare, Pretoria
                                </option>
                                <option value="Europe/Helsinki"
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Helsinki' ? 'selected' : '' }}>
                                    (GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius
                                </option>
                                <option value="Asia/Jerusalem"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Jerusalem' ? 'selected' : '' }}>
                                    (GMT+02:00) Jerusalem
                                </option>




                                <option value="">Select Time Zone</option>
                                <option value="Europe/Minsk"
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Minsk' ? 'selected' : '' }}>
                                    (GMT+02:00) Minsk
                                </option>
                                <option value="Africa/Windhoek"
                                    {{ old('time_zone', $setting['time_zone']) == 'Africa/Windhoek' ? 'selected' : '' }}>
                                    (GMT+02:00) Windhoek
                                </option>
                                <option value="Asia/Kuwait"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Kuwait' ? 'selected' : '' }}>
                                    (GMT+03:00) Kuwait, Riyadh, Baghdad
                                </option>
                                <option value="Europe/Moscow"
                                    {{ old('time_zone', $setting['time_zone']) == 'Europe/Moscow' ? 'selected' : '' }}>
                                    (GMT+03:00) Moscow, St. Petersburg, Volgograd
                                </option>
                                <option value="Africa/Nairobi"
                                    {{ old('time_zone', $setting['time_zone']) == 'Africa/Nairobi' ? 'selected' : '' }}>
                                    (GMT+03:00) Nairobi
                                </option>
                                <option value="Asia/Tbilisi"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Tbilisi' ? 'selected' : '' }}>
                                    (GMT+03:00) Tbilisi
                                </option>
                                <option value="Asia/Tehran"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Tehran' ? 'selected' : '' }}>
                                    (GMT+03:30) Tehran
                                </option>
                                <option value="Asia/Muscat"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Muscat' ? 'selected' : '' }}>
                                    (GMT+04:00) Abu Dhabi, Muscat
                                </option>




                                <option value="Asia/Baku"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Baku' ? 'selected' : '' }}>
                                    (GMT+04:00) Baku</option>
                                <option value="Asia/Yerevan"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Yerevan' ? 'selected' : '' }}>
                                    (GMT+04:00) Yerevan</option>
                                <option value="Asia/Kabul"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Kabul' ? 'selected' : '' }}>
                                    (GMT+04:30) Kabul</option>
                                <option value="Asia/Yekaterinburg"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Yekaterinburg' ? 'selected' : '' }}>
                                    (GMT+05:00) Yekaterinburg</option>
                                <option value="Asia/Karachi"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Karachi' ? 'selected' : '' }}>
                                    (GMT+05:00) Islamabad, Karachi, Tashkent</option>
                                <option value="Asia/Calcutta"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Calcutta' ? 'selected' : '' }}>
                                    (GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                <option value="Asia/Calcutta"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Calcutta' ? 'selected' : '' }}>
                                    (GMT+05:30) Sri Jayawardenapura</option>
                                <option value="Asia/Katmandu"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Katmandu' ? 'selected' : '' }}>
                                    (GMT+05:45) Kathmandu</option>
                                <option value="Asia/Almaty"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Almaty' ? 'selected' : '' }}>
                                    (GMT+06:00) Almaty, Novosibirsk</option>
                                <option value="Asia/Dhaka"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Dhaka' ? 'selected' : '' }}>
                                    (GMT+06:00) Astana, Dhaka</option>
                                <option value="Asia/Rangoon"
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Rangoon' ? 'selected' : '' }}>
                                    (GMT+06:30) Yangon (Rangoon)</option>




                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Bangkok' ? 'selected' : '' }}
                                    value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Krasnoyarsk' ? 'selected' : '' }}
                                    value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Hong_Kong' ? 'selected' : '' }}
                                    value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Kuala_Lumpur' ? 'selected' : '' }}
                                    value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Irkutsk' ? 'selected' : '' }}
                                    value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Australia/Perth' ? 'selected' : '' }}
                                    value="Australia/Perth">(GMT+08:00) Perth</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Taipei' ? 'selected' : '' }}
                                    value="Asia/Taipei">(GMT+08:00) Taipei</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Tokyo' ? 'selected' : '' }}
                                    value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Seoul' ? 'selected' : '' }}
                                    value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Yakutsk' ? 'selected' : '' }}
                                    value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Australia/Adelaide' ? 'selected' : '' }}
                                    value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Australia/Darwin' ? 'selected' : '' }}
                                    value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Australia/Brisbane' ? 'selected' : '' }}
                                    value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Australia/Canberra' ? 'selected' : '' }}
                                    value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</option>



                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Australia/Hobart' ? 'selected' : '' }}
                                    value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Pacific/Guam' ? 'selected' : '' }}
                                    value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Vladivostok' ? 'selected' : '' }}
                                    value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Asia/Magadan' ? 'selected' : '' }}
                                    value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Pacific/Auckland' ? 'selected' : '' }}
                                    value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Pacific/Fiji' ? 'selected' : '' }}
                                    value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                <option
                                    {{ old('time_zone', $setting['time_zone']) == 'Pacific/Tongatapu' ? 'selected' : '' }}
                                    value="Pacific/Tongatapu">(GMT+13:00) Nuku alofa</option>



                            </select>
                        </div>
                        @include('new-theme.components.error1', ['error' => 'time_zone'])
                    </div>
                    <div class="col-lg-12">
                        <div class="flex align gap-3 mb-3">
                            <label for="locationOnMap" class="m-0">{{ __('Location On Map') }}</label>
                            <div class="form-switch m-0">
                                <input class="form-check-input" type="checkbox" checked id="locationOnMap"
                                    onChange="switchInput2(event, 'map')">
                            </div>
                        </div>
                        <div class="googleMapS1">
                            {{--  <input id="pac-input" class="controls" type="text" id="googleMapInput"
                                placeholder="Search Box" />  --}}
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex align end gap-15 orders ">

            <button class="buttonS1 primary" type="submit">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>

@push('script')
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_foD6VvulHSpxKYjtgehkQ_UoVGHH64Y&callback=initMap&libraries=places,geometry">
    </script>
    <script>
        function initMap() {
            var latlng = new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lon").value);
            var map = new google.maps.Map(document.getElementById('map'), {
                center: latlng,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lon values for this property',
                draggable: true
            });

            {{--  if (navigator.geolocation) {
           

                    navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                         alert('dd');
                                console.log(pos);
                    map.setCenter(pos);
                    marker.setPosition(pos);
                    document.getElementById("lat").value = pos.lat;
                    document.getElementById("lon").value = pos.lng;
                    }, function() {
                    handleLocationError(true, map.getCenter());
                    });
            } else {
                handleLocationError(false, map.getCenter());
            }  --}}

            google.maps.event.addListener(marker, 'dragend', function(a) {
                document.getElementById("lat").value = a.latLng.lat().toFixed(6);
                document.getElementById("lon").value = a.latLng.lng().toFixed(6);
            });
        };
    </script>
@endpush
