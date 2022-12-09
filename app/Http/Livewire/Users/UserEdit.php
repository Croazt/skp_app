<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Role;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class UserEdit extends UserForm
{
    protected string $operation = "update";

    public function render()
    {
        return view('livewire.user.user-edit');
    }
}
