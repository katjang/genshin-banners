<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminCharacterController;
use App\Http\Controllers\AdminBannerController;
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
        'characters' => Character::all()->append('last_banner')
    ]);
});

Route::get('/characters/{character}', function (Character $character) {
    $ret = Character::with('banners', 'banners.featured')->where('id', $character->id)->first();
    return $ret;
});

// ---------------------ADMIN-----------------------------
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard', [
            'characters' => Character::all(),
            'banners' => Banner::with('featured')->orderBy('start_date', 'DESC')->get()
        ]);
    })->name('dashboard');

    Route::name('banner.')->controller(AdminBannerController::class)->group(function() {
        Route::get('/banners/create', 'create')->name('create');
        Route::get('/banners/{banner}', 'edit')->name('edit');
        Route::post('/banners', 'store')->name('store');
        Route::put('/banners/{banner}', 'update')->name('update');
        Route::delete('/banners/{banner}', 'delete')->name('delete');
    });

    Route::name('character.')->controller(AdminCharacterController::class)->group(function() {
        Route::get('/characters/create', 'create')->name('create');
        Route::get('/characters/{character}', 'edit')->name('edit');
        Route::post('/characters', 'store')->name('store');
        Route::put('/characters/{character}', 'update')->name('update');
        Route::delete('/characters/{characters}', 'delete')->name('delete');
    });
});

// ---------------------ADMIN-----------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
