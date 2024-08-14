{{-- Vue Blade pour prendre un rendez-vous --}}
@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800  leading-tight">
        {{ __('Prise de rendez-vous') }}
    </h2>
@endsection

@section('content')
    <livewire:reservation-component/>
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <script>
        const swiperEl = document.querySelector('swiper-container');
        const buttonEl = document.querySelector('button');

        buttonEl.addEventListener('click', () => {
            swiperEl.swiper.slideNext();
        });


    </script>

    <script>
        // Définir une variable JavaScript pour savoir si l'utilisateur est connecté
        var isUserLoggedIn = @json(Auth::check());
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dictionnaire de traduction des jours
            const daysOfWeek = {
                'Monday': 'Lundi',
                'Tuesday': 'Mardi',
                'Wednesday': 'Mercredi',
                'Thursday': 'Jeudi',
                'Friday': 'Vendredi',
                'Saturday': 'Samedi',
                'Sunday': 'Dimanche'
            };

            // Dictionnaire de traduction des mois
            const monthsOfYear = {
                'Jan': 'Janv',
                'Feb': 'Févr',
                'Mar': 'Mars',
                'Apr': 'Avr',
                'May': 'Mai',
                'Jun': 'Juin',
                'Jul': 'Juil',
                'Aug': 'Août',
                'Sep': 'Sept',
                'Oct': 'Oct',
                'Nov': 'Nov',
                'Dec': 'Déc'
            };

            // Fonction pour traduire les jours et les mois
            function translateDates() {
                // Traduire les jours de la semaine
                const dayElements = document.querySelectorAll('.day h5:first-child');
                dayElements.forEach(function(element) {
                    let dayText = element.textContent.trim();
                    if (daysOfWeek[dayText]) {
                        element.textContent = daysOfWeek[dayText];
                    }
                });

                // Traduire les mois
                const monthElements = document.querySelectorAll('.day h5:last-child');
                monthElements.forEach(function(element) {
                    let [day, month] = element.textContent.split(' ');
                    if (monthsOfYear[month]) {
                        element.textContent = `${day} ${monthsOfYear[month]}`;
                    }
                });
            }

            // Observer les changements dans le DOM
            const observer = new MutationObserver(translateDates);

            // Configurer l'observer pour observer les changements dans le body
            observer.observe(document.body, { childList: true, subtree: true });

            // Appeler la fonction de traduction initialement pour s'assurer que tout est correct si déjà rendu
            translateDates();
        });
    </script>






@endsection
