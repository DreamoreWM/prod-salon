<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Salon de Coiffure</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f2c10e;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 1em;
            color: #333;
        }
        .login-container label {
            display: block;
            margin-bottom: 0.5em;
            color: #555;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: calc(100% - 1em);
            padding: 0.5em;
            margin-bottom: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-container input[type="checkbox"] {
            margin-right: 0.5em;
        }
        .login-container button {
            width: 100%;
            padding: 0.75em;
            border: none;
            border-radius: 4px;
            background-color: #e53935;
            color: #fff;
            font-size: 1em;
        }
        .login-container a {
            color: #e53935;
            text-decoration: none;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Connexion</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" required autofocus>

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required>

        <div style="margin-bottom: 1em;">
            <label for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                Garder session active
            </label>
        </div>

        <button type="submit">Se connecter</button>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
        @endif
    </form>
</div>
</body>
</html>
