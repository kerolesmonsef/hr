<div class="modal fade customeModal" id="editDepartment-{{ $department->id }}" tabindex="-1"
    aria-labelledby="addNewDepartmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route('department.update', $department) }}">
                    @csrf
                    @method('put')
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang('Add New Department')</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div class="">
                                <label for="departmentName-En" class="form-label">@lang('Department Name English')</label>
                                <div class="inputS1">
                                    <input value="{{ $department->name }}" name="name" id="departmentName-En"
                                        placeholder='@lang('Enter Department Name English')'>
                                </div>
                            </div>
                            <div class="">
                                <label for="departmentName-Ar" class="form-label">@lang('Department Name Arabic')</label>
                                <div class="inputS1">
                                    <input value="{{ $department->name_ar }}" name="name_ar" id="departmentName-Ar"
                                        placeholder='@lang('Enter Department Name Arabic')'>
                                </div>
                            </div>

                            <div class="">
                                <label for="departmentName-Ar" class="form-label">@lang('Department Manager')</label>
                                <div class="inputS1">
                                    <select name="employee_id">
                                        @foreach ($employees as $employee)
                                            <option {{ $employee->id == $department->employee_id ? 'selected' : '' }}
                                                value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="">
                                <label for="branch-edit-d" class="form-label">@lang('Branch')</label>
                                <div class="inputS1">
                                    <select name="branch_id" id="branch-edit-d">
                                        @foreach ($branches as $branch)
                                            <option {{ $branch->id == $department->branch_id ? 'selected' : '' }}
                                                value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="flex align end gap-15 orders  mt-5 mb-4">
                                <button class="buttonS1 rejected" type="button" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    @lang('Cancel')
                                </button>
                                <button class="buttonS1 primary" type="submit">
                                    @lang('Save')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
