<div class="modal fade customeModal" id="editLoanOption-{{$loanoption->id}}" tabindex="-1" aria-labelledby="addNewLoanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route("loanoption.update",$loanoption) }}">
                    @csrf
                    @method("PUT")
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang("Edit Loan Option")</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div class="">
                                <label for="Loan" class="form-label">@lang("Loan Option Arabic")</label>
                                <div class="inputS1">
                                    <input name="name_ar" value="{{ old("name_ar",$loanoption->name_ar) }}" type="text" id="Loan" placeholder='@lang("Enter Loan Option Arabic")'>
                                </div>
                            </div>

                            <div class="">
                                <label for="LoanEn" class="form-label">@lang("Loan Option English")</label>
                                <div class="inputS1">
                                    <input name="name" value="{{ old("name",$loanoption->name) }}" type="text" id="LoanEn" placeholder='@lang("Enter Loan Option English")'>
                                </div>
                            </div>

                            <div class="flex align end gap-15 mt-5 mb-4">
                                <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                                    @lang("Cancel")
                                </button>
                                <button class="buttonS1 primary" type="submit">
                                    @lang("Save")
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
