<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Concerns\DatatableColumn;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    public Collection $data;

    protected string $operation;

    public array $roleOptions;

    public function mount(): void
    {
        // $this->confirmAuthorization();

        $this->data = collect([
            'nama' => $this->user->getAttribute('nama'),
            'username' => $this->user->getAttribute('username'),
            'nip' => $this->user->getAttribute('nip'),
            'tugas_tambahan' => $this->user->getAttribute('tugas_tambahan'),
            'unit_kerja' => $this->user->getAttribute('unit_kerja'),
            'pekerjaan' => $this->user->getAttribute('pekerjaan'),
            'pangkat' => $this->user->getPangkat(),
            'roles' => $this->user->getRoleNames()->toArray(),
        ]);
        $this->roleOptions = Role::pluck('nama', 'nama')->toArray();
    }

    protected array $rules = [
        'data.nama' => 'required',
        'data.username' => 'required',
        'data.nip' => 'required',
        'data.tugas_tambahan' => 'required',
        'data.unit_kerja' => 'required',
        'data.pekerjaan' => 'required',
        // 'data.pangkat' => 'required',
        // 'data.roles' => 'required',
    ];

    /**
     * Get the success message after `save` action called successfully.
     *
     * @return string
     */
    protected function getSuccessMessage(): string
    {
        return ($this->operation === 'create') ?
            'The new user has been saved.' :
            'The user has been updated.';
    }

    public function save(): void
    {
        $this->validate();
        $this->user->fill($this->data->except(['roles','pangkat'])->all());

        if($this->operation == 'create'){
            $this->user->password = Hash::make(substr(strval($this->data['nip']),0,10).strtok(strval($this->data['nama']), " "));
        }

        $this->user->save();

        session()->flash('alertType', 'success');
        session()->flash('alertMessage', $this->getSuccessMessage());

        redirect()->to(route('users.index'));
    }
}
