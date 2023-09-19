<!-- delete modal  -->
<div class="modal fade" id="delete-{{ $type->id }}" abindex="-1" aria-hidden="true">
    <div class="modal-dialog confirmS1 ">
        <div class="content">
            <div class="des">@lang("Are you sure you want to remove this Item?")</div>
            <form class="btns" method="post" action="{{ route("assets-types.destroy",$type) }}">
                @method("delete")
                @csrf
                <button type="submit" class="buttonS2 danger">@lang("remove")</button>
                <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">@lang("Close")</button>
            </form>
        </div>
    </div>
</div>