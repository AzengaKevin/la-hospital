<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @hasSection ('title')
    <title>@yield('title') - {{ config('app.name', 'Hospitali') }}</title>
    @else
    <title>Freelance Health Care - {{ config('app.name', 'Hospitali') }}</title>
    @endif

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased min-h-screen">
    @yield('content')

    @stack('scripts')
</body>

</html>