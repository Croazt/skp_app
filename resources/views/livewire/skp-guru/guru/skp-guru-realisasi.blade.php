@push('styles')
    <style>
        .collapsible {
            position: relative;
            cursor: pointer;
        }

        .collapsible::after {
            content: "\f107";
            font-family: "FontAwesome";
        }

        .collapsible[aria-expanded="true"]::after {
            content: "\f106";
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
<div>
    <div id="accordion">
        <div class="card tw-px-0">
            <div class="card-header tw-py-0 collapsible" href="#collapseOne" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true" id="headingOne" aria-controls="collapseOne" wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA UTAMA
                    </span>
                </div>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='realisasi-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>
                                    {!! $this->renderHeader('RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI') !!}
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('ASPEK') !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU') !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('OUTPUT KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('TARGET', '', 1, 2) !!}
                                    {!! $this->renderHeader('BUKTI KINERJA') !!}
                                    {{-- @if ($this->skpGuru->status == 'verifikasi')
                                        {!! $this->renderHeader('ACTION') !!}
                                    @endif --}}
                                </tr>
                            </thead>
                            @foreach ($rencanaKinerjaUtama as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.realisasi')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-header tw-py-0 collapsible" id="headingTwo" href="#collapseTwo" data-toggle="collapse"
                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA TAMBAHAN
                    </span>
                </div>
            </div>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" wire:ignore.self>
                <div class="card-body px-0 tw-pt-0">
                    <div class="table-responsive table-scroll" id='realisasi-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex">
                            <thead class="text-center">
                                <tr>
                                    {!! $this->renderHeader('RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI') !!}
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('ASPEK') !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU') !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('OUTPUT KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('TARGET', '', 1, 2) !!}
                                    {!! $this->renderHeader('BUKTI KINERJA') !!}
                                </tr>
                            </thead>
                            @foreach ($rencanaKinerjaTambahan as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.realisasi')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($this->skpGuru->status == 'verifikasi' || $this->skpGuru->status == 'ditolak')
        <div class="tw-w-full tw-text-center">
            <button type='button' class="btn btn-primary tw-text-cent3er"
                wire:click='sendVerifyDokumenSKP'>Verifikasi Dokumen</button>
        </div>
    @endif
    @push('modals')
        @include('modals.tambah-kinerja')
    @endpush
    <script>
        $('.dt-delete-kinerja-guru').click(function(event) {
            if (confirm('Do you really wish to continue?')) {
                let key = $(this).attr('data-key');
                @this.deleteDetailKinerjaGuru(key);
            } else {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>
</div>
{{-- @endpush --}}
