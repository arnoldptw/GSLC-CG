<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', [ImageController::class, 'index'])->name('home'); // Halaman upload gambar
Route::post('/upload', [ImageController::class, 'process'])->name('process'); // Proses konversi gambar
