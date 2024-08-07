<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        // Générer le token JWT
        $token = JWTAuth::attempt($request->only('email', 'password'));

        // Stocker le token dans un cookie HTTP-only
        $cookie = cookie('jwt_token', $token, 60 * 12, null, null, false, false);

        Log::info('Token généré avec succès:', ['token' => $token]);

        return redirect()->intended(RouteServiceProvider::HOME)->withCookie($cookie);
    }

    // Ajoutez la méthode destroy pour gérer la déconnexion
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Supprimez le token JWT en supprimant le cookie
        $cookie = cookie()->forget('jwt_token');

        return redirect('/')->withCookie($cookie);
    }
}
