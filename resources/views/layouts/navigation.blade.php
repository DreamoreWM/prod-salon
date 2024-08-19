<!DOCTYPE html>
<html lang="en">

@php
    use App\Models\SalonSetting;
    $backgroundColor = SalonSetting::first()->background_color;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap');

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            background: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            z-index: 1000;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            color: white;
        }

        .logo-nav {
            display: flex;
            align-items: center;
            max-width: 50px;
            margin: 0;
        }

        .logo-nav img {
            max-height: 50px;
            height: auto;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            gap: 30px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            position: relative;
            padding-bottom: 5px;
        }

        .nav-links a:hover,
        .nav-links a:focus {
            color: #b5b5b5;
        }

        .nav-links a.active,
        .nav-links a:hover,
        .nav-links a:focus {
            color: white;
        }

        .nav-links a.active::after,
        .nav-links a:hover::after,
        .nav-links a:focus::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .user-icon {
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #444;
            padding: 10px 0;
            min-width: 200px;
            z-index: 1000;
        }

        .dropdown-content a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #555;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .burger {
            display: none;
            cursor: pointer;
        }

        .burger div {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px;
            transition: all 0.3s ease;
        }

        @media screen and (max-width: 1024px) {
            .nav-links {
                position: fixed;
                right: -100%;
                top: 70px;
                height: calc(100vh - 70px);
                background-color: rgba(0, 0, 0, 0.9);
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 50%;
                transition: right 0.5s ease;
                padding-top: 20px;
            }

            .nav-links.active {
                right: 0;
            }

            .burger {
                display: block;
            }

            .dropdown-content {
                position: static;
                background-color: transparent;
                display: none;
            }

            .dropdown.active .dropdown-content {
                display: block;
            }
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
        <div class="nav-links">
            <a href="{{ route('dashboard.index') }}" class="active">ACCUEIL</a>
            @if(Auth::check())
                @if(Auth::user()->role == 'admin')
                    <div class="dropdown">
                        <a href="javascript:void(0)">ADMINISTRATION</a>
                        <div class="dropdown-content">
                            <a href="{{ route('users.index') }}">UTILISATEURS</a>
                            <a href="{{ route('employees.index') }}">COIFFEURS</a>
                            <a href="{{ route('prestations.create') }}">PRESTATIONS</a>
                            <a href="{{ route('calendar.index') }}">CALENDRIER</a>
                            <a href="{{ route('salon.edit') }}">PARAMÈTRES</a>
                            <a href="{{ route('absences.index') }}">ABSENCES</a>
                            <a href="{{ route('photos.index') }}">PHOTOS</a>
                        </div>
                    </div>
                @endif
                <a href="{{ route('appointments.index') }}">MES RENDEZ-VOUS</a>
                <a href="{{ route('loyalty-card.show') }}">MA CARTE DE FIDÉLITÉ</a>
                <a href="{{ route('reviews.list') }}">AVIS</a>
                <a href="{{ route('appointments.create') }}">PRENDRE RENDEZ-VOUS</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:white;cursor:pointer;">DÉCONNEXION</button>
                </form>
            @endif
            @if(!Auth::check())
                <a href="{{ route('appointments.create') }}">PRENEZ RENDEZ-VOUS</a>
                <a href="{{ route('register') }}">CRÉER UN COMPTE</a>
                <a href="{{ route('reviews.list') }}">AVIS</a>
                <a href="{{ route('login') }}">SE CONNECTER</a>
            @endauth
        </div>
        <div>
            <a href="{{ route('profile.edit') }}" class="user-icon">
                <i class="fa fa-user"></i>
            </a>
        </div>
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </div>
</nav>

<script>
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const dropdowns = document.querySelectorAll('.dropdown');

    burger.addEventListener('click', () => {
        nav.classList.toggle('active');
        burger.classList.toggle('toggle');
    });

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', () => {
            dropdown.classList.toggle('active');
        });
    });
</script>
</body>
</html>
