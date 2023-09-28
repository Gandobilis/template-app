<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index()
    {
        $messages = Message::all();
        return response(['messages' => $messages], Response::HTTP_OK);
    }

    /**
     * Store a newly created message in the database.
     */
    public function store(MessageRequest $request)
    {
        $data = $request->validated();

        $message = Message::create($data);
        return response(['message' => $message], Response::HTTP_CREATED);
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message)
    {
        return response(['message' => $message], Response::HTTP_OK);
    }

    /**
     * Update the specified message in the database.
     */
    public function update(MessageRequest $request, Message $message)
    {
        $data = $request->validated();

        $message->update($data);
        return response(['message' => $message], Response::HTTP_OK);
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
