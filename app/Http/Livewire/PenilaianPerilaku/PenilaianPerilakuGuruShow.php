<?php

namespace App\Http\Livewire\PenilaianPerilaku;

use App\Http\Livewire\Concerns\DatatableComponent;
use App\Models\AspekPerilaku;
use App\Models\IndikatorPenilaianPerilaku;
use App\Models\PangkatPkgAk;
use App\Models\PenilaianPerilakuGuru;
use App\Models\RencanaKinerjaGuru;
use App\Models\Role;
use App\Models\Skp;
use App\Models\SkpGuru;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Browsershot\Browsershot;

class PenilaianPerilakuGuruShow extends Component
{
    public Skp $skp;
    public User $user;
    public PenilaianPerilakuGuru|null $penilaianPerilakuGuru;
    public EloquentCollection $aspekPerilaku;

    public int $level = 4;

    public string $tableType = '';

    protected string $operation = "create";

    public function mount(): void
    {
        $this->aspekPerilaku = AspekPerilaku::all();
        $this->penilaianPerilakuGuru = PenilaianPerilakuGuru::where('skp_id', $this->skp->id)->where('user_nip', $this->user->nip)->first();
    }

    public function back()
    {
        return redirect()->to(
            route('penilaian-perilaku' . '.show', ['skp' => $this->skp->id])
        );
    }

    public function downloadPdf(string $type)
    {
        $file = $this->getTemplate($type);
        return response()->streamDownload(function ()  use ($file) {
            echo file_get_contents(env('APP_URL') . $file['path'] . $file['file_name']);
        }, $file['file_name']);
    }

    private function getTemplate(string $type): array
    {

        $indikatorPenilaian = IndikatorPenilaianPerilaku::select([
            'aspek_perilaku.nama',
            DB::raw('SUM(indikator_kerja.level) as total'),
            DB::raw('count(indikator_kerja.id) as jumlah'),
        ])->leftJoin('indikator_kerja', 'indikator_penilaian_perilaku.indikator_kerja_id', 'indikator_kerja.id')
            ->leftJoin('aspek_perilaku', 'indikator_kerja.aspek_perilaku_id', 'aspek_perilaku.id')
            ->where('skp_id', $this->skp->id)
            ->where('user_nip', $this->user->nip)
            ->groupBy('aspek_perilaku.id')->get();

        if ($this->user->pangkat->jabatan == Role::GURU_MUDA)
            $this->level = 5;
        if ($this->user->pangkat->jabatan == Role::GURU_MADYA)
            $this->level = 6;
        if ($this->user->pangkat->jabatan == Role::GURU_UTAMA)
            $this->level = 7;

        $nilaiAkhirPerilaku = 0;
        foreach ($indikatorPenilaian as $item) {
            $avgPenilaian = $item->total / $item->jumlah;
            if ($avgPenilaian >= $this->level) {
                $item->nilai = 120;
                $nilaiAkhirPerilaku += $item->nilai;
                continue;
            }
            if ($avgPenilaian < ($this->level - 2)) {
                $item->nilai = 120;
                $nilaiAkhirPerilaku += $item->nilai;
                continue;
            }
            if ($avgPenilaian < ($this->level - 2)) {
                $item->nilai = ($avgPenilaian * ($this->level - 2)) * 90;
                $nilaiAkhirPerilaku += $item->nilai;
                continue;
            }
            if ($avgPenilaian > ($this->level - 1)) {
                $item->nilai = 109 + (11 * ($avgPenilaian - ($this->level - 1)));
                $nilaiAkhirPerilaku += $item->nilai;
                continue;
            }
            $item->nilai = 90 + (19 * ($avgPenilaian - ($this->level - 2)));
            $nilaiAkhirPerilaku += $item->nilai;
        }
        $nilaiAkhirPerilaku = $nilaiAkhirPerilaku / count($indikatorPenilaian);
        $penilaianPerilakuGuru = PenilaianPerilakuGuru::where('skp_id', $this->skp->id)
            ->where('user_nip', $this->user->nip)->first();
        $view = (view('livewire.penilaian-perilaku.pdf.penilaian-perilaku-penilaian', [
            'indikatorPenilaian' => $indikatorPenilaian,
            'penilaianPerilakuGuru' => $penilaianPerilakuGuru,
            'skp' => $this->skp,
        ])->render());
        $fileName =  $penilaianPerilakuGuru->user_nip . '-penilaian-perilaku.pdf';
        $margin = [
            'top' => 6,
            'bottom' => 6,
            'right' => 6,
            'left' => 6,
        ];
        $saveToFile = storage_path('app/public/file/penilaian-perilaku/' . $fileName);
        Browsershot::html($view)
            ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
            ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
            ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

        if ($type == 'perilaku') {
            return ['file_name' => $fileName, 'path' => '/storage/file/penilaian-perilaku/'];
        }
        $skpGuru = SkpGuru::where('skp_id', $this->skp->id)->where('user_nip', $this->user->nip)->first();
        $rencanaKinerjaGuru = $this->getRencanaKinerjaGuru($skpGuru);

        $rencanaKinerjaUtama = $rencanaKinerjaGuru->filter(function ($item) {
            return $item->kategori == "utama";
        });

        $nilaiTertimbangUtama = 0;
        $totalTertimbangUtama = 0;
        $nilaiTertimbangTambahan = 0;
        foreach ($rencanaKinerjaGuru as $item) {
            if ($item->terkait) {
                if ($item->kategori == "tambahan") {
                    $nilaiTertimbangTambahan += $item->nilai_tertimbang;
                    continue;
                };
                $nilaiTertimbangUtama +=  $item->nilai_tertimbang;
                $totalTertimbangUtama++;
            }
        }
        $nilaiAkhirSkp = ($nilaiTertimbangUtama / $totalTertimbangUtama) + ($nilaiTertimbangTambahan > 10 ? 10 : $nilaiTertimbangTambahan);
        $nilaiAkhirTotal = (($nilaiAkhirPerilaku * 30) / 100) + (($nilaiAkhirSkp * 70) / 100);
        // dd($nilaiAkhirTotal,$nilaiAkhirPerilaku,$nilaiAkhirSkp);

        $view = (view('livewire.penilaian-perilaku.pdf.penilaian-prestasi-kerja', [
            'nilaiAkhirTotal' => $nilaiAkhirTotal,
            'nilaiAkhirPerilaku' => $nilaiAkhirPerilaku,
            'nilaiAkhirSkp' => $nilaiAkhirSkp,
            'penilaianPerilakuGuru' => $penilaianPerilakuGuru,
            'skp' => $this->skp,
        ])->render());

        $fileName =  $penilaianPerilakuGuru->user_nip . '-penilaian-prestasi.pdf';
        $saveToFile = storage_path('app/public/file/penilaian-prestasi/' . $fileName);
        Browsershot::html($view)
            ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
            ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
            ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

        return ['file_name' => $fileName, 'path' => '/storage/file/penilaian-prestasi/'];
    }

