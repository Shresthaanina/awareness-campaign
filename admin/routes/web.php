<?php

use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Campaign\CampaignController;
use App\Http\Controllers\Admin\Campaign\CategoryController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::group(['middleware' => ['auth','isAdmin']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'campaigns'], function(){
        Route::get('/', [CampaignController::class, 'index'])->name('campaigns.index');
        Route::delete('/{id}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
        Route::patch('/status/{id}',[CampaignController::class, 'updateStatus'])->name('campaigns.updateStatus');
    });
    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
        Route::patch('/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::patch('/status/{id}',[CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
    });
    Route::group(['prefix' => 'banners'], function(){
        Route::get('/', [BannerController::class, 'index'])->name('banners.index');
        Route::get('/{id}', [BannerController::class, 'show'])->name('banners.show');
        Route::post('/', [BannerController::class, 'store'])->name('banners.store');
        Route::patch('/{id}', [BannerController::class, 'update'])->name('banners.update');
        Route::delete('/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
        Route::patch('/status/{id}',[BannerController::class, 'updateStatus'])->name('banners.updateStatus');
    });
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/status/{id}',[UserController::class, 'updateStatus'])->name('users.updateStatus');
    });
    Route::group(['prefix' => 'settings'], function(){
        Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/', [SettingController::class, 'update'])->name('settings.update');
    });
});
