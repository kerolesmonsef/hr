@foreach ($performancefactors as $performancefactor)
<tr>
    <td>{{ $performancefactor->{'name' . $lang} }}</td>

    <td>{{ $performancefactor->performanceperiod->{'name' . $lang} }}</td>
    <td>
        <div class='action flex gap-3'>
            <div data-bs-toggle="modal"
                data-bs-target="#editperformancefactor-{{ $performancefactor->id }}">
                <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
            </div>
            <div data-bs-toggle="modal" data-bs-target="#delete-{{ $performancefactor->id }}">
                <img src="{{ asset('new-theme/icons/all/delete.svg') }}"
                    alt="" />
            </div>
        </div>
    </td>
</tr>
@include('new-theme.settings.performance-s.components.edit')
@include('new-theme.settings.performance-s.components.delete')

@endforeach