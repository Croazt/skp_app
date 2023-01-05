<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\AspekPerilaku;
use App\Models\IndikatorPenilaianPerilaku;
use App\Models\RencanaKinerjaGuru;
use App\Models\Role;
use App\Models\SituasiKerja;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PenilaianPerilakuGuruShowTable extends Component
{

    public Skp $skp;
    public User $user;
    public Collection $indikatorKerja;
    public AspekPerilaku $aspekPerilaku;
    public Collection $situasiKerja;
    public SupportCollection $data;

    protected $listeners = ['savePenilaianKinerja'=>'save'];

    public array $level = [1, 2, 3, 4];

    public string $tableType = '';

    public function mount()
    {
        $this->aspekPerilaku = AspekPerilaku::where('nama', $this->tableType)->first();
        $this->situasiKerja = SituasiKerja::where('aspek_perilaku_id', $this->aspekPerilaku->id)->leftJoin(DB::raw("(SELECT situasi_kerja_id, indikator_kerja_id FROM indikator_penilaian_perilaku WHERE user_nip = {$this->user->nip}) indikator_penilaian_perilaku"), 'indikator_penilaian_perilaku.situasi_kerja_id', 'situasi_kerja.id')->get();

        if ($this->user->pangkat->jabatan == Role::GURU_MUDA)
            $this->level = [2, 3, 4, 5];
        if ($this->user->pangkat->jabatan == Role::GURU_MADYA)
            $this->level = [3, 4, 5, 6];
        if ($this->user->pangkat->jabatan == Role::GURU_UTAMA)
            $this->level = [4, 5, 6, 7];
        $this->indikatorKerja = $this->aspekPerilaku->indikatorKerjas()->whereIn('level', $this->level)->where('aspek_perilaku_id', $this->aspekPerilaku->id)->get();
        $this->data = collect([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
            'indikator_penilaian_perilaku' => $this->situasiKerja->pluck('indikator_kerja_id', 'id')->toArray(),
        ]);
    }


    public function render()
    {
        return view('livewire.penilaian-perilaku.penilaian-perilaku-guru-show-table');
    }
}
