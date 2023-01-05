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
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#kinerjaAtasanModal">
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
                            TARGET
                        </th>
                        <th>
                            ANGKA KREDIT
                        </th>
                        <th>
                            ACTION
                        </th>
                    </tr>
                </thead>
                @foreach ($this->kinerja as $item)
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
                                    <td>
                                        {{ $detailKinerja->detail_output_kualitas }}
                                    </td>
                                    <td rowspan="3" class="text-center tw-align-middle">
                                        {{ $detailKinerja->angka_kredit }}
                                    </td>
                                    <td rowspan="3" class="text-center tw-align-middle">
                                        <div class="tw-align-middle tw-flex tw-flex-col">
                                            <button wire:click="performAction('show', '{{ $detailKinerja->id }}')"
                                                class="btn btn-xs btn-icon mb-1 btn-primary">
                                                <i class="fa fa-eye icon-nm"></i>
                                            </button>

                                            <button wire:click="performAction('edit', '{{ $detailKinerja->id }}')"
                                                class="btn btn-xs btn-icon mb-1 btn-warning">
                                                <i class="fa fa-pen icon-nm"></i>
                                            </button>

                                            <button class="btn btn-xs btn-icon btn-danger dt-delete-kinerja"
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
                                    <td>
                                        {{ $detailKinerja->detail_output_kuantitas }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tw-font-extrabold">
                                        Waktu
                                    </td>
                                    <td>
                                        {{ $detailKinerja->indikator_waktu }}
                                    </td>
                                    <td>
                                        {{ $detailKinerja->detail_output_waktu  }}
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

            function rowspanSelector() {
                const table = document.querySelector('table');
                let headerCell = null;

                let kinerjaAtasanRow = $('.deskripsi')
                for (let i = 0; i < kinerjaAtasanRow.length; i++) {
                    const firstCell = (kinerjaAtasanRow[i])
                    if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                        headerCell = firstCell;
                    } else {
                        headerCell.rowSpan += 3;
                        firstCell.remove();
                    }
                }
            }
            rowspanSelector()

            function findBlocks(theTable) {
                if ($(theTable).data('hasblockrows') == null) {
                    // to prove we only run this once

                    // we will loop through the rows but skip the ones not in a block
                    var rows = $(theTable).find('tr');
                    var maxRowspanAdd = 0;
                    for (var i = 0; i < rows.length;) {
                        var maxRowspanSec = 0;

                        var firstRow = rows[i];

                        // find max rowspan in this row - this represents the size of the block
                        var maxRowspan = 1;
                        $(firstRow).find('td').each(function() {
                            if ($(this).hasClass('deskripsi')) {
                                maxRowspanSec = parseInt($(this).attr('rowspan') || '1', 10)
                                return
                            }
                            var attr = parseInt($(this).attr('rowspan') || '1', 10)
                            if (attr > maxRowspan) maxRowspan = attr;
                        });

                        // set to the index in rows we want to go up to
                        maxRowspan += i;
                        var blockRows = []
                        var parentBlockRows = []
                        if (maxRowspanSec == 1) {
                            blockRows.push($(firstRow).children()[0]);
                            blockRows.push(rows[i]);
                            parentBlockRows.push(rows[i]);
                            $(rows[i]).data('blockrows', blockRows);
                            $($(firstRow).children()[0]).data('blockrows', blockRows)
                            $($(firstRow).children()[0]).data('parentblockrows', parentBlockRows)
                            maxRowspanAdd++
                            i++
                            continue
                        }
                        // build up an array and store with each row in this block
                        // this is still memory-efficient, as we are just storing a pointer to the same array
                        // ... which is also nice becuase we can build the array up in the same loop

                        blockRows.push($(firstRow).children()[0]);
                        for (; i < maxRowspan; i++) {
                            $(rows[i]).data('blockrows', blockRows);
                            blockRows.push(rows[i]);
                            parentBlockRows.push(rows[i]);
                        }
                        if (maxRowspanSec > 3) {
                            for (let j = 1; j <= (maxRowspanSec / 3) - 1; j++) {
                                blockRows = []
                                blockRows.push($(firstRow).children()[0]);
                                var temp = i + 3
                                for (; i < temp; i++) {
                                    $(rows[i]).data('blockrows', blockRows);
                                    blockRows.push(rows[i]);
                                    parentBlockRows.push(rows[i]);
                                }
                                $($(firstRow).children()[0]).data('blockrows', blockRows)
                                $($(firstRow).children()[0]).data('parentblockrows', parentBlockRows)
                            }
                        }
                        // i is now the start of the next block
                    }

                    // set data against table so we know it has been inited (for if we call it in the hover event)
                    $(theTable).data('hasblockrows', 1);
                }
            }
            findBlocks($('table'));
            $(".table-complex td").hover(function() {
                $el = $(this);
                //findBlocks($el.closest('table')); // you can call it here or onload as below
                if (!$el.hasClass('deskripsi')) {
                    $.each($el.parent().data('blockrows'), function() {

                        if ($(this).hasClass('deskripsi')) {
                            $(this).addClass('hover');
                        }
                        $(this).find('td').addClass('hover');
                    });
                } else {
                    $.each($el.data('parentblockrows'), function() {
                        $(this).find('td').addClass('hover');
                    });
                }
            }, function() {
                $el = $(this);
                if (!$el.hasClass('deskripsi')) {
                    $.each($el.parent().data('blockrows'), function() {
                        if ($(this).hasClass('deskripsi')) {
                            $(this).removeClass('hover');
                        }
                        $(this).find('td').removeClass('hover');
                    });
                } else {
                    $.each($el.data('parentblockrows'), function() {
                        $(this).find('td').removeClass('hover');
                    });
                }
            });
        })
    </script>
    @include('livewire.skp.kinerja.partials.scripts')
</div>
@include('livewire.skp.kinerja.kinerja-atasan-create')
