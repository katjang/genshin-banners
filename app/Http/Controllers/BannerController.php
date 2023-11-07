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
        ]);

        $banner = Banner::create([
            'name' => $request->name,
            'patch' => $request->patch,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return to_route('banner.create');
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
        ]);

        $banner->fill($request->all());
        $banner->save();

        return back();
    }
}
