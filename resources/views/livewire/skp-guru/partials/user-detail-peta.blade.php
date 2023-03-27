<div class="tw-py-5 tw-px-6 ">
    <div class="tw-w-10/12 tw-flex tw-flex-wrap tw-mb-2 tw-mx-auto tw-justify-between">
        <div class="sm:tw-text-sm md:tw-text-base tw-font-bold">
            SMA NEGERI 1 SIDRAP
        </div>
        <div class="sm:tw-text-sm md:tw-text-base tw-text-end tw-capitalize">
            <p class="tw-font-bold">
                Periode Penilaian:
            </p>
            <p>
                {{ format_periode($this->skpGuru->skp->periode_awal, $this->skpGuru->skp->periode_akhir) }}
            </p>
        </div>
    </div>
    <div class="tw-w-10/12 tw-flex tw-flex-wrap tw-mb-0 tw-mx-auto">
        <div class="tw-w-1/2 tw-card tw-shadow-none tw-border tw-border-gray-400 tw-rounded tw-rounded-r-none tw-mb-3">
            <div
                class="tw-w-full sm:tw-text-sm md:tw-text-base tw-text-xs tw-font-bold tw-text-center tw-border-b tw-border-gray-400">
                Pegawai Yang Nilai
            </div>
            <div class="card-body tw-w-full tw-p-2">
                <x-responsive-data title="Nama" value="{{ $this->skpGuru->user->nama }}" />
                <x-responsive-data title="NIP" value="{{ $this->skpGuru->user->nip }}" />
                @php
                    $temp = in_array($viewType, ['draft', 'rencana', 'keterkaitan', 'reviu', 'verifikasi', 'penetapan']) ? $this->skpGuru->getPangkatJabatanName('Rencana') : $this->skpGuru->getPangkatJabatanName('Nilai');
                    $pangkat = $temp ? $temp : $this->skpGuru->user->getPangkatJabatanName();
                @endphp
                <x-responsive-data title="Pangkat" value="{{ $pangkat }}" />
                <x-responsive-data title="Jabatan" value="{{ $this->skpGuru->user->pekerjaan }}" />
                <x-responsive-data title="Unit Kerja" value="{{ $this->skpGuru->user->unit_kerja }}" />
            </div>
        </div>
        <div
            class="tw-w-1/2 tw-card tw-shadow-none tw-border  tw-border-gray-400 tw-rounded tw-rounded-l-none  tw-mb-3">
            <div
                class="tw-w-full sm:tw-text-sm md:tw-text-base tw-text-xs tw-font-bold tw-text-center tw-border-b tw-border-gray-400">
                Pegawai Penilai Kinerja
            </div>
            @php
                $pegawaiTemp = in_array($viewType, ['draft', 'rencana', 'keterkaitan', 'reviu', 'verifikasi', 'penetapan']) ? $this->skpGuru->pejabatRencana : $this->skpGuru->pejabatPenilai;
                $pegawaiPenilai = $pegawaiTemp ? $pegawaiTemp : $this->skpGuru->skp->pejabatPenilai;
            @endphp
            <div class="card-body tw-w-full  tw-p-2">
                <x-responsive-data title="Nama" value="{{ $pegawaiPenilai->nama }}" />
                <x-responsive-data title="NIP" value="{{ $pegawaiPenilai->nip }}" />
                <x-responsive-data title="Pangkat"
                    value="{{ $pegawaiPenilai->getPangkatJabatanName() }}" />
                <x-responsive-data title="Jabatan" value="{{ $pegawaiPenilai->pekerjaan }}" />
                <x-responsive-data title="Unit Kerja" value="{{ $pegawaiPenilai->unit_kerja }}" />
            </div>
        </div>
    </div>
</div>
