<?php

namespace App\Http\Controllers;

use App\Models\TemporaryUser;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TemporaryUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Valider les données d'entrée
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        // Vérifier si l'email existe déjà dans la table des utilisateurs ou des utilisateurs temporaires
        $emailExists = User::where('email', $request->email)->exists() || TemporaryUser::where('email', $request->email)->exists();

        if ($emailExists) {
            return response()->json(['error' => 'Cet email existe déjà dans le système'], 400);
        }

        // Créer un nouvel utilisateur temporaire
        $temporaryUser = TemporaryUser::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return response()->json($temporaryUser, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TemporaryUser $temporaryUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemporaryUser $temporaryUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TemporaryUser $temporaryUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemporaryUser $temporaryUser)
    {
        //
    }
}
