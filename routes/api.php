<?php

use App\Http\Controllers\AuthorController;
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

Route::get('author', [AuthorController::class, 'get']);
Route::put('author/{id}', [AuthorController::class, 'update']);
Route::get('author/auto-complete', [AuthorController::class, 'autoComplete']);
