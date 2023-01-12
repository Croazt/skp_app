<?php

namespace App\Http\Livewire\Skp;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
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

        if (Cookie::get('role') == 'Pengelola Kinerja' || Cookie::get('role') == 'Tim Angka Kredit') {
            $field = strtolower(str_replace(' ', '_', Cookie::get('role')));
            return (new Skp())
                ->newQuery()->baseQuery()->where($field , auth()->user()->nip);
        }
        return (new Skp())
            ->newQuery()->baseQuery();
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
