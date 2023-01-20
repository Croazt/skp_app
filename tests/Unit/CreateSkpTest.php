<?php

namespace Tests\Unit;

use App\Http\Livewire\Skp\SkpCreate;
use App\Http\Livewire\Skp\SkpForm;
use App\Models\Pangkat;
use App\Models\PejabatPenilai;
use App\Models\Skp;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateSkpTest extends TestCase
{
    use DatabaseMigrations;

    public User $user;
    public User $timAngkaKredit;
    public User $pengelolaKinerja;
    public PejabatPenilai $pejabatPenilai;
    public function setUp(): void
    {
        parent::setUp();

        $this->seed('PangkatSeeder');
        $this->seed('RoleSeeder');

        $this->timAngkaKredit = User::factory()->create();
        $this->timAngkaKredit->roles()->sync('Tim Angka Kredit');
        $this->pengelolaKinerja = User::factory()->create();
        $this->pengelolaKinerja->roles()->sync('Pengelola Kinerja');
        $this->pejabatPenilai = PejabatPenilai::factory()->create();
        $this->user = User::factory()->create();
        $this->user->roles()->sync('Operator');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_skp_success()
    {
        $this->actingAs($this->user);
        Livewire::test(SkpCreate::class)
            ->set('data.periode_awal', '2022-01-01')
            ->set('data.periode_akhir', '2022-12-31')
            ->set('data.perencanaan', '2022-02-01')
            ->set('data.penilaian', '2022-11-30')
            ->set('data.tim_angka_kredit', $this->timAngkaKredit->nip)
            ->set('data.pengelola_kinerja', $this->pengelolaKinerja->nip)
            ->set('data.pejabat_penilai',  $this->pejabatPenilai->nip)
            ->call('save')
            ->assertRedirect(route('skp.index'));

        $this->assertTrue(Skp::wherePeriodeAwal('2022-01-01')
            ->wherePeriodeAkhir('2022-12-31')
            ->where('periode_akhir', '2022-12-31')
            ->where('perencanaan', '2022-02-01')
            ->where('penilaian', '2022-11-30')
            ->where('tim_angka_kredit', $this->timAngkaKredit->nip)
            ->where('pengelola_kinerja', $this->pengelolaKinerja->nip)
            ->where('pejabat_penilai',  $this->pejabatPenilai->nip)
            ->exists());
    }
    public function test_create_skp_periode_fail()
    {
        Livewire::test(SkpCreate::class)
            ->set('data.periode_awal', '2022-01-01')
            ->set('data.periode_akhir', '2022-12-31')
            ->set('data.perencanaan', '2022-01-12')
            ->set('data.penilaian', '2022-11-30')
            ->set('data.tim_angka_kredit', $this->timAngkaKredit->nip)
            ->set('data.pengelola_kinerja', $this->pengelolaKinerja->nip)
            ->set('data.pejabat_penilai',  $this->pejabatPenilai->nip)
            ->call('save')
            ->assertHasErrors();

        $this->assertFalse(Skp::wherePeriodeAwal('2022-01-01')
            ->wherePeriodeAkhir('2022-12-31')
            ->where('periode_akhir', '2022-12-31')
            ->where('perencanaan', '2022-02-01')
            ->where('penilaian', '2022-11-30')
            ->where('tim_angka_kredit', $this->timAngkaKredit->nip)
            ->where('pengelola_kinerja', $this->pengelolaKinerja->nip)
            ->where('pejabat_penilai',  $this->pejabatPenilai->nip)
            ->exists());
    }
    
    public function test_create_skp_field_null()
    {
        Livewire::test(SkpCreate::class)
            ->call('save');

        $this->assertFalse(Skp::wherePeriodeAwal('2022-01-01')
            ->wherePeriodeAkhir('2022-12-31')
            ->where('periode_akhir', '2022-12-31')
            ->where('perencanaan', '2022-02-01')
            ->where('penilaian', '2022-11-30')
            ->where('tim_angka_kredit', $this->timAngkaKredit->nip)
            ->where('pengelola_kinerja', $this->pengelolaKinerja->nip)
            ->where('pejabat_penilai',  $this->pejabatPenilai->nip)
            ->exists());
    }
}
