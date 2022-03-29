<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

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
Route::get('dreamteam', [IdeaController::class, 'index']);
Route::put('dreamteam/status/{id}', [IdeaController::class, 'channge_status']);
Route::get('dreamteam/{id}', [IdeaController::class, 'show']);
Route::put('dreamteam/{id}', [IdeaController::class, 'update']);
Route::delete('dreamteam/delete/{id}', [IdeaController::class, 'delete']);
Route::post('dreamteam', [IdeaController::class, 'store']);
