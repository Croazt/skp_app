<?php

namespace App\Http\Livewire\SkpGuru;

use App\Http\Livewire\SkpGuru\Traits\SkpGuruMap;
use App\Models\PangkatPkgAk;
use App\Models\RencanaKinerjaGuru;
use App\Models\Role;
use App\Models\SkpGuru;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PDO;

class SkpGuruTable extends Component
{
    use SkpGuruMap;

    public function updateTargetPkg(int $value, string $data)
    {
        $this->skpGuru->$data = $value;
        $this->skpGuru->save();

        $this->refresh();
    }

    public function updateTargetCapaian(int $rencanaId, int $value, string $field)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        if ($rencana instanceof RencanaKinerjaGuru) {
            $rencana->$field = $value;
            $rencana->save();
        }
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
        if (!$this->data['dokumen_diterima'][$rencanaId]) {
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
            return $item->cascading !== null || $item->detailKinerja->kinerja->kategori != 'utama';
        })->isEmpty();
        if (!$targetFilled) {
            $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => 'Tidak dapat mereviu SKP, harap memilih metode cascading terlebih dahulu!']);
            return;
        }
        $this->skpGuru->status = SkpGuru::REVIU;
        $this->skpGuru->tanggal_reviu = now();
        $this->skpGuru->reviu_oleh = auth()->user()->nip;
        
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'Rencana SKP Berhasil Direviu!');
        $this->skpGuru->save();
        $this->dispatchBrowserEvent('showResponseModal', ['success' => true, 'message' => 'Rencana SKP Berhasil Direviu!']);
        return redirect(request()->header('Referer'));
    }

    public function verifikasiSKP()
    {
        $this->skpGuru->status = SkpGuru::VERIFIKASI;
        try {
            DB::beginTransaction();
            $this->skpGuru->rencanaKinerjaGurus()
                ->where('skp_id', $this->skpGuru->skp_id)
                ->where('user_nip', $this->skpGuru->user_nip)
                ->whereNull('terkait')
                ->update([
                    'terkait' => 0,
                ]);
            $this->skpGuru->tanggal_verifikasi = now();
            $this->skpGuru->verifikasi_oleh = auth()->user()->nip;
            $this->skpGuru->save();
            session()->flash('alertType', 'success');
            session()->flash('alertMessage', 'Rencana SKP Berhasil Diverifikasi!');
            $this->dispatchBrowserEvent('showResponseModal', ['success' => true, 'message' => 'Rencana SKP Berhasil Diverifikasi!']);
            DB::commit();
            return redirect(request()->header('Referer'));
        } catch (Exception $err) {
            $this->dispatchBrowserEvent('showResponseModal', ['success' => true, 'message' => 'Terjadi kesalahan,' . $err->getMessage()]);
            DB::rollBack();
            return;
        }
    }

    public function gradeSKP()
    {
        $rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus;
        $diterimaField = $rencanaKinerjaGuru->reject(function ($item) {
            return ($item->dokumen_diterima !== null)||!$item->terkait;
        })->isEmpty();
        $buktiFilled = $rencanaKinerjaGuru->reject(function ($item) {
            return (!($item->dokumen_diterima === 0) || (($item->dokumen_diterima === 0 && $item->catatan_dokumen)))||!$item->terkait;
        })->isEmpty();

        $lingkupFilled = $rencanaKinerjaGuru->reject(function ($item) {
            return (($item->dokumen_diterima == 1 && ($item->lingkup || $item->detailKinerja->kinerja->kategori == 'utama')) || !$item->dokumen_diterima)||!$item->terkait;
        })->isEmpty();

        $realisasiFilled = $rencanaKinerjaGuru->reject(function ($item) {
            return ((($item->dokumen_diterima == 1 && $item->realisasi_kuantitas) && ($item->dokumen_diterima == 1 && $item->realisasi_kualitas) && ($item->dokumen_diterima == 1 && $item->realisasi_waktu)) || !$item->dokumen_diterima)||!$item->terkait;
        })->isEmpty();
        if (!$buktiFilled || !$lingkupFilled || !$realisasiFilled || !$diterimaField) {
            $message = '<div>Tidak dapat melakukan verifikasi dokumen : </div>' .(!$diterimaField ? '<div>Harap memilih status verifikasi dokumen bukti kinerja</div>' : '') . (!$buktiFilled ? '<div>Harap mengisi catatan penolakan bagi kinerja dengan dokumen bukti yang ditolak</div>' : '') . (!$lingkupFilled ? '<div>Harap menentukan lingkup bagi kinerja tambahan dengan dokumen bukti yang diterima!</div>' : '') . (!$realisasiFilled ? '<div>Harap mengisi nilai realisasi kinerja dengan dokumen bukti yang diterima!</div>' : '');
            $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => $message]);
            return;
        }
        $rejectedDocument = $rencanaKinerjaGuru->filter(function ($item) {
            return !$item->dokumen_diterima && $item->terkait;
        })->isEmpty();

        if ($rejectedDocument) {
            $this->skpGuru->status = SkpGuru::DINILAI;
            $this->skpGuru->pangkat_nilai = $this->skpGuru->user->pangkat_id;
            $this->skpGuru->pejabat_nilai = $this->skpGuru->skp->pejabat_penilai;
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

        $this->refresh();

        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'The record (' . $key . ') have been deleted.');
    }

    public function render()
    {
        if ($this->viewType == 'draft') {
            return view('livewire.skp-guru.skp-guru-peta');
        }

        if ($this->viewType == 'rencana') {
            return view('livewire.skp-guru.guru.skp-guru-rencana');
        }

        if ($this->viewType == 'keterkaitan') {
            return view('livewire.skp-guru.guru.skp-guru-keterkaitan');
        }

        if ($this->viewType == 'reviu') {
            if (Cookie::get('role') != Role::PENGELOLA_KINERJA) {
                return view('livewire.skp-guru.guru.skp-guru-reviu');
            }
            return view('livewire.skp-guru.skp-guru-reviu');
        }

        if ($this->viewType == 'verifikasi') {
            if (Cookie::get('role') != Role::TIM_ANGKA_KREDIT) {
                return view('livewire.skp-guru.guru.skp-guru-verifikasi');
            }
            return view('livewire.skp-guru.skp-guru-verifikasi');
        }

        if ($this->viewType == 'realisasi') {
            return view('livewire.skp-guru.skp-guru-realisasi');
        }

        if ($this->viewType == 'penetapan') {
            return view('livewire.skp-guru.guru.skp-guru-penetapan');
        }

        if ($this->viewType == 'penilaian') {
            return view('livewire.skp-guru.guru.skp-guru-penilaian');
        }
    }
}
