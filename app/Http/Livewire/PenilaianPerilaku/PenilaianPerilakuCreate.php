<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\AspekPerilaku;
use App\Models\PenilaianPerilakuGuru;
use App\Models\Role;
use App\Models\Skp;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Livewire\Component;

class PenilaianPerilakuCreate extends Component
{
    public Skp $skp;
    public User $user;
    public EloquentCollection $aspekPerilaku;

    protected string $operation = "create";

    public function mount(): void
    {
        $this->aspekPerilaku = AspekPerilaku::all();
    }

    public function save()
    {
        PenilaianPerilakuGuru::create([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
            'status' => 'dibuat',
            'tanggal_konfirmasi' => now(),
            'konfirmasi_oleh' => auth()->user()->nip,
        ]);
        $this->emit('savePenilaianKinerja');
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'Penilaian perilaku berhasil dibuat!.');
        return redirect(route('penilaian-perilaku.show', ['skp' => $this->skp->id]));
    }

    public function render()
    {
        if (Carbon::parse($this->skp->penilaian)->startOfDay() > now() || Carbon::parse($this->skp->periode_akhir)->endOfDay() < now()) {
            session()->flash('alertType', 'danger');
            session()->flash('alertMessage', ' Tidak dapat membuat penilaian perilaku, saat ini bukanlah waktu penilaian SKP!.');
            redirect(route('penilaian-perilaku.show', ['skp' => $this->skp->id]));
        }
        return view('livewire.penilaian-perilaku.penilaian-perilaku-create');
    }
}
