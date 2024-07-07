<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Tes autres balises head -->
    <style>
        /* Styles existants ici */
        .navbar {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin: 0;
            padding: 0;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .navbar-transparent {
            background: transparent;
            position: fixed;
            top: 0;
            z-index: 1001;
        }

        .navbar-white {
            background: white;
            position: fixed;
            top: 0;
            z-index: 1000;
            opacity: 0;
            pointer-events: none; /* Désactiver les événements pour éviter les clics */
        }

        .logo-nav img {
            height: 50px;
        }

        /* Style général pour tous les boutons */
        .btn {
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: 2px solid transparent; /* Par défaut, pas de bordure */
        }

        /* Style pour le bouton rouge */
        .btn-red {
            background-color: #e74c3c; /* Rouge */
            color: white;
            border-color: #e74c3c; /* Bordure rouge */
        }

        .btn-red:hover {
            background-color: #c0392b; /* Rouge foncé pour le hover */
        }

        /* Style pour les boutons transparents avec bordure blanche pour navbar transparente */
        .navbar-transparent .btn-white {
            background-color: transparent;
            color: white; /* Texte blanc */
            border-color: white; /* Bordure blanche */
        }

        .navbar-transparent .btn-white:hover {
            background-color: rgba(255, 255, 255, 0.1); /* Légère teinte blanche pour le hover */
        }

        /* Style pour les boutons transparents avec bordure rouge pour navbar blanche */
        .navbar-white .btn-white {
            background-color: transparent;
            color: #e74c3c; /* Texte rouge */
            border-color: #e74c3c; /* Bordure rouge */
        }

        .navbar-white .btn-white:hover {
            background-color: rgba(231, 76, 60, 0.1); /* Légère teinte rouge pour le hover */
        }

        .menu-button {
            display: none;
            font-size: 20px;
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
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
            background-color: rgba(0, 0, 0, 0.9); /* Fond sombre avec opacité */
            color: white;
            z-index: 1000;
            overflow: hidden; /* Empêcher le défilement */
        }

        .overlay-menu .menu-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .overlay-menu.active {
            display: flex;
        }

        .overlay-menu a {
            margin: 15px 0;
            font-size: 24px;
            color: white;
            text-decoration: none;
        }


        @media (max-width: 800px) {

                .navbar {
                    flex-direction: row;
                    justify-content: space-between;
                    padding: 0 20px;
                }

            .menu-items {
                display: none;
            }

            .menu-button {
                display: block;
            }


        }
    </style>
</head>
<body>
<nav class="navbar navbar-transparent">
    <div class="menu-items flex space-x-6 items-center">
        <div class="logo-nav">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('logo/logo.png') }}" alt="Logo">
            </a>
        </div>
        <a href="{{ route('dashboard.index') }}" class="btn btn-red">Accueil</a>
        @if(Auth::check())
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('employees.index') }}" class="btn btn-white">Coiffeurs</a>
                <a href="{{ route('prestations.create') }}" class="btn btn-white">Prestations</a>
                <a href="{{ route('calendar.index') }}" class="btn btn-white">Calendrier</a>
                <a href="{{ route('salon.edit') }}" class="btn btn-white">Paramétres</a>
                <a href="{{ route('absences.index') }}" class="btn btn-white">Absences</a>
                <a href="{{ route('photos.index') }}" class="btn btn-white">Photos</a>
            @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-black hover:text-gray-300">Déconnexion</button>
                </form>

        @endif

        @if(!Auth::check())
            <a href="{{ route('appointments.create') }}" class="btn btn-red">Prendez rendez-vous</a>
            <a href="{{ route('register') }}" class="btn btn-white">Créer un compte</a>
            <a href="{{ route('login') }}" class="btn btn-white">Se connecter</a>
        @endauth
    </div>
    <button class="menu-button btn btn-red" id="menuButton">Menu</button>
</nav>

<nav class="navbar navbar-white">
    <div class="menu-items flex space-x-8 items-center">
        <div class="logo-nav">
            <a href="{{ route('dashboard.index') }}">
                <img src="{{ asset('logo/logo.png') }}" alt="Logo">
            </a>
        </div>
        <a href="{{ route('dashboard.index') }}" class="text-black hover:text-gray-300">Accueil</a>
        @if(Auth::check())
            @if(Auth::user()->role == 'admin')
                <a href="{{ route('employees.index') }}" class="text-black hover:text-gray-300">Coiffeurs</a>
                <a href="{{ route('prestations.create') }}" class="text-black hover:text-gray-300">Prestations</a>
                <a href="{{ route('calendar.index') }}" class="text-black hover:text-gray-300">Calendrier</a>
                <a href="{{ route('salon.edit') }}" class="text-black hover:text-gray-300">Paramétres</a>
                <a href="{{ route('absences.index') }}" class="text-black hover:text-gray-300">Absences</a>
                <a href="{{ route('photos.index') }}" class="text-black hover:text-gray-300">Photos</a>
            @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-black hover:text-gray-300">Déconnexion</button>
                </form>

        @endif
        @if(!Auth::check())
            <a href="{{ route('register') }}" class="btn btn-red">Prendez rendez-vous</a>
            <a href="{{ route('register') }}" class="btn btn-white">Créer un compte</a>
            <a href="{{ route('login') }}" class="btn btn-white">Se connecter</a>
        @endauth
    </div>
    <button class="menu-button btn btn-red" id="menuButton">Menu</button>
