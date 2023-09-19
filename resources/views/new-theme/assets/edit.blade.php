@extends('new-theme.layout.layout3')

@section('content')
    <div class="addPayroll">
        <div class="pageS1">

            <a href="{{route('account-assets.index')}}">
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3> {{ __('Update') }} </h3>
                    </div>
                </div>
            </a>

            <form class="formS1 inputsS1" action="{{ route('account-assets.update',[$asset->id]) }}" method="post">
                @method('PUT')
                @csrf
                <div class='sectionS2'>
                    <div class='content p-4'>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="assetsName" class="form-label">{{ __('Assets Name') }}</label>
                                <div class="inputS1">
                                    <input type="text" value="{{ old('name',$asset->name) }}" name="name" id="assetsName"
                                        placeholder='{{ __('Enter', ['val' => __('Assets Name')]) }}' />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'name'])
                            </div>
                            <div class="col-lg-6">
                                <label for="type" class="form-label">{{ __('Type') }}</label>
                                <div class="inputS1">
                                    <select id="status" name="type">
                                        <option value="type1" {{ old('type',$asset->type) == 'type1' ? 'selected' : '' }}>type 1
                                        </option>
                                        <option value="type2" {{ old('type',$asset->type) == 'type2' ? 'selected' : '' }}>type 2
                                        </option>
                                        <option value="type3" {{ old('type',$asset->type) == 'type3' ? 'selected' : '' }}>type 3
                                        </option>
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'type'])
                            </div>
                            <div class="col-lg-6">
                                <label for="snCode" class="form-label">{{ __('S/N') }}</label>
                                <div class="inputS1">
                                    <input name="serial_number" value="{{ old('serial_number',$asset->serial_number) }}" type="text"
                                        id="snCode" placeholder='{{ __('Enter', ['val' => __('S/N')]) }}'>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'serial_number'])
                            </div>
                            <div class="col-lg-6">
                                <label for="amount" class="form-label">{{ __('Amount') }}</label>
                                <div class="inputS1 noHeight">
                                    <input type="number" value="{{ old('amount',$asset->amount) }}" name="amount" value=""
                                        id="amount" placeholder="{{ __('Enter', ['val' => __('Amount')]) }}"
                                        autocomplete="off" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'amount'])
                            </div>
                            <div class="col-lg-6">
                                <label for="employeeName" class="form-label">{{ __('Employee Name') }}</label>
                                <div class="inputS1">
                                    <select id="employee_id" name="employee_id">
                                        @foreach ($employees as $key => $employee)
                                            <option value="{{ $key }}"
                                                {{ old('employee_id',$asset->employee_id) == $key ? 'selected' : '' }}>{{ $employee }}
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
                                        <option value="available" {{ old('status',$asset->status) == 'available' ? 'selected' : '' }}>
                                            {{ __('available') }}</option>
                                    </select>
                                </div>
                                @include('new-theme.components.error1', ['error' => 'status'])
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
