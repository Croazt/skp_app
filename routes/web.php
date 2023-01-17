<?php

use App\Http\Controllers\KinerjaController;
use App\Http\Controllers\DetailKinerjaController;
use App\Http\Controllers\SkpGuruController;
use App\Http\Livewire\PejabatPenilai\PejabatPenilaiCreate;
use App\Http\Livewire\PejabatPenilai\PejabatPenilaiEdit;
use App\Http\Livewire\PejabatPenilai\PejabatPenilaiIndex;
use App\Http\Livewire\PejabatPenilai\PejabatPenilaiShow;
use App\Http\Livewire\PenilaianPerilaku\PenilaianPerilakuCreate;
use App\Http\Livewire\PenilaianPerilaku\PenilaianPerilakuGuruShow;
use App\Http\Livewire\PenilaianPerilaku\PenilaianPerilakuIndex;
use App\Http\Livewire\PenilaianPerilaku\PenilaianPerilakuShow;
use App\Http\Livewire\Skp\Kinerja\KinerjaIndex;
use App\Http\Livewire\Skp\SkpCreate;
use App\Http\Livewire\Skp\SkpEdit;
use App\Http\Livewire\Skp\SkpIndex;
use App\Http\Livewire\Skp\SkpShow;
use App\Http\Livewire\SkpGuru\SkpGuruShow;
use App\Http\Livewire\SkpGuru\SkpGuruIndex;
use App\Http\Livewire\SkpGuru\Guru\SkpGuruIndex as GuruSkpGuruIndex;
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
    return redirect()->route('dashboard');
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

    //users
    Route::get('/pejabat-penilai', PejabatPenilaiIndex::class)->name('pejabat-penilai.index');
    Route::get('/pejabat-penilai/create', PejabatPenilaiCreate::class)->name('pejabat-penilai.create');
    Route::get('/pejabat-penilai/{pejabatPenilai}', PejabatPenilaiShow::class)->name('pejabat-penilai.show');
    Route::get('/pejabat-penilai/{pejabatPenilai}/edit', PejabatPenilaiEdit::class)->name('pejabat-penilai.edit');

    //SKP
    Route::get('/skp', SkpIndex::class)->name('skp.index');
    Route::get('/skp/create', SkpCreate::class)->name('skp.create');
    Route::get('/skp/{skp}', SkpShow::class)->name('skp.show');
    Route::get('/skp/{skp}/edit', SkpEdit::class)->name('skp.edit');
    Route::get('/skp/{skp}/tambah-kinerja', KinerjaIndex::class)->name('skp.tambah-kinerja');

    //PENILAIAN PERILAKU
    Route::get('/penilaian-perilaku', PenilaianPerilakuIndex::class)->name('penilaian-perilaku.index');
    Route::get('/penilaian-perilaku/{skp}', PenilaianPerilakuShow::class)->name('penilaian-perilaku.show');
    Route::get('/penilaian-perilaku/create', PenilaianPerilakuCreate::class)->name('penilaian-perilaku.create');
    Route::get('/penilaian-perilaku/{skp}/users/{user}/create', PenilaianPerilakuCreate::class)->name('penilaian-perilaku.guru.create');
    Route::get('/penilaian-perilaku/{skp}/users/{user}', PenilaianPerilakuGuruShow::class)->name('penilaian-perilaku.guru.show');
    // Route::get('/penilaian-perilaku/{skp}/users/{user}', SkpShow::class)->name('penilaian-perilaku.show');
    // Route::get('/penilaian-perilaku/{skp}/users/{user}/edit', SkpEdit::class)->name('penilaian-perilaku.edit');

    //KINERJA
    Route::get('/skp/{skp}/kinerja/get-jabatan', [KinerjaController::class, 'getJabatan'])->name("getJabatan");
    Route::get('/skp/{skp}/kinerja/get', [KinerjaController::class, 'getKinerja'])->name("getKinerja");
    Route::resource('/skp/{skp}/kinerja', KinerjaController::class);
    
    //DETAIL KINERJA
    Route::get('/skp/{skp}/detail-kinerja', [DetailKinerjaController::class,'index'])->name('detail-kinerja.index');
    Route::get('/skp/{skp}/skp-guru/{skpGuru}/detail-kinerja', [DetailKinerjaController::class,'getSkpGuruKinerja'])->name('skp-guru.detail-kinerja');

    Route::get('/skp-guru/rencana/print', [SkpGuruController::class, 'rencanaPrint'])->name('guru.skp-guru.rencana-print');

    //SKP GURU
    Route::get('/skp/{skp}/skp-guru', SkpGuruIndex::class)->name('skp-guru.index');
    Route::get('/skp/{skp}/skp-guru/{skpGuru}', SkpGuruShow::class)->name('skp-guru.show');
    Route::get('/skp/{skp}/guru/skp-guru', GuruSkpGuruIndex::class)->name('guru.skp-guru.index');
    Route::post('/skp-guru/{skpGuru}/add-rencana', [SkpGuruController::class, 'addRencanaKinerjaGuru'])->name('guru.skp-guru.tambah-rencana');
    Route::post('/skp-guru/{skpGuru}/add-rencana', [SkpGuruController::class, 'addRencanaKinerjaGuru'])->name('guru.skp-guru.tambah-rencana');
    
});
