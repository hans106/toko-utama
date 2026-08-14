<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Toko Utama - Grosir Roko & Sembako Karanganyar</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        {{ $slot }}

        <footer class="bg-gray-800 text-white py-6 mt-12">
            <div class="max-w-6xl mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} Toko Utama. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>