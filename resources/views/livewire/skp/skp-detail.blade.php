<div class="card-body">
    <div class="sm:tw-px-5 md:tw-px-10 tw-px-2 ">
        <x-skp-head perencanaan="{{ $this->skp->periode_awal }}" penilaian="{{ $this->skp->periode_akhir }}" />
        <x-skp-detail title="Pejabat Penilai 1" :data="$this->skp->pejabatPenilaiUtama"></x-skp-detail>
        <x-skp-detail title="Pejabat Penilai 2" :data="$this->skp->pejabatPenilaiDua"></x-skp-detail>
        <x-skp-detail title="Pengelola Kinerja" :data="$this->skp->pengelolaKinerja"></x-skp-detail>
        <x-skp-detail title="Tim Angka Kredit" :data="$this->skp->timAngkaKredit"></x-skp-detail>
        <form class="form" wire:submit.prevent='addKinerja()'>

        </form>
        <div class="form-group text-center">
            <button wire:click="edit()" type="button" class="btn btn-warning mr-2">
                Ubah
            </button>
            <button id="btn-kinerja" name="kinerja" type="button" class="btn btn-info mr-2">
                Tambahkan Kinerja
            </button>
            <button wire:click="backToIndex()" type="button" class="btn btn-secondary">Cancel</button>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#btn-kinerja').on('click', function(e){
                $('.nav-link').removeClass('active')
                $('.tab-pane').removeClass('active')
                $('.tab-pane').removeClass('show')
                $('#'+e.target.name+'-tab').addClass('active')
                $('#'+e.target.name).addClass('show active')
            })
        </script>
    @endpush
</div>
