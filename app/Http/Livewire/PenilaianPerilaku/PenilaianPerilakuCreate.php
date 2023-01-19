<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\AspekPerilaku;
use App\Models\IndikatorPenilaianPerilaku;
use App\Models\Pangkat;
use App\Models\PenilaianPerilakuGuru;
use App\Models\RencanaKinerjaGuru;
use App\Models\Role;
use App\Models\SituasiKerja;
use App\Models\Skp;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PenilaianPerilakuCreate extends Component
{
    public Skp $skp;
    public User $user;
    public EloquentCollection $aspekPerilaku;
    public Collection $data;


    public array $level = [1, 2, 3, 4];
    protected string $operation = "create";

    public function mount(): void
    {
        $this->data = collect([]);
        $this->aspekPerilaku = AspekPerilaku::all();

        if ($this->user->pangkat->jabatan == Pangkat::GURU_MUDA)
            $this->level = [2, 3, 4, 5];
        if ($this->user->pangkat->jabatan == Pangkat::GURU_MADYA)
            $this->level = [3, 4, 5, 6];
        if ($this->user->pangkat->jabatan == Pangkat::GURU_UTAMA)
            $this->level = [4, 5, 6, 7];

        $this->aspekPerilaku->each(function ($item) {
            $situasiKerja = SituasiKerja::where('aspek_perilaku_id', $item->id)->leftJoin(DB::raw("(SELECT situasi_kerja_id, indikator_kerja_id FROM indikator_penilaian_perilaku WHERE user_nip = {$this->user->nip}) indikator_penilaian_perilaku"), 'indikator_penilaian_perilaku.situasi_kerja_id', 'situasi_kerja.id')->get();

            $indikatorKerja = $item->indikatorKerjas()->whereIn('level', $this->level)->where('aspek_perilaku_id', $item->id)->get();
            $this->data = $this->data->merge([
                $item->nama => [
                    'user_nip' => $this->user->nip,
                    'skp_id' => $this->skp->id,
                    'definisi' => $item->de,
                    'indikator_penilaian_perilaku' => $situasiKerja->pluck('indikator_kerja_id', 'id')->toArray(),
                    'situasiKerja' => $situasiKerja->keyBy('id')->toArray(),
                    'indikatorKerja' => $indikatorKerja->keyBy('id')->toArray(),
                ]
            ]);
        });
        // dd($this->data);
    }

    public function save()
    {
        $PenilaianPerilakuGuru = PenilaianPerilakuGuru::create([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
            'status' => 'dibuat',
            'tanggal_konfirmasi' => now(),
            'konfirmasi_oleh' => auth()->user()->nip,
        ]);
        foreach ($this->data as $data) {
            foreach ($data['indikator_penilaian_perilaku'] as $key => $item) {
                if (!$item) {
                    $PenilaianPerilakuGuru->delete();
                    IndikatorPenilaianPerilaku::where('user_nip', $this->user->nip)->where('skp_id', $this->skp->id)->delete();
                    $this->dispatchBrowserEvent('showResponseModal', ['success' => false, 'message' => 'Tidak dapat menyimpan penilaian perilaku, harap mengisi seluruh situasi kinerja!']);
                    return;
                }
                IndikatorPenilaianPerilaku::create([
                    'situasi_kerja_id' => $key,
                    'indikator_kerja_id' => $item,
                    'user_nip' => $this->user->nip,
                    'skp_id' => $this->skp->id,
                ]);
            }
        }
        session()->flash('alertType', 'success');
        session()->flash('alertMessage', 'Penilaian perilaku berhasil dibuat!.');
        return redirect(route('penilaian-perilaku.show', ['skp' => $this->skp->id]));
    }

    public function render()
    {
        if (Carbon::parse($this->skp->penilaian)->startOfDay() > now() || Carbon::parse($this->skp->periode_akhir)->endOfDay() < now()) {
            session()->flash('alertType', 'danger');
            session()->flash('alertMessage', ' Tidak dapat membuat penilaian perilaku, saat ini bukanlah waktu penilaian SKP!.');
            redirect(route('penilaian-perilaku.show', ['skp' => $this->skp->id]));
        }
        return view('livewire.penilaian-perilaku.penilaian-perilaku-create');
    }
}
