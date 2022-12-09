<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'0'],
            ['id'=>0,'pangkat'=>'0','jabatan'=>'0','golongan_ruang'=>'0']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'0'],
            ['id'=>0]
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'III/a'],
            ['pangkat'=>'Penata Muda','jabatan'=>'Guru Pertama','golongan_ruang'=>'III/a']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'III/b'],
            ['pangkat'=>'Penata Muda Tk. 1','jabatan'=>'Guru Pertama','golongan_ruang'=>'III/b']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'III/c'],
            ['pangkat'=>'Penata','jabatan'=>'Guru Muda','golongan_ruang'=>'III/c']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'III/d'],
            ['pangkat'=>'Penata Tk. 1','jabatan'=>'Guru Muda','golongan_ruang'=>'III/d']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/a'],
            ['pangkat'=>'Pembina','jabatan'=>'Guru Madya','golongan_ruang'=>'IV/a']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/b'],
            ['pangkat'=>'Pembina Tk. 1','jabatan'=>'Guru Madya','golongan_ruang'=>'IV/b']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/c'],
            ['pangkat'=>'Pembina Utama Muda','jabatan'=>'Guru Madya','golongan_ruang'=>'IV/c']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/d'],
            ['pangkat'=>'Pembina Utama Madya','jabatan'=>'Guru Utama','golongan_ruang'=>'IV/d']
        );
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/e'],
            ['pangkat'=>'Pembina Utama','jabatan'=>'Guru Utama','golongan_ruang'=>'IV/e']
        );
    }
}
