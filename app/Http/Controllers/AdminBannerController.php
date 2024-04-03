<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Character;
use App\Models\Weapon;
use Inertia\Inertia;

class AdminBannerController extends Controller
{
    public function create() {
        return Inertia::render('Admin/EditBanner', [
            'weapons' => Weapon::all(),
            'characters' => Character::all(),
        ]);
    }

    public function edit(Request $request, Banner $banner) {
        $banner->weapons;
        $banner->characters;
        return Inertia::render('Admin/EditBanner', [
            'banner' => $banner,
            'characters' => Character::all(),
            'weapons' => Weapon::all(),
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'patch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'featured_characters' => 'present|array',
            'featured_weapons' => 'present|array',
        ]);

        $banner = Banner::create([
            'name' => $request->name,
            'patch' => $request->patch,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        $banner->characters()->sync($request->featured_characters);
        $banner->weapons()->sync($request->featured_weapons);

        return to_route('dashboard')->with('message', 'succesfully created banner');
    }

    public function update(Request $request, Banner $banner) {
        $request->validate([
            'patch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'featured_characters' => 'present|array',
            'featured_weapons' => 'present|array',
        ]);

        $banner->fill($request->except(['featured_characters', 'featured_weapons']));
        $banner->characters()->sync($request->featured_characters);
        $banner->weapons()->sync($request->featured_weapons);
        $banner->save();

        return to_route('dashboard')->with('message', 'succesfully updated banner');
    }

    public function destroy(Request $request, Banner $banner) {
        $banner->delete();
        return to_route('dashboard')->with('message', 'succesfully deleted banner');
    }
}
