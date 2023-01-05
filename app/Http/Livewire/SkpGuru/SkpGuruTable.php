<?php

namespace App\Http\Livewire\SkpGuru;

use App\Http\Livewire\SkpGuru\Traits\SkpGuruMap;
use App\Models\PangkatPkgAk;
use App\Models\RencanaKinerjaGuru;
use App\Models\SkpGuru;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class SkpGuruTable extends Component
{
    use SkpGuruMap;

    public function updateTargetPkg(int $value, string $data)
    {
        $this->skpGuru->$data = $value;
        $this->skpGuru->save();

        $this->refresh();
    }

    public function updateCascading(int $rencanaId)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        $rencana->cascading = $this->data['cascading'][$rencanaId];
        $rencana->save();
        $this->refresh();
    }

    public function updateDokumenStatus(int $rencanaId)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        if(!$this->data['dokumen_diterima'][$rencanaId]){
            $rencana->realisasi_kualitas = null;
            $rencana->realisasi_kuantitas = null;
            $rencana->realisasi_waktu = null;
            $rencana->lingkup = '';
        }
        $rencana->dokumen_diterima = $this->data['dokumen_diterima'][$rencanaId];
        $rencana->save();
        $this->refresh();
    }
    public function updateLingkup(int $rencanaId)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        $rencana->lingkup = $this->data['lingkup'][$rencanaId];
        $rencana->save();
        $this->refresh();
    }

    public function updateCatatanDokumen(int $rencanaId)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        $rencana->catatan_dokumen = $this->data['catatan_dokumen'][$rencanaId];
        $rencana->save();
        $this->refresh();
    }
    public function updateCatatan(int $rencanaId)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        $rencana->catatan = $this->data['catatan'][$rencanaId];
        $rencana->save();
        $this->refresh();
    }

    public function updateTerkait(int $rencanaId)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        $rencana->terkait = $this->data['terkait'][$rencanaId];
        $rencana->save();
        $this->refresh();
    }


    public function reviuSKP()
    {
        $rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus;
        $targetFilled = $rencanaKinerjaGuru->reject(function ($item, $key) {
            return $item->cascading !== null;
        })->isEmpty();
        if (!$targetFilled) {
            $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => 'Tidak dapat mereviu SKP, harap memilih metode cascading terlebih dahulu!']);
            return;
        }
        $this->skpGuru->status = SkpGuru::REVIU;
        $this->skpGuru->tanggal_reviu = now();
        $this->skpGuru->save();
        return redirect(request()->header('Referer'));
    }

    public function verifikasiSKP()
    {
        $this->skpGuru->status = SkpGuru::VERIFIKASI;
        $this->skpGuru->tanggal_verifikasi = now();
        $this->skpGuru->save();
        return redirect(request()->header('Referer'));
    }

    public function gradeSKP()
    {
        $rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus;
        $buktiFilled = $rencanaKinerjaGuru->reject(function ($item) {
            return ($item->dokumen_diterima == 1) || (!$item->dokumen_diterima && $item->catatan_dokumen);
        })->isEmpty();

        $lingkupFilled = $rencanaKinerjaGuru->reject(function ($item) {
            return ($item->dokumen_diterima == 1 && $item->lingkup) || !$item->dokumen_diterima;
        })->isEmpty();

        $realisasiFilled = $rencanaKinerjaGuru->reject(function ($item) {
            return (($item->dokumen_diterima == 1 && $item->realisasi_kuantitas)&&($item->dokumen_diterima == 1 && $item->realisasi_kualitas)&&($item->dokumen_diterima == 1 && $item->realisasi_waktu)) || !$item->dokumen_diterima;
        })->isEmpty();
        if (!$buktiFilled || !$lingkupFilled || !$realisasiFilled) {
            $message = '<div>Tidak dapat melakukan verifikasi dokumen : </div>' . (!$buktiFilled ? '<div>Harap mengisi catatan penolakan bagi kinerja dengan dokumen bukti yang ditolak</div>' : '') . (!$lingkupFilled ? '<div>Harap menentukan lingkup bagi kinerja dengan dokumen bukti yang diterima!</div>' : '').(!$realisasiFilled ? '<div>Harap mengisi nilai realisasi kinerja dengan dokumen bukti yang diterima!</div>' : '');
            $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => $message]);
            return;
        }
        $rejectedDocument = $rencanaKinerjaGuru->filter(function ($item) {
            return !$item->dokumen_diterima;
        })->isEmpty();

        if($rejectedDocument){
            $this->skpGuru->status = SkpGuru::DINILAI;
            $this->skpGuru->tanggal_realisasi = now();
            $this->skpGuru->save();
            return redirect(request()->header('Referer'));
        }

        $this->skpGuru->status = SkpGuru::DITOLAK;
        $this->skpGuru->save();

        return redirect(request()->header('Referer'));
    }

    public function confirmSKP()
    {
        $rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus;
        $targetFilled = $rencanaKinerjaGuru->reject(function ($item) {
            return !$item->target1_kualitas || !$item->target2_kualitas ||  !$item->target1_kuantitas || !$item->target2_kuantitas ||  !$item->target1_waktu || !$item->target2_waktu;
        })->isEmpty();
        if ($targetFilled) {
            $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => 'Tidak dapat melakukan konfirmasi SKP, harap isi mengisi target terlebih dahulu!']);
            return;
        }
        $this->skpGuru->status = SkpGuru::KONFIRMASI;
        $this->skpGuru->save();
        return redirect(request()->header('Referer'));
    }

    public function deleteDetailKinerjaGuru(string $key): void
    {
        $row = $this->skpGuru->rencanaKinerjaGurus()->find($key);
        if ($row instanceof RencanaKinerjaGuru) {
            $row->delete();
        }

        $this->selectAllRows = false;
        $this->selectedRows = [];

        $this->refresh();

        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'The record (' . $key . ') have been deleted.');
    }

    public function render()
    {
        if ($this->viewType == 'draft') {
            return view('livewire.skp-guru.skp-guru-peta');
        }

        if ($this->viewType == 'konfirmasi') {
            return view('livewire.skp-guru.skp-guru-rencana');
        }

        if ($this->viewType == 'keterkaitan') {
            return view('livewire.skp-guru.skp-guru-keterkaitan');
        }

        if ($this->viewType == 'reviu') {
            return view('livewire.skp-guru.skp-guru-reviu');
        }

        if ($this->viewType == 'verifikasi') {
            return view('livewire.skp-guru.skp-guru-verifikasi');
        }

        if ($this->viewType == 'realisasi') {
            return view('livewire.skp-guru.skp-guru-realisasi');
        }

        if ($this->viewType == 'penetapan') {
            return view('livewire.skp-guru.guru.skp-guru-penetapan');
        }
    }
}
