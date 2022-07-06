<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GtaFive</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="/style.css" rel="stylesheet">
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 text-gray-500 underline btn btn-primary">Compte</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 text-gray-500 underline btn btn-primary">Connexion</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 text-gray-500 underline btn btn-primary">Inscription</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <img src="https://cdn.discordapp.com/attachments/725802927083618366/994206398357438504/unknown.png" class="h-16 w-auto text-gray-700 sm:h-20">
        </div>

        <div class="mt-8 bg-white bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>

