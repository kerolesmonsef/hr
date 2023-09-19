@error($error)
    <span class="invalid-name" role="alert">
        <strong class="text-danger">{{ $message }}</strong>
    </span>
@enderror
<div class="text-danger d-none ajax-validation" id="{{ $error }}_error"></div>
