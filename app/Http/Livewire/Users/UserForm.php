<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Concerns\DatatableColumn;
use App\Models\Pangkat;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    public array $pangkat;

    public array $tugasTambahan = User::TUGAS_TAMBAHAN;
    public array $pekerjaan = User::PEKERJAAN;

    public Collection $data;

    protected string $operation;

    public array $roleOptions;

    public function mount(): void
    {
        // $this->confirmAuthorization();

        $this->data = collect([
            'id' => $this->user->getAttribute('id'),
            'nama' => $this->user->getAttribute('nama'),
            'email' => $this->user->getAttribute('email'),
            'nip' => $this->user->getAttribute('nip'),
            'tugas_tambahan' => $this->user->getAttribute('tugas_tambahan'),
            'unit_kerja' => $this->user->getAttribute('unit_kerja'),
            'pekerjaan' => $this->user->getAttribute('pekerjaan'),
            'pangkat_id' => $this->user->getAttribute('pangkat_id'),
            'roles' => $this->user->getRoleName()->toArray(),
        ]);
        $this->roleOptions = Role::pluck('nama', 'nama')->toArray();
        $this->pangkat = Pangkat::select(DB::raw('CONCAT(pangkat, ", ",golongan_ruang,"/",jabatan) AS full_pangkat'), 'id')->where('id', '<>', 0)->pluck('full_pangkat', 'id')->toArray();
    }

    protected array $rules = [
        'data.nama' => 'required|string|min:3|max:70',
        'data.tugas_tambahan' => 'nullable|string|min:5|max:50',
        'data.unit_kerja' => 'required|min:5|max:50',
        'data.pekerjaan' => 'required|string|max:50',
        'data.pangkat_id' => 'required|int|exists:pangkat,id',
        'data.roles' => 'required|array|min:1',
        'data.roles.*' => 'required|string|min:3|exists:roles,nama',
    ];

    /**
     * Redirect to the edit page.
     *
     * @return mixed
     */
    public function edit()
    {
        return redirect()->to(
            route('users.edit', ['user' => $this->user])
        );
    }
    
    /**
     * Redirect to the index page.
     *
     * @return mixed
     */
    public function backToIndex()
    {
        return redirect()->to(
            route('users.index')
        );
    }

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
        $this->dispatchBrowserEvent('LiveWireComponentRefreshed');
        $this->rules['data.email'] = [ 'required', 'email', Rule::unique('users','nip')->ignore($this->data['nip'],'nip')];
        $this->rules['data.nip'] = [ 'required', 'min:18', 'max:19', Rule::unique('users','nip')->ignore($this->data['nip'],'nip')];
        if ($this->operation == 'create') {
            $this->data['password'] = Hash::make(substr(strval($this->data['nip']), 0, 10) . strtok(strval($this->data['nama']), " "));
        }
        $this->validate();
        $this->user->fill($this->data->except(['roles'])->all());
        try{

            DB::beginTransaction();
            $this->user->save();
    
            $this->user->roles()->sync($this->data['roles']);
            DB::commit();
        }catch(Exception $err){
            dd($err);
            session()->flash('alertType', 'danger');
            session()->flash('alertMessage', 'Tidak dapat menambahkan pengguna, terdapat kesalahan!');
    
            redirect()->to(route('users.index'));
            DB::rollBack();
            return;
        }
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', $this->getSuccessMessage());

        redirect()->to(route('users.index'));
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
