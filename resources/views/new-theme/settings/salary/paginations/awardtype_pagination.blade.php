@foreach($awardtypes as $awardtype)
    <tr>
        <td>{{ $awardtype->id }}</td>
        <td>{{ $awardtype->{"name".$lang} }}</td>
        <td>
            <div class='action flex gap-3'>
                @can('AwardType-Edit')
                    <div data-bs-toggle="modal" data-bs-target="#editAwardType-{{$awardtype->id}}">
                        <img src="{{ asset("new-theme/icons/all/edit.svg") }}" alt="" />
                    </div>
                @endcan

                @can('AwardType-Delete')
                    <div data-bs-toggle="modal" data-bs-target="#delete-{{ $awardtype->id }}">
                        <img src="{{ asset("new-theme/icons/all/delete.svg") }}" alt="" />
                    </div>
                @endcan
            </div>

            @can('AwardType-Edit')
            @include("new-theme.settings.salary.components.editAwardtypeModel")
            @endcan

            @can('AwardType-Delete')
            @include("new-theme.settings.salary.components.deleteAwardtypeModal")
            @endcan
        </td>
    </tr>
@endforeach