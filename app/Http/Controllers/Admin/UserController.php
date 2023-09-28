<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function __construct(private readonly FileUploadService $fileUploadService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = User::with('image')->get();

        return response([
            'users' => $users
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): Response
    {
        $data = $request->validated();
        $image = $this->fileUploadService->uploadFile($data['image'], 'users');
        unset($data['image']);

        $user = User::create($data);
        $user->image()->create(['image' => $image]);
        $user->load('image');

        return response([
            'message' => 'User created.',
            'user' => $user
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        $user->load('image');

        return response([
            'message' => 'User created.',
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): Response
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $this->fileUploadService->deleteFile($user->image->image);

            $image = $this->fileUploadService->uploadFile($data['image'], 'users');
            $user->image()->update(['image' => $image]);
        }

        unset($data['image']);
        $user->update($data);
        $user->load('image');

        return response([
            'message' => 'User updated.',
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        $this->fileUploadService->deleteFile($user->image->image);
        $user->image->delete();
        $user->delete();

        return response([
            'message' => 'User deleted.'
        ], ResponseAlias::HTTP_OK); // ResponseAlias::HTTP_NO_CONTENT if the response is empty :)
    }

    /**
     * Update the specified resource in storage.
     */
    public function activate(User $user): Response
    {
        $user->update(['active' => true]);
        $user->load('image');

        return response([
            'message' => 'User activated.',
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function deactivate(User $user): Response
    {
        $user->update(['active' => false]);
        $user->load('image');

        return response([
            'message' => 'User deactivated.',
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }
}
