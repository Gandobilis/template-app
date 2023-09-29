<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner\Banner;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    public function index(): Response
    {
        $banners = Banner::with('image')->get();

        return response([
            'banners' => $banners
        ], 200);
    }

    public function show(Banner $banner): Response
    {
        $banner->load('images');

        return response([
            'banner' => $banner
        ], 200);
    }
}
