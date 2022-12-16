<?php

namespace App\Http\Livewire\Skp;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class SkpShow extends SkpForm
{
    protected string $operation = "show";

    public function render()
    {
        return view('livewire.skp.skp-show');
    }
}
