<?php

namespace App\Http\Livewire\Skp\Kinerja;

use App\Http\Livewire\Concerns\DatatableColumn;
use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\Kinerja;
use App\Models\Pangkat;
use App\Models\PejabatPenilai;
use App\Models\Role;
use App\Models\Skp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class KinerjaAtasanCreate extends Component
{
    
    protected $listeners = ['openModal'];
    public bool $showModal = false;
    public Skp $skp;
    
    public array $kinerja;
    public array $tipeAngkaKredit;
    public array $jabatan;

    public Collection $data;
    public int $iteration = 0;

    public function mount(){
        $this->tipeAngkaKredit =[
            "persen" => "Persentase",
            "absolut" => "Absolut"
        ];
        $jabatanWithoutKey = array_merge(User::PEKERJAAN, User::TUGAS_TAMBAHAN);
        $this->jabatan = $jabatanWithoutKey;
        $this->kinerja = $this->skp->kinerjas()->pluck('deskripsi', 'id')->toArray();
        $this->data = collect([
            'kategori' => 'utama',
            'deskripsi' => null,
            'detail_rencana' => null,
            'tipe_angka_kredit' => 'absolut',
            'angka_kredit' => null,
            'iki_kualitas' => null,
            'iki_kuantitas' => null,
            'iki_waktu' => null,
            'butir_kegiatan' => null,
            'output_kegiatan' => null,
            'is_default' => false,
            'pekerjaan' => null,
        ]);
    }


    public function openModal(){
        $this->showModal = true;
    }

    public function closeModal(){
        $this->mount();
        $this->showModal = false;
    }
    public function getBaseRouteName(): string
    {
        return 'skp.';
    }

    protected function newQuery(): Builder
    {
        return (new Kinerja())
            ->newQuery()->where('skp_id', $this->skp->id);
    }
    
    protected array $rules = [
        'data.kategori' => 'required|string|in:utama,tambahan',
        'data.deskripsi' => 'required|string',
        'data.detail_rencana' => 'required|string|unique:detail_kinerja,deskripsi',
        'data.tipe_angka_kredit' => 'required|string',
        'data.angka_kredit' => 'required|integer',
        'data.iki_kualitas' => 'required|string',
        'data.iki_kuantitas' => 'required|string',
        'data.iki_waktu' => 'required|string',
        'data.butir_kegiatan' => 'required|string',
        'data.output_kegiatan' => 'required|string',
        'data.is_default' => ['required', 'boolean'],
        'data.pekerjaan' => 'required_if:data.is_default,==,true',
    ];

    public function save()
    {
        $this->validate();
        $checkKinerja = $this->skp->kinerjas()->where([
            'kategori' => $this->data['kategori'],
            'deskripsi' => $this->data['deskripsi'],
        ])->first();
        if(!$checkKinerja instanceof Kinerja){
            $checkKinerja = $this->skp->kinerjas()->create([
                'kategori' => $this->data['kategori'],
                'deskripsi' => $this->data['deskripsi'],
            ]);
        }
        $checkKinerja->detailKinerjas()->create([
            'deskripsi'=>$this->data['detail_rencana'],
            'skp_id'=>$this->skp->id,
            'butir_kegiatan'=>$this->data['butir_kegiatan'],
            'output_kegiatan'=>$this->data['output_kegiatan'],
            'tipe_angka_kredit'=>$this->data['tipe_angka_kredit'],
            'angka_kredit'=>$this->data['angka_kredit'],
            'pekerjaan'=>$this->data['pekerjaan'],
            'indikator_kualitas'=>$this->data['iki_kualitas'],
            'indikator_kuantitas'=>$this->data['iki_kuantitas'],
            'indikator_waktu'=>$this->data['iki_waktu'],
        ]);
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'Data RHK telah disimpan!');

        
        $this->closeModal();
        // return redirect()->to(
        //     route('skp.show', ['skp' => $this->skp, 'tab'=>'kinerja'])
        // );
    }

    public function render()
    {
        return view('livewire.skp.kinerja.kinerja-atasan-create');
    }
    protected function searchableColumns(): array
    {
        return [
            'pengelolaKinerja.nama',
            'pejabatPenilai.nama',
            'timAngkaKredit.nama'
        ];
    }

    
    public function change()
    {
        $this->dispatchBrowserEvent('select2-create');
    }
    public function hydrate()
    {
        $this->emit('select2');
    }
}
