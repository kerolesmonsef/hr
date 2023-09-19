@extends('new-theme.layout.layout3')

@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href='{{Route('account-assets.index')}}'>
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3> {{ __('Add New Assets') }} </h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="{{ route('account-assets.store') }}" method="post">
                @csrf
                <div class='sectionS2'>
                    <div class='content p-4'>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="assetsName" class="form-label">{{ __('Assets Name') }}</label>
                                <div class="inputS1">
                                    <input type="text" value="{{ old('name') }}" name="name" id="assetsName"
                                        placeholder='{{ __('Enter', ['val' => __('Assets Name')]) }}' />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'name'])
                            </div>
                            <div class="col-lg-6">
                                <label for="type" class="form-label">{{ __('Type') }}</label>
                                <div class="inputS1">
                                    <select name="assets_type_id">
                                        <option value="">{{__('Choose')}}</option>
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}" {{ old('type') == $type->id ? 'selected' : '' }}>
                                                {{$type->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'assets_type_id'])
                            </div>
                            <div class="col-lg-6">
                                <label for="snCode" class="form-label">{{ __('S/N') }}</label>
                                <div class="inputS1">
                                    <input name="serial_number" value="{{ old('serial_number') }}" type="text"
                                        id="snCode" placeholder='{{ __('Enter', ['val' => __('S/N')]) }}'>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'serial_number'])
                            </div>
                            <div class="col-lg-6">
                                <label for="amount" class="form-label">{{ __('Amount') }}</label>
                                <div class="inputS1 noHeight">
                                    <input type="number" value="{{ old('amount') }}" name="amount" value=""
                                        id="amount" placeholder="{{ __('Enter', ['val' => __('Amount')]) }}"
                                        autocomplete="off" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'amount'])
                            </div>
                            <div class="col-lg-6">
                                <label for="employeeName" class="form-label">{{ __('Employee Name') }}</label>
                                <div class="inputS1">
                                    <select id="employee_id" name="employee_id">
                                        <option value="">{{__('Choose')}}</option>
                                        @foreach ($employees as $key => $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee['name'.$lang] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'employee_id'])
                            </div>
                            <div class="col-lg-6">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <div class="inputS1">
                                    <select id="status" name="status">
                                        <option value="not_available"
                                            {{ old('status') == 'not_available' ? 'selected' : '' }}>
                                            {{ __('not_available') }}</option>
                                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                                            {{ __('available') }}</option>
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'status'])
                            </div>

                            <div class="col-lg-6">
                                <label for="companyName" class="form-label">Assets File</label>
                                <div id="addFolderId">
                                    <div class="uploadFileBoxS1">
                                        <div class="uploadFileBoxContent flex align gap-3">
                                            <div class="uploadInput">
                                                <img src="/new-theme/icons/upload.svg" alt="" />
                                                <input type="file" onchange="onUploadFilePreviewCard(this,'addFolderId');" />
                                            </div>
                                            <div class="title">{{__("Upload File")}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>

                <div class="flex align end gap-15 orders ">
                    <a class='buttonS1 rejected' href="{{ route('account-assets.index') }}">
                        {{ __('Cancel') }}
                    </a>
                    <button class='buttonS1 primary' type="submit">
                        {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>



    </div>
    </div>
@endsection
