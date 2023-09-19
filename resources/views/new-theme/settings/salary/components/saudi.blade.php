<div id="saudi">
    <div class='sectionS2' style="border-radius: 0px 0px 10px 20px;margin-top: -36px;">
        <div class="content">
            <div class="row">
                <h5 class='title'>@lang('Social Insurance')</h5>
                <div class="col-lg-6">
                    <label for="socialCompanyInsurance" class="form-label">
                        @lang('saudi company insurance percentage') (SAR)
                    </label>
                    <div class="inputS1">
                        <input name="saudi_company_insurance_percentage" type="number" id="socialCompanyInsurance"
                            value="{{ old('saudi_company_insurance_percentage', $setting->saudi_company_insurance_percentage ?? '') }}"
                            placeholder='0 SAR'>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="socialEmployeeInsurance" class="form-label">
                        @lang('saudi employee insurance percentage') (SAR)
                    </label>
                    <div class="inputS1">
                        <input type="number" id="socialEmployeeInsurance"
                            value="{{ old('saudi_employee_insurance_percentage', $setting->saudi_employee_insurance_percentage) }}"
                            placeholder='0 SAR'>
                    </div>
                </div>

                <h5 class='title'>{{__("Medical Insurance")}}</h5>
                <div class="col-lg-6">
                    <label for="saudi_employee_medical_insurance" class="form-label">@lang('saudi employee medical insurance')
                        (SAR)</label>
                    <div class="inputS1">
                        <input type="number" name="saudi_employee_medical_insurance"
                            id="saudi_employee_medical_insurance"
                            value="{{ old('saudi_employee_medical_insurance', $setting->saudi_employee_medical_insurance) }}"
                            placeholder='0 SAR'>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="saudi_company_medical_insurance" class="form-label">@lang('saudi company medical insurance')
                        (SAR)</label>
                    <div class="inputS1">
                        <input type="number" name="saudi_company_medical_insurance"
                            id="saudi_company_medical_insurance"
                            value="{{ old('saudi_company_medical_insurance', $setting->saudi_company_medical_insurance) }}"
                            placeholder='0 SAR'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='sectionS1'>
        <div class="content">
            <div class="row">
                <div class="col-lg-6">
                    <label for="absence_with_permission_discount" class="form-label">@lang('Discount rate Absence with permission')</label>
                    <div class="inputS1">
                        <input name="absence_with_permission_discount" type="number"
                            id="absence_with_permission_discount"
                            value="{{ $setting->absence_with_permission_discount }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="absence_without_permission_discount" class="form-label">@lang('Discount rate Absence without permission')</label>
                    <div class="inputS1">
                        <input name="absence_without_permission_discount" type="number"
                            id="absence_without_permission_discount"
                            value="{{ $setting->absence_without_permission_discount }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="overtime_rate" class="form-label">@lang('overtime rate')</label>
                    <div class="inputS1">
                        <input type="number" name="overtime_rate" id="overtime_rate"
                            value="{{ $setting->overtime_rate }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="otherCurrencyUnit" class="form-label">@lang('Other currency unit price')</label>
                    <div class="inputS1">
                        <input name="other_currency_rate" type="number" id="otherCurrencyUnit"
                            value="{{ $setting->other_currency_rate }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex align end gap-15 orders  mt-4">
        <button class="buttonS1 rejected" type="submit" data-bs-dismiss="modal" aria-label="Close">
            @lang('Cancel')
        </button>
        <button class="buttonS1 primary" type="submit">
            @lang('Save')
        </button>
    </div>

</div>

