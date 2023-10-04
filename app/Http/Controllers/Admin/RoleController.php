<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if (!auth()->user()->hasPermissionTo('role index')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $roles = Role::paginate(10);

        return response([
            'roles' => $roles
        ], ResponseAlias::HTTP_OK);
    }

    public function getRoles(): Response
    {
        if (!auth()->user()->hasPermissionTo('role get_roles')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $roles = Role::select('id', 'name')->get();

        return response([
            'roles' => $roles
        ], ResponseAlias::HTTP_OK);
    }

    public function getPermissions(): Response
    {
        if (!auth()->user()->hasPermissionTo('role get_permissions')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $permissions = Permission::select('id', 'name')->get();

        return response([
            'permissions' => $permissions
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): Response
    {
        if (!auth()->user()->hasPermissionTo('role store')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();

        $role = Role::firstOrCreate([
            'name' => $data['name'],
            'guard_name' => 'web'
        ]);

        $role->syncPermissions($data['permission_ids']);

        return response([
            'role' => $role
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): Response
    {
        if (!auth()->user()->hasPermissionTo('role show')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $role->load('permissions');

        return response([
            'role' => $role
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): Response
    {
        if (!auth()->user()->hasPermissionTo('role update')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();

        $role->update([
            'name' => $data['name'],
        ]);

        $role->givePermissionTo($data['permission_ids']);

        return response([
            'role' => $role,
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): Response
    {
        if (!auth()->user()->hasPermissionTo('role destroy')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $role->delete();

        return response(status: ResponseAlias::HTTP_NO_CONTENT);
    }
}
