<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Inertia\Inertia;

class AdminCharacterController extends Controller
{
    public function create() {
        return Inertia::render('Admin/EditCharacter');
    }

    public function edit(Request $request, Character $character) {
        return Inertia::render('Admin/EditCharacter', [
            'character' => $character
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'rarity' => 'required|integer|min:3|max:5',
            'weapon_type' => 'required|integer|min:0|max:6',
            'element' => 'required|integer|min:0|max:6',
        ]);

        $character = Character::create([
            'name' => $request->name,
            'rarity' => $request->rarity,
            'weapon_type' => $request->weapon_type,
            'element' => $request->element,
            'featured_name' => $request->featured_name
        ]);

        return to_route('dashboard')->with('message', 'succesfully created character');;
    }

    public function update(Request $request, Character $character) {
        $request->validate([
            'name' => 'required',
            'rarity' => 'required|integer|min:3|max:5',
            'weapon_type' => 'required|integer|min:0|max:6',
            'element' => 'required|integer|min:0|max:6',
        ]);

        $character->fill($request->all());
        $character->save();

        return to_route('dashboard')->with('message', 'succesfully updated character');
    }

    public function destroy(Request $request, Character $character) {
        $character->delete();
        return to_route('dashboard')->with('message', 'succesfully deleted character');
    }
}
