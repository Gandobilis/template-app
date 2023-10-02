<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteImagesRequest;
use App\Http\Requests\Admin\SectionRequest;
use App\Models\Section\Section;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SectionController extends Controller
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    public function index(Request $request): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'content manager'])) {
            return response([
                'message' => trans('section.error.index')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $limit = $request->query('limit', 10);

        $sections = Section::with('image')->paginate($limit);

        return response([
            'sections' => $sections
        ], ResponseAlias::HTTP_OK);
    }

    public function show(Section $section): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'content manager'])) {
            return response([
                'message' => trans('section.error.show')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $section->load(['images', 'posts']);

        return response([
            'section' => $section
        ], ResponseAlias::HTTP_OK);
    }

    public function store(SectionRequest $request): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'content manager'])) {
            return response([
                'message' => trans('section.error.store')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);

        $section = Section::create($data);

        foreach ($images as $image) {
            $image = $this->fileUploadService->uploadFile($image, 'sections');
            $section->images()->create(['image' => $image]);
        }

        $section->load('images');

        return response([
            'message' => trans('section.success.store'),
            'section' => $section
        ], ResponseAlias::HTTP_CREATED);
    }

    public function update(SectionRequest $request, Section $section): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'content manager'])) {
            return response([
                'message' => trans('section.error.update')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();
        $images = $data['images'];
        unset($data['images']);

        $section->update($data);

        foreach ($images as $image) {
            $image = $this->fileUploadService->uploadFile($image, 'sections');
            $section->images()->create(['image' => $image]);
        }

        $section->load('images');

        return response([
            'message' => trans('section.success.update'),
            'section' => $section
        ], ResponseAlias::HTTP_OK);
    }

    public function destroy(Section $section): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'content manager'])) {
            return response([
                'message' => trans('section.error.destroy')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $section->images()->each(function ($image) {
            $image->delete();
        });

        $section->posts()->delete();
        $section->delete();

        return response([
            'message' => trans('section.success.destroy')
        ], ResponseAlias::HTTP_OK);
    }

    public function types(): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'content manager'])) {
            return response([
                'message' => trans('section.error.types')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $types = config('section.types');

        return response([
            'types' => $types
        ], ResponseAlias::HTTP_OK);
    }

    public function deleteImages(DeleteImagesRequest $request, Section $section): Response
    {
        if (!auth()->user()->hasAnyRole(['admin', 'content manager'])) {
            return response([
                'message' => trans('section.error.delete_images')
            ], ResponseAlias::HTTP_FORBIDDEN);
        }

        $data = $request->validated();

        $section->images()->whereIn('id', $data['image_ids'])->delete();

        $section->load('images');

        return response([
            'message' => trans('section.success.images_delete'),
            'section' => $section
        ], ResponseAlias::HTTP_OK);
    }
}
