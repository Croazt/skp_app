<?php

namespace App\Http\Livewire\PejabatPenilai;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\PejabatPenilai;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PejabatPenilaiIndex extends DatatableComponent
{

    public string $sortColumn = 'nip';
    /**
     * Specify the datatable's columns and their behaviors.
     *
     * @return array
     */
    public function columns(): array
    {
        return $this->applyColumnVisibility([
            DatatableColumn::make('nip'),
            DatatableColumn::make('nama'),
            DatatableColumn::make('pangkat'),
            DatatableColumn::make('pekerjaan'),
            DatatableColumn::make('unit_kerja'),
            DatatableColumn::make('atasan'),
            DatatableColumn::make('created_at'),
            DatatableColumn::make('updated_at'),
        ]);
    }

    public function getBaseRouteName(): string
    {
        return 'pejabat-penilai.';
    }

    protected function newQuery(): Builder
    {
        return (new PejabatPenilai())
            ->newQuery()->baseQuery();
    }

    public function render()
    {
        return view('livewire.pejabat-penilai.pejabat-penilai-index');
    }

    protected function searchableColumns(): array
    {
        return [
            'nip',
            'nama',
            'pekerjaan',
            'unit_kerja',
            'atasanPejabat.nama',
        ];
    }
}
