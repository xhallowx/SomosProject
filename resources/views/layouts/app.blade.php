<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{asset('somos.ico')}}" type="image/x-icon">
        <title>Project</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{asset('build/assets/css/app.css')}}">

        <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen body">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <script>
            window.addEventListener("pageshow", function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });

            // Verifica la sesión al cargar la página y cada 10 segundos
            function checkSession() {
                fetch('/check-session')
                    .then(response => response.json())
                    .then(data => {
                        if (!data.authenticated) {
                            alert("Debes iniciar sesión para acceder.");
                            window.location.href = "{{ route('login') }}";
                        }
                    })
                    .catch(error => console.error("Error al comprobar la sesión:", error));
            }

            document.addEventListener("DOMContentLoaded", checkSession);
            setInterval(checkSession, 10000);
        </script>
<script src="{{asset('build/assets/js/tasks/dashboard.js')}}"></script>
    </body>
</html>
