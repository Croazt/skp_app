<div class="p-10">
    <div class="mb-4 h-auto flex flex-wrap justify-between">
        <div class="flex w-full sm:w-5/12 justify-start sm:justify-between">
            <div class="w-1/2 font-bold text-base">
                Tenggat Perencanaan
            </div>
            <div id="periode" class="">
                <span class="font-bold">:</span>
                {{ $this->skp->perencanaan }}
            </div>
        </div>
        <div class="flex w-full sm:w-5/12 justify-start sm:justify-between">
            <div class="w-1/2 font-medium text-base">
                Mulai Penilaian
            </div>
            <div id="periode" class="">
                <span class="font-bold">:</span>
                {{ $this->skp->perencanaan }}
            </div>
        </div>
    </div>
    <div class="w-full flex flex-wrap mb-0">
        <div class="w-5/12 text-base font-bold">
            Pejabat Penilai 1
        </div>
        <span class="font-bold">:</span>
        <div class="ml-2 w-6/12 card shadow-none border border-black  mb-3">
            <div class="card-body">
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Nama
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiUtama->nama }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        NIP
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiUtama->nip }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Pangkat
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiUtama->getPangkatName() }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Jabatan
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiUtama->pekerjaan }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Unit Kerja
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiUtama->unit_kerja }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-wrap">
        <div class="w-5/12 text-base font-bold">
            Pejabat Penilai 2
        </div>
        <span class="font-bold">:</span>
        <div class="ml-2 w-6/12 card shadow-none border border-black  mb-3">
            <div class="card-body">
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Nama
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiDua->nama }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        NIP
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiDua->nip }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Pangkat
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiDua->getPangkatName() }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Jabatan
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiDua->pekerjaan }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Unit Kerja
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pejabatPenilaiDua->unit_kerja }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-wrap">
        <div class="w-5/12 text-base font-bold">
            Pengelola Kinerja
        </div>
        <span class="font-bold">:</span>
        <div class="ml-2 w-6/12 card shadow-none border border-black  mb-3">
            <div class="card-body">
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Nama
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pengelolaKinerja->nama }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        NIP
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pengelolaKinerja->nip }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Pangkat
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pengelolaKinerja->getPangkatName() }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Jabatan
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pengelolaKinerja->pekerjaan }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Unit Kerja
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->pengelolaKinerja->unit_kerja }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-wrap">
        <div class="w-5/12 text-base font-bold">
            Tim Angka Kredit
        </div>
        <span class="font-bold">:</span>
        <div class="ml-2 w-6/12 card shadow-none border border-black  mb-3">
            <div class="card-body">
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Nama
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->timAngkaKredit->nama }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        NIP
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->timAngkaKredit->nip }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Pangkat
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->timAngkaKredit->getPangkatName() }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Jabatan
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->timAngkaKredit->pekerjaan }}
                    </div>
                </div>
                <div class="flex w-full">
                    <div class="w-5/12 text-base font-bold">
                        Unit Kerja
                    </div>
                    <span class="font-bold">:</span>
                    <div class="ml-1 w-6/12 font-medium text-base">
                        {{ $this->skp->timAngkaKredit->unit_kerja }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="form" wire:submit.prevent='addKinerja()'>

    </form>
</div>