<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteImagesRequest;
use App\Http\Requests\Admin\SectionRequest;
use App\Models\Section\Section;
use App\Services\FileUploadService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SectionController extends Controller
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    public function index(): Response
    {
        $sections = Section::with(['image'])->get();

        return response([
            'sections' => $sections
        ], ResponseAlias::HTTP_OK);
    }

    public function show(Section $section): Response
    {
        $section->load(['images', 'posts']);

        return response([
            'section' => $section
        ], ResponseAlias::HTTP_OK);
    }

    public function store(SectionRequest $request): Response
    {
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
            'message' => 'Section created.',
            'section' => $section
        ], ResponseAlias::HTTP_CREATED);
    }

    public function update(SectionRequest $request, Section $section): Response
    {
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
            'message' => 'Section updated.',
            'section' => $section
        ], ResponseAlias::HTTP_OK);
    }

    public function destroy(Section $section): Response
    {
        $section->images()->each(function ($image) {
            $image->delete();
        });

        $section->posts()->delete();
        $section->delete();

        return response([
            'message' => 'Section deleted.'
        ], ResponseAlias::HTTP_OK);
    }

    public function types(): Response
    {
        $types = config('section.types');

        return response([
            'types' => $types
        ], ResponseAlias::HTTP_OK);
    }

    public function deleteImages(DeleteImagesRequest $request, Section $section): Response
    {
        $data = $request->validated();

        $section->images()->whereIn('id', $data['image_ids'])->delete();

        $section->load('images');

        return response([
            'message' => 'Images deleted.',
            'section' => $section
        ], ResponseAlias::HTTP_OK);
    }
}
