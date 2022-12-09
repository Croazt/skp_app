<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class UserCreate extends UserForm
{
    protected string $operation = "create";

    public function mount(): void
    {
        $this->user = new User();

        parent::mount();
    }
    public function render()
    {
        return view('livewire.user.user-create');
    }
}
