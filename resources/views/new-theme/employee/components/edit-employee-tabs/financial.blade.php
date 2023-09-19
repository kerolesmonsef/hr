<div class="tab-pane show active" role="tabpanel" aria-labelledby="financial-tab">
    <form class="formS1" method="post" action="{{ route('employee.update', $employee) }}">
        @method('put')
        @csrf
        <input type="hidden" name="update_financial_info" value="update_financial_info">
        <div class='sectionS2'>
            <div class="head withBorder">
                <h3 class='small'> {{__('Financial details')}} </h3>
            </div>

            <div class="content">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <label for="salary" class="form-label">{{__('Basic Salary')}}</label>
                        <div class="inputS1">
                            <input name="salary" type="number" id="salary"
                                value="{{ old('salary', $employee->salary) }}" placeholder="{{__('Salary')}}"
                                autocomplete="off" />
                        </div>
                        @include('new-theme.components.error1', ['error' => 'salary'])
                    </div>


                    <div class="col-sm-12 col-md-12">
                        <label class="form-label">{{__('Payment Method')}}</label>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label class="form-check" for="id11">
                                    <input class=" " type="radio" value="cash"
                                    @if($employee->payment_type == 'cash') selected @endif
                                    name="payment_type"
                                        id="id11">
                                    <label class="form-check-label" for="id11">
                                        {{__('Cash')}}
                                    </label>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label class="form-check" for="id22">
                                    <input class=" " type="radio" value="cheque"
                                    @if($employee->payment_type == 'cheque') selected @endif
                                    name="payment_type"
                                        id="id22">
                                    <label class="form-check-label" for="id22">
                                        {{__('cheque')}}
                                    </label>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label class="form-check" for="id222">
                                    <input class=" " type="radio" value="bank"
                                    @if($employee->payment_type == 'bank') selected @endif
                                    name="payment_type"
                                        id="id222">
                                    <label class="form-check-label" for="id222">
                                        {{__('Bank')}}
                                    </label>
                                </label>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label class="form-check" for="id28">
                                    <input class=" " type="radio" value="international_transfer" 
                                    @if($employee->payment_type == 'international_transfer') selected @endif
                                    name="payment_type"
                                        id="id28">
                                    <label class="form-check-label" for="id28">
                                        {{__('International Transfer')}}
                                    </label>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class='sectionS2'>
            <div class="head withBorder">
                <h3 class='small'>{{__('Bank Details')}}</h3>
            </div>

            <div class="content">
                <div class="row">

                    <div class="col-sm-12 col-md-6">
                        <label for="bank_id" class="form-label">{{__('Bank Name')}}</label>
                        <div class="inputS1">
                            <select id="bank_id" name="bank_id">
                                @foreach (\App\Models\Bank::all() as $bank)
                                    <option {{ old('bank_id', $employee->bank_id) == $bank->id ? 'selected' : '' }}
                                        value="{{ $bank->id }}">{{ $bank->{'name' . $lang} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="bank_name" class="form-label">{{__('Bank Branch')}}</label>
                        <div class="inputS1">
                            <input type="text" name="bank_name" id="bank_name"
                                value="{{ old('bank_name', $employee->bank_name) }}" placeholder="{{__('Bank Branch')}}"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="account_holder_name" class="form-label">{{__('Account Holder Name')}}</label>
                        <div class="inputS1">
                            <input type="text" name="account_holder_name" id="account_holder_name"
                                value="{{ old('account_holder_name', $employee->account_holder_name) }}"
                                placeholder="{{__('Account Holder Name')}}" autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="account_number" class="form-label">{{__('Account Number')}}</label>
                        <div class="inputS1">
                            <input type="text" name="account_number" id="account_number"
                                value="{{ old('account_number', $employee->account_number) }}"
                                placeholder="{{__('Account Number')}}" autocomplete="off" />
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder">
                <h3 class='small'>{{__('Social Insurance')}}</h3>
            </div>

            <div class="content">
                <div class="row">

                    <div class="col-sm-12 col-md-6">
                        <label for="insurance_number" class="form-label">{{__('Insurance Number')}}</label>
                        <div class="inputS1">
                            <input type="text" name="insurance_number" id="insurance_number"
                                value="{{ old('insurance_number', $employee->insurance_number) }}"
                                placeholder="{{__('Insurance Number')}}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="policy_number" class="form-label">{{__('Policy Number')}}</label>
                        <div class="inputS1">
                            <input type="text" name="policy_number" id="policy_number"
                                value="{{ old('policy_number', $employee->policy_number) }}"
                                placeholder="{{__('Policy Number')}}" autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="datepicker" class="form-label"> {{__('Insurance start date')}} </label>
                        <div class="inputS1">
                            <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                            <input type="text" name="insurance_startdate"
                                value="{{ old('insurance_startdate', front_date($employee->insurance_startdate)) }}"
                                class="datePickerBasic" autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="cost" class="form-label">{{__('Cost')}}</label>
                        <div class="inputS1">

                            <input type="text" name="cost" id="cost"
                                value="{{ old('cost', $employee->cost) }}" placeholder="{{__('Cost')}}"
                                autocomplete="off" />

                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="datepicker" class="form-label"> {{__('availability health insurance council')}} </label>
                        <div class="inputS1">
                            <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                            <input type="text" name="availability_health_insurance_council"
                                value="{{ old('availability_health_insurance_council', front_date($employee->availability_health_insurance_council)) }}"
                                class="datePickerBasic" autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="datepicker" class="form-label"> {{__('availability health insurance council')}} </label>
                        <div class="inputS1">
                            <img src="/new-theme/icons/date.svg" class="iconImg" />
                            <input type="text" value="01/06/2023" placeholder="{{__('availability health insurance council')}}" name="datepicker"
                                class="datePickerBasic" autocomplete="off" />
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class='sectionS2'>
            <div class="head withBorder">
                <h3 class='small'>{{__('Medical Insurance')}}</h3>
            </div>

            <div class="content">
                <div class="row">

                    <div class="col-sm-12 col-md-6">
                        <label for="medical_insurance_number" class="form-label">{{__('Insurance Number')}}</label>
                        <div class="inputS1">
                            <input type="text" name="medical_insurance_number" id="medical_insurance_number"
                                value="{{ old('medical_insurance_number', $employee->medical_insurance_number) }}"
                                placeholder="{{__('Insurance Number')}}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="medical_insurance_card_number" class="form-label">{{__('Insurance card number')}}</label>
                        <div class="inputS1">
                            <input type="text" name="medical_insurance_card_number"
                                id="medical_insurance_card_number"
                                value="{{ old('medical_insurance_card_number', $employee->medical_insurance_card_number) }}"
                                placeholder="{{__('Insurance card number')}}" autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="medical_insurance_start_date" class="form-label"> {{__('Insurance start date')}} </label>
                        <div class="inputS1">
                            <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                            <input type="text" id="medical_insurance_start_date"
                                name="medical_insurance_start_date"
                                value="{{ old('medical_insurance_start_date', front_date($employee->medical_insurance_start_date)) }}"
                                class="datePickerBasic" autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="medical_insurance_end_date" class="form-label">{{__('Insurance End date')}} </label>
                        <div class="inputS1">
                            <img src="{{ asset('new-theme/icons/date.svg') }}" class="iconImg" />
                            <input type="text" id="medical_insurance_end_date" name="medical_insurance_end_date"
                                value="{{ old('medical_insurance_end_date', front_date($employee->medical_insurance_end_date)) }}"
                                class="datePickerBasic" autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="medical_insurance_type" class="form-label">{{__('Insurance type')}}</label>
                        <div class="inputS1">
                            <input type="text" name="medical_insurance_type"
                                value="{{ old('medical_insurance_type', $employee->medical_insurance_type) }}"
                                placeholder="{{__('Insurance type')}}" id="medical_insurance_type"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <label for="medical_cover_ratio" class="form-label">{{__('Cover ratio')}}</label>
                        <div class="inputS1">
                            <input type="text" name="medical_cover_ratio"
                                value="{{ old('medical_cover_ratio', $employee->medical_cover_ratio) }}"
                                placeholder="{{__('Cover ratio')}}" id="medical_cover_ratio" autocomplete="off" />
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-6">
                        <label for="insuranceCompany" class="form-label">{{__('Insurance company')}}</label>
                        <div class="inputS1">
                            <select id="insurance_company_id" name="insurance_company_id">
                                @foreach (\App\Models\InsuranceCompany::all() as $insuranceCompnay)
                                    <option
                                        {{ old('insurance_company_id', $employee->insurance_company_id) == $insuranceCompnay->id ? 'selected' : '' }}
                                        value="{{ $insuranceCompnay->id }}">{{ $insuranceCompnay->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <div class="inputCheckbox">
                            <input type="checkbox"
                                {{ old('medical_insurance_policy', $employee->medical_insurance_policy) ? 'checked' : '' }}
                                value="1" name="medical_insurance_policy" id="medical_insurance_policy">
                            <label for="medical_insurance_policy" class="mb-0">{{__('has a life insurance policy ?')}}</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="flex align end gap-15 orders  my-5">
            <button class="buttonS1 rejected">
                {{__('Cancel')}}
            </button>
            <button class="buttonS1 primary" type="submit">
                {{__('Save')}}
            </button>
        </div>
    </form>
</div>
