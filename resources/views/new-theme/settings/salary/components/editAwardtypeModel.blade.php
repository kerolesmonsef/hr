<div class="modal fade customeModal" id="editAwardType-{{$awardtype->id}}" tabindex="-1" aria-labelledby="addNewAwardLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route("awardtype.update",$awardtype) }}">
                    @csrf
                    @method("PUT")
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang("Edit Award Option")</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div class="">
                                <label for="Award" class="form-label">@lang("Award Option Arabic")</label>
                                <div class="inputS1">
                                    <input name="name_ar" value="{{ old("name_ar",$awardtype->name_ar) }}" type="text" id="Award" placeholder='@lang("Enter Award Type Arabic")'>
                                </div>
                            </div>

                            <div class="">
                                <label for="AwardEn" class="form-label">@lang("Award Option English")</label>
                                <div class="inputS1">
                                    <input name="name" value="{{ old("name",$awardtype->name) }}" type="text" id="AwardEn" placeholder='@lang("Enter Award Type English")'>
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
