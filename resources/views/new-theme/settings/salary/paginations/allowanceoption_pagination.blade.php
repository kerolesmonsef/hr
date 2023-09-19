@foreach ($allowanceoptions as $allowanceoption)
    <tr>
        <td>{{ $allowanceoption->id }}</td>
        <td>{{ $allowanceoption->{'name' . $lang} }}</td>
        <td>
            <div class='action flex gap-3'>
                @can('AllowanceOption-Edit')
                    <div data-bs-toggle="modal"
                        data-bs-target="#editAllawance-{{ $allowanceoption->id }}">
                        <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                    </div>
                @endcan

                @can('AllowanceOption-Delete')
                    <div data-bs-toggle="modal"
                        data-bs-target="#delete-{{ $allowanceoption->id }}">
                        <img src="{{ asset('new-theme/icons/all/delete.svg') }}"
                            alt="" />
                    </div>
                @endcan
            </div>
            @can('AllowanceOption-Edit')
                @include('new-theme.settings.salary.components.editAllowanceoptionModel')
            @endcan

            @can('AllowanceOption-Delete')
                @include('new-theme.settings.salary.components.deleteAllowanceoptionModal')
            @endcan
        </td>
    </tr>
@endforeach