<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post\Post;
use App\Services\FileUploadService;
use Illuminate\Http\Response;

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
        ], 200);
    }

    public function show(Post $post): Response
    {
        $post->load('images');

        return response([
            'post' => $post
        ], 200);
    }

    public function store(PostRequest $request): Response
    {
        $data = $request->validated();
        $images = $data['images'] ?? [];
        unset($data['images']);

        $post = Post::create($data);

        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = $this->fileUploadService->uploadFile($image, 'posts');
        }

        $post->images()->createMany(array_map(function ($image) {
            return ['image' => $image];
        }, $uploadedImages));

        $post->load('images');

        return response([
            'message' => 'Post created.',
            'post' => $post
        ], 201);
    }

    public function update(PostRequest $request, Post $post): Response
    {
        $data = $request->validated();
        $images = $data['images'] ?? [];
        unset($data['images']);

        $post->update($data);

        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = $this->fileUploadService->uploadFile($image, 'posts');
        }

        $images = $post->images;

        foreach ($images as $image) {
            $this->fileUploadService->deleteFile($image['image']);
        }

        $post->images()->delete();

        $post->images()->createMany(array_map(function ($image) {
            return ['image' => $image];
        }, $uploadedImages));

        $post->load('images');

        return response([
            'message' => 'Post updated.',
            'post' => $post
        ], 200);
    }

    public function destroy(Post $post): Response
    {
        $images = $post->images;

        foreach ($images as $image) {
            $this->fileUploadService->deleteFile($image['image']);
        }

        $post->images()->delete();
        $post->delete();

        return response([
            'message' => 'Post deleted.'
        ], 200);
    }
}
