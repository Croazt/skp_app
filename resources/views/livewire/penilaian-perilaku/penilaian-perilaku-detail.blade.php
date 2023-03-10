<div class="card-body">
    <div class="sm:tw-px-5 md:tw-px-10 tw-px-2 ">
        <x-skp-head perencanaan="{{ $this->skp->periode_awal }}" penilaian="{{ $this->skp->periode_akhir }}" />
        <x-skp-detail title="Pejabat Penilai" :data="$this->skp->pejabatPenilai"></x-skp-detail>
        <x-skp-detail title="Pengelola Kinerja" :data="$this->skp->pengelolaKinerja"></x-skp-detail>
        <x-skp-detail title="Tim Angka Kredit" :data="$this->skp->timAngkaKredit"></x-skp-detail>
        <form class="form" wire:submit.prevent='addKinerja()'>

        </form>
        <div class="form-group text-center">
            @can('Operator')
                <button wire:click="edit()" type="button" class="btn btn-warning mr-2">
                    Ubah
                </button>
                <button id="btn-kinerja" name="kinerja" type="button" class="btn btn-info mr-2">
                    Tambahkan Kinerja
                </button>
            @endcan
            <button wire:click="backToIndex()" type="button" class="btn btn-secondary">Kembali</button>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#btn-kinerja').on('click', function(e) {
                $('.nav-link').removeClass('active')
                $('.tab-pane').removeClass('active')
                $('.tab-pane').removeClass('show')
                $('#' + e.target.name + '-tab').addClass('active')
                $('#' + e.target.name).addClass('show active')
            })
        </script>
    @endpush
</div>
