<div class="modal fade customeModal" id="editPaySlip-{{ $paysliptype->id }}" tabindex="-1"
    aria-labelledby="addNewPaySlipLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route('paysliptype.update', $paysliptype) }}">
                    @csrf
                    @method('PUT')
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang('Edit payslip type')</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div class="">
                                <label for="paySlipType" class="form-label">@lang('Payslip Type Arabic')</label>
                                <div class="inputS1">
                                    <input name="name_ar" value="{{ old('name_ar', $paysliptype->name_ar) }}"
                                        type="text" id="paySlipType" placeholder='@lang('Enter Payslip Type Arabic')'>
                                </div>
                            </div>

                            <div class="">
                                <label for="paySlipTypeEn" class="form-label">@lang('Payslip Type English')</label>
                                <div class="inputS1">
                                    <input name="name" value="{{ old('name', $paysliptype->name) }}" type="text"
                                        id="paySlipTypeEn" placeholder='@lang('Enter Payslip Type English')'>
                                </div>
                            </div>

                            <div class="flex align end gap-15 orders  mt-5 mb-4">
                                <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    @lang('Cancel')
                                </button>
                                <button class="buttonS1 primary" type="submit">
                                    @lang('Save')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
