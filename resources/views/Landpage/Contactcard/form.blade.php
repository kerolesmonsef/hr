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

        <form method="POST" action="{{ $case == 'update' ? route('landpage.landcontactcard.update', ['id' => $row->id]) : route('landpage.landcontactcard.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                @php
                    $contact_types = ['phone' , 'email' , 'location'];
                @endphp
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="type" class="form-label">{{ __('landpage.Type') }}</label>
                        <select id ="type" name="type" class="form-select" data-control="select2" data-placeholder="Select an option">
                            <option></option>
                            @foreach($contact_types as $key => $type)
                            <option {{ $case == 'update' &&  $row->type ==  $type ? 'selected'  : '' }} value="{{ $type }}">{{  $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <label for="type" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="titleEn" class="required form-label">{{ __('landpage.English title') }}</label>
                        <input name="titleEn" value="{{ $case == 'update' ? $row->titleEn : old('titleEn') }}" id="titleEn" type="text" class="form-control"  />
                        @error('titleEn')
                            <label for="titleEn" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="titleAr" class="required form-label">{{ __('landpage.Arabic title') }}</label>
                        <input name="titleAr" value="{{ $case == 'update' ? $row->titleAr : old('titleAr') }}" id="titleAr" type="text" class="form-control"  />
                        @error('titleAr')
                            <label for="titleAr" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-11">
                    <div class="mb-10">
                        <label for="image" class="required form-label">{{ __('landpage.Icon') }}</label>
                        <input name="image"  id="image"
                            type="file" class="form-control"  />
                        @error('image')
                            <label for="image" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="col-md-1">
                    <label style="display: block;margin-bottom:9px;">{{ __('landpage.Icon') }}</label>
                    <a href="{{ $case == 'update' ?  url('storage/'.$row->image) :  'icon'    }}">
                        <div class="cursor-pointer symbol symbol-35px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img src="{{ $case == 'update' ?  url('storage/'.$row->image) :  'icon'    }}" alt="icon">
                        </div>
                    </a>
                </div>
            <div class="mb-10">
                <button style="float: right;" class="btn btn-primary btn-sm">{{ __('landpage.Save') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
