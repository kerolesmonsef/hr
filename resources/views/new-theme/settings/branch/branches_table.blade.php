@foreach ($branches as $branch)
    <tr>
        <td>{{ $branch->{'name' . $lang} }}</td>
        <td>{{ $branch->manager ? $branch->manager->name : 'N/A' }}</td>
        <td>{{ $branch->employees_count }}</td>
        <td>
            <div class='action flex gap-3'>
                @can('Branch-Edit')
                    <div data-bs-toggle="modal"
                        data-bs-target="#editBranch-{{ $branch->id }}">
                        <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                    </div>
                @endcan

                @can('Branch-Delete')
                    <div data-bs-toggle="modal" data-bs-target="#delete-{{ $branch->id }}">
                        <img src="{{ asset('new-theme/icons/all/delete.svg') }}"
                            alt="" />
                    </div>
                @endcan
            </div>

            @can('Branch-Edit')
                @include('new-theme.settings.branch.components.editBranchModel')
            @endcan

            @can('Branch-Delete')
                @include('new-theme.settings.branch.components.deleteBranchModal')
            @endcan
        </td>
    </tr>
@endforeach