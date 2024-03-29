@push('styles')
    <style>
        .table-complex thead th:hover,
        thead:hover {
            background: rgba(0, 0, 0, 0.075);
        }

        .hover {
            background: rgba(0, 0, 0, 0.075);
        }

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

<div class="card tw-px-0">
    {{-- @include('livewire.skp.kinerja.partials.modal') --}}
    @can('operator')
    <div class="card-header">
        <div class="tw-w-full tw-h-max tw-flex tw-justify-between">
            <span class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold">
            </span>
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#kinerjaAtasanModal">
                <p>
                    <span class="fas fa-plus"></span> Tambah Rencana Hasil Kinerja
                </p>
            </button>
        </div>
    </div>
    @endcan
    <div class="card-body px-0">
        <div class="card-header tw-py-0 collapsible" href="#collapseOneRencana" data-toggle="collapse"
            data-target="#collapseOneRencana" aria-expanded="true" id="headingOne" aria-controls="collapseOneRencana"
            wire:ignore>
            <div class="tw-w-full tw-flex tw-justify-between">
                <span class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                    KINERJA UTAMA
                </span>
            </div>
        </div>
        <div id="collapseOneRencana" class="collapse show" aria-labelledby="headingOne" wire:ignore.self>
            <div class="table-responsive table-scroll">
                <table class="table table-bordered datatable-sortable table-md tw-text-sm table-complex"
                    style="width:120vw;">
                    <thead style="width=100%;">
                        <tr style="width=100%;">
                            <th style="width:15%;">
                                RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI
                            </th>
                            <th style="width:15%;">
                                RENCANA KINERJA
                            </th>
                            <th style="width:5%;">
                                ASPEK
                            </th>
                            <th style="width:13%;">
                                INDIKATOR KINERJA INDIVIDU
                            </th>
                            <th style="width:15%;">
                                BUTIR KEGIATAN TERKAIT
                            </th>
                            <th style="width:10%;">
                                OUTPUT BUTIR KEGIATAN
                            </th>
                            <th style="width:14%;">
                                TARGET
                            </th>
                            <th style="width:4%;">
                                ANGKA KREDIT
                            </th>
                            @canany(['Operator'])
                                <th style="width:6%;">
                                    ACTION
                                </th>
                            @endcan
                        </tr>
                    </thead>
                    @foreach ($this->kinerja as $item)
                        @if ($item->kategori == 'utama')
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
                                                @can('Operator')
                                                    <div class="tw-align-middle tw-flex tw-flex-row">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deskripsiKinerjaModal"
                                                            data-kategori="{{ $item->kategori }}"
                                                            data-deskripsiid="{{ $item->id }}"
                                                            data-deskripsi="{{ $item->deskripsi }}"
                                                            class="btn btn-xs btn-icon mr-1 btn-warning">
                                                            <i class="fa fa-pen icon-nm"></i>
                                                        </button>

                                                        <button class="btn btn-xs btn-icon mr-1 btn-danger dt-delete"
                                                            data-key="{{ $item->id }}">
                                                            <i class="fa fa-trash icon-nm"></i>
                                                        </button>
                                                    </div>
                                                @endcan
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
                                                {!! nl2br($detailKinerja->butir_kegiatan) !!}
                                            </td>
                                            <td rowspan="3">
                                                {!! nl2br($detailKinerja->output_kegiatan) !!}
                                            </td>
                                            <td>
                                                {{ $detailKinerja->detail_output_kualitas }}
                                            </td>
                                            <td rowspan="3" class="text-center tw-align-middle">
                                                {{ $detailKinerja->angka_kredit }}
                                                @if ($detailKinerja->tipe_angka_kredit == 'persen')
                                                    % PKG
                                                @endif
                                            </td>
                                            @can('Operator')
                                                <td rowspan="3" class="text-center tw-align-middle">
                                                    <div class="tw-align-middle tw-flex tw-flex-col">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#kinerjaAtasanModal"
                                                            data-kategori="{{ $item->kategori }}"
                                                            data-deskripsiid="{{ $item->id }}"
                                                            data-deskripsi="{{ $item->deskripsi }}"
                                                            data-detailid="{{ $detailKinerja->id }}"
                                                            data-detaildeskripsi="{{ $detailKinerja }}"
                                                            class="btn btn-xs btn-icon btn-warning">
                                                            <i class="fa fa-pen icon-nm"></i>
                                                        </button>

                                                        <button class="btn btn-xs btn-icon btn-danger dt-delete-kinerja"
                                                            data-key="{{ $detailKinerja->id }}">
                                                            <i class="fa fa-trash icon-nm"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            @endcan
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
                                                {{ $detailKinerja->detail_output_waktu }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td rowspan="1" class="deskripsi">
                                            {{ $item->deskripsi }}
                                            <div class="tw-align-middle tw-flex tw-flex-row">
                                                <button type="button" data-toggle="modal"
                                                    data-target="#deskripsiKinerjaModal"
                                                    data-kategori="{{ $item->kategori }}"
                                                    data-deskripsiid="{{ $item->id }}"
                                                    data-deskripsi="{{ $item->deskripsi }}"
                                                    class="btn btn-xs btn-icon btn-warning">
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
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
        <div class="card-header tw-py-0 collapsible" id="headingTwo" href="#collapseTwoReviu" data-toggle="collapse"
            data-target="#collapseTwoReviu" aria-expanded="true" aria-controls="collapseTwoReviu" wire:ignore>
            <div class="tw-w-full tw-flex tw-justify-between">
                <span class="tw-my-auto tw-text-center tw-text-base tw-font-extrabold tw-cursor-pointer tw-select-none">
                    KINERJA TAMBAHAN
                </span>
            </div>
        </div>
        <div id="collapseTwoReviu" class="collapse show" aria-labelledby="headingTwo" wire:ignore.self>
            <div class="table-responsive table-scroll">
                <table class="table table-bordered datatable-sortable table-md tw-text-sm table-complex"
                    style="width:120vw;">
                    <thead style="width=100%;">
                        <tr style="width=100%;">
                            <th style="width:15%;">
                                RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI
                            </th>
                            <th style="width:15%;">
                                RENCANA KINERJA
                            </th>
                            <th style="width:5%;">
                                ASPEK
                            </th>
                            <th style="width:13%;">
                                INDIKATOR KINERJA INDIVIDU
                            </th>
                            <th style="width:15%;">
                                BUTIR KEGIATAN TERKAIT
                            </th>
                            <th style="width:10%;">
                                OUTPUT BUTIR KEGIATAN
                            </th>
                            <th style="width:14%;">
                                TARGET
                            </th>
                            <th style="width:4%;">
                                ANGKA KREDIT
                            </th>
                            @canany(['Operator', 'Tim Angka Kredit', 'Pengelola Kinerja', 'Kepala Sekolah'])
                                <th style="width:6%;">
                                    ACTION
                                </th>
                            @endcan
                        </tr>
                    </thead>
                    @foreach ($this->kinerja as $item)
                        @if ($item->kategori == 'tambahan')
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
                                                @can('Operator')
                                                    <div class="tw-align-middle tw-flex tw-flex-row">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deskripsiKinerjaModal"
                                                            data-kategori="{{ $item->kategori }}"
                                                            data-deskripsiid="{{ $item->id }}"
                                                            data-deskripsi="{{ $item->deskripsi }}"
                                                            class="btn btn-xs btn-icon mr-1 btn-warning">
                                                            <i class="fa fa-pen icon-nm"></i>
                                                        </button>

                                                        <button class="btn btn-xs btn-icon mr-1 btn-danger dt-delete"
                                                            data-key="{{ $item->id }}">
                                                            <i class="fa fa-trash icon-nm"></i>
                                                        </button>
                                                    </div>
                                                @endcan
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
                                                {!! nl2br($detailKinerja->butir_kegiatan) !!}
                                            </td>
                                            <td rowspan="3">
                                                {!! nl2br($detailKinerja->output_kegiatan) !!}
                                            </td>
                                            <td>
                                                {{ $detailKinerja->detail_output_kualitas }}
                                            </td>
                                            <td rowspan="3" class="text-center tw-align-middle">
                                                {{ $detailKinerja->angka_kredit }}
                                                @if ($detailKinerja->tipe_angka_kredit == 'persen')
                                                    %
                                                @endif
                                            </td>
                                            @can('Operator')
                                                <td rowspan="3" class="text-center tw-align-middle">
                                                    <div class="tw-align-middle tw-flex tw-flex-col">
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#kinerjaAtasanModal"
                                                            data-kategori="{{ $item->kategori }}"
                                                            data-deskripsiid="{{ $item->id }}"
                                                            data-deskripsi="{{ $item->deskripsi }}"
                                                            data-detailid="{{ $detailKinerja->id }}"
                                                            data-detaildeskripsi="{{ $detailKinerja }}"
                                                            class="btn btn-xs btn-icon btn-warning">
                                                            <i class="fa fa-pen icon-nm"></i>
                                                        </button>

                                                        <button class="btn btn-xs btn-icon btn-danger dt-delete-kinerja"
                                                            data-key="{{ $detailKinerja->id }}">
                                                            <i class="fa fa-trash icon-nm"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            @endcan
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
                                                {{ $detailKinerja->detail_output_waktu }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td rowspan="1" class="deskripsi">
                                            {{ $item->deskripsi }}
                                            <div class="tw-align-middle tw-flex tw-flex-row">
                                                <button type="button" data-toggle="modal"
                                                    data-target="#deskripsiKinerjaModal"
                                                    data-kategori="{{ $item->kategori }}"
                                                    data-deskripsiid="{{ $item->id }}"
                                                    data-deskripsi="{{ $item->deskripsi }}"
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
                        @endif
                    @endforeach
                </table>
            </div>
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

        var ele = document.querySelectorAll('.table-scroll');
        ele.forEach(ele => {

            ele.style.cursor = 'grab';
            let pos = {
                top: 0,
                left: 0,
                x: 0,
                y: 0
            };
            const mouseDownHandler = function(e) {

                ele.style.cursor = 'grabbing';
                ele.style.userSelect = 'none';
                pos = {
                    // The current scroll
                    left: ele.scrollLeft,
                    top: ele.scrollTop,
                    // Get the current mouse position
                    x: e.clientX,
                    y: e.clientY,
                };

                document.addEventListener('mousemove', mouseMoveHandler);
                document.addEventListener('mouseup', mouseUpHandler);
            };
            const mouseMoveHandler = function(e) {
                // How far the mouse has been moved
                const dx = e.clientX - pos.x;
                const dy = e.clientY - pos.y;
                // Scroll the element
                ele.scrollTop = pos.top - dy;
                ele.scrollLeft = pos.left - dx;
            };
            const mouseUpHandler = function() {
                document.removeEventListener('mousemove', mouseMoveHandler);
                document.removeEventListener('mouseup', mouseUpHandler);

                ele.style.cursor = 'grab';
                ele.style.removeProperty('user-select');
            };
            ele.addEventListener('mousedown', mouseDownHandler);
            ele.addEventListener('mouseup', mouseUpHandler);
        });

        function refreshPeta() {
            console.log('test')
        }
    </script>
    @include('livewire.skp.kinerja.partials.scripts')
</div>
@include('livewire.skp.kinerja.kinerja-atasan-create')
{{-- @include('livewire.skp.kinerja.detail-kinerja') --}}
@include('livewire.skp.kinerja.deskripsi-kinerja')
