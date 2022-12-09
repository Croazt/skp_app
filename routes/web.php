<?php

use App\Http\Livewire\Users\UserCreate;
use App\Http\Livewire\Users\UserEdit;
use App\Http\Livewire\Users\UserIndex;
use App\Http\Livewire\Users\UserShow;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/', function () {
        return view('welcome');
    });

    //users
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/{user}', UserShow::class)->name('users.show');
    Route::get('/users/{user}/edit', UserEdit::class)->name('users.edit');
});
