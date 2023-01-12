<?php

namespace App\Http\Livewire\SkpGuru\Traits;

use App\Models\PangkatPkgAk;
use App\Models\RencanaKinerjaGuru;
use Illuminate\Support\Facades\Auth;

trait CalculateRealisasi
{
   
    protected function calculateRealisasiScore(RencanaKinerjaGuru $rencanaKinerjaGuru, $capaianJamPelajaran, $capaianPkg, $capaianPkgTambahan)
    {
        if ($rencanaKinerjaGuru->tipe_angka_kredit == 'persen') {
            $jamAndAk = ($capaianJamPelajaran / 24) * ($rencanaKinerjaGuru->angka_kredit / 100);
            if ($rencanaKinerjaGuru->pekerjaan == Auth::user()->tugas_tambahan) {
                $rencanaKinerjaGuru->realisasi_angka_kredit = PangkatPkgAk::where('pangkat_id', Auth::user()->pangkat_id)->first()->$capaianPkgTambahan * $jamAndAk;
            } else {
                $rencanaKinerjaGuru->realisasi_angka_kredit = PangkatPkgAk::where('pangkat_id', Auth::user()->pangkat_id)->first()->$capaianPkg * $jamAndAk;
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
}