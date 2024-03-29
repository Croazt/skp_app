<div>
    @include('livewire.skp-guru.partials.user-detail-peta')
    <div class="tw-w-full tw-text-center">
        <button class="btn btn-primary" wire:click="downloadPdf"><span class="fas fa-download"></span>&nbsp; Dokumen
            Rencana</button>
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
                <div class="card-body px-0 tw-pt-0 tw-w-full">
                    <div class="table-responsive table-scroll tw-w-full" id='rencana-table'>
                        <table
                            class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex tw-w-full">
                            <thead class="text-center  tw-w-full">
                                <tr>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width:25% ">
                                        RENCANA KINERJA ATASAN
                                        LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width:25% ">
                                        RENCANA KINERJA</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 6%">ASPEK
                                    </th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 19%">
                                        INDIKATOR KINERJA
                                        INDIVIDU</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="2" style="width: 25%">TARGET
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($rencanaKinerjaUtama as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.rencana')
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
                <div class="card-body px-0 tw-pt-0 tw-w-full">
                    <div class="table-responsive table-scroll tw-w-full" id='rencana-table'>
                        <table
                            class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex tw-w-full">
                            <thead class="text-center  tw-w-full">
                                <tr>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width:25% ">
                                        RENCANA KINERJA ATASAN
                                        LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width:25% ">
                                        RENCANA KINERJA</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 6%">ASPEK
                                    </th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 19%">
                                        INDIKATOR KINERJA
                                        INDIVIDU</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="2" style="width: 25%">TARGET
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($rencanaKinerjaTambahan as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.rencana')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
