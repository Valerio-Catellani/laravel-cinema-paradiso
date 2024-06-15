<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SlotController;
use App\Http\Controllers\Admin\MovieRoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('rooms', RoomController::class)->parameters(['rooms' => 'slug']); //sostiuisce l'id come parametro di default con slug in questo modo se noi passiamo room lui viene convertito in slug
    Route::resource('movies', MovieController::class)->parameters(['movies' => 'slug']);
    Route::resource('reviews', ReviewController::class);
    Route::resource('slots', SlotController::class)->parameters(['slots' => 'slug']);
    Route::resource('projections', MovieRoomController::class);
    //altre rotte...
});

/*
L'utente non autenticato richiede /dashboard.
Laravel applica il prefisso e cerca /admin.
Il middleware auth verifica che l'utente non è autenticato. 
Il middleware auth redirige l'utente alla pagina di login (vedi app/Http/middleware/Authenticate).
L'utente viene inviato all'URL /login disponibile grazie a ' require __DIR__ . '/auth.php';'.
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::fallback(function () {
    return redirect()->route('admin.dashboard');
});
