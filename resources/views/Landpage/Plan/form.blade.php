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

        <form method="POST" action="{{ $case == 'update' ? route('landpage.landplan.update', ['id' => $row->id]) : route('landpage.landplan.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">


                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="type" class="form-label">{{ __('landpage.Type') }}</label>
                        <select id ="type" name="type" class="form-select" data-control="select2" data-placeholder="Select an option">
                            <option></option>
                            @foreach($types as $key => $type)
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
                        <label for="dateType" class="form-label">{{ __('landpage.Date type') }}</label>
                        <select id ="dateType" name="dateType" class="form-select" data-control="select2" data-placeholder="Select an option">
                            <option></option>
                            @foreach($datetypes as $key => $dateType)
                            <option {{ $case == 'update' &&  $row->dateType ==  $dateType ? 'selected'  : '' }} value="{{ $dateType }}">{{  $dateType }}</option>
                            @endforeach
                        </select>
                        @error('dateType')
                            <label for="type" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
                        @enderror
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="mb-10">
                        <label for="price" class="required form-label">{{ __('landpage.Price') }}</label>
                        <input name="price" min="1" value="{{ $case == 'update' ? $row->price : old('price') }}" id="price" type="number" class="form-control"  />
                        @error('price')
                            <label for="price" style="color:#f00;font-size:12px;margin-top:3px;">{{ $message }}</label>
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