    public function getRencanaKinerjaGuru(SkpGuru $skpGuru)
    {
        $rencanaKinerjaGuru = $skpGuru->rencanaKinerjaGurus()
            ->select([
                'rencana_kinerja_guru.*',
                'detail_kinerja.deskripsi',
                'detail_kinerja.skp_id',
                'detail_kinerja.kinerja_id',
                'detail_kinerja.butir_kegiatan',
                'detail_kinerja.output_kegiatan',
                'detail_kinerja.angka_kredit',
                'detail_kinerja.pekerjaan',
                'detail_kinerja.indikator_kualitas',
                'detail_kinerja.indikator_kuantitas',
                'detail_kinerja.indikator_waktu',
                'detail_kinerja.detail_output_kualitas',
                'detail_kinerja.detail_output_kuantitas',
                'detail_kinerja.detail_output_waktu',
                'detail_kinerja.tipe_angka_kredit',
                'kinerja.deskripsi as kinerja_desc',
                'kinerja.kategori',
            ])
            ->where('skp_guru_id', $skpGuru->id)
            ->where('terkait', true)
            ->leftJoin('detail_kinerja', 'rencana_kinerja_guru.detail_kinerja_id', '=', 'detail_kinerja.id')
            ->leftJoin('kinerja', 'detail_kinerja.kinerja_id', '=', 'kinerja.id')
            ->orderBy('kinerja.deskripsi', 'asc')
            ->get();

        $capaianPkg = $this->skpGuru->capaian_pkg ?? 125;
        $capaianPkgTambahan = $this->skpGuru->capaian_pkg_tambahan ?? 125;
        $capaianJamPelajaran = $this->skpGuru->capaian_jam_pelajaran ?? 24;
        $rencanaKinerjaGuru = $rencanaKinerjaGuru->each(function ($item) use ($capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan) {
            $this->calculateRealisasiScore($item, $capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan);
        });
        return $rencanaKinerjaGuru;
    }


