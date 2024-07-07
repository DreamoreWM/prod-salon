
    <!-- Tes autres balises head -->
    <style>
        /* Styles ici */
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

        .burger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            height: 24px;
            width: 30px;
        }

        .burger-bar {
            height: 3px;
            width: 100%;
            background-color: #333;
        }



        /* Media query pour afficher le menu burger sur les petits écrans */
        @media (max-width: 800px) {
            .burger-menu {
                display: flex;
            }

            .menu-items {
                display: none;
            }

            .navbar {
                align-items: flex-start;
            }


            .btn.btn-red {
                padding: 8px 8px !important;
                top: 50px !important;
                right: auto;
                font-size: 13px !important;
                position: static;
                margin-top: 20px;
            }

        }

    </style>

    <nav class="navbar navbar-transparent">

        <div class="flex space-x-6 items-center menu-items">
            <div class="logo">
                <a href="{{ route('dashboard.index') }}">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="h-10 w-auto m-5">
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
                    <form method="POST" action="logout">
                        @csrf
                        <a href="logout" class="text-black hover:text-gray-300"
                           onclick="event.preventDefault(); this.closest('form').submit();">Déconnexion</a>
                    </form>
                @endif
            @endif

            @if(!Auth::check())
                <a href="{{ route('appointments.create') }}" class="btn btn-red">Prendez rendez-vous</a>
                <a href="{{ route('register') }}" class="btn btn-white">Créer un compte</a>
                <a href="{{ route('login') }}" class="btn btn-white">Se connecter</a>
            @endauth
        </div>
        <div class="burger-menu" style="display: none; cursor: pointer;">
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
        </div>
    </nav>

    <nav class="navbar navbar-white">
        <div class="flex space-x-8 items-center menu-items">

            <div class="logo">
                <a href="{{ route('dashboard.index') }}">
                    <img src="{{ asset('logo/logo.png') }}" alt="Logo" class="h-10 w-auto m-5">
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
            @endif
            <a href="{{ route('prestations.create') }}" class="btn btn-red">Commander</a>
            <a href="{{ route('register') }}" class="btn btn-white">Créer un compte</a>
            <a href="{{ route('login') }}" class="btn btn-white">Se connecter</a>
        </div>
        <div class="burger-menu" style="display: none; cursor: pointer;">
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
        </div>
    </nav>

    <!-- Le reste du contenu de ta page -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarTransparent = document.querySelector('.navbar-transparent');
            const navbarWhite = document.querySelector('.navbar-white');
            let lastScrollTop = 0;
            const scrollThreshold = 100; // Nombre de pixels de défilement avant de cacher le menu

            function handleScroll() {

                if (window.innerWidth <= 768) {
                    navbarTransparent.style.opacity = '1';
                    navbarWhite.style.opacity = '0';
                    navbarWhite.style.pointerEvents = 'none';
                    return; // Ne pas appliquer le comportement de défilement sur les petits écrans
                }

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
        });
    </script>





