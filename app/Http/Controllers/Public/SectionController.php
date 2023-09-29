<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Section\Section;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SectionController extends Controller
{
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
}
