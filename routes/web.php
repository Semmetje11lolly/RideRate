<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
use Illuminate\Support\Facades\Route;

// -- Default Breeze stuff --
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::redirect('/dashboard', '/');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -- My stuff --
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::resource('/rides', RideController::class)
    ->middleware('auth')
    ->withoutMiddlewareFor(['index', 'show'], 'auth');

Route::post('rides/{ride}/toggle-visibility', [RideController::class, 'toggleVisibility'])
    ->name('rides.toggle-visibility');

Route::resource('/experiences', ExperienceController::class)
    ->middleware('auth')
    ->withoutMiddlewareFor(['index', 'show'], 'auth');

Route::post('experiences/{experience}/toggle-visibility', [ExperienceController::class, 'toggleVisibility'])
    ->name('experiences.toggle-visibility');

Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin')->middleware('auth')->can('admin');
Route::get('/admin/experiences', [AdminController::class, 'experiences'])
    ->name('admin.experiences')->middleware('auth')->can('admin');
Route::get('/admin/rides', [AdminController::class, 'rides'])
    ->name('admin.rides')->middleware('auth')->can('admin');
Route::get('/admin/types', [AdminController::class, 'types'])
    ->name('admin.types')->middleware('auth')->can('admin');
Route::get('/admin/users', [AdminController::class, 'users'])
    ->name('admin.users')->middleware('auth')->can('admin');

require __DIR__ . '/auth.php';
