<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner\Banner;
use App\Services\FileUploadService;
use Illuminate\Http\Response;

class BannerController extends Controller
{
    public function __construct(public FileUploadService $fileUploadService)
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

    public function update(BannerRequest $request, Banner $banner): Response
    {
        $data = $request->validated();
        $images = $data['images'] ?? [];
        unset($data['images']);

        $banner->update($data);

        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = $this->fileUploadService->uploadFile($image, 'banners');
        }

        $images = $banner->images;

        foreach ($images as $image) {
            $this->fileUploadService->deleteFile($image['image']);
        }

        $banner->images()->delete();

        $banner->images()->createMany(array_map(function ($image) {
            return ['image' => $image];
        }, $uploadedImages));

        $banner->load('images');

        return response([
            'message' => 'Banner updated.',
            'banner' => $banner
        ], 200);
    }

    public function destroy(Banner $banner): Response
    {
        foreach ($banner->images as $image) {
            $image->delete();
        }

        $banner->delete();
        return response([
            'message' => 'Banner deleted.'
        ], 200);
    }
}
