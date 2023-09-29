<?php

namespace App\Http\Controllers\Public;

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
        $sections = Section::with(['image'])->get();

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
}
