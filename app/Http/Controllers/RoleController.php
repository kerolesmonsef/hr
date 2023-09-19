<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {

        $roles = Role::query()
            ->when($request->filled('search'), function ($q) {
                $q->where('name', 'like', "%" . request('search') . "%");
            })->paginate();


        if ($request->ajax()) {
            $search   = view('new-theme.settings.roles.roles', compact("roles"));
            $paginate = view('new-theme.settings.roles.paginate', compact("roles"));
            return response()->json(['search' => $search->render(), 'paginate' => $paginate->render()]);
        }
        return view('new-theme.settings.roles.index')->with('roles', $roles);
        // return view('role.index')->with('roles', $roles);

    }

    public function create()
    {

        $permissions_categories = Permission::query()->get()->groupBy('category');
        return view('new-theme.settings.roles.create', ['permissions_categories' => $permissions_categories]);

        // return view('role.create',);
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'name'          => 'required|max:100|unique:roles,name,NULL,id,created_by,' . auth()->user()->creatorId(),
                'permissions'   => 'required|array',
                'permissions.*' => 'required|exists:permissions,id',
            ]
        );

        $name             = $request['name'];
        $role             = new Role();
        $role->name       = $name;
        $role->created_by = auth()->user()->creatorId();
        $permissions      = $request['permissions'];
        $role->save();

        foreach ($permissions as $permission) {
            $p    = Permission::where('id', '=', $permission)->firstOrFail();
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')->with('success', 'Role successfully created.');
    }


    public function edit(Role $role)
    {



        $user = auth()->user();
        if ($user->type == 'super admin' || $user->type == 'company') {
            $permissions = Permission::all()->pluck('name', 'id')->toArray();
        } else {
            $permissions = new Collection();
            foreach ($user->roles as $role1) {
                $permissions = $permissions->merge($role1->permissions);
            }
            $permissions = $permissions->pluck('name', 'id')->toArray();
        }
        $permissions_categories = Permission::query()->get()->groupBy('category');

        return view('new-theme.settings.roles.edit', ['permissions_categories' => $permissions_categories, 'role' => $role]);

        return view('role.edit', compact('role', 'permissions_categories'));
    }

    public function update(Request $request, Role $role)
    {

        $this->validate(
            $request,
            [
                'name' => 'required|max:100|unique:roles,name,' . $role['id'] . ',id,created_by,' . auth()->user()->creatorId(),
                'permissions'   => 'required|array',
                'permissions.*' => 'required|exists:permissions,id',
            ]
        );
        $input       = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')->with('success', 'Role successfully updated.');
    }

    public function destroy(Role $role)
    {

        $role->delete();

        return redirect()->route('roles.index')->with(
            'success',
            'Role successfully deleted.'
        );
    }
}
