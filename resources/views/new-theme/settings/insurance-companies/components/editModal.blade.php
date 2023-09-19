<div class="modal fade customeModal" id="editInsurance-{{ $company->id }}" tabindex="-1"
    aria-labelledby="editInsuranceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route('insurance-companies.update', $company) }}">
                    @csrf
                    @method('PUT')
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang('Edit insurance company')</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div class="">
                                <label for="payrollType" class="form-label">@lang('Insurance Company')</label>
                                <div class="inputS1">
                                    <input name="name" type="text" value="{{ $company->name }}"
                                        placeholder='Enter Insurance Company'>
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
