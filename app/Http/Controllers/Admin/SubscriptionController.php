<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        if (!auth()->user()->hasPermissionTo('subscription index')) {
            abort(ResponseAlias::HTTP_FORBIDDEN);
        }

        $limit = $request->query('limit', 10);

        $subscriptions = Subscription::paginate($limit);

        return response([
            'subscriptions' => $subscriptions
        ], ResponseAlias::HTTP_OK);
    }
}
