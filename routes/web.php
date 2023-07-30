<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
    Route::get('/game/edit', [GameController::class, 'edit'])->name('game.edit');
    Route::get('/game/delete', [GameController::class, 'delete'])->name('game.delete');
    Route::post('/game', [GameController::class, 'save'])->name('game.save');
    Route::patch('/game', [GameController::class, 'update'])->name('game.update');
    Route::delete('/game', [GameController::class, 'destroy'])->name('game.destroy');

    Route::get('/game/stages', [GameController::class, 'manage'])->name('game.manage');
    Route::post('/game/stages', [GameController::class, 'stages'])->name('game.stages');
});

require __DIR__.'/auth.php';
