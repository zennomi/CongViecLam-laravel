<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Actions\Role\CreateRole;
use App\Actions\Role\UpdateRole;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RoleFormRequest;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RolesController extends Controller
{
    use ValidatesRequests;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!userCan('role.view'), 403);

        $roles = Role::SimplePaginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!userCan('role.create'), 403);

        $permissions = Permission::all();
        $permission_groups = Admin::getPermissionGroup();
        return view('admin.roles.create', compact('permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        abort_if(!userCan('role.create'), 403);

        try {
            CreateRole::create($request);

            flashSuccess('Role Created Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        abort_if(!userCan('role.edit'), 403);

        $permissions = Permission::all();
        $permission_groups = Admin::getPermissionGroup();

        return view('admin.roles.edit', compact('permissions', 'permission_groups', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, Role $role)
    {
        abort_if(!userCan('role.edit'), 403);

        try {
            UpdateRole::update($request, $role);

            flashSuccess('Role Updated Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_if(!userCan('role.delete'), 403);

        try {
            if (!is_null($role)) {
                $role->delete();
            }

            flashSuccess('Role Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError($th->getMessage());
            return back();
        }
    }
}
