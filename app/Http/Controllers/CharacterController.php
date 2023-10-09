<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
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
}
