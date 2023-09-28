<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = User::all();

        return response([
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): Response
    {
        $data = $request->validated();
        $data['image'] = $this->fileUploadService->uploadFile($data['image'], 'users/images');

        $user = User::create($data);
        return response([
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        return response([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): Response
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->uploadFile($user->image, 'users/images');
            $this->fileUploadService->deleteFile($user->image);
        }

        $user->update($data);

        return response([
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        $user->image->delete();
        $user->delete();

        return response([
            'message' => 'user deleted'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function activate(User $user): Response
    {
        $user->update(['active' => true]);

        return response([
            'message' => 'user activated successfully',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function deactivate(User $user): Response
    {
        $user->update(['active' => false]);

        return response([
            'message' => 'user deactivated successfully',
            'user' => $user
        ]);
    }
}
