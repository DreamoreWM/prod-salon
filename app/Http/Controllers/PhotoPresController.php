<?php

namespace App\Http\Controllers;

use App\Models\Photospres;
use App\Models\SalonSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo = new Photospres;
        $photo->path = $request->file('photo')->store('photosPres', 'public');
        $photo->save();

        return redirect()->route('photos.index');
    }
    public function destroy($id)
    {
        $photo = PhotosPres::findOrFail($id);

        // Supprimer le fichier de l'image du serveur
        Storage::delete($photo->path);

        // Supprimer l'enregistrement de la base de données
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'La photo a été supprimée avec succès.');
    }


}
