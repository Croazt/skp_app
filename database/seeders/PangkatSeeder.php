<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 2,
            '125'=>'13.13',
            '100'=>'10.50',
            '75'=>'7.88',
            '50'=>'7.88',
            '25'=>'7.88',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'III/b'],
            ['pangkat'=>'Penata Muda Tk. 1','jabatan'=>'Guru Pertama','golongan_ruang'=>'III/b']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 3,
            '125'=>'11.88',
            '100'=>'9.50',
            '75'=>'7.13',
            '50'=>'7.13',
            '25'=>'7.13',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'III/c'],
            ['pangkat'=>'Penata','jabatan'=>'Guru Muda','golongan_ruang'=>'III/c']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 4,
            '125'=>'25.31',
            '100'=>'20.25',
            '75'=>'15.19',
            '50'=>'15.19',
            '25'=>'15.19',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'III/d'],
            ['pangkat'=>'Penata Tk. 1','jabatan'=>'Guru Muda','golongan_ruang'=>'III/d']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 5,
            '125'=>'24.38',
            '100'=>'19.50',
            '75'=>'14.53',
            '50'=>'14.53',
            '25'=>'14.53',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/a'],
            ['pangkat'=>'Pembina','jabatan'=>'Guru Madya','golongan_ruang'=>'IV/a']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 6,
            '125'=>'37.19',
            '100'=>'29.75',
            '75'=>'22.31',
            '50'=>'22.31',
            '25'=>'22.31',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/b'],
            ['pangkat'=>'Pembina Tk. 1','jabatan'=>'Guru Madya','golongan_ruang'=>'IV/b']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 7,
            '125'=>'37.19',
            '100'=>'29.75',
            '75'=>'22.31',
            '50'=>'22.31',
            '25'=>'22.31',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/c'],
            ['pangkat'=>'Pembina Utama Muda','jabatan'=>'Guru Madya','golongan_ruang'=>'IV/c']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 8,
            '125'=>'37.19',
            '100'=>'29.75',
            '75'=>'22.31',
            '50'=>'22.31',
            '25'=>'22.31',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/d'],
            ['pangkat'=>'Pembina Utama Madya','jabatan'=>'Guru Utama','golongan_ruang'=>'IV/d']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 9,
            '125'=>'36.25',
            '100'=>'29.00',
            '75'=>'21.75',
            '50'=>'21.75',
            '25'=>'21.75',
        ]);
        Pangkat::updateOrCreate(
            ['golongan_ruang'=>'IV/e'],
            ['pangkat'=>'Pembina Utama','jabatan'=>'Guru Utama','golongan_ruang'=>'IV/e']
        );
        DB::table('pangkat_pkg_ak')->insert([
            'pangkat_id' => 10,
            '125'=>'48.44',
            '100'=>'38.75',
            '75'=>'29.06',
            '50'=>'29.06',
            '25'=>'29.06',
        ]);
    }
}
