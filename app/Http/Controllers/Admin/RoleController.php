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
        $roles = Role::paginate(10);

        return response([
            'roles' => $roles
        ], ResponseAlias::HTTP_OK);
    }

    public function getRoles(): Response
    {
        $roles = Role::select('id', 'name')->get();

        return response([
            'roles' => $roles
        ], ResponseAlias::HTTP_OK);
    }

    public function getPermissions(): Response
    {
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
        $data = $request->validated();

        $role->update([
            'name' => $data['name'],
        ]);

        $role->syncPermissions($data['permission_ids']);

        return response([
            'role' => $role,
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): Response
    {
        $role->delete();

        return response(status: ResponseAlias::HTTP_NO_CONTENT);
    }
}
