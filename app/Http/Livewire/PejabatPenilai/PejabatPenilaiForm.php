<?php

namespace App\Http\Livewire\PejabatPenilai;

use App\Models\Pangkat;
use App\Models\PejabatPenilai;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class PejabatPenilaiForm extends Component
{
    use AuthorizesRequests;

    public PejabatPenilai $pejabatPenilai;

    public array $pangkat;

    // public array $tugasTambahan = User::TUGAS_TAMBAHAN;
    // public array $pekerjaan = User::PEKERJAAN;

    public Collection $data;

    protected string $operation;

    public array $atasan;

    public function mount(): void
    {
        // $this->confirmAuthorization();

        $this->data = collect([
            'nama' => $this->pejabatPenilai->getAttribute('nama'),
            'nip' => $this->pejabatPenilai->getAttribute('nip'),
            'unit_kerja' => $this->pejabatPenilai->getAttribute('unit_kerja'),
            'pekerjaan' => $this->pejabatPenilai->getAttribute('pekerjaan'),
            'pangkat_id' => $this->pejabatPenilai->getAttribute('pangkat_id'),
            'atasan' => $this->pejabatPenilai->getAttribute('atasan'),
        ]);
        $this->atasan = PejabatPenilai::pluck('nama', 'nip')->toArray();
        $this->pangkat = Pangkat::select(DB::raw('CONCAT(pangkat, ", ",golongan_ruang,"/",jabatan) AS full_pangkat'), 'id')->where('id', '<>', 0)->pluck('full_pangkat', 'id')->toArray();
    }

    protected array $rules = [
        'data.nama' => 'required|string|min:3|max:70',
        'data.nip' => 'required|min:18|max:19',
        'data.unit_kerja' => 'required|min:5|max:50',
        'data.pekerjaan' => 'required|string|max:50',
        'data.pangkat_id' => 'required|int|exists:pangkat,id',
        'data.atasan' => 'nullable|min:18|max:19|exists:pejabat_penilai,nip',
    ];

    /**
     * Redirect to the edit page.
     *
     * @return mixed
     */
    public function edit()
    {
        return redirect()->to(
            route('pejabat-penilai.edit', ['pejabatPenilai' => $this->pejabatPenilai])
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
            route('pejabat-penilai.index')
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
            'The new pejabat penilai has been saved.' :
            'The pejabat penilai has been updated.';
    }

    public function save(): void
    {
        $this->dispatchBrowserEvent('LiveWireComponentRefreshed');
        $this->validate();
        $this->pejabatPenilai->fill($this->data->all());

        DB::beginTransaction();
        $this->pejabatPenilai->save();

        DB::commit();
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', $this->getSuccessMessage());

        redirect()->to(route('pejabat-penilai.index'));
    }

    public function hydrate()
    {
        $this->emit('select2');
    }
}
