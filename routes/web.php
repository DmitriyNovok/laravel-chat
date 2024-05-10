<?php

use App\Http\Controllers\Chat\ChannelController;
use App\Http\Controllers\Chat\MessageController;
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

Auth::routes();

Route::view('/', 'chat')->middleware('auth');

Route::post('messages', [MessageController::class, 'message'])->name('messages')->middleware('auth');

Route::get('/channels/{channel}', [ChannelController::class, 'channels'])->name('channels')->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
