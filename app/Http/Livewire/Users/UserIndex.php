<?php

namespace App\Http\Livewire\Users;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UserIndex extends DatatableComponent
{

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
            DatatableColumn::make('username'),
            // DatatableColumn::make('email_verified_at'),
            DatatableColumn::make('password')->setInvisible(true),
            // DatatableColumn::make('remember_token'),
            DatatableColumn::make('created_at'),
            DatatableColumn::make('updated_at'),
        ]);
    }

    public function getBaseRouteName(): string
    {
        return 'users.';
    }

    protected function newQuery(): Builder
    {
        return (new User())
            ->newQuery();
    }

    public function render()
    {
        return view('livewire.user.user-index');
    }

    protected function searchableColumns(): array
    {
        return [
            'nama',
            'username',
            'nip',
        ];
    }
}
