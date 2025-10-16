<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ride Rate') }} • {{ ucfirst(Route::currentRouteName()) }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

{{--Header Content--}}
@if(isset($header))
    <header>
        <h1>{{ $header }}</h1>
    </header>
@endif

<!-- Page Content -->
<main>
    {{ $slot }}
</main>

</body>

</html>
