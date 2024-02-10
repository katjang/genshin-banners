<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminCharacterController;
use App\Http\Controllers\AdminCharacterBannerController;
use App\Http\Controllers\AdminWeaponController;
use App\Http\Controllers\AdminWeaponBannerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Character;
use App\Models\CharacterBanner;
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
    $ret = Character::with('banners', 'banners.featured')->where('id', $character->id)->first();
    return $ret;
});

Route::get('/weapons/{weapon}', function (Weapon $weapon) {
    $ret = Weapon::with('banners', 'banners.featured')->where('id', $weapon->id)->first();
    return $ret;
});

// ---------------------ADMIN-----------------------------
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard', [
            'characters' => Character::all(),
            'characterBanners' => CharacterBanner::with('featured')->orderBy('start_date', 'DESC')->get(),
            'weapons' => Weapon::all(),
            'weaponBanners' => WeaponBanner::with('featured')->orderBy('start_date', 'DESC')->get(),
        ]);
    })->name('dashboard');

    Route::name('weapon.')->controller(AdminWeaponController::class)->group(function() {
        Route::get('/weapons/create', 'create')->name('create');
        Route::get('/weapons/{weapon}', 'edit')->name('edit');
        Route::post('/weapons', 'store')->name('store');
        Route::put('/weapons/{weapon}', 'update')->name('update');
        Route::delete('/weapons/{weapon}', 'delete')->name('delete');
    });

    Route::name('character.')->controller(AdminCharacterController::class)->group(function() {
        Route::get('/characters/create', 'create')->name('create');
        Route::get('/characters/{character}', 'edit')->name('edit');
        Route::post('/characters', 'store')->name('store');
        Route::put('/characters/{character}', 'update')->name('update');
        Route::delete('/characters/{character}', 'delete')->name('delete');
    });

    Route::name('characterBanner.')->controller(AdminCharacterBannerController::class)->group(function() {
        Route::get('/characterBanners/create', 'create')->name('create');
        Route::get('/characterBanners/{banner}', 'edit')->name('edit');
        Route::post('/characterBanners', 'store')->name('store');
        Route::put('/characterBanners/{banner}', 'update')->name('update');
        Route::delete('/characterBanners/{banner}', 'delete')->name('delete');
    });

    Route::name('weaponBanner.')->controller(AdminWeaponBannerController::class)->group(function() {
        Route::get('/weaponBanners/create', 'create')->name('create');
        Route::get('/weaponBanners/{banner}', 'edit')->name('edit');
        Route::post('/weaponBanners', 'store')->name('store');
        Route::put('/weaponBanners/{banner}', 'update')->name('update');
        Route::delete('/weaponBanners/{banner}', 'delete')->name('delete');
    });
});

// ---------------------ADMIN-----------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('fixbanners', function () {
//     $character_banners = CharacterBanner::with('featured')->get();

//     foreach($character_banners as $banner) {
//         $characters = $banner->featured;

//         foreach($characters as $char) {
//             if($char->rarity == 5) {
//                 $char->featured_name = $banner->name;
//                 $char->save();
//                 $banner->name = null;
//                 $banner->save();
//                 break;
//             }
//         }
//     }
// });

require __DIR__.'/auth.php';
