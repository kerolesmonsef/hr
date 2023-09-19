 @foreach ($templates as $template)
 <tr>
    <td>
        #{{ $template -> id }}
    </td>
    <td>{{ $template -> name }}</td>
    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d' , $template -> date ) -> format('Y/m/d')  }}</td>
    <td>
        <div class='action flex gap-3'>

            @can('ContractTemplates-Edit')
                <div>
                    <a href="{{ route('contract-templates.edit' , $template) }}"><img src="/new-theme/icons/all/edit.svg" alt="" /></a>
                </div>
            @endcan

            @can('ContractTemplates-Delete')
                <div data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('contract-templates.destroy' , $template) }}">
                    <img src="/new-theme/icons/all/delete.svg" alt="" />
                </div>
            @endcan
        </div>
    </td>
</tr>
 @endforeach
