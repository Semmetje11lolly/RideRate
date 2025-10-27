@props(['headerRideImage' => null])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ride Rate') }} • {{ ucfirst(Route::currentRouteName()) }}</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/1fe3729de2.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', $script])
</head>

<body>
{{--Nav Content--}}
<nav>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('rides.index') }}">Rides</a>
    <div class="empty"></div>
    @guest
        <a href="{{ route('login')  }}" style="padding: 10px">Login</a>
    @endguest
    @auth
        <a href="{{ route('profile.edit') }}">
            {{ Auth::user()->name }}
            <img src="{{ url(Auth::user()->image_url) }}" alt="Profile Picture">
        </a>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <input type="submit" name="submit" value="Logout">
        </form>
    @endauth
</nav>

{{--Header Content--}}
@if(isset($header))
    <header @if(Route::currentRouteName() === "home") style="height: 400px" @endif>
        <h1>{{ $header }}</h1>
    </header>
@endif
@if(isset($header_ride))
    <header
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.5)), url({{ $headerRideImage }}); height: 400px">
        {{ $header_ride }}
    </header>
@endif

{{--Page Content--}}
<main>
    {{ $slot }}
</main>

</body>

</html>
