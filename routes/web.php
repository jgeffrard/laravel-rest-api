<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::post('register', 'App\Http\Controllers\ApiController@register');
Route::post('login', 'App\Http\Controllers\ApiController@login');
Route::get('view_messages', 'App\Http\Controllers\ApiController@viewMessages');
Route::post('send_message', 'App\Http\Controllers\ApiController@sendMessage');
Route::get('list_all_users', 'App\Http\Controllers\ApiController@listAllUsers');