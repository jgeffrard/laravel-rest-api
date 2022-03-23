<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\ApiController@register');
Route::post('login', 'App\Http\Controllers\ApiController@login');
Route::get('view_messages', 'App\Http\Controllers\ApiController@viewMessages');
Route::post('send_message', 'App\Http\Controllers\ApiController@sendMessage');
Route::get('list_all_users', 'App\Http\Controllers\ApiController@listAllUsers');