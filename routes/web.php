<?php

use App\Http\Livewire\Skp\Kinerja\KinerjaIndex;
use App\Http\Livewire\Skp\SkpCreate;
use App\Http\Livewire\Skp\SkpEdit;
use App\Http\Livewire\Skp\SkpIndex;
use App\Http\Livewire\Skp\SkpShow;
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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //users
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/{user}', UserShow::class)->name('users.show');
    Route::get('/users/{user}/edit', UserEdit::class)->name('users.edit');

    //SKP
    Route::get('/skp', SkpIndex::class)->name('skp.index');
    Route::get('/skp/create', SkpCreate::class)->name('skp.create');
    Route::get('/skp/{skp}', SkpShow::class)->name('skp.show');
    Route::get('/skp/{skp}/edit', SkpEdit::class)->name('skp.edit');
    Route::get('/skp/{skp}/tambah-kinerja', KinerjaIndex::class)->name('skp.tambah-kinerja');
});
