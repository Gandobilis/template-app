<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SectionController extends Controller
{
    public function index(Request $request): Response
    {
        $limit = $request->query('limit', 10);

        $sections = Section::with('image')->paginate($limit);

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
