<link rel="stylesheet" href="fontawesome/css/all.min.css">
<link rel="stylesheet" href="css/templatemo-style.css">

<style>
    .contact-details p {
        margin: 0;
        padding: 10px 0;
    }

    .contact-details i {
        margin-right: 10px;
    }

    @media (max-width: 600px) {
        .contact-details p {
            font-size: 20px;
        }
    }

    .logo {
        max-width: 200px;
    }

    .menu {
        display: flex;
        flex-direction: row;
    }

    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap');

    @font-face {
        font-family: 'Denver-Broncos-Custom';
        src:url('/font/Denver-Broncos-Custom.ttf.woff') format('woff'),
        url('/font/Denver-Broncos-Custom.ttf.svg#Denver-Broncos-Custom') format('svg'),
        url('/font/Denver-Broncos-Custom.ttf.eot'),
        url('/font/Denver-Broncos-Custom.ttf.eot?#iefix') format('embedded-opentype');
        font-weight: normal;
        font-style: normal;
    }


    @font-face {
        font-family: 'YourFontName';
        src: url('/font/BillionDreams_PERSONAL.ttf') format('truetype');
    }

    .slogan {
        font-family: 'Montserrat', sans-serif;
        font-size: 65px;
        color: white;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Ajoute une ombre noire légère */
    }



    .map-responsive iframe {
        left:0;
        top:0;
        height:100%;
        width:100%;
    }

    .btn-booking {
        position: relative;
        display: inline-block;
        padding: 12px 36px;
        margin: 10px 0;
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 18px;
        letter-spacing: 2px;
        overflow: hidden;
        background: linear-gradient(90deg,#0162c8,#55e7fc);
    }

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


    .effect{
        position: absolute;
        background: #fff;
        transform: translate(-50%, -50%);
        pointer-events: none;
        border-radius: 50%;
        animation: animate 1s linear infinite;
    }

    @keyframes animate {
        0%{
            width: 0px;
            height: 0px;
            opacity: 0.5;
        }
        100%{
            width: 500px;
            height: 500px;
            opacity: 0;
        }
    }

    .home {
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%; /* Change this */
    }

    section {
        width: 100vw;
    }

    .portfolio {
        justify-content: center;
        align-items: center;
        background-color: {{ $background_color }};
        background-size: cover; /* Couvre toute la zone disponible sans redimensionner l'image */
        background-position: center;
        background-repeat: no-repeat; /* Empêche la répétition de l'image */
        background-attachment: fixed;
    }

    .prestation {
        background-size: cover; /* Couvre toute la zone disponible sans redimensionner l'image */
        background-repeat: no-repeat; /* Empêche la répétition de l'image */
        background-attachment: fixed;
        justify-content: center;
        align-items: center;
    }

    .review {
        justify-content: center;
        align-items: center;
    }

    .info {
        justify-content: center;
        align-items: center;
    }

    .photo {
        margin-bottom: -15px;
    }

    .gsi-material-button {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        -webkit-appearance: none;
        background-color: WHITE;
        background-image: none;
        border: 1px solid #747775;
        -webkit-border-radius: 20px;
        border-radius: 20px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        color: #1f1f1f;
        cursor: pointer;
        font-family: 'Roboto', arial, sans-serif;
        font-size: 14px;
        height: 40px;
        letter-spacing: 0.25px;
        outline: none;
        overflow: hidden;
        padding: 0 12px;
        position: relative;
        text-align: center;
        -webkit-transition: background-color .218s, border-color .218s, box-shadow .218s;
        transition: background-color .218s, border-color .218s, box-shadow .218s;
        vertical-align: middle;
        white-space: nowrap;
        width: auto;
        max-width: 400px;
        min-width: min-content;
    }

    .gsi-material-button .gsi-material-button-icon {
        height: 20px;
        margin-right: 12px;
        min-width: 20px;
        width: 20px;
    }

    .gsi-material-button .gsi-material-button-content-wrapper {
        -webkit-align-items: center;
        align-items: center;
        display: flex;
        -webkit-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: nowrap;
        flex-wrap: nowrap;
        height: 100%;
        justify-content: space-between;
        position: relative;
        width: 100%;
    }

    .gsi-material-button .gsi-material-button-contents {
        -webkit-flex-grow: 1;
        flex-grow: 1;
        font-family: 'Roboto', arial, sans-serif;
        font-weight: 500;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: top;
    }

    .gsi-material-button .gsi-material-button-state {
        -webkit-transition: opacity .218s;
        transition: opacity .218s;
        bottom: 0;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    .gsi-material-button:disabled {
        cursor: default;
        background-color: #ffffff61;
        border-color: #1f1f1f1f;
    }

    .gsi-material-button:disabled .gsi-material-button-contents {
        opacity: 38%;
    }

    .gsi-material-button:disabled .gsi-material-button-icon {
        opacity: 38%;
    }

    .gsi-material-button:not(:disabled):active .gsi-material-button-state,
    .gsi-material-button:not(:disabled):focus .gsi-material-button-state {
        background-color: #303030;
        opacity: 12%;
    }

    .gsi-material-button:not(:disabled):hover {
        -webkit-box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
        box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
    }

    .gsi-material-button:not(:disabled):hover .gsi-material-button-state {
        background-color: #303030;
        opacity: 8%;
    }




    .menu-bar {
        border-radius: 25px;
        height: fit-content;
        display: inline-flex;
        background-color: rgba(0, 0, 0, 0.4);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        align-items: center;
        margin: 50px 0 0 0;
        font-size: large;
    }
    .menu-bar li {
        list-style: none;
        color: white;
        font-family: sans-serif;
        font-weight: bold;
        padding: 12px 16px;
        margin: 0 8px;
        position: relative;
        cursor: pointer;
        white-space: nowrap;
    }
    .menu-bar li::before {
        content: " ";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: -1;
        transition: 0.2s;
        border-radius: 25px;
    }
    .menu-bar li:hover {
        color: black;
    }
    .menu-bar li:hover::before {
        background: linear-gradient(to bottom, #e8edec, #d2d1d3);
        box-shadow: 0px 3px 20px 0px black;
        transform: scale(1.2);
    }

    .content-home {
        padding-top: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('{{ asset('background/' . $backgroundImage) }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
    }

    .main-div {
        width: 80%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        width: 30%; /* Ajustez selon la taille du logo désirée */
        height: auto;
        margin-bottom: 20px;
    }

    .slogan, .status {
        text-align: center;
        margin-bottom: 20px;
    }

    .status {
        font-size: 2rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .status-open {
        color: #37ed37;
    }

    .status-closed {
        color: red;
    }

    .status-break {
        color: orange;
    }

    .status-open, .status-closed, .status-break {
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        margin: 0;
    }

    .status-info {
        font-size: 1.2rem;
        text-align: center;
        color: white;
        margin-top: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .btn-on-image {
        padding: 1% 2%;
        background-color: #e74c3c;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1.5vw;
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        margin: 20px 0;
        font-size: 30px;
    }

    .review-card-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 450px;
        height: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 20px 0;
        border-radius: 10px;
        background-color: white;
    }

    .review-slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: 100%;
        border-radius: 10px;
    }

    .review-slide {
        min-width: 100%;
        box-sizing: border-box;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
    }

    .review-slide h4 {
        margin: 0 0 10px;
        font-size: 24px;
        color: #FFD700;
        position: relative;
        top: 10px;
    }

    .review-slide p {
        margin: 15px 0 5px;
        font-size: 16px;
        color: #333;
    }

    .slider-controls {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
    }

    .slider-controls button {
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
        color: white;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .slider-controls button:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Responsive design pour les petits écrans */
    @media (max-width: 1300px) {
        .slogan {
            font-size: 45px;
        }
    }

    @media (max-width: 850px) {
        .main-div {
            width: 90%;
        }

        .slogan {
            font-size: 35px;
        }

        .review-card-container {
            max-width: 90%;
        }
    }


</style>
<style>
    .swiper {
        width: 600px;
        height: 300px;
    }

    .swiper-button-next {
        margin-left: 10px; /* Ajustez cette valeur selon vos besoins */
    }

    .swiper-button-prev {
        margin-right: 10px; /* Ajustez cette valeur selon vos besoins */
    }
</style>

<style>
    .hidden {
        opacity: 0;
    }

    .console-container {
        text-align: center;
        display: flex;
        color: white;
        margin: auto;
        font-family: inherit; /* Utilise la police par défaut définie dans votre projet */
    }

</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<x-app-layout>






    <div class="content-home">
        <div class="main-div">
            <div class="slogan console-container">
                <span id="text"></span>
            </div>


            <div class="status" data-aos="fade-down" data-aos-duration="1200">
                @if ($isOpen)
                    <p class="status-open">OUVERT</p>
                    <p class="status-info" style="color: #92ee53; font-weight:bold ">Horaires d'aujourd'hui : {{ $openingTime->format('H:i') }} - {{ $breakStart->format('H:i') }} et {{ $breakEnd->format('H:i') }} - {{ $closingTime->format('H:i') }}</p>
                @elseif($isOnBreak)
                    <p class="status-break">PAUSE</p>
                    <p class="status-info" style="color: #eeca28; font-weight:bold ">Reprise aujourd'hui à : {{ $breakEnd->format('H:i') }}</p>
                @else
                    <p class="status-closed">FERMÉ</p>
                    <p class="status-info" style="color: #ee3211; font-weight:bold ">Prochaine ouverture : {{ $nextOpeningTime ? $nextOpeningDayFrench . ' ' . $nextOpeningTime->format('H:i') : 'N/A' }}</p>
                @endif
            </div>

            <a href="{{ route('appointments.create') }}" class="btn-on-image">
                Prendre Rendez-Vous <!-- Bouton rendez-vous -->
            </a>

            <div class="review-card-container" data-aos="fade-up" data-aos-duration="1200">
                <div class="review-slider">
                    @foreach($reviews as $review)
                        <div class="review-slide {{ $loop->first ? 'active' : '' }}">
                            <h4>
                                @for ($i = 0; $i < $review->rating; $i++)
                                    ⭐️
                                @endfor
                            </h4>
                            <p>"{{ $review->comment }}"</p>
                            <p>- {{ $review->appointment->bookable->name }}</p>
                            <div class="image-slider" style="padding-bottom: 5px">
                                @if(optional($review->photo))
                                    @foreach($review->photo as $photo)
                                        <div class="photo">
                                            <img src="{{ asset('storage/app/public/' . $photo->filename) }}" alt="Photo de la revue" class="review-image" onclick="showImage(this)">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>



    <div class="prestation">
            <section>
                <div class="mx-auto max-w-screen-lg px-4 lg:px-12">
                    <div class="mb-4 d-flex justify-content-center">
                        <div class="col pb-10">
                            <h2 class=" p-10 text-center" style="font-size: 40px; font-family: 'Montserrat', sans-serif">Nos tarifs</h2>
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-6" data-aos="fade-up" data-aos-duration="1200">
                                        <div class="card mt-4 border-0 bg-transparent">
                                            <div class="card-header bg-transparent">
                                                <h3 class="text-left font-bold">{{ strtoupper($category->name) }}</h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach($category->prestations as $prestation)
                                                    <p class="d-flex justify-content-between">
                                                        <span>{{ $prestation->nom }}</span>
                                                        <span>{{ $prestation->prix }} EUR</span>
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="portfolio">

            <h2 class=" p-10 text-center" style="font-size: 40px;  color: white; font-family: 'Montserrat', sans-serif">Nos réalisations</h2>
            <div class="container-fluid tm-container-content" >
                <div class="row tm-gallery pt-5 pb-5" style="justify-content: center !important">
                        <div class="swiper" data-aos="fade-down" data-aos-duration="1200">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                @foreach($photos as $photo)
                                    <div class="swiper-slide">
                                        <figure class="effect-ming tm-video-item">
                                            <img src="{{ asset('storage/app/public/' . $photo->path) }}" onclick="showImage(this)" alt="Image" class="img-fluid" style="width: 100%; height: 260px; object-fit: cover;">
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                            <!-- If we need scrollbar -->
                            <div class="swiper-scrollbar"></div>
                        </div>
                </div> <!-- row -->
            </div>
        </div>

        <div class="info" style="padding-bottom: 30px">
            <section>
                <h2 class=" p-10 text-center" style="font-size: 40px; font-family: 'Montserrat', sans-serif">Nos coordonnées</h2>
                <div class="mx-auto max-w-screen-lg px-4 lg:px-12">
                    <div class="mb-4">
                        <div class="col">
                            <div class="contact-details text-center">
                                <p style="font-size: 24px; color: #333;">
                                    <i class="fas fa-map-marker-alt" style="color: #e74c3c;"></i> {{$address}}
                                </p>
                                <p style="font-size: 24px; color: #333;">
                                    <i class="fas fa-phone" style="color: #e74c3c;"></i> +33 1 23 45 67 89
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-6" >
                                                <iframe src="https://maps.google.com/maps?q={{$address}}&output=embed" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                </div>

                                <div class="col-md-6">
                                    @if(!empty($facebookPageUrl))
                                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F{{$facebookPageUrl}}&amp;locale%3Dfr_FR&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"  data-adapt-container-width="true" width="100%" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>                                    @else
                                        <p>Facebook page URL is not set.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Structure de la modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire de Connexion -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Adresse Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Se souvenir de moi</label>
                            </div>
                            <div class="buttons-container d-flex justify-content-between">
                                <button class="btn btn-primary">Se connecter</button>
                            </div>
                        </form>
                        <button class="btn btn-primary" onclick="location.href='{{ route('register') }}'">S'incrire</button>
                    </div>
                </div>
            </div>
        </div>

        <footer style="background-color: #767473; padding: 10px; text-align: center; border-top: 1px solid #e7e7e7;">
            <div style="margin-bottom: 20px;">
                <a href="/about" style="margin-right: 15px; text-decoration: none; color: #FFFFFF;">À propos</a>
                <a href="/services" style="margin-right: 15px; text-decoration: none; color: #FFFFFF;">Services</a>
                <a href="/contact" style="text-decoration: none; color: #FFFFFF;">Contact</a>
                <a href="/confidentiality" style="text-decoration: none; color: #FFFFFF;">Régles de confidentialités</a>
            </div>
            <div>
                <p style="margin: 0; color: #E2E2E2;">© 2024 MonSiteWeb. Tous droits réservés.</p>
                <p style="margin: 0; color: #E2E2E2;">contact@monsiteweb.com | +33 1 23 45 67 89</p>
            </div>
        </footer>

    <script>
        function consoleText(words, id, colors) {
            if (colors === undefined) colors = ['#fff'];
            var visible = true;
            var con = document.getElementById('console');
            var letterCount = 1;
            var x = 1;
            var waiting = false;
            var target = document.getElementById(id);
            target.setAttribute('style', 'color:' + colors[0]);

            window.setInterval(function() {
                if (waiting === false) {
                    target.innerHTML = words[0].substring(0, letterCount);
                    letterCount += x;
                }
            }, 30);
        }

        // Appelez la fonction consoleText avec le slogan
        document.addEventListener("DOMContentLoaded", function() {
            consoleText(['{{ $slogan }}'], 'text', ['#fff']);
        });
    </script>

    <script>
        $(document).ready(function(){
            let currentIndex = 0;
            const slides = $('.review-slide');
            const totalSlides = slides.length;
            const intervalTime = 2500; // Temps en millisecondes entre chaque défilement automatique

            // Fonction pour passer au slide suivant
            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            }

            // Fonction pour passer au slide précédent
            $('.next').click(function() {
                nextSlide();
            });

            $('.prev').click(function() {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSlider();
            });

            // Fonction pour mettre à jour la position du slider
            function updateSlider() {
                const offset = -currentIndex * 100 + '%';
                $('.review-slider').css('transform', 'translateX(' + offset + ')');
            }

            // Défilement automatique des slides
            setInterval(function() {
                nextSlide();
            }, intervalTime);
        });
    </script>



    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },

            effect: 'coverflow',

            slidesPerView: 3, // Adjust this value according to your needs

            // Enable centered slides
            centeredSlides: true,

            // Customize the coverflow effect
            coverflowEffect: {
                rotate: 50, // Slide rotate in degrees
                stretch: 0, // Stretch space between slides (in px)
                depth: 100, // Depth offset in px (slides translate in Z axis)
                modifier: 1, // Effect multipler
                slideShadows: true, // Enables slides shadows
            },
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>






</x-app-layout>

