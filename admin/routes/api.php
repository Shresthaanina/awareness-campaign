<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\PassportAuthController;
use App\Http\Controllers\Api\Campaign\CampaignController;
use App\Http\Controllers\Api\Category\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [PassportAuthController::class, 'login'])->name('login');
Route::post('register', [PassportAuthController::class, 'register'])->name('register');
// Route::post('refresh_token', [PassportAuthController::class, 'refreshToken'])->name('refresh_token');
// Route::post('verification/send_email', [PassportAuthController::class, 'resend'])->name('verification.resend');
// Route::post('verification/verify_email', [PassportAuthController::class, 'verify'])->name('verification.verify');
// Route::post('password/reset', [PassportAuthController::class, 'resetPassword'])->name('reset_password');

Route::group(['prefix' => 'v1'], function(){
    Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/{slug}', [CampaignController::class, 'show'])->name('campaigns.show');
    Route::get('/recent_campaigns', [CampaignController::class, 'recent'])->name('campaigns.recent');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', [PassportAuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'v1'], function(){
        Route::get('profile', [PassportAuthController::class, 'profile'])->name('profile');
        Route::patch('profile', [PassportAuthController::class, 'updateProfile'])->name('profile.update');

        Route::group(['prefix' => 'campaigns'], function(){
            Route::post('/', [CampaignController::class, 'store'])->name('campaigns.store');
            Route::patch('/{id}', [CampaignController::class, 'update'])->name('campaigns.update');

        });
    });
});