</nav>

<div class="overlay-menu" id="overlayMenu">
    <button class="menu-button btn btn-red" id="closeButton">Fermer</button>
    <a href="{{ route('dashboard.index') }}" class="text-black hover:text-gray-300">Accueil</a>
    @if(Auth::check())
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('employees.index') }}" class="text-black hover:text-gray-300">Coiffeurs</a>
            <a href="{{ route('prestations.create') }}" class="text-black hover:text-gray-300">Prestations</a>
            <a href="{{ route('calendar.index') }}" class="text-black hover:text-gray-300">Calendrier</a>
            <a href="{{ route('salon.edit') }}" class="text-black hover:text-gray-300">Paramétres</a>
            <a href="{{ route('absences.index') }}" class="text-black hover:text-gray-300">Absences</a>
            <a href="{{ route('photos.index') }}" class="text-black hover:text-gray-300">Photos</a>
        @endif
    @endif
    @if(!Auth::check())
        <a href="{{ route('register') }}" class="btn btn-red">Prendez rendez-vous</a>
        <a href="{{ route('register') }}" class="btn btn-white">Créer un compte</a>
        <a href="{{ route('login') }}" class="btn btn-white">Se connecter</a>
    @endauth
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbarTransparent = document.querySelector('.navbar-transparent');
        const navbarWhite = document.querySelector('.navbar-white');
        const menuButton = document.getElementById('menuButton');
        const closeButton = document.getElementById('closeButton');
        const overlayMenu = document.getElementById('overlayMenu');
        let lastScrollTop = 0;
        const scrollThreshold = 100; // Nombre de pixels de défilement avant de cacher le menu

        function handleScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > scrollThreshold) {
                if (scrollTop > lastScrollTop) {
                    // Scrolling down après avoir dépassé le seuil
                    navbarWhite.style.opacity = '0';
                    navbarWhite.style.pointerEvents = 'none';
                } else {
                    // Scrolling up après avoir dépassé le seuil
                    navbarWhite.style.opacity = '1';
                    navbarWhite.style.pointerEvents = 'auto';
                }
            }

            if (scrollTop === 0) {
                // Retour en haut
                navbarTransparent.style.opacity = '1';
                navbarWhite.style.opacity = '0';
                navbarWhite.style.pointerEvents = 'none';
            } else if (scrollTop > 0 && scrollTop <= scrollThreshold) {
                navbarTransparent.style.opacity = '1';
                navbarWhite.style.opacity = '0';
                navbarWhite.style.pointerEvents = 'none';
            } else {
                navbarTransparent.style.opacity = '0';
            }

            lastScrollTop = scrollTop;
        }

        // Appeler handleScroll au chargement de la page pour définir l'état initial
        handleScroll();

        // Ajouter l'écouteur de défilement
        window.addEventListener('scroll', handleScroll);

        // Gérer le clic du bouton menu
        menuButton.addEventListener('click', () => {
            overlayMenu.classList.add('active');
            document.body.style.overflow = 'hidden'; // Désactiver le défilement
            menuButton.style.display = 'none';
            closeButton.style.display = 'block';
        });

        // Gérer le clic du bouton fermer
        closeButton.addEventListener('click', () => {
            overlayMenu.classList.remove('active');
            document.body.style.overflow = 'auto'; // Réactiver le défilement
            menuButton.style.display = 'block';
            closeButton.style.display = 'none';
        });

        // Fermer le menu responsive automatiquement lorsqu'on n'est pas en mode responsive
        window.addEventListener('resize', () => {
            if (window.innerWidth > 800) {
                overlayMenu.classList.remove('active');
                document.body.style.overflow = 'auto'; // Réactiver le défilement
                menuButton.style.display = 'none'; // S'assurer que le bouton "Menu" est masqué en mode desktop
                closeButton.style.display = 'none'; // Masquer également le bouton "Fermer"
            } else if (overlayMenu.classList.contains('active')) {
                menuButton.style.display = 'none'; // Masquer le bouton Menu si le menu est actif
                closeButton.style.display = 'block'; // Afficher le bouton Fermer si le menu est actif
            } else {
                menuButton.style.display = 'block'; // Afficher le bouton Menu en mode responsive si le menu n'est pas actif
                closeButton.style.display = 'none'; // Masquer le bouton Fermer si le menu n'est pas actif
            }
        });

        // Initial check on page load
        if (window.innerWidth > 800) {
            menuButton.style.display = 'none';
            closeButton.style.display = 'none';
        }
    });


</script>
</body>
</html>
