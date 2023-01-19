<?php

namespace Tests\Integration;

use App\Http\Livewire\Skp\SkpCreate;
use App\Http\Livewire\Skp\SkpForm;
use App\Http\Livewire\Skp\SkpShow;
use App\Models\DetailKinerja;
use App\Models\Kinerja;
use App\Models\Pangkat;
use App\Models\PejabatPenilai;
use App\Models\RencanaKinerjaGuru;
use App\Models\Skp;
use App\Models\SkpGuru;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CreateSkpGuruTest extends TestCase
{
    use DatabaseMigrations;

    public User $user;
    public User $timAngkaKredit;
    public User $pengelolaKinerja;
    public PejabatPenilai $pejabatPenilai;
    public Skp $skp;
    public DetailKinerja $detailKinerja;
    public Kinerja $kinerja;
    public SkpGuru $skpGuru;
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
        $this->skp = Skp::create([
            'periode_awal' => '2023-01-01',
            'periode_akhir' => '2023-12-31',
            'perencanaan' => '2023-02-01',
            'penilaian' => '2023-11-30',
            'tim_angka_kredit' => $this->timAngkaKredit->nip,
            'pengelola_kinerja' => $this->pengelolaKinerja->nip,
            'pejabat_penilai1' => $this->pejabatPenilai->nip,
            'pejabat_penilai2' => $this->pejabatPenilai->nip,
        ]);

        $this->kinerja = $this->skp->kinerjas()->create([
            'kategori' => 'utama',
            'deskripsi' => 'Test kinerja',
        ]);
        $this->detailKinerja = $this->kinerja->detailKinerjas()->create([
            'deskripsi' => 'test detail kinerja',
            'skp_id' => $this->skp->id,
            'butir_kegiatan' => 'test butir kegiatan',
            'output_kegiatan' => 'test',
            'tipe_angka_kredit' => 'persen',
            'angka_kredit' => '50',
            'pekerjaan' => 'test',
            'indikator_kualitas' => 'test',
            'indikator_kuantitas' => 'test',
            'indikator_waktu' => 'test',
        ]);
        $this->user = User::factory()->create([
            'tugas_tambahan' => 'test',
        ]);
        $this->user->roles()->sync('Guru');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_skp_guru_integration_test_success()
    {
        $this->actingAs($this->user);
        $skpShow = new SkpShow();
        $skpShow->skp = $this->skp;
        $skpShow->mount();

        $this->followRedirects($skpShow->createSkpGuru())->assertStatus(200)->assertSee('Kerangka SKP berhasil dibuat, silahkan rencanakan SKP anda!');
        
        $this->assertEquals(session()->get('alertType'),"success");
        $this->assertEquals(session()->get('alertMessage'),"Kerangka SKP berhasil dibuat, silahkan rencanakan SKP anda!");
        $this->assertTrue(SkpGuru::where([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
        ])->exists());

        $this->assertTrue(RencanaKinerjaGuru::where([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
            'detail_kinerja_id' => $this->detailKinerja->id
        ])->exists());
    }
    public function test_create_skp_guru_integration_test_success_without_rencana_kinerja()
    {
        $this->user->tugas_tambahan = "test-kinerja";
        $this->user->save();
        $this->user =  $this->user->refresh();

        $this->actingAs($this->user);

        $skpShow = new SkpShow();
        $skpShow->skp = $this->skp;
        $skpShow->mount();

        $this->followRedirects($skpShow->createSkpGuru())->assertStatus(200)->assertSee('Kerangka SKP berhasil dibuat, silahkan rencanakan SKP anda!');
        
        $this->assertEquals(session()->get('alertType'),"success");
        $this->assertEquals(session()->get('alertMessage'),"Kerangka SKP berhasil dibuat, silahkan rencanakan SKP anda!");
        
        $this->assertTrue(SkpGuru::where([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
        ])->exists());
        
        $this->assertFalse(RencanaKinerjaGuru::where([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
            'detail_kinerja_id' => $this->detailKinerja->id
        ])->exists());
    }

    public function test_create_skp_guru_integration_test_fail()
    {
        $this->skp->perencanaan = "2022-03-01";
        $this->skp->save();
        $this->skp = $this->skp->refresh();

        $this->actingAs($this->user);

        $skpShow = new SkpShow();
        $skpShow->skp = $this->skp;
        $skpShow->mount();

        $result = $skpShow->createSkpGuru();
        $this->assertNull($result);
        
        $this->assertFalse(SkpGuru::where([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
        ])->exists());

        $this->assertFalse(RencanaKinerjaGuru::where([
            'user_nip' => $this->user->nip,
            'skp_id' => $this->skp->id,
            'detail_kinerja_id' => $this->detailKinerja->id
        ])->exists());
    }
}
