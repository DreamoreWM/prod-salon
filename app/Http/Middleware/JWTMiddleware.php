<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class JWTMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Récupérer le token JWT du cookie
            $token = $request->cookie('jwt_token');

            if (!$token) {
                return $this->redirectWithLogout($request, 'Authorization Token not found');
            }

            // Authentifier l'utilisateur avec le token JWT
            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                return $this->redirectWithLogout($request, 'User not authenticated');
            }

            Auth::setUser($user); // Assurez-vous que l'utilisateur est authentifié dans le système d'authentification Laravel
            $request->merge(['user_id' => $user->id]); // Ajouter uniquement l'ID de l'utilisateur à la requête


        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                Log::error('Token is Invalid');
                return $this->redirectWithLogout($request, 'Token is Invalid');
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                Log::error('Token is Expired');
                return $this->redirectWithLogout($request, 'Token Expired');
            } else {
                Log::error('Authorization Token not found', ['exception' => $e]);
                return $this->redirectWithLogout($request, 'Authorization Token not found');
            }
        }

        return $next($request);
    }

    private function redirectWithLogout($request, $message)
    {
        // Supprimez le token de session Laravel
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigez vers la page de login avec un message d'erreur
        return redirect()->route('login')
            ->withErrors(['message' => $message])
            ->withCookie(cookie()->forget('jwt_token'));
    }
}
