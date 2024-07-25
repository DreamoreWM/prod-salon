<!DOCTYPE html>
<html lang="en">

@php
    use App\Models\SalonSetting;
    $backgroundColor = SalonSetting::first()->background_color;
@endphp

<head>
    <style>
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            background: {{ $backgroundColor }};
            position: absolute;
            top: 0;
            z-index: 1000;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
        }

        .logo-nav {
            display: flex;
            justify-content: center;
            flex: 1;
            max-width: 50px;
            margin: 0 5px 5px 0;
        }

        .logo-nav img {
            max-height: 50px;
            height: auto;
        }

        .menu-button {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            max-width: 150px;
            width: auto;
        }

        .overlay-menu {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            color: white;
            z-index: 1001;
            overflow: auto;
        }

        .overlay-menu .menu-button {
            position: absolute;
            top: 20px;
            right: 20px;
            max-width: none;
            width: auto;
        }

        .overlay-menu.active {
            display: flex;
        }

        .overlay-menu .menu-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            width: 90%;
            max-width: 600px;
        }

        .overlay-menu a,
        .overlay-menu form {
            margin: 5px 0;
            font-size: 1.2rem;
            color: white;
            text-decoration: none;
        }

        .overlay-menu form button {
            font-size: 1.2rem;
            background: none;
            border: none;
            cursor: pointer;
            color: white;
            text-align: center;
            display: inline-block;
            padding: 0;
            margin: 0;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: 2px solid transparent;
        }

        .btn-red {
            background-color: #e74c3c;
            color: white;
            border-color: #e74c3c;
        }

        .btn-red:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-content">
        <div class="logo-nav">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('logo/logo.png') }}" alt="Logo">
            </a>
        </div>
        <button class="menu-button btn btn-red" id="menuButton">Menu</button>
    </div>
</nav>

<div class="overlay-menu" id="overlayMenu">
    <button class="menu-button btn btn-red" id="closeButton">Fermer</button>
    <div class="menu-content">
        <a href="{{ route('dashboard.index') }}" class="btn btn-red">Accueil</a>
        @if(Auth::check())
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('users.index') }}" class="btn btn-red">Utilisateurs</a>
                <a href="{{ route('employees.index') }}" class="btn btn-red">Coiffeurs</a>
                <a href="{{ route('prestations.create') }}" class="btn btn-red">Prestations</a>

                <a href="{{ route('salon.edit') }}" class="btn btn-red">Paramétres</a>
                <a href="{{ route('absences.index') }}" class="btn btn-red">Absences</a>
                <a href="{{ route('photos.index') }}" class="btn btn-red">Photos</a>
            @endif
            <a href="{{ route('appointments.index') }}" class="btn btn-red">Mes rendez-vous</a>
                <a href="{{ route('reviews.list') }}" class="btn btn-red">Avis</a>
            <a href="{{ route('appointments.create') }}" class="btn btn-red">Prendre rendez-vous</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-red">Déconnexion</button>
            </form>
        @endif
        @if(!Auth::check())
            <a href="{{ route('appointments.create') }}" class="btn btn-red">Prenez rendez-vous</a>
            <a href="{{ route('reviews.list') }}" class="btn btn-red">Avis</a>
            <a href="{{ route('login') }}" class="btn btn-red">Se connecter</a>
        @endauth
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.getElementById('menuButton');
        const closeButton = document.getElementById('closeButton');
        const overlayMenu = document.getElementById('overlayMenu');

        menuButton.addEventListener('click', () => {
            overlayMenu.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        closeButton.addEventListener('click', () => {
            overlayMenu.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });
</script>
</body>
</html>
