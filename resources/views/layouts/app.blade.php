<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Quicksand:wght@600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js">
        
        <!-- Scripts -->

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <style>
            .price-range {
            width: 100%;
            height: 10px;
            background-color: #ccc;
            position: relative;
            cursor: pointer; /* Cambiar el cursor al hacer clic en la barra */

            }
            .range-label-left,
            .range-label-right {
            position: absolute;
            top: -20px; /* Ajusta la posición vertical según tu preferencia */
            color: #333; /* Color del texto de las etiquetas */
            }

            .range-label-left {
            left: 0;
            margin-bottom:70px;
            }

            .range-label-right {
            right: 0;
            }
            /* .range-bar {
            width: 100%;
            height: 100%;
            background-color: #007bff;
            } */

            .range-handle {
            width: 15px;
            height: 18px;
            background-color: #007bff;
            position: absolute;
            top: -5px;
            border-radius: 50%;
            cursor: grab; /* Cambiar el cursor al hacer clic en el asa */
            }


            .custom-checkbox:checked {
                background-color: #000; /* Fondo negro */
                border: 2px solid white; /* Borde blanco */
            }
            .container-home {
                background-image: url('https://static.nike.com/a/images/f_auto/62eca93e-e6ba-4b6d-8b72-9e58d0a5642a/image.jpg');
                background-size: cover; /* Ajusta el tamaño de la imagen para cubrir el div */
                background-position: center center; /* Centra la imagen horizontal y verticalmente */
                background-repeat: no-repeat; /* Evita que la imagen se repita */
                height: 300px; /* Ajusta la altura del div según tus necesidades */
            }
            .filtro-panel {
                width: 200px;
                background-color: #c5d9e9;
                padding: 10px;
            }
            .shop-icon{
                transition: transform 0.5s ease-in-out;
            }
            .shop-icon:hover {
                transition: transform 0.5s ease-in-out;
                transform: scale(1.2); /* Hace que el ícono sea un 20% más grande al hacer hover */
            }
            .lb-outerContainer {
                min-width: 850px;
            }

            .lb-image {
                min-height: 750px;
                min-width:850px;
            }

            @keyframes slideUp {
                /* 0% {
                    transform: translateY(0);
                } */
                100% {
                    transform: translateY(-300%);
                    opacity: 0;
                }
            }

            .animate-slide-up {
                animation: slideUp 0.8s ease-out;
            }
        </style>

        @livewireStyles

    </head>
    
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>

    </body>
</html>
