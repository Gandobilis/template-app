<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Subscription\SubscriptionRequest;
use App\Http\Requests\Public\Subscription\UpdateSubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function subscribe(SubscriptionRequest $request, Subscription $subscription): Response
    {
        $data = $request->validated();

        $subscription = Subscription::create($data);

        return response([
            'message' => 'Subscribed successfully.',
            'subscription' => $subscription
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function unsubscribe(UpdateSubscriptionRequest $request, Subscription $subscription): Response
    {
        $request->validated();

        $subscription->update(['active' => false]);

        return response([
            'message' => 'Unsubscribed successfully.',
            'subscription' => $subscription
        ], ResponseAlias::HTTP_OK);
    }
}
