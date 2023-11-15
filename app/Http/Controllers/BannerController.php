<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Character;
use Inertia\Inertia;

class BannerController extends Controller
{

    public function create() {
        return Inertia::render('EditBanner', [
            'characters' => Character::all(),
        ]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'patch' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'featured' => 'required|array'
        ]);

        $banner = Banner::create([
            'name' => $request->name,
            'patch' => $request->patch,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        $banner->featured()->sync($request->featured);

        return to_route('dashboard')->with('message', 'succesfully created banner');
    }

    public function edit(Request $request, Banner $banner) {
        $banner->featured;
        return Inertia::render('EditBanner', [
            'banner' => $banner,
            'characters' => Character::all(),
        ]);
    }

    public function update(Request $request, Banner $banner) {
        $request->validate([
            'name' => 'required',
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

    public function delete(Request $request, Banner $banner) {
        $banner->delete();
        return to_route('dashboard')->with('message', 'succesfully deleted banner');
    }
}
