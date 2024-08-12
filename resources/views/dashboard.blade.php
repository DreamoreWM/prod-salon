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
        font-family: 'YourFontName';
        font-size: 65px;
        color: white;
        text-align: center;
        margin-top: 10px;
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

    .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-image: url('{{ asset('background/' . $backgroundImage) }}');
        background-size: cover; /* Couvre toute la zone disponible sans redimensionner l'image */
        background-position: center;
        background-repeat: no-repeat; /* Empêche la répétition de l'image */ /* Définissez une hauteur fixe ou utilisez flexbox/grid pour définir la hauteur */
        margin: 0; /* Reset margin */
        padding: 0;
        height: 100vh;
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

    .content-wrapper {
        display: flex;
        justify-content: space-between;
        width: 80%;
        max-width: 75vw;
    }

    .left-section,
    .right-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 50%;
    }

    @media (max-width: 1500px){
        .logo {
            max-width: 150px;
        }

        .slogan {
            font-size: 60px;
        }

        .content-wrapper {
            width: 100%;
        }
    }


    @media (max-width: 1100px){
        .content-wrapper {
            flex-direction: column;
            align-items: center;
        }

        .left-section{
            padding-top: 4em
        }

        .left-section,
        .right-section {
            width: 80% !important;
        }

        .slogan {
            margin-top: 300px;
        }

    }

    @media (max-width: 800px){
        .content-wrapper {
            max-width: 100vw;
        }

        .left-section,
        .right-section {
            width: 100% !important;
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
    @media (max-width: 1100px) {
        .flex-container {
            flex-direction: column;
        }

        .logo {
            max-width: 100px;
        }

        .slogan {
            font-size: 50px;
        }

        .icon-web {
            padding-top: 200px;
        }
    }
</style>

<style>
    @import url(https://fonts.googleapis.com/css?family=Ek+Mukta:200);

    .menu-responsive {
        position: relative;
        display: block;
        width: 360px;
        height: 567px;
        margin: 10px auto 0;
        box-shadow: 0 0 65px 15px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        border-radius: 3px;
        background: #F1F1F1;
    }
    .menu-responsive .header {
        position: absolute;
        display: block;
        top: 0;
        left: 0;
        height: 50px;
        width: 100%;
        background: rgba(0, 0, 0, 0.8);
        overflow: hidden;
        -webkit-transition: all 0.5s ease-out, background 1s ease-out;
        transition: all 0.5s ease-out, background 1s ease-out;
        -webkit-transition-delay: 0.2s;
        transition-delay: 0.2s;
        z-index: 1;
    }
    .menu-responsive .header .burger-container {
        position: relative;
        display: inline-block;
        height: 50px;
        width: 50px;
        cursor: pointer;
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
        -webkit-transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }
    .menu-responsive .header .burger-container #burger {
        width: 18px;
        height: 8px;
        position: relative;
        display: block;
        margin: -4px auto 0;
        top: 50%;
    }
    .menu-responsive .header .burger-container #burger .bar {
        width: 100%;
        height: 1px;
        display: block;
        position: relative;
        background: #FFF;
        -webkit-transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: all 0.3s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        -webkit-transition-delay: 0s;
        transition-delay: 0s;
    }
    .menu-responsive .header .burger-container #burger .bar.topBar {
        -webkit-transform: translateY(0px) rotate(0deg);
        transform: translateY(0px) rotate(0deg);
    }
    .menu-responsive .header .burger-container #burger .bar.btmBar {
        -webkit-transform: translateY(6px) rotate(0deg);
        transform: translateY(6px) rotate(0deg);
    }
    .menu-responsive .header .icon {
        display: inline-block;
        position: absolute;
        height: 100%;
        line-height: 50px;
        width: 50px;
        height: 50px;
        text-align: center;
        color: #FFF;
        font-size: 22px;
        left: 50%;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }
    .menu-responsive .header .icon.icon-bag {
        right: 0;
        top: 0;
        left: auto;
        -webkit-transform: translateX(0px);
        transform: translateX(0px);
        -webkit-transition: -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        -webkit-transition-delay: 0.65s;
        transition-delay: 0.65s;
    }
    .menu-responsive .header ul.menu {
        position: relative;
        display: block;
        padding: 0px 48px 0;
        list-style: none;
    }
    .menu-responsive .header ul.menu li.menu-item {
        border-bottom: 1px solid #333;
        margin-top: 5px;
        -webkit-transform: scale(1.15) translateY(-30px);
        transform: scale(1.15) translateY(-30px);
        opacity: 0;
        -webkit-transition: opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99), opacity 0.6s cubic-bezier(0.4, 0.01, 0.165, 0.99), -webkit-transform 0.5s cubic-bezier(0.4, 0.01, 0.165, 0.99);
    }
    .menu-responsive .header ul.menu li.menu-item:nth-child(1) {
        -webkit-transition-delay: 0.49s;
        transition-delay: 0.49s;
    }
    .menu-responsive .header ul.menu li.menu-item:nth-child(2) {
        -webkit-transition-delay: 0.42s;
        transition-delay: 0.42s;
    }
    .menu-responsive .header ul.menu li.menu-item:nth-child(3) {
        -webkit-transition-delay: 0.35s;
        transition-delay: 0.35s;
    }
    .menu-responsive .header ul.menu li.menu-item:nth-child(4) {
        -webkit-transition-delay: 0.28s;
        transition-delay: 0.28s;
    }
    .menu-responsive .header ul.menu li.menu-item:nth-child(5) {
        -webkit-transition-delay: 0.21s;
        transition-delay: 0.21s;
    }
    .menu-responsive .header ul.menu li.menu-item:nth-child(6) {
        -webkit-transition-delay: 0.14s;
        transition-delay: 0.14s;
    }
    .menu-responsive .header ul.menu li.menu-item:nth-child(7) {
        -webkit-transition-delay: 0.07s;
        transition-delay: 0.07s;
    }
    .menu-responsive .header ul.menu li.menu-item a {
        display: block;
        position: relative;
        color: #FFF;
        font-family: "Ek Mukta", sans-serif;
        font-weight: 100;
        text-decoration: none;
        font-size: 22px;
        line-height: 2.35;
        font-weight: 200;
        width: 100%;
    }
    .menu-responsive .header.menu-opened {
        height: 100%;
        background-color: #000;
        -webkit-transition: all 0.3s ease-in, background 0.5s ease-in;
        transition: all 0.3s ease-in, background 0.5s ease-in;
        -webkit-transition-delay: 0.25s;
        transition-delay: 0.25s;
    }
    .menu-responsive .header.menu-opened .burger-container {
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    .menu-responsive .header.menu-opened .burger-container #burger .bar {
        -webkit-transition: all 0.4s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        transition: all 0.4s cubic-bezier(0.4, 0.01, 0.165, 0.99);
        -webkit-transition-delay: 0.2s;
        transition-delay: 0.2s;
    }
    .menu-responsive .header.menu-opened .burger-container #burger .bar.topBar {
        -webkit-transform: translateY(4px) rotate(45deg);
        transform: translateY(4px) rotate(45deg);
    }
    .menu-responsive .header.menu-opened .burger-container #burger .bar.btmBar {
        -webkit-transform: translateY(3px) rotate(-45deg);
        transform: translateY(3px) rotate(-45deg);
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item {
        -webkit-transform: scale(1) translateY(0px);
        transform: scale(1) translateY(0px);
        opacity: 1;
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item:nth-child(1) {
        -webkit-transition-delay: 0.27s;
        transition-delay: 0.27s;
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item:nth-child(2) {
        -webkit-transition-delay: 0.34s;
        transition-delay: 0.34s;
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item:nth-child(3) {
        -webkit-transition-delay: 0.41s;
        transition-delay: 0.41s;
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item:nth-child(4) {
        -webkit-transition-delay: 0.48s;
        transition-delay: 0.48s;
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item:nth-child(5) {
        -webkit-transition-delay: 0.55s;
        transition-delay: 0.55s;
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item:nth-child(6) {
        -webkit-transition-delay: 0.62s;
        transition-delay: 0.62s;
    }
    .menu-responsive .header.menu-opened ul.menu li.menu-item:nth-child(7) {
        -webkit-transition-delay: 0.69s;
        transition-delay: 0.69s;
    }
    .menu-responsive .header.menu-opened .icon.icon-bag {
        -webkit-transform: translateX(75px);
        transform: translateX(75px);
        -webkit-transition-delay: 0.3s;
        transition-delay: 0.3s;
    }
    .menu-responsive .content {
        font-family: "Ek Mukta", sans-serif;
        padding: 67px 4% 0;
        text-align: justify;
        overflow: scroll;
        max-height: 100%;
    }
    .menu-responsive .content::-webkit-scrollbar {
        display: none;
    }
    .menu-responsive .content h2 {
        margin-bottom: 0px;
        letter-spacing: 1px;
    }
    .menu-responsive .content img {
        width: 95%;
        position: relative;
        display: block;
        margin: 75px auto 75px;
    }
    .menu-responsive .content img:nth-of-type(2) {
        margin: 75px auto;
    }

    .menu-responsive {
        display: none;
    }
    @media (max-width: 1050px) {
        .menu-responsive {
            display: block;
            width: 100%;
            margin: 0;
            border-radius: 0px;
        }
        .menu-responsive .header {
            position: fixed;
        }

        .menu {
            display: none;
        }
    }

    .right-section {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .main-image {
        position: relative;
        z-index: 2; /* Place la première image au-dessus */
    }

    .overlay-image {
        position: absolute;
        top: 0;
        right: 0;
        max-width: 55%; /* Ajustez la taille de l'image selon vos besoins */ /* Ajoutez un peu de marge pour un meilleur espacement */
        z-index: 1; /* Place la nouvelle image derrière */
        margin-right: 30px; /* Ajoutez un peu de marge pour un meilleur espacement */
        margin-top: 55px;
    }

    .review-card-container {
        position: relative;
        width: 80%; /* Ajustez la largeur selon vos besoins */
        margin-top: -150px; /* Espace négatif pour coller à la première image */
        z-index: 3; /* Place cette div au-dessus de la première image si besoin */
        padding-bottom: 150px;
    }

    .review-card {
        padding: 20px; /* Ajoutez de l'espace intérieur */
    }

    @media (max-width: 599px) {
        .btn-home{
            padding: 12px 12px !important;
            top: 50px !important;
            right: 20px !important;
            font-size: 13px !important;
            position: static;
        }
    }

    /* Appareils moyens (tablettes en mode portrait, 600px à 767px) */
    @media (min-width: 600px) and (max-width: 767px) {
        .btn-home{
            top: 30px !important;
        }
    }

    /* Appareils larges (tablettes en mode paysage, petits ordinateurs portables, 768px à 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .btn-home{
            top: 50px !important;
        }
    }

    /* Appareils extra-larges (ordinateurs portables et de bureau, 992px à 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
        .btn-home{
            top: 80px !important;
        }
    }

    /* Appareils ultra-larges (grands écrans de bureau, 1200px et plus) */
    @media (min-width: 1200px) {
        .btn-home{
            top: 80px !important;
            right: 40px !important;
        }
    }

    .slogan {
        text-align: center;
        margin-top: 20px;
    }

    .status {
        margin-top: 20px;
    }

    .status-open, .status-closed, .status-break {
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        margin: 0;
    }

    .status-open {
        color: green;
    }

    .status-closed {
        color: red;
    }

    .status-break {
        color: yellow;
    }

    .status-info {
        font-size: 1.2rem;
        text-align: center;
        color: white;
        margin-top: 10px;
    }

    .styled-link {
        display: inline-block;
        color: #e74c3c;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        border: 2px solid #e74c3c;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .styled-link:hover {
        background-color: #e74c3c;
        color: white;
    }



</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<x-app-layout>






        <div id="content" class="content pt-10">



            <div class="py-6">
                @if(session()->has('success'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-circle"></i></button>
                    </div>
                @endif
                    <div class="home" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <div class="content-wrapper">
                            <!-- Section de gauche pour le logo et le slogan -->
                            <div class="left-section">



                                <!-- Logo -->



                                <span class="slogan">
                                    {{ $slogan }}
                                </span>
                                <div class="status">
                                    @if ($isOpen)
                                        <p class="status-open">OUVERT</p>
                                        <p class="status-info">Horaires d'aujourd'hui : {{ $openingTime->format('H:i') }} - {{ $breakStart->format('H:i') }} et {{ $breakEnd->format('H:i') }} - {{ $closingTime->format('H:i') }}</p>
                                    @elseif($isOnBreak)
                                        <p class="status-break">PAUSE</p>
                                        <p class="status-info">Reprise aujourd'hui à : <?= $breakEnd->format('H:i') ?></p>
                                    @else
                                        <p class="status-closed">FERMÉ</p>
                                        <p class="status-info">Prochaine ouverture : {{ $nextOpeningTime ? $nextOpeningDayFrench . ' ' . $nextOpeningTime->format('H:i') : 'N/A' }}</p>
                                    @endif

                                </div>
                            </div>

                            <!-- Section de droite pour l'image des avis -->
                            <div class="right-section" id="right-section">
                                <img src="{{ asset('images/home/' . $salonSetting->dashboard_image) }}" alt="Avis" class="main-image" style="max-width: 80%;">
                                <div class="review-card-container">
                                    <div class="review-card">
                                        <!-- Contenu de la carte des avis -->
                                        @include('reviews.index', ['reviews' => $reviews])
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('reviews.list') }}" class="styled-link">Voir tout les avis</a>
                                        </div>

                                    </div>


                                </div>
                                <div class="boutton-home">
                                        <a href="{{ route('appointments.create') }}" style="z-index: 10; position: absolute; top: 200px; right: 55px; font-size: 18px; padding: 12px 36px;" class="btn-home btn btn-red">
                                            Prendre Rendez-Vous
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        </div>

        <div class="prestation">
            <section>
                <div class="mx-auto max-w-screen-lg px-4 lg:px-12">
                    <div class="mb-4 d-flex justify-content-center">
                        <div class="col pb-10">
                            <h2 class=" p-10 text-center" style="font-size: 60px; font-family: 'YourFontName';">Nos tarifs</h2>
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-6">
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

            <h2 class=" p-10 text-center" style="font-size: 60px;  color: white; font-family: 'YourFontName';">Nos réalisations</h2>
            <div class="container-fluid tm-container-content" >
                <div class="row tm-gallery pt-5 pb-5" style="justify-content: center !important">
                        <div class="swiper">
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
                <h2 class=" p-10 text-center" style="font-size: 60px; font-family: 'YourFontName';">Nos coordonnées</h2>
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




    <script type="text/javascript">
        const buttons = document.querySelectorAll('.btn-booking');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;

                let ripples = document.createElement('span');
                ripples.classList.add('effect');
                ripples.style.left = x + 'px';
                ripples.style.top = y + 'px';
                this.appendChild(ripples);

                setTimeout(() => {
                    ripples.remove()
                }, 1000);
            });
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

