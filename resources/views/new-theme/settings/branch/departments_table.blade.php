@foreach ($departments as $department)
    <tr>
        <td>{{ $department->{'name' . $lang} }}</td>
        <td>{{ $department->branch ? $department->branch->name : 'N/A' }}</td>
        <td>{{ $department->manager ? $department->manager->name : 'N/A' }}</td>
        <td>{{ $department->employeess_count }}</td>
        <td>
            <div class='action flex gap-3'>
                @can('Department-Edit')
                    <div data-bs-toggle="modal"
                        data-bs-target="#editDepartment-{{ $department->id }}">
                        <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                    </div>
                @endcan

                @can('Department-Delete')
                    <div data-bs-toggle="modal" data-bs-target="#delete-{{ $department->id }}">
                        <img src="{{ asset('new-theme/icons/all/delete.svg') }}"
                            alt="" />
                    </div>
                @endcan
            </div>

            @can('Department-Edit')
                @include('new-theme.settings.branch.components.editDepartmentModel')
            @endcan

            @can('Department-Delete')
                @include('new-theme.settings.branch.components.deleteDepartmentModal')
            @endcan
        </td>
    </tr>
@endforeach