@extends('new-theme.layout.layout1',['showSettingMenu'=>true])
@push('styles')
    <link rel="stylesheet" href="{{ asset('new-theme/styles/settings.css') }}"/>
@endpush

@section('content')
    <div class="salaryPage">
        <div class="pageS1">
            @component("new-theme.settings.salary.components.tabs")
                @slot("active","payroll")
                <div class="tab-pane show active" id="Payroll" role="tabpanel" aria-labelledby="Payroll-tab">
                    <form action="{{ route("payroll_setting.store") }}" method="post" class="formS1">
                        @csrf
                        <div class='sectionS2'>
                            <div class="head withBorder flex align between">
                                <h3 class='small'>@lang("Payslip Columns")</h3>
                            </div>

                            <div class="content">
                                <div class="row">
                                    @foreach($payroll_settings as $payroll_setting)
                                        <div class="col-lg-6">
                                            <label class="inputCheckbox" for="payroll_reports_view_{{ $payroll_setting->id }}">
                                                <input 
                                                    {{ $payroll_setting->payroll_dispaly ? "checked" : "" }}
                                                    type="checkbox" 
                                                    id="payroll_reports_view_{{ $payroll_setting->id }}" 
                                                    name="payroll_dispaly[{{ $payroll_setting->id }}]">
                                                <p>@lang($payroll_setting->name)</p>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="flex align end gap-15 mt-4">
                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal" aria-label="Close">
                                {{__('Cancel')}}
                            </button>
                            <button class="buttonS1 primary" type="submit">
                                {{__('Save')}}
                            </button>
                        </div>
                    </form>
                </div>
            @endcomponent
        </div>
    </div>

@endsection
