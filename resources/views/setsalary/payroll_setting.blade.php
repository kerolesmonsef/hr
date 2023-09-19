@extends('layouts.admin')
@section('page-title')
    {{ __('payroll_setting') }}
@endsection
@section('content')

    <div id="kt_app_content" class="app-content mt-4 p-4 flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    {{ Form::model($payroll_settings, ['route' => ['payroll_setting.store'], 'method' => 'POST']) }}
                    <div class="col-lg-12">
                        @if (!empty($payroll_settings))
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>{{ __('payroll_setting') }}</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('title') }} </th>
                                                    <th>{{ __('Action') }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payroll_settings as $key => $payroll_setting)
                                                    <tr>
                                                        <td>{{ __($payroll_setting->name) }}</td>
                                                        <td>
                                                            <div class="row ">
                                                                <div
                                                                    class="col-md-3 custom-control custom-checkbox">
                                                                    {{ Form::checkbox("payroll_dispaly[$payroll_setting->id]", null, false, ['class' => 'custom-control-input',$payroll_setting->payroll_dispaly == 1 ? 'checked' : '']) }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @can('Create Set Salary')
                        <div class="row">
                            <div class="col-12 text-right mt-1">
                                <input type="submit" value="{{ __('Save Change') }}" class="btn btn-primary">
                            </div>
                        </div>
                    @endcan

                    {{ Form::close() }}
                </div>
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Content container-->
    </div>

@endsection
