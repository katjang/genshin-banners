<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\BannerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Character;
use App\Models\Banner;

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
    return Inertia::render('Overview', [
        'characters' => Character::all(),
    ]);
});

// ---------------------ADMIN-----------------------------
Route::get('/banners/create', [BannerController::class, 'create'])->name('banner.create');
Route::get('/characters/create', [CharacterController::class, 'create'])->name('character.create');

Route::post('/characters', [CharacterController::class, 'store'])->name('character.store');
Route::post('/banners', [BannerController::class, 'store'])->name('banner.store');

Route::get('/banners/{banner}', [BannerController::class, 'edit'])->name('banner.edit');
Route::put('/banners/{banner}', [BannerController::class, 'update'])->name('banner.update');

Route::get('/characters/{character}', [CharacterController::class, 'edit'])->name('character.edit');
Route::put('/characters/{character}', [CharacterController::class, 'update'])->name('character.update');
// ---------------------ADMIN-----------------------------

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
