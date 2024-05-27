<?php

namespace App\Http\Controllers;

use App\Models\Photospres;
use App\Models\SalonSetting;
use Illuminate\Http\Request;

class PhotoPresController extends Controller
{
    public function index()
    {
        $background_color = SalonSetting::first()->background_color;
        $photos = Photospres::all();
        return view('photos.index', compact('photos', 'background_color'));
    }

    public function store(Request $request)
    {
        $photo = new Photospres;
        $photo->path = $request->file('photo')->store('photosPres', 'public');
        $photo->save();

        return redirect()->route('photos.index');
    }
}
