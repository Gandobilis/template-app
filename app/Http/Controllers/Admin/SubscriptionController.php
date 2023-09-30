<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $subscriptions = Subscription::all();

        return response([
            'subscriptions' => $subscriptions
        ], ResponseAlias::HTTP_OK);
    }
}
