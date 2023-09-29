<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subscription\SubscriptionRequest;
use App\Http\Requests\Admin\Subscription\UpdateSubscriptionRequest;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscriptionRequest $request): Response
    {
        $data = $request->validated();

        $subscription = Subscription::create($data);

        return response([
            'message' => 'Subscription created.',
            'subscription' => $subscription
        ], ResponseAlias::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription): Response
    {
        return response([
            'subscription' => $subscription
        ], ResponseAlias::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription): Response
    {
        $data = $request->validated();

        $subscription->update($data);

        return response([
            'message' => 'Subscription updated.',
            'subscription' => $subscription
        ], ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription): Response
    {
        $subscription->delete();

        return response([
            'message' => 'Subscription deleted.',
        ], ResponseAlias::HTTP_OK);
    }
}
