<?php

use App\Http\Controllers\Web\Panel\{
    ClientController,
    HomeController,
};
use App\Http\Controllers\Web\Site\SiteController;
use Illuminate\Support\Facades\Route;


# Public Routes
Route::get('/', [SiteController::class, 'welcome']);


# Private Routes
Route::group(['namespace' => 'Web\Panel', 'middleware' => ['auth:sanctum', 'verified']], function () {
    # Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    # Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
});
