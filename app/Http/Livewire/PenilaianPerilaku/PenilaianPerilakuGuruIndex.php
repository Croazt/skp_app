<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PenilaianPerilakuGuruIndex extends DatatableComponent
{

    public Skp $skp;

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
            DatatableColumn::make('status'),
        ]);
    }

    public function getBaseRouteName(): string
    {
        return 'penilaian-perilaku.';
    }

    public function performAction(string $action, string $key = null)
    {
        return redirect()->to(
            route($this->getBaseRouteName().'guru.'.$action, ['skp' => $this->skp->id, 'user' => $key])
        );
    }
    protected function newQuery(): Builder
    {
        return (new User())
        ->penilaianPerilakuQuery($this->skp->id)->newQuery();
    }

    public function render()
    {
        return view('livewire.penilaian-perilaku.penilaian-perilaku-guru-index');
    }

    protected function searchableColumns(): array
    {
        return [
            'nama',
            'username',
        ];
    }
}
