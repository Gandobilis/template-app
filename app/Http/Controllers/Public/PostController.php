<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post\Post;
use App\Services\FileUploadService;
use Illuminate\Http\Response;

class PostController extends Controller
{

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
}
