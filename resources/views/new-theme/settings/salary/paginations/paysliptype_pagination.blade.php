@foreach ($paysliptypes as $paysliptype)
    <tr>
        <td>{{ $paysliptype->id }}</td>
        <td>{{ $paysliptype->{'name' . $lang} }}</td>
        <td>
            <div class='action flex gap-3'>

                @can('PayslipType-Edit')
                    <div data-bs-toggle="modal"
                        data-bs-target="#editPaySlip-{{ $paysliptype->id }}">
                        <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                    </div>
                @endcan

                @can('PayslipType-Delete')
                    <div data-bs-toggle="modal" data-bs-target="#delete-{{ $paysliptype->id }}">
                        <img src="{{ asset('new-theme/icons/all/delete.svg') }}"
                            alt="" />
                    </div>
                @endcan
            </div>
            @can('PayslipType-Edit')
                @include('new-theme.settings.salary.components.editPaysliptypeModel')
            @endcan

            @can('PayslipType-Delete')
                @include('new-theme.settings.salary.components.deletePaysliptypeModal')
            @endcan
        </td>
    </tr>
@endforeach