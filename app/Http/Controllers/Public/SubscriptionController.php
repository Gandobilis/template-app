<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function subscribe(SubscriptionRequest $request): Response
    {
        $data = $request->validated();

        $subscription = Subscription::firstOrCreate(
            ['email' => $data['email']]
        );

        return response([
            'message' => __('subscription.subscribe'),
            'subscription' => $subscription
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function unsubscribe(Subscription $subscription): Response
    {
        $subscription->delete();

        return response([
            'message' => __('subscription.unsubscribe'),
        ], ResponseAlias::HTTP_OK);
    }
}
