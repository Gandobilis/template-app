<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\SubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function subscribe(SubscriptionRequest $request): Response
    {
        $data = $request->validated();
        $data['token'] = Str::random();

        $subscription = Subscription::updateOrCreate(
            ['email' => $data['email']],
            $data
        );

        return response([
            'message' => __('subscription.subscribe'),
            'subscription' => $subscription
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function unsubscribe(string $token, Subscription $subscription): Response
    {
        $subscription->update([
            'active' => false
        ]);

        return response([
            'message' => __('subscription.unsubscribe'),
            'subscription' => $subscription
        ], ResponseAlias::HTTP_OK);
    }
}
