<?php

namespace Database\Seeders;

use App\Models\PejabatPenilai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PejabatPenilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $atasan = PejabatPenilai::create(
            [
                'nama' => 'Dra. SURIYANI A.NUR RASULY, M.Pd',
                'nip' => '196511281992032006',
                'pekerjaan' => 'Kepala Cabang Dinas Pendidikan Wilayah VIII',
                'unit_kerja' => 'Dinas Pendidikan Provinsi Sulawesi Selatan',
                'pangkat_id' => 6,
            ]
        );
        PejabatPenilai::create(
            [
                'nama' => 'Drs. H. Mursalim, M.Si',
                'nip' => '196212311988031146',
                'pekerjaan' => 'Kepala Sekolah',
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP',
                'pangkat_id' => 7,
                'atasan' => $atasan->nip,
            ]
        );
    }
}
