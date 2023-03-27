<?php

namespace App\Http\Livewire\SkpGuru;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Skp;
use App\Models\SkpGuru;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class SkpGuruIndex extends DatatableComponent
{

    public Skp $skp;
    /**
     * Specify the datatable's columns and their behaviors.
     *
     * @return array
     */
    public function columns(): array
    {
        return $this->applyColumnVisibility([
            DatatableColumn::make('id'),
            DatatableColumn::make('nama'),
            DatatableColumn::make('nip'),
            DatatableColumn::make('status'),
        ]);
    }

    public function getBaseRouteName(): string
    {
        return 'skp-guru.';
    }

    protected function newQuery(): Builder
    {
        if (Cookie::get('role') == 'Pengelola Kinerja') {
            return (new SkpGuru())
                ->newQuery()->baseQuery($this->skp->id)->where(function ($q) {
                    $q->where('status', SkpGuru::KONFIRMASI)
                        ->orWhere('status', SkpGuru::VERIFIKASI)
                        ->orWhere('status', SkpGuru::REVIU)
                        ->orWhere('status', SkpGuru::BUKTI)
                        ->orWhere('status', SkpGuru::DITOLAK)
                        ->orWhere('status', SkpGuru::DINILAI);
                });
        }
        return (new SkpGuru())
            ->newQuery()->baseQuery($this->skp->id);
    }

    public function render()
    {
        return view('livewire.skp-guru.skp-guru-index');
    }

    public function showSkpGuru($key)
    {
        return redirect()->to(
            route($this->getBaseRouteName() . 'show', ['skp' => $this->skp->id, 'skpGuru' => $key])
        );
    }
    protected function searchableColumns(): array
    {
        return [
            'pengelolaKinerja.nama',
            'pejabatPenilai.nama',
            'timAngkaKredit.nama'
        ];
    }
}
