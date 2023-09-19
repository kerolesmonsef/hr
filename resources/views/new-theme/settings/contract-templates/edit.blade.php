@extends('new-theme.layout.layout2')

@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}" />
@endpush


@section('content')
    <div class="addContractPage">
        <div class="pageS1">

            <a href="{{ route('contract-templates.index') }}">
                <div class='heading mb-4'>
                    <div class='flex align gap-15'>
                        <img src='/new-theme/icons/arrowLeft.svg' alt='' />
                        <h3>{{ __('All Contract Templates') }}</h3>
                    </div>
                </div>
            </a>

            <form action="{{ route('contract-templates.update' , $contract_template) }}" class="formS1 inputsS1"  method="post">
                @csrf
                @method('put')
                <div class='sectionS2'>
                    <div class='content p-4'>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="Template  Name" class="form-label">{{ __('Template Name') }}</label>
                                <div class="inputS1">
                                    <input type="text" name="name" id="" placeholder='' value="{{ old('name' , $contract_template -> name) }}">
                                </div>
                                @include('new-theme.components.error1', ['error' => 'name'])
                            </div>
                            <div class="col-lg-6">
                                <label for="date" class="form-label">{{ __('Date') }}</label>
                                <div class="inputS1">
                                    <img src="/new-theme/icons/date.svg" class="iconImg" />
                                    <input type="text"  name="date" value="{{ old('date' , Carbon\Carbon::createFromFormat('Y-m-d' , $contract_template-> date)->format('d/m/Y'))  }}" id="date" placeholder="Enter Date"
                                        name="datepicker" class="datePickerBasic" />
                                </div>
                                @include('new-theme.components.error1', ['error' => 'date'])
                            </div>
                        </div>
                    </div>

                </div>

                <div class='sectionS2'>
                    <div class="head withBorder flex align between mb-4">
                        <h3 class="small">{{ __('Contract Template') }}</h3>
                        <div class="flex align gap-2">
                            <a href="{{ route("contract-templates.print",$contract_template) }}" target="_blank" id="print" class='buttonS2  withBorder' type="button">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5.4375 5.25H12.5625V3.75C12.5625 2.25 12 1.5 10.3125 1.5H7.6875C6 1.5 5.4375 2.25 5.4375 3.75V5.25Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M12 11.25V14.25C12 15.75 11.25 16.5 9.75 16.5H8.25C6.75 16.5 6 15.75 6 14.25V11.25H12Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M15.75 7.5V11.25C15.75 12.75 15 13.5 13.5 13.5H12V11.25H6V13.5H4.5C3 13.5 2.25 12.75 2.25 11.25V7.5C2.25 6 3 5.25 4.5 5.25H13.5C15 5.25 15.75 6 15.75 7.5Z"
                                        stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12.75 11.25H11.8425H5.25" stroke="#292D32" stroke-width="1.2"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M5.25 8.25H7.5" stroke="#292D32" stroke-width="1.2" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Print
                            </a>

                        </div>
                    </div>
                    <div class='content'>
                        <div class="avaliableTags">
                            <h4>{{ __('Available Tags:') }}</h4>
                            <p>{employee_Name} , {Nationality} , {Salary} , {Qualifications} , {Id_Number} , {job_title} ,
                                {Join_Date} , {Branch} , {Department} </p>
                        </div>
                        <textarea name="template" id="editor">{{ old('template' , $contract_template -> template) }}</textarea>
                         @include('new-theme.components.error1', ['error' => 'template'])
                    </div>
                </div>

                <div class="flex align end gap-15">
                    <a href="{{ route('contract-templates.index') }}">
                        <button class='buttonS1 rejected' type="button">
                            {{  __('Cancel') }}
                        </button>
                    </a>
                    <button class='buttonS1 primary' type="submit">
                            {{ __('Save') }}
                    </button>
                </div>

            </form>
        </div>



    </div>
@endsection

@push('script')
    <!-- editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
