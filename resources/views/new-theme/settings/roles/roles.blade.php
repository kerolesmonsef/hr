@foreach ($roles as $role)
<tr>
    <td>
        <div class="userTabl user">
            <img src="/new-theme/icons/all/user.svg" />
        </div>
    </td>
    <td>{{ $role->name }}</td>
    <td>{{ $role->created_at->format('d/m/Y') }}</td>
    <td>{{ $role->updated_at->format('d/m/Y') }}</td>
    <td>
        <div class='action flex gap-3'>
            <div>
                <a href="{{ route('roles.edit',$role->id) }}">
                    <img src="{{ asset('new-theme/icons/all/edit.svg') }}" alt="" />
                </a>
            </div>

            <div >

                <img data-bs-toggle="modal" data-bs-target="#confirm1" class="delete" data-route="{{ route('roles.destroy' , $role->id) }}" src="/new-theme/icons/all/delete.svg" />
            </div>
        </div>
    </td>
</tr>
@endforeach