<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{

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
}
