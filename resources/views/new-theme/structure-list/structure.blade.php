@extends('new-theme.layout.layout1')

@push('styles')
    <style>

    </style>
@endpush

@section('content')
    <div class="indexPage">
        <div class="pageS1">
            <div class="sectionS2">
                <div class="head flex align between">
                    <h3 class="small">{{ __('Structure list') }}</h3>
                    @can('companyStructures-Assign')
                        <button class="buttonS1 primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#assignNewEmployee">{{ __('Assign') }}
                        </button>
                    @endcan

                </div>
                <div class="content">
                    <div style="width:100%; height:700px; direction: ltr;" id="tree"></div>
                </div>

                <!-- Add New structure Modal -->
                <div class="modal fade customeModal" id="assignNewEmployee" tabindex="-1"
                    aria-labelledby="addNewEmployeeLabel" aria-hidden="true">


                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">

                                {{ Form::open(['url' => 'assign_employee', 'class' => 'formS1', 'method' => 'post']) }}
                                <div class="sectionS2">
                                    <div class="head withBorder flex align between">
                                        <h3 class="small">{{ __('Assign') }}</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="content">

                                        <div class="col-12">
                                            <label for="paymentType" class="form-label">{{ __('Structure list') }}</label>
                                            <div class="sectionInput">
                                                <div class="inputS1">
                                                    <select name="structure_id" required>
                                                        <option value="">{{ __('Main') }}</option>
                                                        @foreach ($lists as $structure)
                                                            <option value="{{ $structure->id }}">
                                                                {{ $structure['name' . $lang] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @include('new-theme.components.error1', [
                                                    'error' => 'structure_id',
                                                ])
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <label for="paymentType" class="form-label">{{ __('Employees') }}</label>
                                            <div class="sectionInput">
                                                <div class="inputS1">
                                                    <select name="employees[]" class="select2" multiple required
                                                        style="width: 100%;">
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}">
                                                                {{ $employee['name' . $lang] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @include('new-theme.components.error1', [
                                                    'error' => 'employee_id',
                                                ])
                                            </div>
                                        </div>

                                        <div class="flex align end gap-15 mt-5 mb-4">
                                            <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                {{ __('Cancel') }}
                                            </button>
                                            <button class="buttonS1 primary" type="submit">
                                                {{ __('Save') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://balkan.app/js/OrgChart.js"></script>

    <script>
        let chart = new OrgChart(document.getElementById("tree"), {
            template: "olivia",
            mouseScrool: OrgChart.action.none,
            enableSearch: false,
            nodeBinding: {
                field_0: "name",
                field_1: "title",
                img_0: "img"
            },
        });

        chart.load(@json($CompanyStructures));
    </script>
@endpush
