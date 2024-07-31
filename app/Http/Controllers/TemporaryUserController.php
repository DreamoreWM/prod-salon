<?php

namespace App\Http\Controllers;

use App\Models\TemporaryUser;
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:temporary_users',
        ]);

        $temporaryUser = TemporaryUser::create($validatedData);

        return response()->json($temporaryUser);
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
