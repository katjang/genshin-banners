<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CharacterBanner;
use App\Models\Character;
use Inertia\Inertia;

class AdminCharacterBannerController extends Controller
{
    public function create() {
        return Inertia::render('Admin/EditCharacterBanner', [
            'characters' => Character::all(),
        ]);
    }

    public function edit(Request $request, CharacterBanner $characterBanner) {
        $characterBanner->featured;
        return Inertia::render('Admin/EditCharacterBanner', [
            'banner' => $characterBanner,
            'characters' => Character::all(),
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'patch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'featured' => 'required|array'
        ]);

        $characterBanner = CharacterBanner::create([
            'name' => $request->name,
            'patch' => $request->patch,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        $characterBanner->featured()->sync($request->featured);

        return to_route('dashboard')->with('message', 'succesfully created banner');
    }

    public function update(Request $request, CharacterBanner $characterBanner) {
        $request->validate([
            'patch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'featured' => 'required|array'
        ]);

        $characterBanner->fill($request->except('featured'));
        $characterBanner->featured()->sync($request->featured);
        $characterBanner->save();

        return to_route('dashboard')->with('message', 'succesfully updated banner');
    }

    public function destroy(Request $request, CharacterBanner $characterBanner) {
        $characterBanner->delete();
        return to_route('dashboard')->with('message', 'succesfully deleted banner');
    }
}
