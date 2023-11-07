<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function create() {
        return Inertia::render('CreateCharacter');
    }

    public function edit(Request $request, Character $character) {
        return Inertia::render('CreateCharacter', [
            'character' => $character
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'rarity' => 'required|integer|min:3|max:5',
            'weapon_type' => 'required|integer|min:0|max:6'
        ]);

        $character = Character::create([
            'name' => $request->name,
            'rarity' => $request->rarity,
            'weapon_type' => $request->weapon_type
        ]);

        return to_route('character.create');
    }

    public function update(Request $request, Character $character) {
        $request->validate([
            'name' => 'required',
            'rarity' => 'required|integer|min:3|max:5',
            'weapon_type' => 'required|integer|min:0|max:6'
        ]);

        $character->fill($request->all());
        $character->save();

        return to_route('character.create')->with('message', 'succesfully updated');
    }
}
