<?php

namespace App\Http\Livewire\Skp;

use App\Http\Livewire\Concerns\DatatableColumn;
use App\Models\Pangkat;
use App\Models\PejabatPenilai;
use App\Models\Role;
use App\Models\Skp;
use App\Models\User;
use App\Rules\SameYear;
use App\Rules\UniqueYear;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SkpForm extends Component
{
    use AuthorizesRequests;

    public Skp $skp;

    public array $periodeAwal;

    public array $periodeAkhir;

    public array $timKredit;
    public array $pengelola;
    public array $penilai;

    public Collection $data;

    protected string $operation;

    public function mount(): void
    {
        // $this->confirmAuthorization();
        $periode = null;
        if ($this->skp->getAttribute('periode_awal') && $this->skp->getAttribute('periode_akhir')) {
            $periode = $this->skp->getAttribute('periode_awal') . ' - ' . $this->skp->getAttribute('periode_akhir');
        }
        $this->data = collect([
            'perencanaan' => $this->skp->getAttribute('perencanaan'),
            'periode' => $periode,
            'periode_awal' => $this->skp->getAttribute('periode_awal'),
            'periode_akhir' => $this->skp->getAttribute('periode_akhir'),
            'penilaian' =>  $this->skp->getAttribute('penilaian'),
            'pengelola_kinerja' => $this->skp->getAttribute('pengelola_kinerja'),
            'tim_angka_kredit' => $this->skp->getAttribute('tim_angka_kredit'),
            'pejabat_penilai' => $this->skp->getAttribute('pejabat_penilai'),
        ]);

        $this->timKredit = User::whereHas('roles', function ($query) {
            $query->where('nama', 'Tim Angka Kredit');
        })->pluck('nama', 'nip')->toArray();

        $this->pengelola = User::whereHas('roles', function ($query) {
            $query->where('nama', 'Pengelola Kinerja');
        })->pluck('nama', 'nip')->toArray();

        $this->penilai = PejabatPenilai::pluck('nama', 'nip')->toArray();
    }

    protected array $rules = [
        'data.periode_awal' => 'required|date|before:data.periode_akhir',
        'data.periode_akhir' => 'required|date|after:data.periode_awal',
        'data.perencanaan' => 'required|date|after:data.30_hari_periode_awal|before:data.penilaian',
        'data.penilaian' => 'required|date|before:data.30_hari_periode_akhir|after:data.perencanaan',
        'data.pengelola_kinerja' => 'required|exists:users,nip',
        'data.tim_angka_kredit' => 'required|exists:users,nip',
        'data.pejabat_penilai' => 'required|exists:pejabat_penilai,nip',
    ];

    /**
     * Redirect to the edit page.
     *
     * @return mixed
     */
    public function edit()
    {
        return redirect()->to(
            route('skp.edit', ['skp' => $this->skp])
        );
    }

    /**
     * Redirect to the edit page.
     *
     * @return mixed
     */
    public function tambahKinerja()
    {
        return redirect()->to(
            route('skp.tambah-kinerja', ['skp' => $this->skp])
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
            route('skp.index')
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

        $this->data = $this->data->merge([
            '30_hari_periode_awal' => Carbon::parse($this->data['periode_awal'])->addDay(30),
            '30_hari_periode_akhir' => Carbon::parse($this->data['periode_akhir'])->subDay(30),
        ]);

        // $this->validate();
        $this->rules['data.periode_awal'] = ['required','date','before:data.periode_akhir', (new SameYear($this->data['periode_akhir'])), new UniqueYear($this->skp)];
        $this->validate();
        
        DB::beginTransaction();
        $this->skp->fill($this->data->except(['periode'])->all());
        $this->skp->save();
        DB::commit();
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', $this->getSuccessMessage());

        redirect()->to(route('skp.index'));
    }
    
    public function hydrate()
    {
        $this->emit('select2');
    }
}
