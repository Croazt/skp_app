<?php

namespace App\Http\Livewire\SkpGuru\Guru;

use App\Http\Livewire\SkpGuru\Traits\SkpGuruMap;
use App\Models\PangkatPkgAk;
use App\Models\RencanaKinerjaGuru;
use App\Models\SkpGuru;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SkpGuruPeta extends Component
{
    
    use SkpGuruMap;
    use WithFileUploads;
    protected $listeners = ['refresh' => 'refresh', 'kinerjaGuruAdded' => 'refresh'];

    public function updateTargetPkg(int $value, string $data)
    {
        $this->skpGuru->$data = $value;
        $this->skpGuru->save();

        $this->refresh();
    }
    public function updateTargetCapaian(int $id, int $value, string $field)
    {
        $rencana = RencanaKinerjaGuru::find($id);
        $rencana->$field = $value;
        $rencana->save();
    }

    public function confirmSKP()
    {
        $rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus;
        $targetFilled = $rencanaKinerjaGuru->reject(function ($item, $key) {
            return !$item->target1_kualitas || !$item->target2_kualitas ||  !$item->target1_kuantitas || !$item->target2_kuantitas ||  !$item->target1_waktu || !$item->target2_waktu;
        })->isEmpty();
        if ($targetFilled) {
            $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => 'Tidak dapat melakukan konfirmasi SKP, harap isi mengisi target terlebih dahulu!']);
            return;
        }
        $this->skpGuru->status = SkpGuru::KONFIRMASI;
        $this->skpGuru->tanggal_konfirmasi = now();
        $this->skpGuru->save();
        return redirect(request()->header('Referer'));
    }

    public function sendVerifyDokumenSKP()
    {
        $rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus;
        $targetFilled = $rencanaKinerjaGuru->reject(function ($item, $key) {
            return ($item->dokumen_bukti && $item->dokumen_diterima !== 0) || !$item->terkait;
        })->isEmpty();
        if (!$targetFilled) {
            if($this->skpGuru->status =='ditolak'){
                $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => 'Tidak dapat meminta verifikasi, harap memperbaiki dokumen bukti kinerja terlebih dahulu!']);
                return;
            }
            $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => 'Tidak dapat meminta verifikasi, harap mengunggah dokumen bukti kinerja terlebih dahulu!']);
            return;
        }
        $this->skpGuru->status = SkpGuru::BUKTI;
        $this->skpGuru->save();
        return redirect(request()->header('Referer'));
    }

    public function updatedDokumen($value, $key)
    {
        $this->resetErrorBag('dokumen.' . $key);
        $dataName = uniqid('bukti-' . Auth::user()->nip . '-') . '.pdf';
        $path = $this->dokumen[$key]->storeAs('dokumen_bukti', $dataName, 'public');

        $rencana = RencanaKinerjaGuru::find($key);
        $rencana->dokumen_bukti = env('APP_URL') . "/storage/" . $path;
        $rencana->dokumen_diterima = null;
        $rencana->save();
        $this->refresh();
    }
    public function deleteDetailKinerjaGuru(string $key): void
    {
        $row = $this->skpGuru->rencanaKinerjaGurus()->find($key);
        if ($row instanceof RencanaKinerjaGuru) {
            $row->delete();
        }

        // $this->selectAllRows = false;
        // $this->selectedRows = [];

        $this->refresh();

        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'The record (' . $key . ') have been deleted.');
    }
    public function render()
    {
        if ($this->viewType == 'draft') {
            return view('livewire.skp-guru.guru.skp-guru-peta');
        }

        if ($this->viewType == 'rencana') {
            return view('livewire.skp-guru.guru.skp-guru-rencana');
        }

        if ($this->viewType == 'keterkaitan') {
            return view('livewire.skp-guru.guru.skp-guru-keterkaitan');
        }

        if ($this->viewType == 'reviu') {
            return view('livewire.skp-guru.guru.skp-guru-reviu');
        }

        if ($this->viewType == 'verifikasi') {
            return view('livewire.skp-guru.guru.skp-guru-verifikasi');
        }

        if ($this->viewType == 'realisasi') {
            return view('livewire.skp-guru.guru.skp-guru-realisasi');
        }

        if ($this->viewType == 'penetapan') {
            return view('livewire.skp-guru.guru.skp-guru-penetapan');
        }
        if ($this->viewType == 'penilaian') {
            return view('livewire.skp-guru.guru.skp-guru-penilaian');
        }
    }
}
