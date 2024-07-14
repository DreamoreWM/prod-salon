<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalonSetting;
use Carbon\Carbon;

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
            'logo_upload' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:52048',
            'bg_upload' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:52048',
            'dashboard_image' => 'nullable|string'
        ]);

        $setting = SalonSetting::firstOrNew([]);

        if ($request->hasFile('logo_upload')) {
            $logo = $request->file('logo_upload');
            $logoFilename = $logo->getClientOriginalName();
            $logo->move(public_path('logo'), $logoFilename);
            $setting->logo = $logoFilename;
        }

        if ($request->hasFile('bg_upload')) {
            $background = $request->file('bg_upload');
            $backgroundFilename = $background->getClientOriginalName();
            $background->move(public_path('background'), $backgroundFilename);
            $setting->background_image = $backgroundFilename;
        }

        $data = $request->except(['logo_upload', 'bg_upload']); // Get all the other data

        // Encode open_days to JSON if it is present
        if (isset($data['open_days'])) {
            $data['open_days'] = json_encode($data['open_days']);
        }

        // Fill the remaining data
        $setting->fill($data);
        $setting->save();

        return redirect()->route('salon.edit')->with('success', 'Les paramètres ont été mis à jour avec succès.');
    }
}
