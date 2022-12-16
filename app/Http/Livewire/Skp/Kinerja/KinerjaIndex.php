<?php

namespace App\Http\Livewire\Skp\Kinerja;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\DetailKinerja;
use App\Models\Kinerja;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;

class KinerjaIndex extends Component
{
    
    public string $operation = "";
    public Skp $skp;
    // /**
    //  * Specify the datatable's columns and their behaviors.
    //  *
    //  * @return array
    //  */
    // public function columns(): array
    // {
    //     return $this->applyColumnVisibility([
    //         DatatableColumn::make('id'),
    //         DatatableColumn::make('periode_awal'),
    //         DatatableColumn::make('periode_akhir'),
    //         DatatableColumn::make('perencanaan'),
    //         // DatatableColumn::make('email_verified_at'),
    //         // DatatableColumn::make('remember_token'),
    //         DatatableColumn::make('penilaian'),
    //         DatatableColumn::make('pengelola_kinerja'),
    //         DatatableColumn::make('pejabat_penilai1'),
    //         DatatableColumn::make('pejabat_penilai2'),
    //         DatatableColumn::make('tim_angka_kredit'),
    //     ]);
    // }

    public function getBaseRouteName(): string
    {
        return 'skp.';
    }

    
    public function render()
    {
        return view('livewire.skp.kinerja.kinerja-index');
    }

 

    public function delete(string $key): void
    {
        $row = $this->skp->kinerjas()->find($key);
        if ($row instanceof Kinerja) {
            $row->detailKinerjas()->delete();
            $row->delete();
        }

        $this->selectAllRows = false;
        $this->selectedRows = [];

        // $this->refresh();

        $this->dispatchBrowserEvent('deletedDetailKinerja');
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'The record ('.$key.') have been deleted.');
    }
    
    public function deleteDetailKinerja(string $key): void
    {
        $row = $this->skp->detailKinerjas()->find($key);
        if ($row instanceof DetailKinerja) {
            $row->delete();
        }

        $this->selectAllRows = false;
        $this->selectedRows = [];

        // $this->refresh();

        $this->dispatchBrowserEvent('deletedDetailKinerja');
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'The record ('.$key.') have been deleted.');
    }
    protected function searchableColumns(): array
    {
        return [

        ];
    }
}
