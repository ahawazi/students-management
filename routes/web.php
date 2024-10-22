<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['role:admin'])->group(function () {
//     Filament::routes();
// });

// Route::middleware(['role:teacher'])->group(function () {
//     Filament::routes();
// });
