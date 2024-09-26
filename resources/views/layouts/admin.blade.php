<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Layanan - SMKN 1 Ciamis</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}


    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <style>
        html,
        body {
            height: 100vh;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        :root::-webkit-scrollbar {
            display: none;
        }

        :root {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .content {
            flex: 1 0 auto;
        }

        footer {
            flex-shrink: 0;
            margin-top: auto;
            background-color: #0168fa;
        }

        .navbar-collapse {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        #manualBookBtn {
            position: fixed;
            bottom: 0;
            right: 0;
            width: 5%;
            z-index: 999;
            transition: bottom 0.3s ease-in-out;
        }
    </style>

    <style>
        /*!
        * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
        * Copyright 2015 Daniel Cardoso <@DanielCardoso>
        * Licensed under MIT
        */
        .la-ball-clip-rotate-pulse,
        .la-ball-clip-rotate-pulse>div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-clip-rotate-pulse {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-clip-rotate-pulse.la-dark {
            color: #333;
        }

        .la-ball-clip-rotate-pulse>div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-clip-rotate-pulse {
            width: 32px;
            height: 32px;
        }

        .la-ball-clip-rotate-pulse>div {
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 100%;
        }

        .la-ball-clip-rotate-pulse>div:first-child {
            position: absolute;
            width: 32px;
            height: 32px;
            background: transparent;
            border-style: solid;
            border-width: 2px;
            border-right-color: transparent;
            border-left-color: transparent;
            -webkit-animation: ball-clip-rotate-pulse-rotate 1s cubic-bezier(.09, .57, .49, .9) infinite;
            -moz-animation: ball-clip-rotate-pulse-rotate 1s cubic-bezier(.09, .57, .49, .9) infinite;
            -o-animation: ball-clip-rotate-pulse-rotate 1s cubic-bezier(.09, .57, .49, .9) infinite;
            animation: ball-clip-rotate-pulse-rotate 1s cubic-bezier(.09, .57, .49, .9) infinite;
        }

        .la-ball-clip-rotate-pulse>div:last-child {
            width: 16px;
            height: 16px;
            -webkit-animation: ball-clip-rotate-pulse-scale 1s cubic-bezier(.09, .57, .49, .9) infinite;
            -moz-animation: ball-clip-rotate-pulse-scale 1s cubic-bezier(.09, .57, .49, .9) infinite;
            -o-animation: ball-clip-rotate-pulse-scale 1s cubic-bezier(.09, .57, .49, .9) infinite;
            animation: ball-clip-rotate-pulse-scale 1s cubic-bezier(.09, .57, .49, .9) infinite;
        }

        .la-ball-clip-rotate-pulse.la-sm {
            width: 16px;
            height: 16px;
        }

        .la-ball-clip-rotate-pulse.la-sm>div:first-child {
            width: 16px;
            height: 16px;
            border-width: 1px;
        }

        .la-ball-clip-rotate-pulse.la-sm>div:last-child {
            width: 8px;
            height: 8px;
        }

        .la-ball-clip-rotate-pulse.la-2x {
            width: 64px;
            height: 64px;
        }

        .la-ball-clip-rotate-pulse.la-2x>div:first-child {
            width: 64px;
            height: 64px;
            border-width: 4px;
        }

        .la-ball-clip-rotate-pulse.la-2x>div:last-child {
            width: 32px;
            height: 32px;
        }

        .la-ball-clip-rotate-pulse.la-3x {
            width: 96px;
            height: 96px;
        }

        .la-ball-clip-rotate-pulse.la-3x>div:first-child {
            width: 96px;
            height: 96px;
            border-width: 6px;
        }

        .la-ball-clip-rotate-pulse.la-3x>div:last-child {
            width: 48px;
            height: 48px;
        }

        /*
        * Animations
        */
        @-webkit-keyframes ball-clip-rotate-pulse-rotate {
            0% {
                -webkit-transform: translate(-50%, -50%) rotate(0deg);
                transform: translate(-50%, -50%) rotate(0deg);
            }

            50% {
                -webkit-transform: translate(-50%, -50%) rotate(180deg);
                transform: translate(-50%, -50%) rotate(180deg);
            }

            100% {
                -webkit-transform: translate(-50%, -50%) rotate(360deg);
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @-moz-keyframes ball-clip-rotate-pulse-rotate {
            0% {
                -moz-transform: translate(-50%, -50%) rotate(0deg);
                transform: translate(-50%, -50%) rotate(0deg);
            }

            50% {
                -moz-transform: translate(-50%, -50%) rotate(180deg);
                transform: translate(-50%, -50%) rotate(180deg);
            }

            100% {
                -moz-transform: translate(-50%, -50%) rotate(360deg);
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @-o-keyframes ball-clip-rotate-pulse-rotate {
            0% {
                -o-transform: translate(-50%, -50%) rotate(0deg);
                transform: translate(-50%, -50%) rotate(0deg);
            }

            50% {
                -o-transform: translate(-50%, -50%) rotate(180deg);
                transform: translate(-50%, -50%) rotate(180deg);
            }

            100% {
                -o-transform: translate(-50%, -50%) rotate(360deg);
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @keyframes ball-clip-rotate-pulse-rotate {
            0% {
                -webkit-transform: translate(-50%, -50%) rotate(0deg);
                -moz-transform: translate(-50%, -50%) rotate(0deg);
                -o-transform: translate(-50%, -50%) rotate(0deg);
                transform: translate(-50%, -50%) rotate(0deg);
            }

            50% {
                -webkit-transform: translate(-50%, -50%) rotate(180deg);
                -moz-transform: translate(-50%, -50%) rotate(180deg);
                -o-transform: translate(-50%, -50%) rotate(180deg);
                transform: translate(-50%, -50%) rotate(180deg);
            }

            100% {
                -webkit-transform: translate(-50%, -50%) rotate(360deg);
                -moz-transform: translate(-50%, -50%) rotate(360deg);
                -o-transform: translate(-50%, -50%) rotate(360deg);
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        @-webkit-keyframes ball-clip-rotate-pulse-scale {

            0%,
            100% {
                opacity: 1;
                -webkit-transform: translate(-50%, -50%) scale(1);
                transform: translate(-50%, -50%) scale(1);
            }

            30% {
                opacity: .3;
                -webkit-transform: translate(-50%, -50%) scale(.15);
                transform: translate(-50%, -50%) scale(.15);
            }
        }

        @-moz-keyframes ball-clip-rotate-pulse-scale {

            0%,
            100% {
                opacity: 1;
                -moz-transform: translate(-50%, -50%) scale(1);
                transform: translate(-50%, -50%) scale(1);
            }

            30% {
                opacity: .3;
                -moz-transform: translate(-50%, -50%) scale(.15);
                transform: translate(-50%, -50%) scale(.15);
            }
        }

        @-o-keyframes ball-clip-rotate-pulse-scale {

            0%,
            100% {
                opacity: 1;
                -o-transform: translate(-50%, -50%) scale(1);
                transform: translate(-50%, -50%) scale(1);
            }

            30% {
                opacity: .3;
                -o-transform: translate(-50%, -50%) scale(.15);
                transform: translate(-50%, -50%) scale(.15);
            }
        }

        @keyframes ball-clip-rotate-pulse-scale {

            0%,
            100% {
                opacity: 1;
                -webkit-transform: translate(-50%, -50%) scale(1);
                -moz-transform: translate(-50%, -50%) scale(1);
                -o-transform: translate(-50%, -50%) scale(1);
                transform: translate(-50%, -50%) scale(1);
            }

            30% {
                opacity: .3;
                -webkit-transform: translate(-50%, -50%) scale(.15);
                -moz-transform: translate(-50%, -50%) scale(.15);
                -o-transform: translate(-50%, -50%) scale(.15);
                transform: translate(-50%, -50%) scale(.15);
            }
        }

        /* Loading indicator styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent black overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
    @livewireStyles
    @stack('css')
</head>

<body class="bg-light bg-gradient">

    <x-load />

    <x-admin.nav-head />

    <div class="content mt-5 pt-2">
        @yield('content')
    </div>

    {{-- <div id="manualBookBtn" class="p-3 me-3">
        <button class="btn btn-primary d-flex align-items-center justify-content-center rounded-circle p-3"
            data-bs-toggle="modal" data-bs-target="#BookModal">
            <i class="fa-solid fa-book fs-4 text-white"></i>
        </button>
    </div> --}}

    <x-admin.footer />

    {{-- <!-- Manual Book Modal -->
    <div class="modal fade" id="BookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Manual Book</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="{{asset("manual/Manual-User.pdf")}}"
                        frameborder="0" width="100%" height="300px"></iframe>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const manualBookBtn = document.getElementById('manualBookBtn');
            const footer = document.querySelector('footer');
            const manualBookHeight = manualBookBtn.offsetHeight;

            function updateButtonPosition() {
                const footerTop = footer.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                // If the footer is in view, move the button above it
                if (footerTop < windowHeight) {
                    manualBookBtn.style.bottom = `${(windowHeight - footerTop) + 10}px`;
                } else {
                    manualBookBtn.style.bottom = '0';
                }
            }

            // Call the function on load and when the user scrolls or resizes the window
            window.addEventListener('scroll', updateButtonPosition);
            window.addEventListener('resize', updateButtonPosition);
            updateButtonPosition();
        });
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script> --}}

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        window.addEventListener('load', function() {
            var loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) {
                loadingOverlay.style.display = 'none';
            }
        });
    </script>
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @stack('js')
</body>

</html>
