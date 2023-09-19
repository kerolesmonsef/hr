<div class="content">
    <div class="row">
        <div class="col-md-6">
            <label for="Name" class="form-label">{{__("Name")}}</label>
            <div class="inputS1">
                <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}" id="Name" placeholder={{__("Name")}}>
            </div>
            @include('new-theme.components.error1',['error' => 'name'])
        </div>

        <div class="col-md-6">
            <label for="E-mail" class="form-label">{{__("E-mail")}}</label>
            <div class="inputS1">
                <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" id="E-mail" placeholder={{__("E-mail")}}>
            </div>
            @include('new-theme.components.error1',['error' => 'email'])
        </div>

        <div class="col-md-6">
            <label for="Password" class="form-label">{{__("Password")}}</label>
            <div class="inputS1">
                <input type="password" name="password"  id="Password" placeholder={{__("Password")}}>
            </div>
            @include('new-theme.components.error1',['error' => 'password'])
        </div>

        <div class="col-md-6">
            <label for="Role" class="form-label">{{__("Role")}}</label>
            <div class="inputS1">
                <select name="role" id="Role">
                    <option value=""> {{__('Role')}} </option>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}" @if(isset($user) && $user->roles->pluck('id')->first() == $role->id) selected @endif>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            @include('new-theme.components.error1',['error' => 'role'])
        </div>
    </div>
</div>