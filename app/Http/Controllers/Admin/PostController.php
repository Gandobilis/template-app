<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteImagesRequest;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post\Post;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    public function index(Request $request): Response
    {
        if (!auth()->user()->hasPermissionTo('post index')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $limit = $request->query('limit', 10);

        $posts = Post::with('image')->paginate($limit);

        return response([
            'posts' => $posts
        ], ResponseAlias::HTTP_OK);
    }

    public function show(Post $post): Response
    {
        if (!auth()->user()->hasPermissionTo('post show')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $post->load(['images', 'section']);

        return response([
            'post' => $post
        ], ResponseAlias::HTTP_OK);
    }

    public function store(PostRequest $request): Response
    {
        if (!auth()->user()->hasPermissionTo('post store')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);

        $post = Post::create($data);

        foreach ($images as $image) {
            $image = $this->fileUploadService->uploadFile($image, 'posts');
            $post->images()->create(['image' => $image]);
        }

        $post->load('images');

        return response([
            'message' => __('post.success.store'),
            'post' => $post
        ], ResponseAlias::HTTP_CREATED);
    }

    public function update(PostRequest $request, Post $post): Response
    {
        if (!auth()->user()->hasPermissionTo('post update')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);

        $post->update($data);

        foreach ($images as $image) {
            $image = $this->fileUploadService->uploadFile($image, 'posts');
            $post->images()->create(['image' => $image]);
        }

        $post->load('images');

        return response([
            'message' => __('post.success.update'),
            'post' => $post
        ], ResponseAlias::HTTP_OK);
    }

    public function destroy(Post $post): Response
    {
        if (!auth()->user()->hasPermissionTo('post destroy')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $post->images()->each(function ($image) {
            $image->delete();
        });

        $post->delete();

        return response([
            'message' => __('post.success.destroy'),
        ], ResponseAlias::HTTP_OK);
    }

    public function deleteImages(DeleteImagesRequest $request, Post $post): Response
    {
        if (!auth()->user()->hasPermissionTo('post delete_images')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();

        $post->images()->whereIn('id', $data['image_ids'])->delete();

        $post->load('images');

        return response([
            'message' => __('post.success.images_delete'),
            'post' => $post
        ], ResponseAlias::HTTP_OK);
    }
}
