<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Requests\Admin\DeleteImagesRequest;
use App\Models\Banner\Banner;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BannerController extends Controller
{
    public function __construct(private readonly FileUploadService $fileUploadService)
    {
    }

    public function index(Request $request): Response
    {
        if (!auth()->user()->hasPermissionTo('banner index')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $limit = $request->query('limit', 10);

        $banners = Banner::with('image')->paginate($limit);

        return response([
            'banners' => $banners
        ], ResponseAlias::HTTP_OK);
    }

    public function show(Banner $banner): Response
    {
        if (!auth()->user()->hasPermissionTo('banner show')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $banner->load('images');

        return response([
            'banner' => $banner
        ], ResponseAlias::HTTP_OK);
    }

    public function store(BannerRequest $request): Response
    {
        if (!auth()->user()->hasPermissionTo('banner store')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);

        $banner = Banner::create($data);

        foreach ($images as $image) {
            $image = $this->fileUploadService->uploadFile($image, 'banners');
            $banner->images()->create(['image' => $image]);
        }

        $banner->load('images');

        return response([
            'message' => __('banner.success.store'),
            'banner' => $banner
        ], ResponseAlias::HTTP_CREATED);
    }

    public function update(BannerRequest $request, Banner $banner): Response
    {
        if (!auth()->user()->hasPermissionTo('banner update')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);

        $banner->update($data);

        foreach ($images as $image) {
            $image = $this->fileUploadService->uploadFile($image, 'banners');
            $banner->images()->create(['image' => $image]);
        }

        $banner->load('images');

        return response([
            'message' => __('banner.success.update'),
            'banner' => $banner
        ], ResponseAlias::HTTP_OK);
    }

    public function destroy(Banner $banner): Response
    {
        if (!auth()->user()->hasPermissionTo('banner destroy')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $banner->images()->each(function ($image) {
            $image->delete();
        });

        $banner->delete();

        return response([
            'message' => __('banner.success.destroy')
        ], ResponseAlias::HTTP_OK);
    }

    public function types(): Response
    {
        if (!auth()->user()->hasPermissionTo('banner types')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $types = config('banner.types');

        return response([
            'types' => $types
        ], ResponseAlias::HTTP_OK);
    }

    public function deleteImages(DeleteImagesRequest $request, Banner $banner): Response
    {
        if (!auth()->user()->hasPermissionTo('banner delete_images')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();

        $banner->images()->whereIn('id', $data['image_ids'])->delete();

        $banner->load('images');

        return response([
            'message' => __('banner.success.delete_images'),
            'banner' => $banner
        ], ResponseAlias::HTTP_OK);
    }
}
