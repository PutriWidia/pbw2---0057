<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::resource('buku', BukuController::class);