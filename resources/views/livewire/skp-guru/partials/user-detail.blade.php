<div class="card-body">
    <div class="tw-px-2 ">
        <div class="tw-w-10/12 tw-flex tw-flex-wrap tw-mb-2 tw-mx-auto tw-justify-between">
            <div class="sm:tw-text-sm md:tw-text-base tw-font-bold">
                SMA NEGERI 1 SIDRAP
            </div>
            <div class="sm:tw-text-sm md:tw-text-base tw-text-end tw-capitalize">
                <p class="tw-font-bold">
                    Periode Penilaian:
                </p>
                <p >
                    {{ format_periode($this->skp->periode_awal,$this->skp->periode_akhir) }}
                </p>
            </div>
        </div>
        <div class="tw-w-10/12 tw-flex tw-flex-wrap tw-mb-0 tw-mx-auto">
            <div
                class="tw-w-1/2 tw-card tw-shadow-none tw-border tw-border-gray-400 tw-rounded tw-rounded-r-none tw-mb-3">
                <div
                    class="tw-w-full sm:tw-text-sm md:tw-text-base tw-text-xs tw-font-bold tw-text-center tw-border-b tw-border-gray-400">
                    Pegawai Yang Nilai
                </div>
                <div class="card-body tw-w-full tw-p-2">
                    <x-responsive-data title="Nama" value="{{ $this->skpGuru->user->nama }}" />
                    <x-responsive-data title="NIP" value="{{ $this->skpGuru->user->nip }}" />
                    <x-responsive-data title="Pangkat" value="{{ $this->skpGuru->user->getPangkatJabatanName() }}" />
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
                <div class="card-body tw-w-full  tw-p-2">
                    <x-responsive-data title="Nama" value="{{ $this->skp->pejabatPenilai->nama }}" />
                    <x-responsive-data title="NIP" value="{{ $this->skp->pejabatPenilai->nip }}" />
                    <x-responsive-data title="Pangkat" value="{{ $this->skp->pejabatPenilai->getPangkatJabatanName() }}" />
                    <x-responsive-data title="Jabatan" value="{{ $this->skp->pejabatPenilai->pekerjaan }}" />
                    <x-responsive-data title="Unit Kerja" value="{{ $this->skp->pejabatPenilai->unit_kerja }}" />
                </div>
            </div>
        </div>
    </div>
</div>
