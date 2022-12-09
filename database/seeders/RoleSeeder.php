<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate(
            ["nama" => "Operator"],
            ["nama" => "Operator"]
        );
        Role::updateOrCreate(
            ["nama" => "Guru"],
            ["nama" => "Guru"]
        );
        Role::updateOrCreate(
            ["nama" => "Tim Angka Kredit"],
            ["nama" => "Tim Angka Kredit"]
        );
        Role::updateOrCreate(
            ["nama" => "Pengelola Kinerja"],
            ["nama" => "Pengelola Kinerja"]
        );
        Role::updateOrCreate(
            ["nama" => "Kepala Sekolah"],
            ["nama" => "Kepala Sekolah"]
        );
    }
}
