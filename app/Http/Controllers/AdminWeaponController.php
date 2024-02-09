<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weapon;
use Inertia\Inertia;

class AdminWeaponController extends Controller
{
    public function create() {
        return Inertia::render('Admin/EditWeapon');
    }

    public function edit(Request $request, Weapon $weapon) {
        return Inertia::render('Admin/EditWeapon', [
            'weapon' => $weapon
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'rarity' => 'required|integer|min:3|max:5',
            'weapon_type' => 'required|integer|min:0|max:6',
        ]);

        $weapon = Weapon::create([
            'name' => $request->name,
            'rarity' => $request->rarity,
            'weapon_type' => $request->weapon_type,
        ]);

        return to_route('dashboard')->with('message', 'succesfully created weapon');;
    }

    public function update(Request $request, Weapon $weapon) {
        $request->validate([
            'name' => 'required',
            'rarity' => 'required|integer|min:3|max:5',
            'weapon_type' => 'required|integer|min:0|max:6',
        ]);

        $weapon->fill($request->all());
        $weapon->save();

        return to_route('dashboard')->with('message', 'succesfully updated weapon');
    }

    public function delete(Request $request, Weapon $weapon) {
        $weapon->delete();
        return to_route('dashboard')->with('message', 'succesfully deleted weapon');
    }
}
