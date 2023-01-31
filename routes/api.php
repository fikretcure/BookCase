<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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
Route::get('/', function () {
    return response()->json("Hi Dear , Welcome BookCase");
});

Route::name("authors.")->prefix('authors')->controller(AuthorController::class)->group(function () {
    Route::name("get")->get(null, 'get');
    Route::name("create")->post(null, 'create');
    Route::name("show")->get("{id}", 'show');
    Route::name("delete")->delete("{id}", 'delete');
    Route::name("update")->put("{id}", 'update');
});

Route::name("books.")->prefix('books')->controller(BookController::class)->group(function () {
    Route::name("get")->get(null, 'get');
    Route::name("create")->post(null, 'create');
    Route::name("show")->get("{id}", 'show');
    Route::name("delete")->delete("{id}", 'delete');
    Route::name("update")->put("{id}", 'update');
});

Route::post('upload', [DocumentController::class, 'upload']);
