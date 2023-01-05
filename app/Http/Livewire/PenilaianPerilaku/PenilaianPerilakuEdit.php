<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class PenilaianPerilakuEdit extends PenilaianPerilakuForm
{
    protected string $operation = "update";

    public function render()
    {
        return view('livewire.penilaian-perilaku.penilaian-perilaku-edit');
    }
}
