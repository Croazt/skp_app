<?php

namespace App\Http\Livewire\Skp;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\Skp;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class SkpCreate extends SkpForm
{
    protected string $operation = "create";

    public function mount(): void
    {
        $this->skp = new Skp();

        parent::mount();
    }
    public function render()
    {
        return view('livewire.skp.skp-create');
    }
}
