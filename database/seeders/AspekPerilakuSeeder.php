<?php

namespace Database\Seeders;

use App\Models\AspekPerilaku;
use App\Models\Pangkat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AspekPerilakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $aspek = AspekPerilaku::updateOrCreate(
            ['nama' => 'ORIENTASI PERILAKU'],
            ['nama' => 'ORIENTASI PERILAKU', 'definisi' => 'Sikap dan perilaku kerja pegawai dalam memberikan pelayanan terbaik kepada yang dilayani antara lain meliputi  masyarakat, atasan, rekan kerja, unit   kerja terkait, dan/atau instansi lain.']
        );
        $aspek->indikatorKerjas()->insert([
            [
                'level' => 1,
                'indikator' => 'Memahami dan memberikan  pelayanan yang baik sesuai standar.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 2,
                'indikator' => 'Memberikan pelayanan sesuai standar dan menunjukkan    komitmen dalam pelayanan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 3,
                'indikator' => 'Memberikan pelayanan diatas standar untuk memastikan keputusan pihak-pihak yang dilayani sesuai arahan atasan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 4,
                'indikator' => 'Memberikan pelayanan diatas standar dan membangun nilai tambah dalam pelayanan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 5,
                'indikator' => 'Berusaha memenuhi kebutuhan  mendasar dalam pelayanan dan percepatan penanganan masalah.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 6,
                'indikator' => 'Mengevaluasi dan mengantisipasi kebutuhan pihak-pihak yang dilayani.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 7,
                'indikator' => 'Mengembangkan sistem pelayanan baru bersifat jangka panjang untuk memastikan kebutuhan dan kepuasan pihak-pihak yang dilayani.',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);

        $aspek->situasiKerjas()->insert([
            [
                'situasi' => 'Ketika memberikan pelayanan kepada pihak-pihak yang dilayani.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika membangun hubungan dengan pihak-pihak yang dilayani.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika diharapkan memberikan nilai-nilai tumbuh atas layanan yang diberikan kepada pihak-pihak yang dilayani.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika beradaptasi dengan menggunakan teknologi digital.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika diharapkan dengan benturan kepentingan.',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);

        $aspek = AspekPerilaku::updateOrCreate(
            ['nama' => 'KOMITMEN'],
            ['nama' => 'KOMITMEN', 'definisi' => 'Kemauan dan kemampuan untuk menyelaraskan sikap dan tindakan pegawai untuk mewujudkan tujuan organisasi dengan mengutamakan kepentingan dinas daripada kepentingan diri sendiri, seseorang, dan/atau golongan.']
        );

        $aspek->indikatorKerjas()->insert([
            [
                'level' => 1,
                'indikator' => 'Memahami dan mengetahui perilaku dasar menyangkut komitmen organisasi.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 2,
                'indikator' => 'Menunjukkan perilaku atau  tindakan sesuai dengan aturan atau nilai-nilai organisasi sebatas mengikuti arahan atasan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 3,
                'indikator' => 'Menunjukkan tindakan dan  perilaku yang konsisten serta meneladani perilaku komitmen terhadap organisasi.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 4,
                'indikator' => 'Mendukung tujuan serta menjaga citra organisasi secara    konsisten.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 5,
                'indikator' => 'Bertindak berdasarkan nilai-nilai organisasi secara konsisten.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 6,
                'indikator' => 'Menunjukkan komitmen atas kepentingan yang lebih besar daripada  kepentingan',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 7,
                'indikator' => 'Mengambil keputusan atau tindakan yang membutuhkan pengorbanan yang besar (menjadi model perilaku positif yang terintegrasi)',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);

        $aspek->situasiKerjas()->insert([
            [
                'situasi' => 'Ketika menjalankan tugas serta kewajibannya sebagai anggota organisasi.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika harus menjaga citra organisasi.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika menghadapi keadaan dilematis.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika diharapkan memupuk jiwa nasionalisme',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika dihadapkan dengan masalah korupsi/ kolusi/ nepotisme (KKN).',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);
        $aspek = AspekPerilaku::updateOrCreate(
            ['nama' => 'INISIATIF KERJA'],
            ['nama' => 'INISIATIF KERJA', 'definisi' => 'Kemauan dan kemampuan untuk melahirkan ide-ide baru, cara-cara baru untuk peningkatan kerja, kemauan untuk membantu rekan kerja yang membutuhkan bantuan, melihat masalah sebagai peluang bukan ancaman, kemauan untuk   bekerja menjadi lebih baik setiap hari, serta penuh semangat dan antusiasme, aspek inisiatif kerja juga termasuk inovasi yang dilakukan oleh pegawai.']
        );

        $aspek->indikatorKerjas()->insert([
            [
                'level' => 1,
                'indikator' => 'Memahami apa yang harus  dilakukan dalam merespon tugas atau pekerjaan, belum menunjukkan perilaku dasar yang diharapkan oleh organisasi.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 2,
                'indikator' => 'Cepat tanggap ketika menerima tugas atau pekerjaan dengan menyusun target, mencari ide baru ataupun menunjukkan keinginan untuk berkontribusi dalam tugas, dan menghadapi permasalahan dengan menghubungi pihak berwenang/atasan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 3,
                'indikator' => 'Dapat bekerja secara mandiri, kemauan untuk mencoba hal baru dan membangun jejaring. Mampu bertindak secara mandiri sesuai kewenangan dalam menangani permasalahan rutin.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 4,
                'indikator' => 'Bertindak proaktif pada situasi kritis, terbuka terhadap pendekatan baru, dan secara sukarela mengembangkan kemampuan orang lain.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 5,
                'indikator' => 'Menyusun rencana, tindakan taktis maupun langkah antisipasi terhadap permasalahan rutin. Menyusun perbaikan berkelanjutan, dan menghargai orang lain.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 6,
                'indikator' => 'Merancang rencana jangka  pendek, adaptasi ide untuk meningkatkan Kinerja, dan memberikan dukungan terhadap orang lain.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 7,
                'indikator' => 'Merancang rencana yang komprehensif, berorientasi jangka panjang, mempertimbangkan kesuksesan anggota organisasi, serta membuat terobosan baru.',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);

        $aspek->situasiKerjas()->insert([
            [
                'situasi' => 'Ketika menjalankan tugas yang terkait pekerjaannya.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika kondisi/ situasi  penyelesaian.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika menjadi bagian anggota tim/ kelompok kerja. ',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika menghadapi masamasa sulit. ',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika dituntut bekerja lebih baik.',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);
        $aspek = AspekPerilaku::updateOrCreate(
            ['nama' => 'KERJASAMA'],
            ['nama' => 'KERJASAMA', 'definisi' => 'Kemauan dan kemampuan untuk melahirkan ide-ide baru, cara-cara baru untuk peningkatan kerja, kemauan untuk membantu rekan kerja yang membutuhkan bantuan, melihat masalah sebagai peluang bukan ancaman, kemauan untuk   bekerja menjadi lebih baik setiap hari, serta penuh semangat dan antusiasme, aspek inisiatif kerja juga termasuk inovasi yang dilakukan oleh pegawai.']
        );

        $aspek->indikatorKerjas()->insert([
            [
                'level' => 1,
                'indikator' => 'Memahami dan memberikan  pelayanan yang baik sesuai standar.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 2,
                'indikator' => 'Memberikan pelayanan sesuai standar dan menunjukkan    komitmen dalam pelayanan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 3,
                'indikator' => 'Memberikan pelayanan diatas standar untuk memastikan keputusan pihak-pihak yang dilayani sesuai arahan atasan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 4,
                'indikator' => 'Memberikan pelayanan diatas standar dan membangun nilai tambah dalam pelayanan.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 5,
                'indikator' => 'Berusaha memenuhi kebutuhan  mendasar dalam    pelayanan    dan percepatan penanganan masalah.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 6,
                'indikator' => 'Mengevaluasi dan mengantisipasi kebutuhan pihak-pihak yang dilayani.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'level' => 7,
                'indikator' => 'Mengembangkan sistem pelayanan baru bersifat jangka panjang untuk memastikan kebutuhan dan kepuasan pihak-pihak yang dilayani.',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);

        $aspek->situasiKerjas()->insert([
            [
                'situasi' => 'Ketika menghadapi masalah dengan pegawai lain/ orang yang tidak disukai ditempat kerja.',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika mendapatkan pembagian tugas yang tidak menyenangkan ',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika menghadapi pimpinan yang tidak memperdulikan kontribusi anggota tim',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika bekerja di dalam kelompok/ tim',
                'aspek_perilaku_id' => $aspek->id
            ],
            [
                'situasi' => 'Ketika dituntut untuk mengembangkan jaringan Kerjasama.',
                'aspek_perilaku_id' => $aspek->id
            ],
        ]);
    }
}
