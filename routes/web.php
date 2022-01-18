<?php

use App\Http\Controllers\Web\Panel\{
    ClientController,
    EmployeeController,
    EstimateController,
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
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
    Route::post('/clients/add', [ClientController::class, 'add'])->name('clients.add');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}/update', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');


    # Employees
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}/update', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}/destroy', [EmployeeController::class, 'destroy'])->name('employees.destroy');


    # Estimates
    Route::get('/estimates', [EstimateController::class, 'index'])->name('estimates.index');
    Route::get('/estimates/create', [EstimateController::class, 'create'])->name('estimates.create');
    Route::post('/estimates/store', [EstimateController::class, 'store'])->name('estimates.store');
    Route::get('/estimates/{id}/edit', [EstimateController::class, 'edit'])->name('estimates.edit');
    Route::put('/estimates/{id}/update', [EstimateController::class, 'update'])->name('estimates.update');
    Route::delete('/estimates/{id}/destroy', [EstimateController::class, 'destroy'])->name('estimates.destroy');
    Route::any('/estimates/search', [EstimateController::class, 'search'])->name('estimates.search');
});
