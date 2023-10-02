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
        if (!auth()->user()->hasRole('admin')) {
            return response([
                'message' => trans('user.error.index')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

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
        if (!auth()->user()->hasRole('admin')) {
            return response([
                'message' => trans('user.error.store')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        $image = $this->fileUploadService->uploadFile($data['image'], 'users');
        unset($data['image']);

        $user = User::create($data);
        $user->image()->create(['image' => $image]);
        $user->load('image');

        return response([
            'message' => trans('user.success.store'),
            'user' => $user
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Response
    {
        if (!auth()->user()->hasRole('admin')) {
            return response([
                'message' => trans('user.error.show')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $user->load('image');

        return response([
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): Response
    {
        if (!auth()->user()->hasRole('admin')) {
            return response([
                'message' => trans('user.error.update')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        if (isset($data['image'])) {
            $this->fileUploadService->deleteFile($user->image?->image);

            $image = $this->fileUploadService->uploadFile($data['image'], 'users');
            $user->image()->update(['image' => $image]);
        }

        unset($data['image']);
        $user->update($data);
        $user->load('image');

        return response([
            'message' => trans('user.success.update'),
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Response
    {
        if (!auth()->user()->hasRole('admin')) {
            return response([
                'message' => trans('user.error.destroy')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $this->fileUploadService->deleteFile($user->image?->image);
        $user->image?->delete();
        $user->delete();

        return response([
            'message' => trans('user.success.destroy'),
        ], ResponseAlias::HTTP_OK); // ResponseAlias::HTTP_NO_CONTENT if the response is empty :)
    }

    /**
     * Update the specified resource in storage.
     */
    public function activate(User $user): Response
    {
        if (!auth()->user()->hasRole('admin')) {
            return response([
                'message' => trans('user.error.activate')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $user->update(['active' => true]);
        $user->load('image');

        return response([
            'message' => trans('user.success.activate'),
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function deactivate(User $user): Response
    {
        if (!auth()->user()->hasRole('admin')) {
            return response([
                'message' => trans('user.error.deactivate')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $user->update(['active' => false]);
        $user->load('image');

        return response([
            'message' => trans('user.success.deactivate'),
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }
}
