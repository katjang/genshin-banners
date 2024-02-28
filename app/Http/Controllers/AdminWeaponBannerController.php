<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeaponBanner;
use App\Models\Weapon;
use Inertia\Inertia;

class AdminWeaponBannerController extends Controller
{
    public function create() {
        return Inertia::render('Admin/EditWeaponBanner', [
            'weapons' => Weapon::all(),
        ]);
    }

    public function edit(Request $request, WeaponBanner $banner) {
        $banner->featured;
        return Inertia::render('Admin/EditWeaponBanner', [
            'banner' => $banner,
            'weapons' => Weapon::all(),
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'patch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'featured' => 'required|array'
        ]);

        $banner = WeaponBanner::create([
            'name' => $request->name,
            'patch' => $request->patch,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        $banner->featured()->sync($request->featured);

        return to_route('dashboard')->with('message', 'succesfully created banner');
    }

    public function update(Request $request, WeaponBanner $banner) {
        $request->validate([
            'patch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'featured' => 'required|array'
        ]);

        $banner->fill($request->except('featured'));
        $banner->featured()->sync($request->featured);
        $banner->save();

        return to_route('dashboard')->with('message', 'succesfully updated banner');
    }

    public function destroy(Request $request, WeaponBanner $banner) {
        $banner->delete();
        return to_route('dashboard')->with('message', 'succesfully deleted banner');
    }
}
