<?php

namespace App\Http\Livewire\SkpGuru\Guru;

use App\Http\Livewire\SkpGuru\Traits\CalculateRealisasi;
use App\Models\PangkatPkgAk;
use App\Models\RencanaKinerjaGuru;
use App\Models\Skp;
use App\Models\SkpGuru;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Browsershot\Browsershot;
use ZipArchive;

class SkpGuruIndex extends Component
{
    public Skp $skp;
    public SkpGuru $skpGuru;
    public Collection $rencanaKinerjaGuru;
    public Collection $rencanaKinerjaGuruSql;
    use CalculateRealisasi;

    public function mount()
    {
        $this->skpGuru = $this->skp->skpGurus()->where('user_nip', auth()->user()->nip)->first();
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
            ->where('skp_guru_id',  $this->skpGuru->id)
            ->leftJoin('detail_kinerja', 'rencana_kinerja_guru.detail_kinerja_id', '=', 'detail_kinerja.id')
            ->leftJoin('kinerja', 'detail_kinerja.kinerja_id', '=', 'kinerja.id')
            ->orderBy('kinerja.deskripsi', 'asc')
            ->get();
    }
    public function render()
    {
        return view('livewire.skp-guru.guru.skp-guru-index');
    }

    public function downloadAllPdf()
    {
        $targetPkg = $this->skpGuru->target_pkg ?? 125;
        $targetPkgTambahan = $this->skpGuru->target_pkg_tambahan ?? 125;
        $targetJamPelajaran = $this->skpGuru->jam_pelajaran ?? 24;

        $rencanaKinerjaGuru = $this->skpGuru->rencanaKinerjaGurus()
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

        $rencanaKinerjaGuru = $rencanaKinerjaGuru->each(function ($item) use ($targetJamPelajaran, $targetPkg, $targetPkgTambahan) {
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


        $data = collect([
            'kinerja_desc' => $rencanaKinerjaGuru->pluck('kinerja_desc', 'id')->toArray(),
            'deskripsi' => $rencanaKinerjaGuru->pluck('deskripsi', 'id')->toArray(),
            'indikator_kualitas' => $rencanaKinerjaGuru->pluck('indikator_kualitas', 'id')->toArray(),
            'indikator_kuantitas' => $rencanaKinerjaGuru->pluck('indikator_kuantitas', 'id')->toArray(),
            'indikator_waktu' => $rencanaKinerjaGuru->pluck('indikator_waktu', 'id')->toArray(),
            'butir_kegiatan' => $rencanaKinerjaGuru->pluck('butir_kegiatan', 'id')->toArray(),
            'output_kegiatan' => $rencanaKinerjaGuru->pluck('output_kegiatan', 'id')->toArray(),
            'detail_output_kualitas' => $rencanaKinerjaGuru->pluck('detail_output_kualitas', 'id')->toArray(),
            'detail_output_kuantitas' => $rencanaKinerjaGuru->pluck('detail_output_kuantitas', 'id')->toArray(),
            'detail_output_waktu' => $rencanaKinerjaGuru->pluck('detail_output_waktu', 'id')->toArray(),
            'angka_kredit' => $rencanaKinerjaGuru->pluck('angka_kredit', 'id')->toArray(),
            'target1_kualitas' => $rencanaKinerjaGuru->pluck('target1_kualitas', 'id')->toArray(),
            'target2_kualitas' => $rencanaKinerjaGuru->pluck('target2_kualitas', 'id')->toArray(),
            'target1_kuantitas' => $rencanaKinerjaGuru->pluck('target1_kuantitas', 'id')->toArray(),
            'target2_kuantitas' => $rencanaKinerjaGuru->pluck('target2_kuantitas', 'id')->toArray(),
            'target1_waktu' => $rencanaKinerjaGuru->pluck('target1_waktu', 'id')->toArray(),
            'target2_waktu' => $rencanaKinerjaGuru->pluck('target2_waktu', 'id')->toArray(),
            'realisasi_kualitas' => $rencanaKinerjaGuru->pluck('realisasi_kualitas', 'id')->toArray(),
            'realisasi_kuantitas' => $rencanaKinerjaGuru->pluck('realisasi_kuantitas', 'id')->toArray(),
            'realisasi_waktu' => $rencanaKinerjaGuru->pluck('realisasi_waktu', 'id')->toArray(),
            'dokumen_bukti' => $rencanaKinerjaGuru->pluck('dokumen_bukti', 'id')->toArray(),
            'dokumen_diterima' => $rencanaKinerjaGuru->pluck('dokumen_diterima', 'id')->toArray(),
            'catatan_dokumen' => $rencanaKinerjaGuru->pluck('catatan_dokumen', 'id')->toArray(),
            'terkait' => $rencanaKinerjaGuru->pluck('terkait', 'id')->toArray(),
            'cascading' => $rencanaKinerjaGuru->pluck('cascading', 'id')->toArray(),
            'catatan' => $rencanaKinerjaGuru->pluck('catatan', 'id')->toArray(),
            'lingkup' => $rencanaKinerjaGuru->pluck('lingkup', 'id')->toArray(),
            'kategori' => $rencanaKinerjaGuru->pluck('kategori', 'id')->toArray(),
            'target_pkg' => $this->skpGuru->target_pkg,
            'target_pkg_tambahan' => $this->skpGuru->target_pkg_tambahan,
            'jam_pelajaran' => $this->skpGuru->jam_pelajaran,
            'capaian_pkg' => $this->skpGuru->capaian_pkg,
            'capaian_pkg_tambahan' => $this->skpGuru->capaian_pkg_tambahan,
            'capaian_jam_pelajaran' => $this->skpGuru->capaian_jam_pelajaran,
        ]);

        $capaianPkg = $this->skpGuru->capaian_pkg ?? 125;
        $capaianPkgTambahan = $this->skpGuru->capaian_pkg_tambahan ?? 125;
        $capaianJamPelajaran = $this->skpGuru->capaian_jam_pelajaran ?? 24;
        $rencanaKinerjaGuru = $rencanaKinerjaGuru->each(function ($item) use ($capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan) {
            $this->calculateRealisasiScore($item, $capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan);
        });
        $data = $data->merge([
            'capaian_iki_kuantitas' =>  $rencanaKinerjaGuru->pluck('capaian_iki_kuantitas', 'id')->toArray(),
            'capaian_iki_kualitas' =>  $rencanaKinerjaGuru->pluck('capaian_iki_kualitas', 'id')->toArray(),
            'capaian_iki_waktu' =>  $rencanaKinerjaGuru->pluck('capaian_iki_waktu', 'id')->toArray(),
            'kategori_capaian_iki_waktu' =>  $rencanaKinerjaGuru->pluck('kategori_capaian_iki_waktu', 'id')->toArray(),
            'kategori_capaian_iki_kualitas' =>  $rencanaKinerjaGuru->pluck('kategori_capaian_iki_kualitas', 'id')->toArray(),
            'kategori_capaian_iki_kuantitas' =>  $rencanaKinerjaGuru->pluck('kategori_capaian_iki_waktu', 'id')->toArray(),
            'kategori_crk' =>  $rencanaKinerjaGuru->pluck('kategori_crk', 'id')->toArray(),
            'nilai_crk' =>  $rencanaKinerjaGuru->pluck('nilai_crk', 'id')->toArray(),
            'nilai_tertimbang' =>  $rencanaKinerjaGuru->pluck('nilai_tertimbang', 'id')->toArray(),
        ]);
        // }
        $rencanaKinerjaUtama = $rencanaKinerjaGuru->filter(function ($item) {
            return $item->kategori == "utama";
        });
        $rencanaKinerjaTambahan = $rencanaKinerjaGuru->filter(function ($item) {
            return $item->kategori == "tambahan";
        });


        $view = '';
        $fileName = '';
        $margin = [
            'top' => 6,
            'bottom' => 6,
            'right' => 6,
            'left' => 6,
        ];
        $zip = new ZipArchive();
        $zipName = 'skp-' . $this->skpGuru->user_nip . '.zip';
        $zipFile = storage_path('app/public/file/zip/skp/' . $zipName);

        $zip->open($zipFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $view = (view('livewire.skp-guru.pdf.skp-guru-rencana', [
            'rencanaKinerjaUtama' => $rencanaKinerjaUtama,
            'rencanaKinerjaTambahan' => $rencanaKinerjaTambahan,
            'data' => $data,
            'skpGuru' => $this->skpGuru,
            'skp' => $this->skpGuru->skp,
        ])->render());
        $fileName =  $this->skpGuru->user_nip . '-rencana.pdf';
        $saveToFile = storage_path('app/public/file/rencana/' . $fileName);
        Browsershot::html($view)
            ->scale(1)
            ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
            ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
            ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

        $zip->addFile(storage_path('app/public/file/rencana/' . $fileName), $fileName);

        $view = (view('livewire.skp-guru.pdf.skp-guru-keterkaitan', [
            'rencanaKinerjaUtama' => $rencanaKinerjaUtama,
            'rencanaKinerjaTambahan' => $rencanaKinerjaTambahan,
            'data' => $data,
            'skpGuru' => $this->skpGuru,
            'skp' => $this->skpGuru->skp,
        ])->render());
        $fileName =  $this->skpGuru->user_nip . '-keterkaitan.pdf';
        $saveToFile = storage_path('app/public/file/keterkaitan/' . $fileName);
        Browsershot::html($view)
            ->scale(1)
            ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
            ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
            ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

        $zip->addFile(storage_path('app/public/file/keterkaitan/' . $fileName), $fileName);

        if (in_array($this->skpGuru->status, [SkpGuru::KONFIRMASI, SkpGuru::REVIU, SkpGuru::VERIFIKASI, SkpGuru::DINILAI, SkpGuru::BUKTI, SkpGuru::DITOLAK])) {
            $view = (view('livewire.skp-guru.pdf.skp-guru-reviu', [
                'rencanaKinerjaUtama' => $rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $rencanaKinerjaTambahan,
                'data' => $data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-reviu.pdf';
            $saveToFile = storage_path('app/public/file/reviu/' . $fileName);
            Browsershot::html($view)
                ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
                ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
                ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

            $zip->addFile(storage_path('app/public/file/reviu/' . $fileName), $fileName);
        }

        if (in_array($this->skpGuru->status, [SkpGuru::REVIU, SkpGuru::VERIFIKASI, SkpGuru::DINILAI, SkpGuru::BUKTI, SkpGuru::DITOLAK])) {
            $view = (view('livewire.skp-guru.pdf.skp-guru-verifikasi', [
                'rencanaKinerjaUtama' => $rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $rencanaKinerjaTambahan,
                'data' => $data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
                'rencanaKinerjaGuru' => $rencanaKinerjaGuru,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-verifikasi.pdf';
            $saveToFile = storage_path('app/public/file/verifikasi/' . $fileName);
            Browsershot::html($view)
                ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
                ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
                ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

            $zip->addFile(storage_path('app/public/file/verifikasi/' . $fileName), $fileName);
        }

        if (in_array($this->skpGuru->status, [SkpGuru::VERIFIKASI, SkpGuru::DINILAI, SkpGuru::BUKTI, SkpGuru::DITOLAK])) {
            $view = (view('livewire.skp-guru.pdf.skp-guru-penetapan', [
                'rencanaKinerjaUtama' => $rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $rencanaKinerjaTambahan,
                'data' => $data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
                'rencanaKinerjaGuru' => $rencanaKinerjaGuru,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-penetapan.pdf';
            $saveToFile = storage_path('app/public/file/penetapan/' . $fileName);
            Browsershot::html($view)
                ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
                ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
                ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

            $zip->addFile(storage_path('app/public/file/penetapan/' . $fileName), $fileName);
        }

        if (in_array($this->skpGuru->status, [SkpGuru::DINILAI])) {
            $view = (view('livewire.skp-guru.pdf.skp-guru-penilaian', [
                'rencanaKinerjaUtama' => $rencanaKinerjaUtama,
                'rencanaKinerjaTambahan' => $rencanaKinerjaTambahan,
                'data' => $data,
                'skpGuru' => $this->skpGuru,
                'skp' => $this->skpGuru->skp,
                'rencanaKinerjaGuru' => $rencanaKinerjaGuru,
            ])->render());
            $fileName =  $this->skpGuru->user_nip . '-penilaian.pdf';
            $margin = [
                'top' => 0,
                'bottom' => 0,
                'right' => 6,
                'left' => 6,
            ];
            $saveToFile = storage_path('app/public/file/penilaian/' . $fileName);
            Browsershot::html($view)
                ->setNodeBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/node')
                ->setNpmBinary('/home/fachry/.nvm/versions/node/v18.12.1/bin/npm')
                ->margins($margin['top'], $margin['right'], $margin['bottom'], $margin['left'])->savePdf($saveToFile);

            $zip->addFile(storage_path('app/public/file/penilaian/' . $fileName), $fileName);
        }
        $zip->close();

        return response()->streamDownload(function ()  use ($zipName) {
            echo file_get_contents(env('APP_URL') . "/storage/file/zip/skp/" . $zipName);
        }, $zipName);
    }
}
