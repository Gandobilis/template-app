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
    public function store(Request $request): Response
    {
        $subscription =
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription): Response
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription): Response
    {
        //
    }
}
