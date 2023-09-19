<div class="modal fade customeModal" id="editBranch-{{ $branch->id }}" tabindex="-1" aria-labelledby="addNewBranchLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="formS1" method="post" action="{{ route('branch.update', $branch) }}">
                    @csrf
                    @method('put')
                    <div class="sectionS2">
                        <div class="head withBorder flex align between">
                            <h3 class='small'>@lang('Add New Branch')</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="content">
                            <div class="">
                                <label for="branchName-En" class="form-label">@lang('Branch Name English')</label>
                                <div class="inputS1">
                                    <input value="{{ $branch->name }}" name="name" id="branchName-En"
                                        placeholder='@lang('Enter Branch Name English')'>
                                </div>
                            </div>
                            <div class="">
                                <label for="branchName-Ar" class="form-label">@lang('Branch Name Arabic')</label>
                                <div class="inputS1">
                                    <input value="{{ $branch->name_ar }}" name="name_ar" id="branchName-Ar"
                                        placeholder='@lang('Enter Branch Name Arabic')'>
                                </div>
                            </div>

                            <div class="">
                                <label for="branchName-Ar" class="form-label">@lang('Branch Manager')</label>
                                <div class="inputS1">
                                    <select name="employee_id">
                                        @foreach ($employees as $employee)
                                            <option {{ $employee->id == $branch->employee_id ? 'selected' : '' }}
                                                value="{{ $employee->id }}">{{ $employee->name }}</option>
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
