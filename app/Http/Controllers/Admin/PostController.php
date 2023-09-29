<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteImagesRequest;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post\Post;
use App\Services\FileUploadService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    public function index(): Response
    {
        $posts = Post::with('image')->get();

        return response([
            'posts' => $posts
        ], ResponseAlias::HTTP_OK);
    }

    public function show(Post $post): Response
    {
        $post->load(['images', 'section']);

        return response([
            'post' => $post
        ], ResponseAlias::HTTP_OK);
    }

    public function store(PostRequest $request): Response
    {
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
            'message' => 'Post created.',
            'post' => $post
        ], ResponseAlias::HTTP_CREATED);
    }

    public function update(PostRequest $request, Post $post): Response
    {
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
            'message' => 'Post updated.',
            'post' => $post
        ], ResponseAlias::HTTP_OK);
    }

    public function destroy(Post $post): Response
    {
        $post->images()->each(function ($image) {
            $image->delete();
        });

        $post->delete();

        return response([
            'message' => 'Post deleted.'
        ], ResponseAlias::HTTP_OK);
    }

    public function deleteImages(DeleteImagesRequest $request, Post $post): Response
    {
        $data = $request->validated();

        $post->images()->whereIn('id', $data['image_ids'])->delete();

        $post->load('images');

        return response([
            'message' => 'Images deleted.',
            'post' => $post
        ], ResponseAlias::HTTP_OK);
    }
}
