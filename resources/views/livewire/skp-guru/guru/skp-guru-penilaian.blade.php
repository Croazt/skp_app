<div>
    @include('livewire.skp-guru.partials.user-detail-peta')
    <div class="tw-w-full tw-text-center">
        <button class="btn btn-primary" wire:click="downloadPdf"><span class="fas fa-download"></span>&nbsp;Dokumen
            Penilaian</button>
    </div>
    <div id="accordion">
        <div class="card tw-px-0">
            {{-- @include('livewire.skp.kinerja.partials.modal') --}}
            <div class="card-header tw-py-0 collapsible" href="#collapseOneRencana" data-toggle="collapse"
                data-target="#collapseOneRencana" aria-expanded="true" id="headingOne" aria-controls="collapseOneRencana"
                wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA UTAMA
                    </span>
                </div>
            </div>
            <div id="collapseOneRencana" class="collapse show" aria-labelledby="headingOne" wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='rencana-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>
                                    {!! $this->renderHeader(
                                        'RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI',
                                        '',
                                        2,
                                        1,
                                    ) !!}
                                    {!! $this->renderHeader('RENCANA KINERJA', '', 2, 1) !!}
                                    {!! $this->renderHeader('ASPEK', '', 2, 1) !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU', '', 2, 1) !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT', '', 2, 1) !!}
                                    {!! $this->renderHeader('OUTPUT KEGIATAN TERKAIT', '', 2, 1) !!}
                                    {!! $this->renderHeader('TARGET', '', 2, 2) !!}
                                    {!! $this->renderHeader('REALISASI', '', 2, 2) !!}
                                    {!! $this->renderHeader('CAPAIAN IKI', '', 2, 1) !!}
                                    {!! $this->renderHeader('KATEGORI CAPAIAN IKI', '', 2, 1) !!}
                                    {!! $this->renderHeader('CAPAIAN RENCANA KINERJA', '', 1, 2) !!}
                                    {!! $this->renderHeader('METODE CASCADING', '', 2, 1) !!}
                                    {!! $this->renderHeader('NILAI TERTIMBANG', '', 2, 1) !!}
                                </tr>
                                <tr>
                                    {!! $this->renderHeader('KATEGORI', '', 1, 1) !!}
                                    {!! $this->renderHeader('NILAI', '', 1, 1) !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaUtama as $rencanaKinerja)
                                @if ($this->data['terkait'][$rencanaKinerja->id])
                                    @include('livewire.skp-guru.guru.tables.penilaian')
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-header tw-py-0 collapsible" id="headingTwo" href="#collapseTwoRencana"
                data-toggle="collapse" data-target="#collapseTwoRencana" aria-expanded="true"
                aria-controls="collapseTwoRencana" wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA TAMBAHAN
                    </span>
                </div>
            </div>
            <div id="collapseTwoRencana" class="collapse show" aria-labelledby="headingTwo" wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='rencana-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>

                                    {!! $this->renderHeader(
                                        'RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI',
                                        '',
                                        2,
                                        1,
                                    ) !!}
                                    {!! $this->renderHeader('RENCANA KINERJA', '', 2, 1) !!}
                                    {!! $this->renderHeader('ASPEK', '', 2, 1) !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU', '', 2, 1) !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT', '', 2, 1) !!}
                                    {!! $this->renderHeader('OUTPUT KEGIATAN TERKAIT', '', 2, 1) !!}
                                    {!! $this->renderHeader('TARGET', '', 2, 2) !!}
                                    {!! $this->renderHeader('REALISASI', '', 2, 2) !!}
                                    {!! $this->renderHeader('CAPAIAN IKI', '', 2, 1) !!}
                                    {!! $this->renderHeader('KATEGORI CAPAIAN IKI', '', 2, 1) !!}
                                    {!! $this->renderHeader('CAPAIAN RENCANA KINERJA', '', 1, 2) !!}
                                    {!! $this->renderHeader('METODE CASCADING', '', 2, 1) !!}
                                    {!! $this->renderHeader('NILAI TERTIMBANG', '', 2, 1) !!}
                                </tr>
                                <tr>
                                    {!! $this->renderHeader('KATEGORI', '', 1, 1) !!}
                                    {!! $this->renderHeader('NILAI', '', 1, 1) !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaTambahan as $rencanaKinerja)
                                @if ($this->data['terkait'][$rencanaKinerja->id])
                                    @include('livewire.skp-guru.guru.tables.penilaian')
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
