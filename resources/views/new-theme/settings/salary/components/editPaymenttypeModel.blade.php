<div class="modal fade customeModal" id="editPaymentType-{{$paymenttype->id}}" tabindex="-1" aria-labelledby="addNewPaymentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route("paymenttype.update",$paymenttype) }}">
                    @csrf
                    @method("PUT")
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang("Edit Payment Option")</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="content">


                            <div class="">
                                <label for="PaymentEn" class="form-label">@lang("Payment Option")</label>
                                <div class="inputS1">
                                    <input name="name" value="{{ old("name",$paymenttype->name) }}" type="text" id="PaymentEn" placeholder='@lang("Enter Payment Type")'>
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
