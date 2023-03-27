<?php

namespace Database\Seeders;

use App\Models\PejabatPenilai;
use App\Models\Role;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class SkpSeeder extends Seeder
{
    /**
     * The current Faker instance.
     *
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Create a new seeder instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = $this->withFaker();
    }

    /**
     * Get a new Faker instance.
     *
     * @return \Faker\Generator
     */
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skp = Skp::create([
            'periode_awal' => '2022-01-01',
            'periode_akhir' => '2022-12-31',
            'perencanaan' => '2022-02-01',
            'penilaian' => '2022-11-30',
            'tim_angka_kredit' =>  User::whereEmail('zainal@test.com')->first()->nip,
            'pengelola_kinerja' => User::whereEmail('syarifuddin@test.com')->first()->nip,
            'pejabat_penilai' =>  PejabatPenilai::whereNip('196212311988031146')->first()->nip,
        ]);
        $skp = Skp::create([
            'periode_awal' => '2023-01-01',
            'periode_akhir' => '2023-12-31',
            'perencanaan' => '2023-02-01',
            'penilaian' => '2023-11-30',
            'tim_angka_kredit' =>  User::whereEmail('zainal@test.com')->first()->nip,
            'pengelola_kinerja' => User::whereEmail('syarifuddin@test.com')->first()->nip,
            'pejabat_penilai' =>  PejabatPenilai::whereNip('196212311988031146')->first()->nip,
        ]);
    }
}
