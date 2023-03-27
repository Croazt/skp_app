<div>
    @include('livewire.skp-guru.partials.user-detail-peta')
    <div class="tw-w-full tw-text-center">
        <button class="btn btn-primary" wire:click="downloadPdf"><span class="fas fa-download"></span>&nbsp; Dokumen Reviu</button>
    </div>
    <div id="accordion">
        <div class="card tw-px-0">
            <div class="card-header tw-py-0 collapsible" href="#collapseOneReviu" data-toggle="collapse"
                data-target="#collapseOneReviu" aria-expanded="true" id="headingOne" aria-controls="collapseOneReviu" wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA UTAMA
                    </span>
                </div>
            </div>
            <div id="collapseOneReviu" class="collapse show" aria-labelledby="headingOne"
                wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='peta-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>
                                    {!! $this->renderHeader('RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI') !!}
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('ASPEK') !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU') !!}
                                    {!! $this->renderHeader('TARGET', '', 1, 2) !!}
                                    {!! $this->renderHeader('REVIU OLEH PENGELOLA') !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaUtama as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.reviu')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-header tw-py-0 collapsible" id="headingTwo" href="#collapseTwoReviu" data-toggle="collapse"
                data-target="#collapseTwoReviu" aria-expanded="true" aria-controls="collapseTwoReviu" wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA TAMBAHAN
                    </span>
                </div>
            </div>
            <div id="collapseTwoReviu" class="collapse show" aria-labelledby="headingTwo"
                wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='peta-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>
                                    {!! $this->renderHeader('RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI') !!}
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('ASPEK') !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU') !!}
                                    {!! $this->renderHeader('TARGET', '', 1, 2) !!}
                                    {!! $this->renderHeader('REVIU OLEH PENGELOLA') !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaTambahan as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.reviu')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