    protected function calculateRealisasiScore(RencanaKinerjaGuru $rencanaKinerjaGuru, $capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan)
    {
        if ($rencanaKinerjaGuru->tipe_angka_kredit == 'persen') {
            $jamAndAk = ($capaianJamPelajaran / 24) * ($rencanaKinerjaGuru->angka_kredit / 100);
            if ($rencanaKinerjaGuru->pekerjaan == auth()->user()->tugas_tambahan) {
                $rencanaKinerjaGuru->realisasi_angka_kredit = PangkatPkgAk::where('pangkat_id', auth()->user()->pangkat_id)->first()->$capaianPkgTambahan * $jamAndAk;
            } else {
                $rencanaKinerjaGuru->realisasi_angka_kredit = PangkatPkgAk::where('pangkat_id', auth()->user()->pangkat_id)->first()->$capaianPkg * $jamAndAk;
            }
            $rencanaKinerjaGuru->realisasi_angka_kredit = round($rencanaKinerjaGuru->angka_kredit, 2);
        } elseif ($rencanaKinerjaGuru->tipe_angka_kredit == 'absolut' && $rencanaKinerjaGuru->kategori == 'tambahan') {
            $rencanaKinerjaGuru->realisasi_angka_kredit = $rencanaKinerjaGuru->angka_kredit * $rencanaKinerjaGuru->realisasi_kuantitas;
        }
        $realisasiKualitas = $rencanaKinerjaGuru->realisasi_kualitas;
        $target1Kualitas = $rencanaKinerjaGuru->target1_kualitas;
        $target2Kualitas = $rencanaKinerjaGuru->target2_kualitas;
        $rencanaKinerjaGuru->capaian_iki_kualitas = ($realisasiKualitas > $target2Kualitas) ? (intdiv($realisasiKualitas * 100, $target2Kualitas)) : ($realisasiKualitas >= $target1Kualitas ? 100 : intdiv($realisasiKualitas * 100, $target1Kualitas));
        $rencanaKinerjaGuru->kategori_capaian_iki_kualitas = $this->setKategoriIki($rencanaKinerjaGuru->capaian_iki_kualitas);

        $realisasiKuantitas = $rencanaKinerjaGuru->realisasi_kuantitas;
        $target1Kuantitas = $rencanaKinerjaGuru->target1_kuantitas;
        $target2Kuantitas = $rencanaKinerjaGuru->target2_kuantitas;
        $rencanaKinerjaGuru->capaian_iki_kuantitas = ($realisasiKuantitas > $target2Kuantitas) ? (intdiv($realisasiKuantitas * 100, $target2Kuantitas)) : ($realisasiKuantitas >= $target1Kuantitas ? 100 : intdiv($realisasiKuantitas * 100, $target1Kuantitas));


        $rencanaKinerjaGuru->kategori_capaian_iki_kuantitas = $this->setKategoriIki($rencanaKinerjaGuru->capaian_iki_kuantitas);

        $realisasiWaktu = $rencanaKinerjaGuru->realisasi_waktu;
        $target1Waktu = $rencanaKinerjaGuru->target1_waktu;
        $target2Waktu = $rencanaKinerjaGuru->target2_waktu;
        $rencanaKinerjaGuru->capaian_iki_waktu = ($realisasiWaktu > $target2Waktu) ? (intdiv($realisasiWaktu * 100, $target2Waktu)) : ($realisasiWaktu >= $target1Waktu ? 100 : intdiv($realisasiWaktu * 100, $target1Waktu));
        $rencanaKinerjaGuru->kategori_capaian_iki_waktu = $this->setKategoriIki($rencanaKinerjaGuru->capaian_iki_waktu);

        $crkValue = $this->getCrkValue($rencanaKinerjaGuru->kategori_capaian_iki_kualitas, $rencanaKinerjaGuru->kategori_capaian_iki_kuantitas, $rencanaKinerjaGuru->kategori_capaian_iki_waktu);
        $rencanaKinerjaGuru->kategori_crk = $crkValue[0];
        $rencanaKinerjaGuru->nilai_crk = $crkValue[1];
        $rencanaKinerjaGuru->nilai_tertimbang = 100;
    }

    protected function getCrkValue($kategoriKualitas, $kategoriKuantitas, $kategoriWaktu): array
    {
        $kategoriIkiTotal = array_count_values([$kategoriKualitas, $kategoriKuantitas, $kategoriWaktu]);
        $crkPoint = constant(RencanaKinerjaGuru::class . "::" . $kategoriKualitas) + constant(RencanaKinerjaGuru::class . "::" . $kategoriKuantitas) + constant(RencanaKinerjaGuru::class . "::" . $kategoriWaktu);
        if ($crkPoint >= 45) {
            return ['SANGAT_BAIK', 120];
        }

        if (array_key_exists('SANGAT_KURANG', $kategoriIkiTotal) && $kategoriIkiTotal['SANGAT_KURANG'] >= 2) {
            return ['SANGAT_KURANG', 25];
        }

        if ((array_key_exists('KURANG', $kategoriIkiTotal) && $kategoriIkiTotal['KURANG'] >= 2) || (array_key_exists('SANGAT_KURANG', $kategoriIkiTotal) && $kategoriIkiTotal['SANGAT_KURANG'] >= 1)) {
            return ['KURANG', 60];
        }

        if ((array_key_exists('KURANG', $kategoriIkiTotal) && $kategoriIkiTotal['KURANG'] <= 1) || (array_key_exists('CUKUP', $kategoriIkiTotal) && $kategoriIkiTotal['CUKUP'] >= 2)) {
            return ['CUKUP', 80];
        }

        return ['BAIK', 100];
    }
    protected function setKategoriIki($value)
    {
        if ($value > 100) {
            return 'SANGAT_BAIK';
        }
        if ($value == 100) {
            return 'BAIK';
        }
        if ($value < 100 && $value >= 80) {
            return 'CUKUP';
        }
        if ($value < 80 && $value >= 60) {
            return 'KURANG';
        }
        return 'SANGAT_KURANG';
    }

    public function render()
    {
        return view('livewire.penilaian-perilaku.penilaian-perilaku-guru-show');
    }
}
