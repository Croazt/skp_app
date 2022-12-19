<?php

namespace App\Http\Livewire\PejabatPenilai;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\PejabatPenilai;
use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class PejabatPenilaiCreate extends PejabatPenilaiForm
{
    protected string $operation = "create";

    public function mount(): void
    {
        $this->pejabatPenilai = new PejabatPenilai();

        parent::mount();
    }
    public function render()
    {
        return view('livewire.pejabat-penilai.pejabat-penilai-create');
    }
}
