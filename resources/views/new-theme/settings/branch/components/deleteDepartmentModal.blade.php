<div class="modal fade" id="delete-{{ $department->id }}" abindex="-1" aria-hidden="true">
    <div class="modal-dialog confirmS1 ">
        <form class="content" method="post" action="{{ route("department.destroy",$department) }}">
            @csrf
            @method("delete")
            <div class="des">@lang("Are you sure you want to remove this Item?")</div>
            <div class="btns">
                <button type="submit" class="buttonS2 danger">@lang("Remove")</button>
                <button type="button" class="buttonS2 cancel" data-bs-dismiss="modal">@lang("Close")</button>
            </div>
        </form>
    </div>
</div>