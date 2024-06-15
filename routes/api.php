<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ProjectionController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\SlotController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/get-data', [DataController::class, 'getData']);


Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{slug}', [MovieController::class, 'show']);
Route::get('rooms', [RoomController::class, 'index']);
Route::get('rooms/{slug}', [RoomController::class, 'show']);
Route::get('reviews', [ReviewController::class, 'index']);
Route::get('reviews/{id}', [ReviewController::class, 'show']);
Route::get('projections', [ProjectionController::class, 'index']);
Route::get('projections/{id}', [ProjectionController::class, 'show']);
Route::get('slots', [SlotController::class, 'index']);
Route::get('slots/{slug}', [SlotController::class, 'show']);



// Route::get('projects/{slug}', [ProjectController::class, 'show']);
// Route::get('types', [TypeController::class, 'index']);
// Route::post('contacts', [LeadController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
