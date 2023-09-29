<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner\Banner;
use App\Services\FileUploadService;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    public function __construct(private readonly FileUploadService $fileUploadService)
    {
    }

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

    public function store(BannerRequest $request): Response
    {
        $data = $request->validated();
        $images = $data['images'] ?? [];
        unset($data['images']);

        $banner = Banner::create($data);

        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = $this->fileUploadService->uploadFile($image, 'banners');
        }

        $banner->images()->createMany(array_map(function ($image) {
            return ['image' => $image];
        }, $uploadedImages));

        $banner->load('images');

        return response([
            'message' => 'Banner created.',
            'banner' => $banner
        ], 201);
    }
}
