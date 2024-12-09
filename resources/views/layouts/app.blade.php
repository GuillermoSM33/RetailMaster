<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Título dinámico -->
        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- Fuentes -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- CSS global -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/plantilla.css'])

        <!-- CSS adicional -->
        @yield('estilos')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Contenido de la página -->
            <div class="content">
                @yield('contenido')
            </div>
        </div>
    </body>
</html>
