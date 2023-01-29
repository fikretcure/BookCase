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
    Route::middleware('auth.can:author-get')->get(null, 'get');
    Route::middleware('auth.can:author-create')->post(null, 'create');
    Route::middleware('auth.can:author-show')->get("{id}", 'show');
    Route::middleware('auth.can:author-delete')->delete("{id}", 'delete');
    Route::middleware('auth.can:author-update')->put("{id}", 'update');
});

Route::post('upload', [DocumentController::class, 'upload']);
