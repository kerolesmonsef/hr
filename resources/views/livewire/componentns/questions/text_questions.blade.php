<div class="row gx-5">

    <div class="col-lg-6">
        <div>
            <label for="{{ $prefix }}-points" class="form-label">Points</label>
            <div class="inputS1">
                <input wire:model="{{ $prefix . '.points' }}" type="number" name="notRequired"
                    id="{{ $prefix }}-points">
            </div>
        </div>
    </div>

</div>
