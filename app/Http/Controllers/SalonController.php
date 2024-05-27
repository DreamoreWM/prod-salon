<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalonSetting;

class SalonController extends Controller
{
    // Méthode pour afficher le formulaire de paramètres du salon
    public function edit()
    {
        // Récupère les paramètres existants ou crée un nouvel objet sans le sauvegarder
        $setting = SalonSetting::firstOrNew([]);
        $background_color = SalonSetting::first()->background_color;

        // Passe les paramètres (existants ou nouveaux) à la vue
        return view('salon.edit', compact('setting', 'background_color'));
    }

    // Méthode pour sauvegarder ou mettre à jour les paramètres
    public function update(Request $request)
    {
        $request->validate([
            'logo_upload' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $setting = SalonSetting::firstOrNew([]);

        if ($request->hasFile('logo_upload')) {
            $logo = $request->file('logo_upload');
            $filename = $logo->getClientOriginalName();
            $logo->move(public_path('logo'), $filename);
            $setting->logo = $filename;
        }

        $data = $request->except('logo_upload'); // Get all the other data
        $data['open_days'] = json_encode($data['open_days']);

        $setting->fill($data)->save();

        return redirect()->route('salon.edit')->with('success', 'Les paramètres ont été mis à jour avec succès.');
    }
}
