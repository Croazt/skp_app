<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PenilaianPerilakuIndex extends DatatableComponent
{

    /**
     * Specify the datatable's columns and their behaviors.
     *
     * @return array
     */
    public function columns(): array
    {
        return $this->applyColumnVisibility([
            DatatableColumn::make('id'),
            DatatableColumn::make('periode_awal'),
            DatatableColumn::make('periode_akhir'),
        ]);
    }

    public function getBaseRouteName(): string
    {
        return 'penilaian-perilaku.';
    }

    protected function newQuery(): Builder
    {
        return (new Skp())
            ->newQuery()->baseQuery();
    }
    public function updatedDataDokumen_bukti()
    {
        dd($this->data['dokumen_bukti']);
        // here you can store immediately on any change of the property
    }
    public function render()
    {
        return view('livewire.penilaian-perilaku.penilaian-perilaku-index');
    }

    protected function searchableColumns(): array
    {
        return [
            'pengelolaKinerja.nama',
            'pejabatPenilaiUtama.nama',
            'pejabatPenilaiDua.nama',
            'timAngkaKredit.nama'
        ];
    }
}
