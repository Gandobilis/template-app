<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index(Request $request): Response
    {
        if (!auth()->user()->hasPermissionTo('message index')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $limit = $request->query('limit', 10);

        $messages = Message::paginate($limit);

        return response([
            'data' => $messages,
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Display the specified message.
     */
    public function show(Message $message): Response
    {
        if (!auth()->user()->hasPermissionTo('message show')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        return response([
            'data' => $message
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified message from the database.
     */
    public function destroy(Message $message): Response
    {
        if (!auth()->user()->hasPermissionTo('message destroy')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $message->delete();

        return response([
            'message' => __('message.success.destroy')
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Display a listing of the archived messages.
     */
    public function archived(Request $request): Response
    {
        if (!auth()->user()->hasPermissionTo('message archived')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $limit = $request->query('limit', 10);

        $messages = Message::onlyTrashed()->paginate($limit);

        return response([
            'data' => $messages,
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Restore a specific archived messages.
     */
    public function restore(string $id): Response
    {
        if (!auth()->user()->hasPermissionTo('message restore')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $message = Message::onlyTrashed()->find($id);
        $message->restore();

        return response([
            'message' => __('message.success.restore'),
            'data' => $message,
        ], ResponseAlias::HTTP_OK);
    }
}
