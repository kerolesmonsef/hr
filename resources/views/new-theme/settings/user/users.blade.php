@foreach($users as $user)
    <tr>
        <td>
            <div class="userTabl user">
                <img src="/new-theme/icons/all/user.svg" />
            </div>
        </td>

        <td>{{$user->name}}</td>
        <td>{{$user->type}} </td>
        <td>{{$user->last_login}}</td>
        <td>
            @if($user->status = 0)
                <div class="buttonS2 danger">{{__('Disabled')}}</div>
            @else
                <div class="buttonS2 success"> {{__('Enabled')}} </div>
            @endif
        </td>

        <td>
            <div class='action flex gap-3'>
                @can('Users-Edit')
                    <a href="{{Route('user.edit',$user->id)}}">
                        <img src="/new-theme/icons/all/edit.svg" alt="" />
                    </a>
                @endcan
                
                @can('Users-Delete')
                    <div data-bs-toggle="modal" data-bs-target="#confirm1" class="delete"
                        data-route="{{ route('user.destroy', $user->id) }}">
                        <img src="/new-theme/icons/all/delete.svg" alt="" />
                    </div>
                @endcan
            </div>
        </td>

    </tr>
@endforeach