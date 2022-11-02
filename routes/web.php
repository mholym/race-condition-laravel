<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CouponFixController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\PollFixController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('polls')->controller(PollController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'index')->name('polls');
        Route::get('/create', 'create');
        Route::post('{id}', 'vote');
        Route::get('/revoke', 'revokeVotes'); // it is what it is
    });
});

Route::prefix('polls-fix')->controller(PollFixController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'index')->name('polls-fix');
        Route::get('/create', 'create');
        Route::post('{id}', 'vote');
        Route::get('/revoke', 'revokeVotes'); // it is what it is
    });
});

Route::prefix('answers')->controller(AnswerController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'index')->name('answers');
    });
});

Route::prefix('coupons')->controller(CouponController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/', 'index')->name('coupons');
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/cart', 'apply');
    });
});

Route::prefix('coupons-fix')->controller(CouponFixController::class)->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/cart', 'cart')->name('cart-fix');
        Route::post('/cart', 'apply');
    });
});

require __DIR__.'/auth.php';
