
<div>
    @include('livewire.skp-guru.partials.user-detail-peta')
    <div class="tw-w-full tw-text-center">
        <button class="btn btn-primary" wire:click="downloadPdf"><span class="fas fa-download"></span>&nbsp; Dokumen Verifikasi</button>
    </div>
    <div id="accordion">
        <div class="card tw-px-0">
            <div class="card-header tw-py-0 collapsible" href="#collapseOneVerifikasi" data-toggle="collapse"
                data-target="#collapseOneVerifikasi" aria-expanded="true" id="headingOne" aria-controls="collapseOneVerifikasi" wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA UTAMA
                    </span>
                </div>
            </div>
            <div id="collapseOneVerifikasi" class="collapse show" aria-labelledby="headingOne"
                wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='peta-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('OUTPUT BUTIR KEGIATAN') !!}
                                    {!! $this->renderHeader('ANGKA KREDIT') !!}
                                    {!! $this->renderHeader('VERIFIKASI TIM PENILAI ANGKA KREDIT') !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaUtama as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.verifikasi')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-header tw-py-0 collapsible" id="headingTwo" href="#collapseTwoVerifikasi" data-toggle="collapse"
                data-target="#collapseTwoVerifikasi" aria-expanded="true" aria-controls="collapseTwoVerifikasi" wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA TAMBAHAN
                    </span>
                </div>
            </div>
            <div id="collapseTwoVerifikasi" class="collapse show" aria-labelledby="headingTwo"
                wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='peta-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('OUTPUT BUTIR KEGIATAN') !!}
                                    {!! $this->renderHeader('ANGKA KREDIT') !!}
                                    {!! $this->renderHeader('VERIFIKASI TIM PENILAI ANGKA KREDIT') !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaTambahan as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.verifikasi')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
