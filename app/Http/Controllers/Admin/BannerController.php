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
        $banners = Banner::with(['images' => function ($query) {
            $query->limit(1);
        }])->get();

        return response([
            'banners' => $banners
        ], 200);
    }

    public function show(Banner $banner): Response
    {
        $banner = Banner::with('images');

        return response([
            'banner' => $banner
        ], 200);
    }

    public function store(BannerRequest $request): Response
    {
        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);
        $banner = Banner::create($data);

        foreach ($images as $image) {
            $_image = $this->fileUploadService->uploadFile($image, 'banners');
            $banner->images()->create([
                'image' => $_image
            ]);
        }
        return response([
            'message' => 'Banner created.',
            'banner' => $banner
        ], 201);
    }

    public function update(BannerRequest $request, Banner $banner): Response
    {
        $data = $request->validated();
        $banner->update($data);
        return response([
            'message' => 'Banner updated.',
            'banner' => $banner
        ], 200);
    }

    public function destroy(Banner $banner): Response
    {
        $images = $banner->images;
        foreach ($images as $image) {
            $this->fileUploadService->deleteFile($image);
        }
        $banner->delete();
        return response([
            'message' => 'Banner deleted.'
        ], 200);
    }
}
