@foreach ($performancePeriods as $performanceperiod)
    <tr>
        <td>{{ $performanceperiod->{'name' . $lang} }}</td>

        <td>{{ $performanceperiod->months_no }}</td>
        <td>
            <div class='action flex gap-3'>
                <div data-bs-toggle="modal" data-bs-target="#editperformanceperiod-{{ $performanceperiod->id }}">
                    <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                </div>
                <div data-bs-toggle="modal" data-bs-target="#delete-{{ $performanceperiod->id }}">
                    <img src="{{ asset('new-theme/icons/all/delete.svg') }}" alt="" />
                </div>
            </div>
        </td>
    </tr>
    @include('new-theme.settings.performance-s.components.editperiod')
    @include('new-theme.settings.performance-s.components.deleteperiod')
@endforeach
