<?php

namespace App\Http\Livewire\SkpGuru\Traits;

use App\Http\Controllers\SkpGuruController;
use App\Models\PangkatPkgAk;
use App\Models\RencanaKinerjaGuru;
use App\Models\SkpGuru;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;
use ZipArchive;

trait SkpGuruMap
{
    public string $viewType;

    public SkpGuru $skpGuru;
    public Collection $rencanaKinerjaGuru;
    public Collection $rencanaKinerjaUtama;
    public Collection $rencanaKinerjaTambahan;
    public SupportCollection $data;
    public SupportCollection $dokumen;

    use CalculateRealisasi;

    public function mount()
    {
        $targetPkg = $this->skpGuru->target_pkg ?? 125;
        $targetPkgTambahan = $this->skpGuru->target_pkg_tambahan ?? 125;
        $targetJamPelajaran = $this->skpGuru->jam_pelajaran ?? 24;

        $this->rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus()
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
            ->where('skp_guru_id', $this->skpGuru->id)
            ->leftJoin('detail_kinerja', 'rencana_kinerja_guru.detail_kinerja_id', '=', 'detail_kinerja.id')
            ->leftJoin('kinerja', 'detail_kinerja.kinerja_id', '=', 'kinerja.id')
            ->orderBy('kinerja.deskripsi', 'asc')
            ->get();

        $this->rencanaKinerjaGuru = $this->rencanaKinerjaGuru->each(function ($item) use ($targetJamPelajaran, $targetPkg, $targetPkgTambahan) {
            if ($item->tipe_angka_kredit == 'persen') {
                $jamAndAk = ($targetJamPelajaran / 24) * ($item->angka_kredit / 100);
                if ($item->pekerjaan == Auth::user()->tugas_tambahan) {
                    $item->angka_kredit = PangkatPkgAk::where('pangkat_id', Auth::user()->pangkat_id)->first()->$targetPkgTambahan * $jamAndAk;
                } else {
                    $item->angka_kredit = PangkatPkgAk::where('pangkat_id', Auth::user()->pangkat_id)->first()->$targetPkg * $jamAndAk;
                }
                $item->angka_kredit = round($item->angka_kredit, 2);
            }
        });


        $this->data = collect([
            'kinerja_desc' => $this->rencanaKinerjaGuru->pluck('kinerja_desc', 'id')->toArray(),
            'deskripsi' => $this->rencanaKinerjaGuru->pluck('deskripsi', 'id')->toArray(),
            'indikator_kualitas' => $this->rencanaKinerjaGuru->pluck('indikator_kualitas', 'id')->toArray(),
            'indikator_kuantitas' => $this->rencanaKinerjaGuru->pluck('indikator_kuantitas', 'id')->toArray(),
            'indikator_waktu' => $this->rencanaKinerjaGuru->pluck('indikator_waktu', 'id')->toArray(),
            'butir_kegiatan' => $this->rencanaKinerjaGuru->pluck('butir_kegiatan', 'id')->toArray(),
            'output_kegiatan' => $this->rencanaKinerjaGuru->pluck('output_kegiatan', 'id')->toArray(),
            'detail_output_kualitas' => $this->rencanaKinerjaGuru->pluck('detail_output_kualitas', 'id')->toArray(),
            'detail_output_kuantitas' => $this->rencanaKinerjaGuru->pluck('detail_output_kuantitas', 'id')->toArray(),
            'detail_output_waktu' => $this->rencanaKinerjaGuru->pluck('detail_output_waktu', 'id')->toArray(),
            'angka_kredit' => $this->rencanaKinerjaGuru->pluck('angka_kredit', 'id')->toArray(),
            'target1_kualitas' => $this->rencanaKinerjaGuru->pluck('target1_kualitas', 'id')->toArray(),
            'target2_kualitas' => $this->rencanaKinerjaGuru->pluck('target2_kualitas', 'id')->toArray(),
            'target1_kuantitas' => $this->rencanaKinerjaGuru->pluck('target1_kuantitas', 'id')->toArray(),
            'target2_kuantitas' => $this->rencanaKinerjaGuru->pluck('target2_kuantitas', 'id')->toArray(),
            'target1_waktu' => $this->rencanaKinerjaGuru->pluck('target1_waktu', 'id')->toArray(),
            'target2_waktu' => $this->rencanaKinerjaGuru->pluck('target2_waktu', 'id')->toArray(),
            'realisasi_kualitas' => $this->rencanaKinerjaGuru->pluck('realisasi_kualitas', 'id')->toArray(),
            'realisasi_kuantitas' => $this->rencanaKinerjaGuru->pluck('realisasi_kuantitas', 'id')->toArray(),
            'realisasi_waktu' => $this->rencanaKinerjaGuru->pluck('realisasi_waktu', 'id')->toArray(),
            'dokumen_bukti' => $this->rencanaKinerjaGuru->pluck('dokumen_bukti', 'id')->toArray(),
            'dokumen_diterima' => $this->rencanaKinerjaGuru->pluck('dokumen_diterima', 'id')->toArray(),
            'catatan_dokumen' => $this->rencanaKinerjaGuru->pluck('catatan_dokumen', 'id')->toArray(),
            'terkait' => $this->rencanaKinerjaGuru->pluck('terkait', 'id')->toArray(),
            'cascading' => $this->rencanaKinerjaGuru->pluck('cascading', 'id')->toArray(),
            'catatan' => $this->rencanaKinerjaGuru->pluck('catatan', 'id')->toArray(),
            'lingkup' => $this->rencanaKinerjaGuru->pluck('lingkup', 'id')->toArray(),
            'kategori' => $this->rencanaKinerjaGuru->pluck('kategori', 'id')->toArray(),
            'target_pkg' => $this->skpGuru->target_pkg,
            'target_pkg_tambahan' => $this->skpGuru->target_pkg_tambahan,
            'jam_pelajaran' => $this->skpGuru->jam_pelajaran,
            'capaian_pkg' => $this->skpGuru->capaian_pkg,
            'capaian_pkg_tambahan' => $this->skpGuru->capaian_pkg_tambahan,
            'capaian_jam_pelajaran' => $this->skpGuru->capaian_jam_pelajaran,
        ]);
        // if ($this->viewType == 'penilaian') {
        $capaianPkg = $this->skpGuru->capaian_pkg ?? 125;
        $capaianPkgTambahan = $this->skpGuru->capaian_pkg_tambahan ?? 125;
        $capaianJamPelajaran = $this->skpGuru->capaian_jam_pelajaran ?? 24;
        $this->rencanaKinerjaGuru = $this->rencanaKinerjaGuru->each(function ($item) use ($capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan) {
            $this->calculateRealisasiScore($item, $capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan);
        });
        $this->data = $this->data->merge([
            'capaian_iki_kuantitas' =>  $this->rencanaKinerjaGuru->pluck('capaian_iki_kuantitas', 'id')->toArray(),
            'capaian_iki_kualitas' =>  $this->rencanaKinerjaGuru->pluck('capaian_iki_kualitas', 'id')->toArray(),
            'capaian_iki_waktu' =>  $this->rencanaKinerjaGuru->pluck('capaian_iki_waktu', 'id')->toArray(),
            'kategori_capaian_iki_waktu' =>  $this->rencanaKinerjaGuru->pluck('kategori_capaian_iki_waktu', 'id')->toArray(),
            'kategori_capaian_iki_kualitas' =>  $this->rencanaKinerjaGuru->pluck('kategori_capaian_iki_kualitas', 'id')->toArray(),
            'kategori_capaian_iki_kuantitas' =>  $this->rencanaKinerjaGuru->pluck('kategori_capaian_iki_waktu', 'id')->toArray(),
            'kategori_crk' =>  $this->rencanaKinerjaGuru->pluck('kategori_crk', 'id')->toArray(),
            'nilai_crk' =>  $this->rencanaKinerjaGuru->pluck('nilai_crk', 'id')->toArray(),
            'nilai_tertimbang' =>  $this->rencanaKinerjaGuru->pluck('nilai_tertimbang', 'id')->toArray(),
        ]);
        // }
        $this->dokumen = collect([$this->rencanaKinerjaGuru->pluck('', 'id')->toArray()]);
        $this->rencanaKinerjaUtama = $this->rencanaKinerjaGuru->filter(function ($item) {
            return $item->kategori == "utama";
        });
        $this->rencanaKinerjaTambahan = $this->rencanaKinerjaGuru->filter(function ($item) {
            return $item->kategori == "tambahan";
        });
    }


