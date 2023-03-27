<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Container\Container;

class UserSeeder extends Seeder
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
        $PEKERJAAN = [
            'Guru Mata Pelajaran',
            'Guru Bimbingan Konseling',
            'Guru Kelas',
            'Guru Kelompok',
        ];
        $user = [
            [
                'nama' => 'Drs. H. Mursalim, M.Si', 
                'nip' => '196212311988031146',
                'pekerjaan' => 'Kepala Sekolah', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Guru Mata Pelajaran', 
                'email' => 'mursalim@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Abd. Rahman, S.Pd.I., MA', 
                'nip' => '198008252009011004', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Guru Bimbingan Konseling', 
                'email' => 'rahman@test.com', 'pangkat_id' => 6, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Zainab, S.Ag., MA', 
                'nip' => '197011292006042006', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Guru Bimbingan Konseling', 
                'email' => 'zainab@test.com', 'pangkat_id' => 6, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Abd. Rahim, S.Pd., M.Pd', 
                'nip' => '197011072002121005', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'rahim@test.com', 'pangkat_id' => 6, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Dra. Hj. Ridha Abbas, M.Pd', 
                'nip' => '196901072000122004', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'ridha@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Muh. Basri Abbas, SS, S.Pd., M.Si', 
                'nip' => '197501292006041009', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'basri@test.com', 'pangkat_id' => 6, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => ' Zainal, S.Pd.,Gr., S.Kom., M.Pd.', 
                'nip' => '197404272009011006', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'zainal@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Dra. Hj. Sitti Masitah, S.Pd., M.Si.', 
                'nip' => '196308251987032018', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'sittim@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Rahmat Ahmad, S.Pd., M.Pd. ', 
                'nip' => '198702202011011002', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Wakil Kepala Sekolah', 
                'email' => 'rahmat@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Hasmuriyani, S.Pd., Gr., M.Si.', 
                'nip' => '198311202006042013', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'hasmuriyani@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Jusmiati, S.Pd., M.Si.', 
                'nip' => '197909212006042016', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'jusmiati@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Harus, S.Pd., M.Pd., M.Ed', 
                'nip' => '196505271988031015', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'harus@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Drs. Mansur, M.Si.', 
                'nip' => '196510221991031009', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'mansur@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Syarifuddin, S.Pd., M.Pd.', 
                'nip' => '198411102009011009', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Wakil Kepala Sekolah', 
                'email' => 'syarifuddin@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Asrawarsita, S.Si', 
                'nip' => '198001302009012003', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Wakil Kepala Sekolah', 
                'email' => 'asrawarsita@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'St. Namri HP, S.Pd., M.Si.', 
                'nip' => '198208242010012020', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'namri@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Roswati, S.Pd., M.MPd.', 
                'nip' => '196912311992032039', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'roswati@test.com', 'pangkat_id' => 6, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Roeskandar, S.Pd.', 
                'nip' => '196811261997021002', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'roeskandar@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Abd. Wahid, S.Pd.', 
                'nip' => '196910202000121009', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'wahid@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Muhammad Idrus, S.Pd., Gr., M.Pd.', 
                'nip' => '196701011995121010', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'idrus@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Hj. Sitti Halimah, S.Pd.', 
                'nip' => '196406261988032012', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'sitti@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Muh. Akib Mappa, S.Pd., M.Si.', 
                'nip' => '196310041987031010', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'akib@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Hj. Marhani, S.Pd., M.Si.', 
                'nip' => '196711101992032016', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'marhani@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Hasdiana Saima Kamaluddin, S.Pd', 
                'nip' => '196507031989012002', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Kepala Laboratorium', 
                'email' => 'hasdiana@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Hj. Nursyam, S.Pd., M.Si.', 
                'nip' => '196403221987032007', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'nursyam@test.com', 'pangkat_id' => 8, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Suriyani Nur, S.Pd', 
                'nip' => '198109292011012004', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'suriyani@test.com', 'pangkat_id' => 4, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Drs. Akmal, M.Pd.', 
                'nip' => '196412311989021026', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'akmal@test.com', 'pangkat_id' => 9, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Jafar N, S.Pd., M.Si.', 
                'nip' => '196412311994011018', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'jafar@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Drs. Saudi, M.Si.', 
                'nip' => '196312311988031171', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'saudi@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Drs. Ikhsan Nur, M.Si.', 
                'nip' => '196609091992031016', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'ikhsan@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Nur Sam, S.Pd., M.Si.', 
                'nip' => '196412311991031124', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'sam@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Rusli Rahman, SE., Gr., M.Si.', 
                'nip' => '198009132010011014', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'rusli@test.com', 'pangkat_id' => 4, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Mahyuddin, S.Pd., M.Pd.', 
                'nip' => '197906152009011005', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => 'Wakil Kepala Sekolah', 
                'email' => 'mahyuddin@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Rusman, SE.', 
                'nip' => '197404042009011008', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'rusman@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Rosmawati K, S.Sos., Gr.', 
                'nip' => '198305302010012015', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'rosmawati@test.com', 'pangkat_id' => 4, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Drs. H. Agussalim, M.Si.', 
                'nip' => '196412311993031113', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'agussalim@test.com', 'pangkat_id' => 7, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
            [
                'nama' => 'Adnan Tutu, S.Kom., M.I.Kom.', 
                'nip' => '198502102011011002', 
                'pekerjaan' => 'Guru Mata Pelajaran', 
                'unit_kerja' => 'UPT. SMA NEGERI 2 SIDRAP', 
                'tugas_tambahan' => null, 
                'email' => 'adnan@test.com', 'pangkat_id' => 5, 
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ],
        ];
        User::insert($user);
        User::all()->each(function ($user) {
            $user->roles()->sync(['Guru']);
        });
        User::whereEmail('mursalim@test.com')->first()?->roles()->sync(['Kepala Sekolah']);
        User::whereEmail('adnan@test.com')->first()?->roles()->sync(['Operator']);
        User::whereEmail('asra@test.com')->first()?->roles()->sync(['Operator']);
        User::whereEmail('syarifuddin@test.com')->first()?->roles()->sync(['Pengelola Kinerja']);
        User::whereEmail('zainal@test.com')->first()?->roles()->sync(['Tim Angka Kredit']);
    }
}
