<?php

namespace App\Http\Livewire\PejabatPenilai;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class PejabatPenilaiShow extends PejabatPenilaiForm
{
    protected string $operation = "show";
    public function render()
    {
        return view('livewire.pejabat-penilai.pejabat-penilai-show');
    }
}
