<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminCharacterController;
use App\Http\Controllers\AdminBannerController;
use App\Http\Controllers\AdminWeaponController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Character;
use App\Models\Banner;
use App\Models\Weapon;
use App\Models\WeaponBanner;

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
        'characters' => Character::all()->append('last_banner'),
        'weapons' => Weapon::all()->append('last_banner')
    ]);
});

Route::get('/characters/{character}', function (Character $character) {
    return Character::with(['banners', 'banners.characters', 'banners.weapons'])->where('id', $character->id)->firstOrFail();
});

Route::get('/weapons/{weapon}', function (Weapon $weapon) {
    return Weapon::with('banners', 'banners.characters', 'banners.weapons')->where('id', $weapon->id)->firstOrFail();
});

// --------------------------------------<ADMIN>-------------------------------
// ---- before it will see any production use, auth will be implemented -------
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard', [
            'characters' => Character::all(),
            'banners' => Banner::with('weapons', 'characters')->orderBy('start_date', 'DESC')->get(),
            'weapons' => Weapon::all(),
        ]);
    })->name('dashboard');

    Route::resource('weapons', AdminWeaponController::class)->except(['index', 'show']);

    Route::resource('characters', AdminCharacterController::class)->except(['index', 'show']);

    Route::resource('banners', AdminBannerController::class)->except(['index', 'show']);
});

// ---------------------</ADMIN>-----------------------------

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
