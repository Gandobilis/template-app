<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Diff\Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

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
        ], 200);
    }

    public function getRoles(): Response
    {
        $roles = Role::select('id', 'name')->get();

        return response([
            'roles' => $roles
        ], 200);
    }

    public function getPermissions(): Response
    {
        $permissions = Permission::select('id', 'name')->get();

        return response([
            'roles' => $permissions
        ], 200);
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
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role): Response
    {
        $role->load('permissions');

        return response([
            'role' => $role
        ], 200);
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
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response([
        ], 204);
    }
}
