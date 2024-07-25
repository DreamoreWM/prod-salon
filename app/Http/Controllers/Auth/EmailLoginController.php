<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class EmailLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function sendLoginLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;

        // Crée un token unique
        $token = Str::random(60);

        // Stocke le token dans la session
        session(['login_token' => $token, 'login_email' => $email]);

        // Envoie l'email avec le lien de connexion
        Mail::send('auth.emails.login-link', ['token' => $token], function($message) use ($email) {
            $message->to($email)->subject('Votre lien de connexion');
        });

        return redirect()->route('login')->with('success', 'Un lien de connexion vous a été envoyé par email.');
    }

    public function confirmLogin($token)
    {
        // Vérifie si le token dans la session correspond
        if ($token !== session('login_token')) {
            return redirect()->route('login')->with('error', 'Le lien de connexion est invalide ou a expiré.');
        }

        $email = session('login_email');
        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => 'Utilisateur Temporaire'] // Vous pouvez personnaliser cela
        );

        Auth::login($user);

        // Efface le token de la session
        session()->forget(['login_token', 'login_email']);

        // Met à jour un cookie pour signaler que l'email a été vérifié
        session(['email_verified' => true]);

        return redirect()->route('email.confirmed');
    }

    public function emailConfirmed()
    {
        return view('auth.confirmed');
    }

    public function checkEmailVerified()
    {
        return response()->json(['email_verified' => session('email_verified', false)]);
    }
}
