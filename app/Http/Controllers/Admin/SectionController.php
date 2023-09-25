<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionRequest;
use App\Models\Section\Section;
use Illuminate\Http\Response;
use App\Services\FileUploadService;

class SectionController extends Controller
{
    public function __construct(public FileUploadService $fileUploadService)
    {
    }

    public function index(): Response
    {
        $sections = Section::with(['image', 'posts'])->get();

        return response([
            'sections' => $sections
        ], 200);
    }

    public function show(Section $section): Response
    {
        $section->load(['images', 'posts']);

        return response([
            'section' => $section
        ], 200);
    }

    public function store(SectionRequest $request): Response
    {
        $data = $request->validated();
        $images = $data['images'] ?? [];
        unset($data['images']);

        $section = Section::create($data);

        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = $this->fileUploadService->uploadFile($image, 'sections');
        }

        $section->images()->createMany(array_map(function ($image) {
            return ['image' => $image];
        }, $uploadedImages));

        $section->load(['images', 'posts']);

        return response([
            'message' => 'Section created.',
            'section' => $section
        ], 201);
    }

    public function update(SectionRequest $request, Section $section): Response
    {
        $data = $request->validated();
        $images = $data['images'] ?? [];
        unset($data['images']);

        $section->update($data);

        $uploadedImages = [];

        foreach ($images as $image) {
            $uploadedImages[] = $this->fileUploadService->uploadFile($image, 'sections');
        }

        $images = $section->images;

        foreach ($images as $image) {
            $this->fileUploadService->deleteFile($image['image']);
        }

        $section->images()->delete();

        $section->images()->createMany(array_map(function ($image) {
            return ['image' => $image];
        }, $uploadedImages));

        $section->load(['images', 'posts']);

        return response([
            'message' => 'Section updated.',
            'section' => $section
        ], 200);
    }

    public function destroy(Section $section): Response
    {
        $images = $section->images;

        foreach ($images as $image) {
            $this->fileUploadService->deleteFile($image['image']);
        }

        $section->images()->delete();
        $section->delete();

        return response([
            'message' => 'Section deleted.'
        ], 200);
    }
}
