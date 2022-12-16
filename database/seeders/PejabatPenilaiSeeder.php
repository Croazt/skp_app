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
       PejabatPenilai::factory(100)->create();
    }
}
