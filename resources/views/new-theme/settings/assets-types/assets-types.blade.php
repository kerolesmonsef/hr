@foreach ($types as $type)
    <tr>
        <td>{{ $type->id }}</td>
        <td>{{ $type->name }}</td>
        <td>
            <div class='action flex gap-3'>
                @can('AssetTypes-Edit')
                    <div data-bs-toggle="modal" data-bs-target="#editInsurance-{{ $type->id }}">
                        <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                    </div>
                @endcan

                @can('AssetTypes-Delete')
                    <div data-bs-toggle="modal" data-bs-target="#delete-{{ $type->id }}">
                        <img src="{{ asset('new-theme/icons/all/delete.svg') }}" alt="" />
                    </div>
                @endcan

            </div>

            @can('AssetTypes-Edit')
                @include('new-theme.settings.assets-types.components.editModal')
            @endcan

            @can('AssetTypes-Delete')
                @include('new-theme.settings.assets-types.components.deleteModel')
            @endcan
        </td>
    </tr>
@endforeach