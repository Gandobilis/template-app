<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner\Banner;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BannerController extends Controller
{
    public function index(): Response
    {
        $banners = Banner::with('image')->get();

        return response([
            'banners' => $banners
        ], ResponseAlias::HTTP_OK);
    }

    public function show(Banner $banner): Response
    {
        $banner->load('images');

        return response([
            'banner' => $banner
        ], ResponseAlias::HTTP_OK);
    }
}
