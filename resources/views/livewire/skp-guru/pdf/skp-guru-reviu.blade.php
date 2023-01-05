<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('stisla/js/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/js/modules/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">

    @vite(['resources/css/app.css'])

    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        * {
            font-family: "Bookman Old Style", Georgia, serif !important;
        }

        thead {
            display: table-row-group
        }

        .table-leading {
            border-bottom: 0px none !important;
        }

        .table-following {
            border-top: none !important;
            border-bottom: none !important;
        }

        .table-ending {
            border-top: none !important;
        }

        .table-border table,
        .table-border th,
        .table-border td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 4px;
        }

        body,
        table {
            font-size: 12px;
            margin: 0px;
        }

        .wrapping-div {
            display: block;
        }

        @media print {
            tr {
                page-break-inside: avoid !important;
                -webkit-column-break-inside: avoid;
                break-inside: avoid;
                -webkit-region-break-inside: avoid;
            }
        }

        .wrapping-div tbody,
        .wrapping-div tr,
        .wrapping-div td,
        .wrapping-div th {
            page-break-inside: avoid !important;
        }

        table {
            width: 100%;
        }
    </style>

</head>

<body>
    <div class="tw-pb-7 tw-text-base tw-font-bold tw-w-full tw-text-center">REVIU RENCANA SKP PEJABAT FUNGSIONAL</div>
    @include('livewire.skp-guru.pdf.partials.user-detail')
    <div style="display: block; padding-right: 1px;" class="wrapping-div">
        <table class="table-border" style="width: 100%;">
            <thead style="width: 100%;">
                <tr class="text-center">
                    <th style="width: 2%;" class="tw-align-middle">NO</th>
                    <th style="width: 18%;" class="tw-align-middle">RENCANA KINERJA ATASAN LANGSUNG/ UNIT KERJA DAN ATAU
                        ORGANISASI YANG DIINTERVENSI</th>
                    <th style="width: 19%;" class="tw-align-middle">RENCANA KINERJA</th>
                    <th style="width: 6%;" class="tw-align-middle">ASPEK</th>
                    <th style="width: 17%;" class="tw-align-middle">INDIKATOR KINERJA INDIVIDU</th>
                    <th style="width: 22%;" class="tw-align-middle" colspan="2">TARGET</th>
                    <th style="width: 16%;" class="tw-align-middle">REVIU OLEH PENGELOLA</th>
                </tr>
                <tr class="text-center">
                    <th class="tw-align-middle" rowspan="1" colspan="1">(1)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(2)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(3)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(4)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(5)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="2">(6)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(7)</th>
                </tr>
            </thead>
            <tr>
                <th class="tw-align-middle" rowspan="1" colspan="8">A. KINERJA UTAMA</th>
            </tr>
            @php
                $i = 1;
                $firstKey = $rencanaKinerjaUtama->first()->id;
                $deskripsi = $data['kinerja_desc'][$firstKey];
            @endphp
            @foreach ($rencanaKinerjaUtama as $rencanaKinerja)
                @if ($firstKey != $rencanaKinerja->id && $deskripsi != $data['kinerja_desc'][$rencanaKinerja->id])
                    @php
                        $deskripsi = $data['kinerja_desc'][$rencanaKinerja->id];
                        $i++;
                    @endphp
                @endif
                @include('livewire.skp-guru.pdf.tables.reviu')
            @endforeach
            <tr>
                <th class="tw-align-middle" rowspan="1" colspan="8">B. KINERJA TAMBAHAN</th>
            </tr>
            @php
                $i = 1;
                $firstKey = $rencanaKinerjaTambahan->first()->id;
                $deskripsi = $data['kinerja_desc'][$firstKey];
            @endphp
            @foreach ($rencanaKinerjaTambahan as $rencanaKinerja)
                @if ($firstKey != $rencanaKinerja->id && $deskripsi != $data['kinerja_desc'][$rencanaKinerja->id])
                    @php
                        $deskripsi = $data['kinerja_desc'][$rencanaKinerja->id];
                        $i++;
                    @endphp
                @endif
                @include('livewire.skp-guru.pdf.tables.reviu')
            @endforeach
        </table>
    </div>
    <div style="float: right; display: block; break-inside: avoid;" class="tw-mr-3">
        <br>
        <div>
            Sidrap, {{ Carbon\Carbon::parse($skpGuru->tanggal_reviu)->translatedFormat('d F Y') }}
        </div>
        <div>
            Pengelola Kinerja,
        </div>
        <br>
        <br>
        <br>
        <p class="tw-uppercase tw-font-bold" style="text-decoration: underline!important;">
            {{ $skpGuru->reviu->nama }}
        </p>
        <div class="tw-uppercase">
            NIP {{ $skpGuru->reviu->nip }}
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var headerCell = null;

            var kinerjaAtasanRow = $(".deskripsi");
            var tempCell = null;
            for (var i = 0; i < kinerjaAtasanRow.length; i++) {
                const firstCell = (kinerjaAtasanRow[i])
                if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                    headerCell = firstCell;
                } else {
                    $(headerCell).addClass("table-leading");
                    $(firstCell).addClass("table-following").empty();
                    if (i == kinerjaAtasanRow.length - 1) {
                        $(firstCell).removeClass("table-following");
                        $(firstCell).addClass("table-ending").empty();
                    }
                    tempCell = firstCell;
                }
            }
            headerCell = null;

            var numRow = $(".num-row-utama");
            tempCell = null;
            for (var i = 0; i < numRow.length; i++) {
                const firstCell = (numRow[i])
                if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                    headerCell = firstCell;
                } else {
                    $(headerCell).addClass("table-leading");
                    $(firstCell).addClass("table-following").empty();
                    if (i == numRow.length - 1) {
                        $(firstCell).removeClass("table-following");
                        $(firstCell).addClass("table-ending").empty();
                    }
                    tempCell = firstCell;
                }
            }
            headerCell = null;

            numRow = $(".num-row-tambahan");
            tempCell = null;
            for (var i = 0; i < numRow.length; i++) {
                const firstCell = (numRow[i])
                if (headerCell === null || firstCell.innerText !== headerCell.innerText) {
                    headerCell = firstCell;
                } else {
                    $(headerCell).addClass("table-leading");
                    $(firstCell).addClass("table-following").empty();
                    if (i == numRow.length - 1) {
                        $(firstCell).removeClass("table-following");
                        $(firstCell).addClass("table-ending").empty();
                    }
                    tempCell = firstCell;
                }
            }
        })
    </script>
</body>

</html>
