<?php

namespace Database\Factories;

use App\Models\Pangkat;
use App\Models\PejabatPenilai;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PejabatPenilaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PejabatPenilai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'nip' => strval($this->faker->numberBetween(100000000000000000, 9999999999999)),
            'pekerjaan' => 'pekerjaan',
            'pangkat_id' => Pangkat::inRandomOrder()->first(),
            'unit_kerja' => 'unit_kerja',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
