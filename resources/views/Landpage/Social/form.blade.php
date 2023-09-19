@extends('layouts.admin')
@section('page-title')
    {{__('Dashboard')}}
@endsection

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        {{--  @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif  --}}

        <form method="POST" action="{{ $case == 'update' ? route('landpage.landsocial.update', ['id' => $row->id]) : route('landpage.landsocial.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="url" class="required form-label">{{ __('landpage.Url') }}</label>
                        <input name="url" value="{{ $case == 'update' ? $row->url : old('url') }}" id="url"
                            type="text" class="form-control" {{ $row }}/>
                        @error('url')
                            <label for="url" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="type" class="form-label">{{ __('landpage.Type') }}</label>
                        <select id ="type" name="type" class="form-select" data-control="select2" data-placeholder="Select an option">
                            <option></option>
                            @foreach($types as $key => $type)
                            <option {{ $case == 'update' &&  $row->type ==  $type ? 'selected'  : (old('type') == $type ? 'selected' : '' ) }} value="{{ $type }}">{{  $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <label for="type" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>





            <div class="mb-10">
                <button style="float: right;" class="btn btn-primary btn-sm">{{ __('landpage.Save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
