<?php

namespace App\Http\Livewire\Skp\Kinerja;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\ComponentDataRepository;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\DetailKinerja;
use App\Models\Kinerja;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Livewire\Component;

class KinerjaIndex extends Component
{
    protected $listeners = ['KinerjaAdded' => '$refresh','KinerjaDeleted' => '$refresh'];
    public string $operation = "";
    public Skp $skp;
    public EloquentCollection $kinerja;

    public function getBaseRouteName(): string
    {
        return 'skp.';
    }

    
    public function render()
    {
        return view('livewire.skp.kinerja.kinerja-index');
    }

    public function mount(){
        $this->kinerja = $this->skp->kinerjas;
    }
    // public function booted(): void
    // {

    // }

    // public function refresh(): void
    // {
    //     app(ComponentDataRepository::class)->save($this);
    // }

    public function delete(string $key): void
    {
        $row = $this->skp->kinerjas()->find($key);
        // dd($row);
        if ($row instanceof Kinerja) {
            $row->detailKinerjas()->delete();
            $row->delete();
        }

        $this->selectAllRows = false;
        $this->selectedRows = [];

        // $this->refresh();

        $this->emit('KinerjaDeleted');
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

        $this->emit('KinerjaDeleted');
        $this->dispatchBrowserEvent('KinerjaDeleted');
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'The record ('.$key.') have been deleted.');
    }

    protected function searchableColumns(): array
    {
        return [

        ];
    }
}
