<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\SkpGuru;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class PenilaianPerilakuShow extends PenilaianPerilakuForm
{
    protected string $operation = "show";

    public function showMySkp()
    {

        return redirect()->to(
            route('guru.skp-guru.index', ['skp' => $this->skp])
        );
    }
    public function createSkpGuru()
    {
        $isRightPeriode = $this->checkSkpPeriode();
        if (!$isRightPeriode) {
            return;
        }
        $user = auth()->user();
        $skpGuru = $this->skp->skpGurus()->create([
            'user_nip' => $user->nip,
        ]);
        $this->createDefaultRencana($skpGuru, 'Semua Guru');
        if ($user->tugas_tambahan) {
            $this->createDefaultRencana($skpGuru, $user->tugas_tambahan);
        }
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'Kerangka SKP berhasil dibuat, silahkan rencanakan SKP anda!');
        return redirect()->to(
            route('guru.skp-guru.index', ['skp' => $this->skp])
        );
    }

    public function createDefaultRencana(SkpGuru $skpGuru, string $pekerjaan): void
    {
        $detailKinerjas = $this->skp->detailKinerjas()->where([
            'pekerjaan'  => $pekerjaan,
        ])->get();
        if ($detailKinerjas instanceof EloquentCollection){
            $detailKinerjas->each(function ($data, $key) use ($skpGuru) {
                $skpGuru->rencanaKinerjaGurus()->create([
                    'user_nip' => $skpGuru->user_nip,
                    'skp_id' => $skpGuru->skp_id,
                    'detail_kinerja_id' => $data->id,
                ]);
            });
        }
    }

    public function checkSkpPeriode(): bool
    {
        if ($this->skp->periode_awal >= now()) {
            session()->flash('alertType', 'danger');
            session()->flash('alertMessage', 'Tidak dapat merencanakan SKP, pelaksanaan SKP belum dimulai!');
            return false;
        }
        if (Carbon::parse($this->skp->periode_akhir)->endOfDay() <= now()) {
            session()->flash('alertType', 'danger');
            session()->flash('alertMessage', 'Tidak dapat merencanakan SKP, pelaksanaan SKP telah selesai!');
            return false;
        }
        if (Carbon::parse($this->skp->perencanaan)->endOfDay() <= now()) {
            session()->flash('alertType', 'danger');
            session()->flash('alertMessage', 'Tidak dapat merencanakan SKP, telah melewati waktu perencanaan!');
            return false;
        }
        return true;
    }
    
    public function booted()
    {
        if (Cookie::get('role') === 'Guru') {
            return redirect()->to(
                route('penilaian-perilaku.guru' . '.show', ['skp' => $this->skp->id, 'user' => auth()->user()])
            );
        }
    }

    public function cetak()
    {
        return view('livewire.penilaian-perilaku.penilaian-perilaku-show');
    }
    public function render()
    {
        return view('livewire.penilaian-perilaku.penilaian-perilaku-show');
    }
}
