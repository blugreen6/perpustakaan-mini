<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Kembalikan arah halaman utama ke /buku
Route::redirect('/', '/buku');

// 2. Kembalikan route CRUD Perpustakaan Mini kita
Route::resource('buku', BukuController::class);

// --- Rute bawaan Breeze untuk Dashboard & Profile (Biarkan saja) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';