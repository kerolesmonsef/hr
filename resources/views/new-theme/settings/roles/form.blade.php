<div class="formS1">
    <div class="sectionS2">
        <div class="head withBorder">
            <h2>{{ __('Role Data') }}</h2>
        </div>
        <div class="content">
            <div class="">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <div class="inputS1">
                    <input type="text" value="{{ old('name',$role->name ?? null) }}" name="name" id="name" placeholder='{{ __('Enter',['val'    => __('Role name') ]) }}'>
                </div>
                @include('new-theme.components.error1',['error' => 'name'])
            </div>
        </div>
    </div>
</div>

<div class="sectionS2">
    <div class="head withBorder flex between align">
        <h2>{{ __('Permissions') }}</h2>

        <div class="flex align">
            <button class="buttonS6" onclick='selectAll(event)'>{{ __('select all') }}</button>
            <div class="divider"></div>
            <button class="buttonS6" onclick='deSelectAll(event)'>{{ __('clear all') }}</button>
        </div>
    </div>


    <div class="content">
        <div class="row between">
            @foreach($permissions_categories as $category_name => $permission_category)
                <div class="col-lg-5">
                    <div class="permissionBox">
                        <div class="boxHead flex between align">
                            <h4>{{ $category_name }}</h4>
                            <div class="flex align">
                                <button class="buttonS6" onclick="select(event)">{{ __('select all') }}</button>
                                <div class="divider"></div>
                                <button class="buttonS6" onclick="deSelect(event)">{{ __('clear all') }}</button>
                            </div>

                        </div>
                        <div class="flex flex-wrap gap-10">

                           @foreach($permission_category as $permission)
                                <div class="inputCheckbox">
                                    <input type="checkbox" name="permissions[]" id="permissions{{$permission->id}}" value="{{ $permission->id }}"  {{ in_array($permission->id, old('permissions',( isset($role) ? $role->permissions->pluck('id')->toArray() : []) )) ? 'checked' : '' }}>
                                    <label for="permissions{{$permission->id}}">{{ explode('-',$permission->name)[1] }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            @endforeach
        </div>  
    </div>
</div>

<div class='buttons flex end gap-3'>
    <button type="button" class='buttonS1 rejected'>{{ __('Cancel') }}</button>
    <button class='buttonS1 primary' type="submit">{{ __('Save') }}</button>
</div>