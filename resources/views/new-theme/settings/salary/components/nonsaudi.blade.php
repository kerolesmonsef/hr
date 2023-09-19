<div id="non-saudi">
    <div class='sectionS2' style="border-radius: 0px 0px 10px 20px;margin-top: -36px;">

    <div class="content">
        <div class="row">
            <h5 class='title'>@lang('Social Insurance')</h5>
            <div class="col-lg-6">
                <label for="socialCompanyInsurance" class="form-label">
                    @lang('company insurance percentage')
                </label>
                <div class="inputS1">
                    <input name="Nonsaudi_company_insurance_percentage" type="number"
                        id="socialCompanyInsurance"
                        value="{{ old('Nonsaudi_company_insurance_percentage', $setting->Nonsaudi_company_insurance_percentage ?? '') }}"
                        placeholder='0 '>
                </div>
            </div>
            <div class="col-lg-6">
                <label for="socialEmployeeInsurance" class="form-label">
                    @lang('employee insurance percentage')
                </label>
                <div class="inputS1">
                    <input type="number" id="socialEmployeeInsurance"
                        value="{{ old('Nonsaudi_employee_insurance_percentage', $setting->Nonsaudi_employee_insurance_percentage) }}"
                        placeholder='0 ' name="Nonsaudi_employee_insurance_percentage">
                </div>
            </div>

            <h5 class='title'>Medical Insurance</h5>
            <div class="col-lg-6">
                <label for="Nonsaudi_employee_medical_insurance" class="form-label">@lang('employee medical insurance')
                    </label>
                <div class="inputS1">
                    <input type="number" name="Nonsaudi_employee_medical_insurance"
                        id="Nonsaudi_employee_medical_insurance"
                        value="{{ old('Nonsaudi_employee_medical_insurance', $setting->Nonsaudi_employee_medical_insurance) }}"
                        placeholder='0 '>
                </div>
            </div>
            <div class="col-lg-6">
                <label for="Nonsaudi_company_medical_insurance" class="form-label">@lang('company medical insurance')
                 </label>
                <div class="inputS1">
                    <input type="number" name="Nonsaudi_company_medical_insurance"
                        id="Nonsaudi_company_medical_insurance"
                        value="{{ old('Nonsaudi_company_medical_insurance', $setting->Nonsaudi_company_medical_insurance) }}"
                        placeholder='0 '>
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
