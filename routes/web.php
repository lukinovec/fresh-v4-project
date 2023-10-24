<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyBySubdomain;
use Stancl\Tenancy\Middleware\PreventAccessFromUnwantedDomains;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware([
    'web',
    'universal',
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application.' . (tenant() ? ('The id of the current tenant is ' . tenant('id')) : '');
    });
    Route::get('/home/{user?}', Home::class);
});

Route::middleware(['web', 'tenant'])->group(function () {
    Route::get('/tenant', function ($tenant) {
        return $tenant;
    })->name('tenant');
});

Route::middleware(['web'])->group(function () {
    Route::get('/central', function () {
        return 'central route';
    })->name('central');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware([
    'web',
    'universal',
    PreventAccessFromUnwantedDomains::class,
    InitializeTenancyBySubdomain::class,
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    // InitializeTenancyByPath::class,
])->name('dashboard');
