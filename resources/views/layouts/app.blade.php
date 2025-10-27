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
            Hey, {{ Auth::user()->name }}
            <img src="{{ url(Auth::user()->image_url) }}" alt="Profile Picture">
        </a>
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

{{--Footer Content--}}
<footer>
    <div class="footer-container">
        <div class="form-row" style="gap: 50px">
            <section class="footer-section">
                <h3>Ride Rate</h3>
                The place to get real ride experiences from real people all around the world’s theme parks! Inform
                yourself today!
            </section>
            <section class="footer-section">
                <h3>Quick links</h3>
                <a href="{{ route('rides.index') }}">Rides</a>
                <a href="{{ route('login') }}">Login</a>
            </section>
            <section class="footer-section">
                <h3>Socials</h3>
                <a href=""><i class="fa-brands fa-instagram"></i> Instagram</a>
                <a href=""><i class="fa-brands fa-tiktok"></i> TikTok</a>
                <a href=""><i class="fa-brands fa-threads"></i> Threads</a>
                <a href=""><i class="fa-brands fa-youtube"></i> YouTube</a>
            </section>
            <section class="footer-section">
                <h3>Legal</h3>
                <a href="">Privacy Policy</a>
                <a href="">Terms & Conditions</a>
                <a href="">Cookies</a>
            </section>
        </div>
        <hr style="margin: 20px 0; border: 1px solid #e1ebeb">
        <div class="footer-section">
            <p>&copy; Copyright 2025 Ride Rate. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>

</html>
