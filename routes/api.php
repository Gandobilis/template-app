<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController as BannerAdminController;
use App\Http\Controllers\Public\BannerController;
use App\Http\Controllers\Admin\PostController as PostAdminController;
use App\Http\Controllers\Public\PostController;
use App\Http\Controllers\Admin\SectionController as SectionAdminController;
use App\Http\Controllers\Public\SectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MessageController as MessageAdminController;
use App\Http\Controllers\Public\MessageController;
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

    Route::post('subscription/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::put('subscription/unsubscribe/{subscription}', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe');

    Route::apiResource('banners', BannerController::class)->names('banners');

    Route::apiResource('posts', PostController::class)->names('posts');

    Route::apiResource('sections', SectionController::class)->names('sections');

    Route::post('messages', [MessageController::class, 'message'])->name('message');

    Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::apiResource('users', UserController::class)->names('admin.users');
        Route::put('users/{user}/activate', [UserController::class, 'activate'])->name('admin.users.activate');
        Route::put('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('admin.users.deactivate');

        Route::apiResource('banners', BannerAdminController::class)->names('admin.banners');
        Route::put('banners/{banner}/images', [BannerAdminController::class, 'deleteImages'])->name('admin.banners.images');
        Route::get('banner/types', [BannerAdminController::class, 'types'])->name('admin.banner.types');

        Route::apiResource('posts', PostAdminController::class)->names('admin.posts');

        Route::apiResource('sections', SectionAdminController::class)->names('admin.sections');

        Route::apiResource('messages', MessageAdminController::class)->names('admin.messages');

        Route::apiResource('subscriptions', SubscriptionAdminController::class)->names('admin.subscriptions');
    });
});
