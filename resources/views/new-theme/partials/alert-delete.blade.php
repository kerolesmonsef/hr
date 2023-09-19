
<div class="modal modal-delete fade" id="confirm1" abindex="-1" aria-hidden="true">
    <div class="modal-dialog confirmS1 ">
        <div class="content">
            <div class="des">{{ __('Are you sure to delete this item ?') }}</div>
            <div class="btns">
                <button form="delete-form" type="submit" class="buttonS2 danger">{{ __('Remove') }}</button>
                <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <form id="delete-form" style="display:none;" method="post" action="">
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>