    public function refresh()
    {
        $this->mount();
    }

    public function renderHeader(string $text, string $class = '', int $rowspan = 1, int $colspan = 1): string
    {
        $rowspanText = 'rowspan=' . $rowspan;
        $colspanText = 'colspan=' . $colspan;
        $header = sprintf('<th class="%s tw-align-middle" %s %s>%s</th>', $class, $rowspanText, $colspanText, $text);
        return $header;
    }
    public function updateTargetCapaian(int $rencanaId, int $value, string $field)
    {
        $rencana = RencanaKinerjaGuru::find($rencanaId);
        $rencana->$field = $value;
        $rencana->save();
    }

    public function downloadPdf()
    {
        $view = '';
        $fileName = '';
        $margin = [
            'top' => 6,
            'bottom' => 6,
            'right' => 6,
            'left' => 6,
        ];
        if ($this->viewType == 'rencana') {
            $view = (view('livewire.skp-guru.pdf.skp-guru-rencana', [
                'rencanaKinerjaUtama' => $this->rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $this->rencanaKinerjaTambahan,
                'data' => $this->data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-rencana.pdf';
        };
        if ($this->viewType == 'keterkaitan') {
            $view = (view('livewire.skp-guru.pdf.skp-guru-keterkaitan', [
                'rencanaKinerjaUtama' => $this->rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $this->rencanaKinerjaTambahan,
                'data' => $this->data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-keterkaitan.pdf';
        }
        if ($this->viewType == 'reviu') {
            $view = (view('livewire.skp-guru.pdf.skp-guru-reviu', [
                'rencanaKinerjaUtama' => $this->rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $this->rencanaKinerjaTambahan,
                'data' => $this->data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-reviu.pdf';
        }
        if ($this->viewType == 'verifikasi') {
            $view = (view('livewire.skp-guru.pdf.skp-guru-verifikasi', [
                'rencanaKinerjaUtama' => $this->rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $this->rencanaKinerjaTambahan,
                'data' => $this->data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
                'rencanaKinerjaGuru' => $this->rencanaKinerjaGuru,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-verifikasi.pdf';
        }
        if ($this->viewType == 'penetapan') {
            $view = (view('livewire.skp-guru.pdf.skp-guru-penetapan', [
                'rencanaKinerjaUtama' => $this->rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $this->rencanaKinerjaTambahan,
                'data' => $this->data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
                'rencanaKinerjaGuru' => $this->rencanaKinerjaGuru,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-penetapan.pdf';
        }
        if ($this->viewType == 'penilaian') {
            $view = (view('livewire.skp-guru.pdf.skp-guru-penilaian', [
                'rencanaKinerjaUtama' => $this->rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $this->rencanaKinerjaTambahan,
                'data' => $this->data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
                'rencanaKinerjaGuru' => $this->rencanaKinerjaGuru,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-penilaian.pdf';
            $margin = [
                'top' => 0,
                'bottom' => 0,
                'right' => 6,
                'left' => 6,
            ];
        }
        $saveToFile = storage_path('app/public/file/' . $this->viewType . '/' . $fileName);
        Browsershot::html($view)
            ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
            ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
            ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

        return response()->streamDownload(function ()  use ($fileName) {
            echo file_get_contents(env('APP_URL') . "/storage/file/" . $this->viewType . '/' . $fileName);
        }, $fileName);
    }
}
