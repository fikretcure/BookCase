<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DocumentController;
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

Route::prefix('authors')->controller(AuthorController::class)->group(function () {
    Route::get(null, 'get');
    Route::post(null, 'create');
    Route::get("{id}", 'show');
    Route::delete("{id}", 'delete');
    Route::put("{id}", 'updated');
});

Route::post('upload', [DocumentController::class, 'upload']);
