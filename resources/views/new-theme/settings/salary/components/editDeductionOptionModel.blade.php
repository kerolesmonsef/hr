<div class="modal fade customeModal" id="editDeductionOption-{{$deductionoption->id}}" tabindex="-1" aria-labelledby="addNewDeductionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route("deductionoption.update",$deductionoption) }}">
                    @csrf
                    @method("PUT")
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang("Edit Deduction Option")</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div class="">
                                <label for="Deduction" class="form-label">@lang("Deduction Option Arabic")</label>
                                <div class="inputS1">
                                    <input name="name_ar" value="{{ old("name_ar",$deductionoption->name_ar) }}" type="text" id="Deduction" placeholder='@lang("Enter Deduction Option Arabic")'>
                                </div>
                            </div>

                            <div class="">
                                <label for="DeductionEn" class="form-label">@lang("Deduction Option English")</label>
                                <div class="inputS1">
                                    <input name="name" value="{{ old("name",$deductionoption->name) }}" type="text" id="DeductionEn" placeholder='@lang("Enter Deduction Option English")'>
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
