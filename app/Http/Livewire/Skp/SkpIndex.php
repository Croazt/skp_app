<?php

namespace App\Http\Livewire\Skp;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SkpIndex extends DatatableComponent
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
            DatatableColumn::make('perencanaan'),
            // DatatableColumn::make('email_verified_at'),
            // DatatableColumn::make('remember_token'),
            DatatableColumn::make('penilaian'),
            DatatableColumn::make('pengelola_kinerja'),
            DatatableColumn::make('pejabat_penilai1'),
            DatatableColumn::make('pejabat_penilai2'),
            DatatableColumn::make('tim_angka_kredit'),
        ]);
    }

    public function getBaseRouteName(): string
    {
        return 'skp.';
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
        return view('livewire.skp.skp-index');
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
