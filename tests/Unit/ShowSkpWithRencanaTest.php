<?php

namespace Tests\Unit;

use App\Http\Livewire\Skp\SkpCreate;
use App\Http\Livewire\Skp\SkpForm;
use App\Http\Livewire\Skp\SkpShow;
use App\Http\Livewire\SkpGuru\Guru\SkpGuruPeta;
use App\Http\Livewire\SkpGuru\SkpGuruTable;
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

class ShowSkpWithRencanaTest extends TestCase
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
    public RencanaKinerjaGuru $rencanaKinerjaGuru;
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
            'periode_awal' => '2022-01-01',
            'periode_akhir' => '2022-12-31',
            'perencanaan' => '2022-02-01',
            'penilaian' => '2022-11-30',
            'tim_angka_kredit' => $this->timAngkaKredit->nip,
            'pengelola_kinerja' => $this->pengelolaKinerja->nip,
            'pejabat_penilai' => $this->pejabatPenilai->nip,
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
        $this->skpGuru = $this->skp->skpGurus()->create([
            'user_nip' => $this->user->nip,
            'status' => 'dinilai',
        ]);
        $this->rencanaKinerjaGuru = RencanaKinerjaGuru::create([
            'user_nip' => $this->user->nip,
            'skp_guru_id' => $this->skpGuru->id,
            'skp_id'=>$this->skp->id,
            'detail_kinerja_id' => $this->detailKinerja->id,
            'target1_kuantitas' => 10,
            'target2_kuantitas' => 30,
            'target1_kualitas' => 10,
            'target2_kualitas' => 30,
            'target1_waktu' => 10,
            'target2_waktu' => 30,
            'realisasi_kuantitas' => 20,
            'realisasi_kualitas' => 20,
            'realisasi_waktu' => 20,
        ]);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_show_skp_rencana()
    {
        $this->actingAs($this->user);
        $skpGuru = new SkpGuruPeta();
        $skpGuru->skpGuru = $this->skpGuru;
        $skpGuru->viewType = 'penilaian';
        $skpGuru->mount();
        $view = $skpGuru->render();
        $this->assertNotNull($view);
    }
}
