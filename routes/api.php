<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['controller' => AuthController::class, 'prefix' => 'user'], function() {
    Route::post('login', 'login');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('profile', 'profile');
        Route::get('logout', 'logout');
    });
});

Route::group(['controller' => UserNoteController::class, 'prefix' => 'user_note'], function() {
    Route::post('share', 'share');
});

Route::group(['controller' => UserController::class, 'prefix' => 'users'], function() {
    Route::get('/', 'index');
    Route::post('toggle_notice', 'toggleNotice');
});

Route::apiResource('notes', \NoteController::class);