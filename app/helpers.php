<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

if (!function_exists('pageTitle')) {
    function pageTitle(): string
    {
        $route = Route::currentRouteName();

        $titles = [
            'home' => 'Home',
            'rides.index' => 'Rides',
            'rides.create' => 'Rides - Add New',
            'rides.show' => 'Rides - Details',
            'rides.edit' => 'Rides - Edit',
            'experiences.index' => 'Experiences',
            'experiences.create' => 'Experiences - Add New',
            'experiences.show' => 'Experiences - Details',
            'experiences.edit' => 'Experiences - Edit',
            'profile.edit' => 'Profile',
            'admin' => 'Admin Dashboard',
            'admin.experiences' => 'Admin Dashboard - Experiences',
            'admin.rides' => 'Admin Dashboard - Rides',
            'admin.types' => 'Admin Dashboard - Types',
            'admin.users' => 'Admin Dashboard - Users'
        ];

        return $titles[$route] ?? Str::title(Str::afterLast($route, '.'));
    }
}
