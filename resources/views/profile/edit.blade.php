<x-app-layout>
    <style>

        .menu {
            display: flex;
            flex-direction: row;
        }

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

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
