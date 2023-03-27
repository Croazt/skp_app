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
                -webkit-column-break-inside: avoid;
                break-inside: avoid;
                -webkit-region-break-inside: avoid;
        }

        table {
            width: 100%;
        }
    </style>

</head>

<body>
    <div class="tw-pb-7 tw-text-base tw-font-bold tw-w-full tw-text-center">PENILAIAN PRESTASI KERJA PNS
    </div>
    @include('livewire.penilaian-perilaku.pdf.partials.user-detail')
    <div style="display: block; padding-right: 1px;" class="wrapping-div">
        <table class="table-border" style="width: 100%;">
            <thead style="width: 100%;">
                <tr class="text-center">
                    <th style="width: 50%;" class="tw-align-middle tw-text-center">UNSUR YANG DINILAI</th>
                    <th style="width: 50%;" class="tw-align-middle tw-text-center">NILAI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        a. Sasaran Kerja Pegawai
                    </td>
                    <td class="tw-text-center">
                        {{ $nilaiAkhirSkp }}
                    </td>
                </tr>
                <tr>
                    <td>
                        b. Perilaku Kerja Pegawai
                    </td>
                    <td class="tw-text-center">
                        {{ $nilaiAkhirPerilaku }}
                    </td>
                </tr>
                <tr>
                    <td class="tw-text-right">
                        <p class="tw-font-bold tw-uppercase">
                            NILAI PRESTASI KERJA PNS
                        </p>
                        <p>
                            (70% Nilai SKP dan 30% Nilai Perilaku Kerja)
                        </p>
                    </td>
                    <td class="tw-text-center">
                        {{ $nilaiAkhirTotal }}
                    </td>
                </tr>
                <tr>
                    <td>
                        c. Ide Baru
                    </td>
                    <td class="tw-text-center">
                        {{ 0 }}
                    </td>
                </tr>
                <tr>
                    <td class="tw-text-right">
                        <p class="tw-font-bold tw-uppercase">
                            NILAI AKHIR
                        </p>
                        <p>
                            (Nilai Kinerja PNS + Nilai Ide Baru)
                        </p>
                    </td>
                    <td class="tw-text-center">
                        {{ $nilaiAkhirTotal }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="float: right; display: block; break-inside: avoid;" class="tw-mr-3">
        <br>
        <div>
            Sidrap, {{ Carbon\Carbon::parse($penilaianPerilakuGuru->tanggal_konfirmasi)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}
        </div>
        <div>
            Pejabat Penilai Kerja,
        </div>
        <br>
        <br>
        <br>
        <p class="tw-uppercase tw-font-bold" style="text-decoration: underline!important;">
            {{ $penilaianPerilakuGuru->konfirmasiOleh->nama }}
        </p>
        <div class="tw-uppercase">
            NIP {{ $penilaianPerilakuGuru->konfirmasiOleh->nip }}
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
