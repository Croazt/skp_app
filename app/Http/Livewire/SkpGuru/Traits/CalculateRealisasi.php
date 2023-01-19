<?php

namespace App\Http\Livewire\SkpGuru\Traits;

use App\Models\PangkatPkgAk;
use App\Models\RencanaKinerjaGuru;
use Illuminate\Support\Facades\Auth;

trait CalculateRealisasi
{

    protected function calculateRealisasiScore()
    {
        $capaianPkg = $this->skpGuru->capaian_pkg ?? 125;
        $capaianPkgTambahan = $this->skpGuru->capaian_pkg_tambahan ?? 125;
        $capaianJamPelajaran = $this->skpGuru->capaian_jam_pelajaran ?? 24;
        $this->rencanaKinerjaGuru = $this->rencanaKinerjaGuru->each(function ($item) use ($capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan) {
            if ($item->tipe_angka_kredit == 'persen') {
                $jamAndAk = ($capaianJamPelajaran / 24) * ($item->angka_kredit / 100);
                if ($item->pekerjaan == Auth::user()->tugas_tambahan) {
                    $item->realisasi_angka_kredit = PangkatPkgAk::where('pangkat_id', Auth::user()->pangkat_id)->first()->$capaianPkgTambahan * $jamAndAk;
                } else {
                    $item->realisasi_angka_kredit = PangkatPkgAk::where('pangkat_id', Auth::user()->pangkat_id)->first()->$capaianPkg * $jamAndAk;
                }
                $item->realisasi_angka_kredit = round($item->angka_kredit, 2);
            } elseif ($item->tipe_angka_kredit == 'absolut' && $item->kategori == 'tambahan') {
                $item->realisasi_angka_kredit = $item->angka_kredit * $item->realisasi_kuantitas;
            }
            $realisasiKualitas = $item->realisasi_kualitas;
            $target1Kualitas = $item->target1_kualitas;
            $target2Kualitas = $item->target2_kualitas;
            $item->capaian_iki_kualitas = ($realisasiKualitas > $target2Kualitas) ? (intdiv($realisasiKualitas * 100, $target2Kualitas)) : ($realisasiKualitas >= $target1Kualitas ? 100 : intdiv($realisasiKualitas * 100, $target1Kualitas));
            $item->kategori_capaian_iki_kualitas = $this->setKategoriIki($item->capaian_iki_kualitas);

            $realisasiKuantitas = $item->realisasi_kuantitas;
            $target1Kuantitas = $item->target1_kuantitas;
            $target2Kuantitas = $item->target2_kuantitas;
            $item->capaian_iki_kuantitas = ($realisasiKuantitas > $target2Kuantitas) ? (intdiv($realisasiKuantitas * 100, $target2Kuantitas)) : ($realisasiKuantitas >= $target1Kuantitas ? 100 : intdiv($realisasiKuantitas * 100, $target1Kuantitas));


            $item->kategori_capaian_iki_kuantitas = $this->setKategoriIki($item->capaian_iki_kuantitas);

            $realisasiWaktu = $item->realisasi_waktu;
            $target1Waktu = $item->target1_waktu;
            $target2Waktu = $item->target2_waktu;
            $item->capaian_iki_waktu = ($realisasiWaktu > $target2Waktu) ? (intdiv($realisasiWaktu * 100, $target2Waktu)) : ($realisasiWaktu >= $target1Waktu ? 100 : intdiv($realisasiWaktu * 100, $target1Waktu));
            $item->kategori_capaian_iki_waktu = $this->setKategoriIki($item->capaian_iki_waktu);

            $crkValue = $this->getCrkValue($item->kategori_capaian_iki_kualitas, $item->kategori_capaian_iki_kuantitas, $item->kategori_capaian_iki_waktu);
            $item->kategori_crk = $crkValue[0];
            $item->nilai_crk = $crkValue[1];
            $item->nilai_tertimbang = 100;
        });
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
}
