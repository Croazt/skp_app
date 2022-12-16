@push('styles')
    <style>
        .table-complex thead th:hover,
        thead:hover {
            background: rgba(0, 0, 0, 0.075);
        }

        .hover {
            background: rgba(0, 0, 0, 0.075);
        }
    </style>
@endpush

<div class="card tw-px-0">
    {{-- @include('livewire.skp.kinerja.partials.modal') --}}
    <div class="card-header">
        <div class="tw-w-full tw-h-max tw-flex tw-justify-between">
            <span class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold">
                KINERJA UTAMA
            </span>
            <button type="button" class="btn btn-primary ml-2" wire:click="$emit('openModal')">
                <p>
                    <span class="fas fa-plus"></span> Tambah Rencana Hasil Kinerja
                </p>
            </button>
        </div>
    </div>
    <div class="card-body px-0">
        <div class="table-responsive">
            <table class="table table-bordered datatable-sortable table-md tw-text-sm table-complex">
                <thead>
                    <tr>
                        <th>
                            RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI
                        </th>
                        <th>
                            RENCANA KINERJA
                        </th>
                        <th>
                            ASPEK
                        </th>
                        <th>
                            INDIKATOR KINERJA INDIVIDU
                        </th>
                        <th>
                            BUTIR KEGIATAN TERKAIT
                        </th>
                        <th>
                            OUTPUT BUTIR KEGIATAN
                        </th>
                        <th>
                            ANGKA KREDIT
                        </th>
                        <th>
                            ACTION
                        </th>
                    </tr>
                </thead>
                @php
                    $kinerjas = $this->skp
                        ->kinerjas()
                        ->orderBy('deskripsi', 'desc')
                        ->get();
                @endphp
                @foreach ($kinerjas as $item)
                    <tbody>
                        @php
                            $detailKinerjaData = $item
                                ->detailKinerjas()
                                ->where('skp_id', $this->skp->id)
                                ->get();
                        @endphp
                        @if (count($detailKinerjaData) > 0)
                            @foreach ($detailKinerjaData as $detailKinerja)
                                <tr>
                                    <td rowspan="3" class="deskripsi">
                                        {{ $item->deskripsi }}
                                        
                                        <div class="tw-align-middle tw-flex tw-flex-row">
                                            <button wire:click="performAction('show', '{{ $item->id }}')"
                                                class="btn btn-xs btn-icon mr-1 btn-primary">
                                                <i class="fa fa-eye icon-nm"></i>
                                            </button>

                                            <button wire:click="performAction('edit', '{{ $item->id }}')"
                                                class="btn btn-xs btn-icon mr-1 btn-warning">
                                                <i class="fa fa-pen icon-nm"></i>
                                            </button>

                                            <button class="btn btn-xs btn-icon mr-1 btn-danger dt-delete"
                                                data-key="{{ $item->id }}">
                                                <i class="fa fa-trash icon-nm"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td rowspan="3">
                                        {{ $detailKinerja->deskripsi }}
                                    </td>
                                    <td class="tw-font-extrabold">
                                        Kualitas
                                    </td>
                                    <td>
                                        {{ $detailKinerja->indikator_kualitas }}
                                    </td>
                                    <td rowspan="3">
                                        {{ $detailKinerja->butir_kegiatan }}
                                    </td>
                                    <td rowspan="3">
                                        {{ $detailKinerja->output_kegiatan }}
                                    </td>
                                    <td rowspan="3" class="text-center tw-align-middle">
                                        {{ $detailKinerja->angka_kredit }}
                                    </td>
                                    <td rowspan="3" class="text-center tw-align-middle">
                                        <div class="tw-align-middle tw-flex tw-flex-row">
                                            <button wire:click="performAction('show', '{{ $detailKinerja->id }}')"
                                                class="btn btn-xs btn-icon mr-1 btn-primary">
                                                <i class="fa fa-eye icon-nm"></i>
                                            </button>

                                            <button wire:click="performAction('edit', '{{ $detailKinerja->id }}')"
                                                class="btn btn-xs btn-icon mr-1 btn-warning">
                                                <i class="fa fa-pen icon-nm"></i>
                                            </button>

                                            <button class="btn btn-xs btn-icon mr-1 btn-danger dt-delete-kinerja"
                                                data-key="{{ $detailKinerja->id }}">
                                                <i class="fa fa-trash icon-nm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tw-font-extrabold">
                                        Kuantitas
                                    </td>
                                    <td>
                                        {{ $detailKinerja->indikator_kuantitas }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tw-font-extrabold">
                                        Waktu
                                    </td>
                                    <td>
                                        {{ $detailKinerja->indikator_waktu }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td rowspan="1" class="deskripsi">
                                    {{ $item->deskripsi }}
                                    <div class="tw-align-middle tw-flex tw-flex-row">
                                        <button wire:click="performAction('show', '{{ $item->id }}')"
                                            class="btn btn-xs btn-icon mr-1 btn-primary">
                                            <i class="fa fa-eye icon-nm"></i>
                                        </button>

                                        <button wire:click="performAction('edit', '{{ $item->id }}')"
                                            class="btn btn-xs btn-icon mr-1 btn-warning">
                                            <i class="fa fa-pen icon-nm"></i>
                                        </button>

                                        <button class="btn btn-xs btn-icon mr-1 btn-danger dt-delete"
                                            data-key="{{ $item->id }}">
                                            <i class="fa fa-trash icon-nm"></i>
                                        </button>
                                    </div>
                                </td>
                                <td rowspan="1" colspan="7">
                                    Tidak terdapat rencana kinerja terhadap rencana kinerja atasan ini!
                                </td>
                            </tr>
                        @endif
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            $('.dt-delete').click(function(event) {
                if (confirm('Do you really wish to continue?')) {
                    let key = $(this).attr('data-key');
                    @this.delete(key);
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });
            $('.dt-delete-kinerja').click(function(event) {
                if (confirm('Do you really wish to continue?')) {
                    let key = $(this).attr('data-key');
                    @this.deleteDetailKinerja(key);
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });
            $('.dt-delete-selected').click(function(event) {
                if (confirm('Do you really wish to continue?')) {
                    @this.deleteSelected();
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                }
            });
        })
    </script>
    <div id="#atasanCreateModal">
        @livewire('skp.kinerja.kinerja-atasan-create', ['skp' => $skp], key($skp->id))
    </div>
    @include('livewire.skp.kinerja.partials.scripts')


</div>
