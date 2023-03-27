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
    @if ($this->skpGuru->status == 'draft')
        @if (\Carbon\Carbon::parse($this->skpGuru->skp->perencanaan) < now())
            <div class="tw-flex tw-justify-evenly tw-px-8 tw-text-center">
                <div class="tw-w-3/12">
                    <x-jet-label for="target_pkg" value="{{ __('Target PKG') }}" />
                    <select disabled id="target_pkg" data-toggle="tooltip" data-placement="top"
                        data-title="Waktu perencanaan SKP telah selesai"
                        class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                        wire:model="data.target_pkg" name="data.target_pkg" :value="old('target_pkg')"
                        placeholder="Masukkan Target PKG Tugas Tambahan">
                        <option value="125">125%</option>
                        <option value="100">100%</option>
                        <option value="75">75%</option>
                        <option value="25">25%</option>
                        <option value="50">50%</option>
                    </select>

                </div>
                <div class="tw-w-3/12">
                    <x-jet-label for="jam_pelajaran" value="{{ __('Target Jam Pelajaran') }}" />
                    <select disabled id="jam_pelajaran" data-toggle="tooltip" data-placement="top"
                        data-title="Waktu perencanaan SKP telah selesai"
                        class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                        wire:model="data.jam_pelajaran" name="data.jam_pelajaran" :value="old('jam_pelajaran')"
                        placeholder="Masukkan Target PKG Tugas Tambahan">
                        <option value="24">24-40</option>
                        @for ($i = 23; $i >= 6; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                @can('tugas_tambahan')
                    <div class="tw-w-3/12">
                        <x-jet-label for="target_pkg_tambahan" value="{{ __('Target PKG Tugas Tambahan') }}" />
                        <select disabled id="target_pkg_tambahan" data-toggle="tooltip" data-placement="top"
                            data-title="Waktu perencanaan SKP telah selesai"
                            class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                            wire:model="data.target_pkg_tambahan" name="data.target_pkg_tambahan"
                            :value="old('target_pkg_tambahan')" placeholder="Masukkan Target PKG Tugas Tambahan">
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
            <div class="tw-w-full tw-text-center tw-py-5">
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                    data-target="#tambahRencanaKinerjaModal">
                    <p>
                        <span class="fas fa-plus"></span> Rencana Kinerja
                    </p>
                </button>`
            </div>
            <div class="tw-flex tw-justify-evenly tw-px-8 tw-text-center">
                <div class="tw-w-3/12">
                    <x-jet-label for="target_pkg" value="{{ __('Target PKG') }}" />
                    <select id="target_pkg"
                        class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                        wire:change="updateTargetPkg($event.target.value,'target_pkg')" wire:model="data.target_pkg"
                        name="data.target_pkg" :value="old('target_pkg')"
                        placeholder="Masukkan Target PKG Tugas Tambahan">
                        <option value="125">125%</option>
                        <option value="100">100%</option>
                        <option value="75">75%</option>
                        <option value="25">25%</option>
                        <option value="50">50%</option>
                    </select>

                </div>
                <div class="tw-w-3/12">
                    <x-jet-label for="jam_pelajaran" value="{{ __('Target Jam Pelajaran') }}" />
                    <select id="jam_pelajaran"
                        class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                        wire:change="updateTargetPkg($event.target.value,'jam_pelajaran')"
                        wire:model="data.jam_pelajaran" name="data.jam_pelajaran" :value="old('jam_pelajaran')"
                        placeholder="Masukkan Target PKG Tugas Tambahan">
                        <option value="24">24-40</option>
                        @for ($i = 23; $i >= 6; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                @can('tugas_tambahan')
                    <div class="tw-w-3/12">
                        <x-jet-label for="target_pkg_tambahan" value="{{ __('Target PKG Tugas Tambahan') }}" />
                        <select id="target_pkg_tambahan"
                            class="tw-mx-auto tw-w-1/2 form-control tw-border-gray-300 focus:tw-border-indigo-300 focus:tw-ring focus:tw-ring-indigo-200 focus:tw-ring-opacity-50 tw-rounded-md tw-shadow-sm"
                            wire:change="updateTargetPkg($event.target.value,'target_pkg_tambahan')"
                            wire:model="data.target_pkg_tambahan" name="data.target_pkg_tambahan"
                            :value="old('target_pkg_tambahan')" placeholder="Masukkan Target PKG Tugas Tambahan">
                            <option value="125">125%</option>
                            <option value="100">100%</option>
                            <option value="75">75%</option>
                            <option value="25">25%</option>
                            <option value="50">50%</option>
                        </select>

                    </div>
                @endcan
            </div>
        @endif
    @else
        <div class="tw-flex tw-justify-evenly tw-px-8 tw-text-center">
            <div class="tw-w-3/12">
                <x-jet-label for="target_pkg" value="{{ __('Target PKG') }}" />
                <x-jet-input type="text" class="form-input tw-text-center" id="target_pkg"
                    wire:model="data.target_pkg" name="data.target_pkg" disabled />
            </div>
            <div class="tw-w-3/12">
                <x-jet-label for="jam_pelajaran" value="{{ __('Target Jam Pelajaran') }}" />
                <x-jet-input type="text" class="form-input tw-text-center" id="jam_pelajaran"
                    wire:model="data.jam_pelajaran" name="data.jam_pelajaran" />
            </div>
            @can('tugas_tambahan')
                <div class="tw-w-3/12">
                    <x-jet-label for="target_pkg_tambahan" value="{{ __('Target PKG Tugas Tambahan') }}" />
                    <x-jet-input type="text" class="form-input tw-text-center" id="target_pkg_tambahan"
                        wire:model="data.target_pkg_tambahan" name="data.target_pkg_tambahan" disabled />

                </div>
            @endcan
        </div>
    @endif
    <div id="accordion">
        <div class="card tw-px-0">
            <div class="card-header tw-py-0 collapsible" href="#collapseOne" data-toggle="collapse"
                data-target="#collapseOne" aria-expanded="true" id="headingOne" aria-controls="collapseOne"
                wire:ignore>
                <div class="tw-w-full tw-flex tw-justify-between">
                    <span
                        class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                        KINERJA UTAMA
                    </span>
                </div>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" wire:ignore.self>
                <div class="card-body px-0 tw-pt-0 tw-w-full">
                    <div class="table-responsive table-scroll tw-w-full" id='peta-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex"
                            style="width: 125%">
                            <thead class="text-center" style="width: 100%">
                                <tr style="width: 100%">
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">RENCANA KINERJA ATASAN
                                        LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">RENCANA KINERJA</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 6%">ASPEK</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 10%">INDIKATOR KINERJA
                                        INDIVIDU</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">BUTIR KEGIATAN TERKAIT
                                    </th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">OUTPUT KEGIATAN
                                        TERKAIT</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="2" style="width: 16%">TARGET</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1">ANGKA KREDIT</th>
                                    @if ($this->skpGuru->status == 'draft' && !(\Carbon\Carbon::parse($this->skpGuru->skp->perencanaan) < now()))
                                        <th class=" tw-align-middle" rowspan="1" colspan="1">AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaUtama as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.peta-rencana')
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
                <div class="card-body px-0 tw-pt-0 tw-w-full">
                    <div class="table-responsive table-scroll tw-w-full" id='peta-table'>
                        <table class="table table-bordered datatable-sortable table-sm tw-text-sm table-complex"
                            style="width: 125%">
                            <thead class="text-center" style="width: 100%">
                                <tr style="width: 100%">
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">RENCANA KINERJA ATASAN
                                        LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">RENCANA KINERJA</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 6%">ASPEK</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 10%">INDIKATOR KINERJA
                                        INDIVIDU</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">BUTIR KEGIATAN TERKAIT
                                    </th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1" style="width: 15%">OUTPUT KEGIATAN
                                        TERKAIT</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="2" style="width: 16%">TARGET</th>
                                    <th class=" tw-align-middle" rowspan="1" colspan="1">ANGKA KREDIT</th>
                                    @if ($this->skpGuru->status == 'draft' && !(\Carbon\Carbon::parse($this->skpGuru->skp->perencanaan) < now()))
                                        <th class=" tw-align-middle" rowspan="1" colspan="1">AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            @foreach ($this->rencanaKinerjaTambahan as $rencanaKinerja)
                                @include('livewire.skp-guru.guru.tables.peta-rencana')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($this->skpGuru->status == 'draft')
        @if (\Carbon\Carbon::parse($this->skpGuru->skp->perencanaan) >= now())
            <div class="tw-w-full tw-text-center">
                <button type='button' class="btn btn-primary tw-text-cent3er"
                    wire:click='confirmSKP'>Konfirmasi</button>
            </div>
        @else
            <div class="tw-w-full tw-text-center">
                <div data-toggle="tooltip" data-placement="top" data-title="Waktu perencanaan SKP telah selesai"
                    type='button' class="btn btn-secondary tw-text-cent3er">Konfirmasi</div>
            </div>
        @endif
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
