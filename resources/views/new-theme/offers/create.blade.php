<?php
    if($offer->exists) {
        $method = "put";
        $action = route("offers.update", $offer);
    } else {
        $method = "post";
        $action = route("offers.store");
    }
?>
@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ url('new-theme/styles/offers.css') }}"/>
@endpush

@section('content')
    <div class="addofferPage">
        <div class="pageS1">

            <a href='/offers/index'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt=''/>
                        <h3>@lang("Add New Offer")</h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="{{ $action }}" method="post" enctype="multipart/form-data">
                @csrf
                @method($method)
                <div class='sectionS2'>
                    <div class='content p-4'>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="offerName" class="form-label">@lang("Name")</label>
                                @include("new-theme.components.error1",['error'=>'name'])
                                <div class="inputS1">
                                    <input type="text" name="name" value="{{ old('name',$offer->name) }}" id="offerName"
                                           placeholder="@lang("Enter Offer Name")">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="offer" class="form-label">@lang("Offer")</label>
                                @include("new-theme.components.error1",['error'=>'offer'])
                                <div class="inputS1">
                                    <input type="number" name="offer" value="{{ old('offer',$offer->offer) }}"
                                           id="offer" placeholder="@lang("Enter Offer")">
                                </div>
                            </div>
                            @push("script")
                                <script>
                                    <?php
                                    $start_date = now()->format("Y-m-d");
                                    $end_date =  now()->format("Y-m-d");
                                    
                                    if (old('end_date')) {
                                        $dates = explode(" to ", old('end_date'));
                                        $start_date = $dates[0] ?? now()->format("Y-m-d");
                                        $end_date = $dates[1] ?? now()->format("Y-m-d");
                                    }
                                    ?>
                                    var rangeDate = document.getElementById("end_date");

                                    var flatpickrRange = flatpickr(rangeDate, {
                                        mode: "range",
                                        dateFormat: "Y-m-d",
                                    });

                                    flatpickrRange.setDate(["{{ $start_date }}", "{{ $end_date }}"]);
                                </script>
                            @endpush
                            <div class="col-lg-6">
                                <label for="end_date" class="form-label">@lang("Date")</label>
                                <div class="inputS1 noHeight">
                                    <img src="/new-theme/icons/date.svg" class="iconImg"/>
                                    <input type="text" value="" id="end_date"
                                           name="end_date"
                                           class="datePickerRange" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="link_promocode" class="form-label">@lang("Link / Promocode")</label>
                                @include("new-theme.components.error1",['error'=>'promocode'])
                                <div class="inputS1">
                                    <input type="text" name="promocode" value="{{ old("promocode",$offer->promocode) }}"
                                           id="link_promocode"
                                           placeholder="@lang("Enter Link / Promocode")">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="description" class="form-label">@lang("Description")</label>
                                <div class="inputS1">
                                    <textarea name="description" id="description"
                                              placeholder="@lang("Enter Description")">{{ old('description',$offer->description) }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="offerPhoto" class="form-label">@lang("Offer Photo")</label>
                                @include("new-theme.components.error1",['error'=>'photo'])
                                <div class="uploadFileBox">
                                    <div class="uploadFileBoxContent">
                                        <div class="title" id="fileName">@lang("Upload Your File")</div>
                                        <div class="des">
                                            @lang("Browse and choose the files you want to upload")
                                        </div>
                                        <div class="uploadInput">
                                            <img src="/new-theme/icons/uploadS1.svg" alt=""/>
                                            <input name="photo" type="file" onchange="getFileData(this);"/>
                                        </div>
                                        <div class="fileSize" id="fileSize">@lang("Max file size:") 2MB</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex align end gap-15">
                    <a href="{{ route("offers.index") }}">
                        <button class='buttonS1 rejected' type="button">
                            @lang("Cancel")
                        </button>
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        @lang("Save")
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection
@push('script')
@endpush
