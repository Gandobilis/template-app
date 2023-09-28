<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request): Response
    {
        $data = $request->validated();

        $message = Message::create($data);

        return response([
            'message' => 'Message created.',
            'data' => $message
        ], ResponseAlias::HTTP_CREATED);
    }
}
