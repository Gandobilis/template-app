<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\MessageController as MessageAdminController;
use App\Http\Controllers\Public\MessageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubscriptionController as SubscriptionAdminController;
use App\Http\Controllers\Public\SubscriptionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('locale')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');

    Route::post('subscribe/{subscription}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::post('unsubscribe/{subscription}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

    Route::post('messages', [MessageController::class, 'message'])->name('message');

    Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::apiResource('users', UserController::class)->names('admin.users');
        Route::put('users/{user}/activate', [UserController::class, 'activate'])->name('admin.users.activate');
        Route::put('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('admin.users.deactivate');

        Route::apiResource('posts', PostController::class)->names('admin.posts');

        Route::apiResource('banners', BannerController::class)->names('admin.banners');

        Route::apiResource('sections', SectionController::class)->names('admin.sections');

        Route::apiResource('messages', MessageAdminController::class)->names('admin.messages');

        Route::apiResource('subscriptions', SubscriptionAdminController::class)->names('admin.subscriptions');
    });
});
