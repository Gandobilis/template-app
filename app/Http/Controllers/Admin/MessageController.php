<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index(): Response
    {
        $messages = Message::all();

        return response([
            'data' => $messages
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Store a newly created message in the database.
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

    /**
     * Display the specified message.
     */
    public function show(Message $message): Response
    {
        return response([
            'data' => $message
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified message in the database.
     */
    public function update(MessageRequest $request, Message $message): Response
    {
        $data = $request->validated();

        $message->update($data);

        return response([
            'message' => 'Message updated.',
            'data' => $message
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified message from the database.
     */
    public function destroy(Message $message): Response
    {
        $message->delete();

        return response([
            'message' => 'Message deleted.'
        ], ResponseAlias::HTTP_OK);
    }
}
