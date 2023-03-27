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
    @include('livewire.skp-guru.partials.user-detail-peta')
    @if ($this->skpGuru->status == 'bukti')
        {{-- <div class="tw-w-full tw-text-center tw-py-5">
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                data-target="#tambahRencanaKinerjaModal">
                <p>
                    <span class="fas fa-plus"></span> Rencana Kinerja
                </p>
            </button>`
        </div> --}}
        <div class="tw-flex tw-justify-evenly tw-px-8 tw-text-center">
            <div class="tw-w-3/12">
                <x-jet-label for="capaian_pkg" value="{{ __('Capaian PKG') }}" />
                <select id="capaian_pkg"
                    class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:change="updateTargetPkg($event.target.value,'capaian_pkg')" wire:model="data.capaian_pkg"
                    name="data.capaian_pkg" :value="old('capaian_pkg')" placeholder="Masukkan Capaian PKG Tugas Tambahan">
                    <option value="125">125%</option>
                    <option value="100">100%</option>
                    <option value="75">75%</option>
                    <option value="25">25%</option>
                    <option value="50">50%</option>
                </select>

            </div>
            <div class="tw-w-3/12">
                <x-jet-label for="capaian_jam_pelajaran" value="{{ __('Capaian Jam Pelajaran') }}" />
                <select id="capaian_jam_pelajaran"
                    class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                    wire:change="updateTargetPkg($event.target.value,'capaian_jam_pelajaran')" wire:model="data.capaian_jam_pelajaran"
                    name="data.capaian_jam_pelajaran" :value="old('capaian_jam_pelajaran')"
                    placeholder="Masukkan Capaian PKG Tugas Tambahan">
                    <option value="24">24-40</option>
                    @for ($i = 23; $i >= 6; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            @can('tugas_tambahan')
                <div class="tw-w-3/12">
                    <x-jet-label for="capaian_pkg_tambahan" value="{{ __('Capaian PKG Tugas Tambahan') }}" />
                    <select id="capaian_pkg_tambahan"
                        class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                        wire:change="updateTargetPkg($event.target.value,'capaian_pkg_tambahan')"
                        wire:model="data.capaian_pkg_tambahan" name="data.capaian_pkg_tambahan"
                        :value="old('capaian_pkg_tambahan')" placeholder="Masukkan Target PKG Tugas Tambahan">
                        <option value="125">125%</option>
                        <option value="100">100%</option>
                        <option value="75">75%</option>
                        <option value="25">25%</option>
                        <option value="50">50%</option>
                    </select>

                </div>
            @endcan
        </div>
    @else
        <div class="tw-flex tw-justify-evenly tw-px-8 tw-text-center">
            <div class="tw-w-3/12">
                <x-jet-label for="capaian_pkg" value="{{ __('Capaaian PKG') }}" />
                <x-jet-input type="text" class="form-input tw-text-center" id="capaian_pkg"
                    wire:model="data.capaian_pkg" name="data.capaian_pkg" disabled />
            </div>
            <div class="tw-w-3/12">
                <x-jet-label for="capaian_jam_pelajaran" value="{{ __('Target Jam Pelajaran') }}" />
                <x-jet-input type="text" class="form-input tw-text-center" id="capaian_jam_pelajaran"
                    wire:model="data.capaian_jam_pelajaran" name="data.capaian_jam_pelajaran" disabled/>
            </div>
            @can('tugas_tambahan')
                <div class="tw-w-3/12">
                    <x-jet-label for="capaian_pkg_tambahan" value="{{ __('Target PKG Tugas Tambahan') }}" />
                    <x-jet-input type="text" class="form-input tw-text-center" id="capaian_pkg_tambahan"
                        wire:model="data.capaian_pkg_tambahan" name="data.capaian_pkg_tambahan" disabled />

                </div>
            @endcan
        </div>
    @endif
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
                                    {!! $this->renderHeader('DOKUMEN BUKTI') !!}
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('ASPEK') !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU') !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('OUTPUT KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('TARGET', '', 1, 2) !!}
                                    {!! $this->renderHeader('REALISASI', '', 1, 2) !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaUtama as $rencanaKinerja)
                                @if ($this->data['terkait'][$rencanaKinerja->id])
                                    @include('livewire.skp-guru.tables.realisasi')
                                @endif
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
                                    {!! $this->renderHeader('DOKUMEN BUKTI') !!}
                                    {!! $this->renderHeader('RENCANA KINERJA') !!}
                                    {!! $this->renderHeader('ASPEK') !!}
                                    {!! $this->renderHeader('INDIKATOR KINERJA INDIVIDU') !!}
                                    {!! $this->renderHeader('BUTIR KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('OUTPUT KEGIATAN TERKAIT') !!}
                                    {!! $this->renderHeader('TARGET', '', 1, 2) !!}
                                    {!! $this->renderHeader('REALISASI', '', 1, 2) !!}
                                    {!! $this->renderHeader('Lingkup') !!}
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaTambahan as $rencanaKinerja)
                                @if ($this->data['terkait'][$rencanaKinerja->id])
                                    @include('livewire.skp-guru.tables.realisasi')
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($this->skpGuru->status == 'bukti')
        <div class="tw-w-full tw-text-center">
            <button type='button' class="btn btn-primary tw-text-cent3er" wire:click='gradeSKP'>Verifikasi
                Dokumen</button>
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
