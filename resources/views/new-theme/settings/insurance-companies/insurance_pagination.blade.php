@foreach ($companies as $company)
    <tr>
        <td>{{ $company->id }}</td>
        <td>{{ $company->name }}</td>
        <td>
            <div class='action flex gap-3'>
                @can('InsuranceCompanies-Edit')
                    <div data-bs-toggle="modal" data-bs-target="#editInsurance-{{ $company->id }}">
                        <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                    </div>
                @endcan

                @can('InsuranceCompanies-Delete')
                    <div data-bs-toggle="modal" data-bs-target="#delete-{{ $company->id }}">
                        <img src="{{ asset('new-theme/icons/all/delete.svg') }}" alt="" />
                    </div>
                @endcan

            </div>
            @can('InsuranceCompanies-Edit')
            @include('new-theme.settings.insurance-companies.components.editModal')
            @endcan

            @can('InsuranceCompanies-Delete')
            @include('new-theme.settings.insurance-companies.components.deleteModel')
            @endcan
        </td>
    </tr>
@endforeach