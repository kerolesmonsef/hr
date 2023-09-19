@foreach($deductionoptions as $deductionoption)
    <tr>
        <td>{{ $deductionoption->id }}</td>
        <td>{{ $deductionoption->{"name".$lang} }}</td>
        <td>
            <div class='action flex gap-3'>
                @can('DeductionOption-Edit')
                    <div data-bs-toggle="modal" data-bs-target="#editDeductionOption-{{$deductionoption->id}}">
                        <img src="{{ asset("new-theme/icons/all/edit.svg") }}" alt="" />
                    </div>
                @endcan

                @can('DeductionOption-Delete')
                    <div >
                        <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('deductionoption.destroy' , $deductionoption->id) }}" src="{{ asset("new-theme/icons/all/delete.svg") }}" alt="" />
                    </div>
                @endcan
            </div>
            @include("new-theme.settings.salary.components.editDeductionOptionModel")
        </td>
    </tr>
@endforeach