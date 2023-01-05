<?php

namespace App\Http\Livewire\SkpGuru\Guru;

use App\Models\RencanaKinerjaGuru;
use App\Models\Skp;
use App\Models\SkpGuru;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SkpGuruIndex extends Component
{
    public Skp $skp;
    public SkpGuru $skpGuru;
    public Collection $rencanaKinerjaGuru;
    public Collection $rencanaKinerjaGuruSql;

    public function mount(){    
        $this->skpGuru = $this->skp->skpGurus()->where('user_nip', auth()->user()->nip)->first();
        $this->rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus()
            ->select([
                'rencana_kinerja_guru.*',
                'detail_kinerja.deskripsi',
                'detail_kinerja.skp_id',
                'detail_kinerja.kinerja_id',
                'detail_kinerja.butir_kegiatan',
                'detail_kinerja.output_kegiatan',
                'detail_kinerja.angka_kredit',
                'detail_kinerja.pekerjaan',
                'detail_kinerja.indikator_kualitas',
                'detail_kinerja.indikator_kuantitas',
                'detail_kinerja.indikator_waktu',
                'detail_kinerja.detail_output_kualitas',
                'detail_kinerja.detail_output_kuantitas',
                'detail_kinerja.detail_output_waktu',
                'detail_kinerja.tipe_angka_kredit',
                'kinerja.deskripsi as kinerja_desc',
                'kinerja.kategori',
            ])
            ->where('skp_guru_id',  $this->skpGuru->id)
            ->leftJoin('detail_kinerja', 'rencana_kinerja_guru.detail_kinerja_id', '=', 'detail_kinerja.id')
            ->leftJoin('kinerja', 'detail_kinerja.kinerja_id', '=', 'kinerja.id')
            ->orderBy('kinerja.deskripsi', 'asc')
            ->get();
    }
    public function render()
    {
        return view('livewire.skp-guru.guru.skp-guru-index');
    }
}
