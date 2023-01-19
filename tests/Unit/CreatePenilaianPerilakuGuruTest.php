<?php

namespace Tests\Unit;

use App\Http\Livewire\PenilaianPerilaku\PenilaianPerilakuCreate;
use App\Models\AspekPerilaku;
use App\Models\Pangkat;
use App\Models\PejabatPenilai;
use App\Models\PenilaianPerilakuGuru;
use App\Models\Skp;
use App\Models\SkpGuru;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreatePenilaianPerilakuGuruTest extends TestCase
{
    use DatabaseMigrations;

    public User $user;
    public User $kepalaSekolah;
    public User $timAngkaKredit;
    public User $pengelolaKinerja;
    public PejabatPenilai $pejabatPenilai;
    public Skp $skp;
    public SkpGuru $skpGuru;
    public Collection $aspekPerilaku;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('PangkatSeeder');
        $this->seed('RoleSeeder');
        $this->seed('AspekPerilakuSeeder');
        sleep(2);
        $this->timAngkaKredit = User::factory()->create();
        $this->timAngkaKredit->roles()->sync('Tim Angka Kredit');
        $this->pengelolaKinerja = User::factory()->create();
        $this->pengelolaKinerja->roles()->sync('Pengelola Kinerja');
        $this->pejabatPenilai = PejabatPenilai::factory()->create();
        $this->skp = Skp::create([
            'periode_awal' => '2022-01-01',
            'periode_akhir' => '2022-12-31',
            'perencanaan' => '2022-02-01',
            'penilaian' => '2022-11-30',
            'tim_angka_kredit' => $this->timAngkaKredit->nip,
            'pengelola_kinerja' => $this->pengelolaKinerja->nip,
            'pejabat_penilai1' => $this->pejabatPenilai->nip,
            'pejabat_penilai2' => $this->pejabatPenilai->nip,
        ]);
        $this->user = User::factory()->create([
            'pangkat_id' => Pangkat::where('golongan_ruang', 'III/a')->first()->id,
            'tugas_tambahan' => 'test',
        ]);
        $this->kepalaSekolah = User::factory()->create();
        $this->user->roles()->sync('Kepala Sekolah');
        $this->aspekPerilaku = AspekPerilaku::all();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_penilaian_perilaku_success()
    {
        $this->actingAs($this->kepalaSekolah);

        $penilaianPerilakuCreate =  new PenilaianPerilakuCreate();
        $penilaianPerilakuCreate->skp = $this->skp;
        $penilaianPerilakuCreate->user = $this->user;
        $penilaianPerilakuCreate->mount();
        $dataTemp = $penilaianPerilakuCreate->data->toArray();
        foreach ($this->aspekPerilaku as $aspek) {
            foreach ($dataTemp[$aspek->nama]['indikator_penilaian_perilaku'] as $key => $item) {
                $indikatorKey = array_key_first($dataTemp[$aspek->nama]['indikatorKerja']);
                $dataTemp[$aspek->nama]['indikator_penilaian_perilaku'][$key] = $dataTemp[$aspek->nama]['indikatorKerja'][$indikatorKey]['id'];
            }
        };
        $penilaianPerilakuCreate->data = collect($dataTemp);

        $this->followRedirects($penilaianPerilakuCreate->save())->assertStatus(200)->assertSee('Penilaian perilaku berhasil dibuat!.');
        $this->assertTrue(PenilaianPerilakuGuru::where([
            'skp_id' => $this->skp->id,
            'user_nip' => $this->user->nip,
        ])->exists());

        $this->aspekPerilaku->each(function ($item) {
            $this->assertTrue(PenilaianPerilakuGuru::where([
                'skp_id' => $this->skp->id,
                'user_nip' => $this->user->nip,
            ])->exists());
        });
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_penilaian_perilaku_fail()
    {
        $this->actingAs($this->kepalaSekolah);

        $penilaianPerilakuCreate =  new PenilaianPerilakuCreate();
        $penilaianPerilakuCreate->skp = $this->skp;
        $penilaianPerilakuCreate->user = $this->user;
        $penilaianPerilakuCreate->mount();

        $this->assertNull($penilaianPerilakuCreate->save());

        $this->assertFalse(PenilaianPerilakuGuru::where([
            'skp_id' => $this->skp->id,
            'user_nip' => $this->user->nip,
        ])->exists());

        $this->aspekPerilaku->each(function ($item) {

            $this->assertFalse(PenilaianPerilakuGuru::where([
                'skp_id' => $this->skp->id,
                'user_nip' => $this->user->nip,
            ])->exists());
        });
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_penilaian_perilaku_without_situasi()
    {
        AspekPerilaku::query()->delete();
        $this->actingAs($this->kepalaSekolah);

        $penilaianPerilakuCreate =  new PenilaianPerilakuCreate();
        $penilaianPerilakuCreate->skp = $this->skp;
        $penilaianPerilakuCreate->user = $this->user;
        $penilaianPerilakuCreate->mount();


        $this->followRedirects($penilaianPerilakuCreate->save())->assertStatus(200)->assertSee('Penilaian perilaku berhasil dibuat!.');

        $this->assertTrue(PenilaianPerilakuGuru::where([
            'skp_id' => $this->skp->id,
            'user_nip' => $this->user->nip,
        ])->exists());
    }
}
