<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', function () {
    $company = 'Hogeschool Rotterdam';
    return view('contact', compact('company'));
});

Route::get('products/{id}', function (int $id) {
    return view('products', [
        'id' => $id
    ]);
})->name('product');

Route::get('/over/{name}', [AboutController::class, 'index'])
    ->name('over');

require __DIR__ . '/auth.php';
