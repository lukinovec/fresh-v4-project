<?php

use Illuminate\Support\Facades\Route;

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
    'universal',
    'web',
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application.' . tenant() ? ('The id of the current tenant is ' . tenant('id')) : '';
    });
    Route::get('/foo', function () {
        return 'foo route. ' . (tenant() ? 'The id of the current tenant is ' . tenant('id') : '');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware([
    'universal',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->name('dashboard');
