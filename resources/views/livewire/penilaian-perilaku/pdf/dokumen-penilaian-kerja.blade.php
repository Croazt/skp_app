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

            head,
            body {
                width: 100%;
            }

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
    <div class="tw-p-7 tw-text-2xl tw-font-bold tw-w-full tw-text-center">LAPORAN DOKUMEN PENILAIAN KINERJA</div>
    <div style="display: block; padding-right: 1px;">
        <table class="table-border tw-text-lg" style="width: 100%;">
            @php
                $i = 1;
            @endphp
            @for (; $i <= 3; $i++)
                @php
                    $head = 'PEGAWAI YANG DINILAI';
                    $userData = $skpGuru->user;
                    if ($i == 2) {
                        $head = 'PEJABAT PENILAI KINERJA';
                        $userData = $skp->pejabatPenilai;
                    }
                    if ($i == 3) {
                        $head = 'ATASAN PEJABAT PENILAI';
                        $userData = $skp->pejabatPenilai->atasanPejabat;
                    }
                @endphp
                <tr class="tw-w-full">
                    <td rowspan="6" style="width:5%" class="tw-text-center">
                        {{ $i }}
                    </td style="width:95%">
                    <td class="tw-font-bold" colspan="2">
                        {{ $head }}
                    </td>
                </tr>
                <tr style="width:95%">
                    <td class="tw-w-1/2">
                        Nama
                    </td>
                    <td class="tw-w-1/2">
                        {{ $userData->nama }}
                    </td>
                </tr>
                <tr style="width:95%">
                    <td class="tw-w-1/2">
                        NIP
                    </td>
                    <td class="tw-w-1/2">
                        {{ $userData->nip }}
                    </td>
                </tr>
                <tr style="width:95%">
                    <td class="tw-w-1/2">
                        Pangkat / Gol.Ruang
                    </td>
                    <td class="tw-w-1/2">
                        {{ $userData->getPangkatName() }}
                    </td>
                </tr>
                <tr style="width:95%">
                    <td class="tw-w-1/2">
                        Jabatan
                    </td>
                    <td class="tw-w-1/2">
                        {{ $userData->pekerjaan }}
                    </td>
                </tr>
                <tr style="width:95%">
                    <td class="tw-w-1/2">
                        UNIT KERJA
                    </td>
                    <td class="tw-w-1/2">
                        {{ $userData->unit_kerja }}
                    </td>
                </tr>
            @endfor
            <tr class="tw-w-full">
                <td rowspan="8" style="width:5%" class="tw-text-center">
                    {{ $i++ }}
                </td style="width:95%">
                <td class="tw-font-bold" colspan="2">
                    PENILAIAN KINERJA
                </td>
            </tr>
            <tr style="width:95%">
                <td class="tw-w-1/2">
                    NILAI SKP
                </td>
                <td class="tw-w-1/2">
                    {{ $nilaiAkhirSkp }}
                </td>
            </tr>
            <tr style="width:95%">
                <td class="tw-w-1/2">
                    NILAI PERILAKU KERJA
                </td>
                <td class="tw-w-1/2">
                    {{ $nilaiAkhirPerilaku }}
                </td>
            </tr>
            <tr style="width:95%">
                <td class="tw-w-1/2">
                    NILAI SKP + NILAI PERILAKU KERJA
                </td>
                <td class="tw-w-1/2">
                    {{ $nilaiAkhirTotal }}
                </td>
            </tr>
            <tr style="width:95%">
                <td class="tw-w-1/2">
                    IDE BARU
                </td>
                <td class="tw-w-1/2">
                    {{ $skpGuru->ideBaru ?? ' ' }}
                </td>
            </tr>
            <tr style="width:95%">
                <td class="tw-w-1/2">
                    NILAI KINERJA PEGAWAI
                </td>
                <td class="tw-w-1/2">
                    {{ $nilaiAkhirTotal }}
                </td>
            </tr>
            <tr style="width:95%">
                <td class="tw-w-1/2">
                    PREDIKAT KINERJA PEGAWAI
                </td>
                <td class="tw-w-1/2">
                    {{ $nilaiAkhirTotal < 50
                        ? 'SANGAT KURANG'
                        : ($nilaiAkhirTotal < 70
                            ? 'KURANG'
                            : ($nilaiAkhirTotal < 90
                                ? 'CUKUP'
                                : ($nilaiAkhirTotal < 110
                                    ? 'BAIK'
                                    : ($nilaiAkhirTotal < 110 && ($skpGuru->ideBaru ?? 0) > 0
                                        ? 'SANGAT BAIK'
                                        : 'BAIK')))) }}
                </td>
            <tr style="width:95%">
                <td class="tw-w-1/2">
                    TOTAL ANGKA KREDIT YANG DIPEROLEH (BAGI PEJABAT FUNGSIONAL)
                </td>
                <td class="tw-w-1/2">
                    @php
                        $totalAngkaKredit = 0;
                        foreach ($rencanaKinerjaGuru as $key => $value) {
                            $totalAngkaKredit += $value->angka_kredit ?? 0;
                        }
                    @endphp
                    {{ $totalAngkaKredit }}
                </td>
            </tr>
            </tr>
            <tr class="tw-w-full">
                <td rowspan="2" style="width:5%" class="tw-text-center">
                    {{ $i++ }}
                </td style="width:95%">
                <td class="tw-font-bold" colspan="2">
                    PERMASALAHAN
                </td>
            </tr>
            <tr>
                <td class="tw-font-bold" colspan="2">
                    <div class="tw-h-20"></div>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td rowspan="2" style="width:5%" class="tw-text-center">
                    {{ $i++ }}
                </td style="width:95%">
                <td class="tw-font-bold" colspan="2">
                    REKOMENDASI
                </td>
            </tr>
            <tr>
                <td class="tw-font-bold" colspan="2">
                    <div class="tw-h-20"></div>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td rowspan="2" style="width:5%" class="tw-text-center">
                    {{ $i++ }}
                </td style="width:95%">
                <td class="tw-font-bold" colspan="2">
                    KEBERATAN
                </td>
            </tr>
            <tr>
                <td class="tw-font-bold" colspan="2">
                    <div class="tw-h-20"></div>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td rowspan="2" style="width:5%" class="tw-text-center">
                    {{ $i++ }}
                </td style="width:95%">
                <td class="tw-font-bold" colspan="2">
                    PENJELASAN PEJABAT PENILAI ATAS KEBERATAN
                </td>
            </tr>
            <tr>
                <td class="tw-font-bold" colspan="2">
                    <div class="tw-h-20"></div>
                </td>
            </tr>
            <tr class="tw-w-full">
                <td rowspan="2" style="width:5%" class="tw-text-center">
                    {{ $i++ }}
                </td style="width:95%">
                <td class="tw-font-bold" colspan="2">
                    KEPUTUSAN ATASAN PEJABAT PENILAI KINERJA
                </td>
            </tr>
            <tr>
                <td class="tw-font-bold" colspan="2">
                    <div class="tw-h-20"></div>
                </td>
            </tr>
        </table>
    </div>
    <div style="break-inside: auto; border: 1px solid" class="tw-mr-1 tw-w-full tw-text-lg">
        <div style="width:97%" class="tw-mx-auto">
            <div class="tw-w-full tw-flex tw-justify-between">
                <div class="tw-w-fit tw-text-center">
                    <br>
                    <div>
                        {{ $i++ }}. Sidrap,
                        {{ Carbon\Carbon::now()->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('.... F Y') }}
                    </div>
                    <div>
                        Pegawai Yang Dinilai,
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
                <div class="tw-w-fit tw-text-center">
                    <br>
                    <div>
                        {{ $i++ }}. Sidrap,
                        {{ Carbon\Carbon::now()->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('.... F Y') }}
                    </div>
                    <div>
                        Pejabat Penilai Kerja,
                    </div>
                    <br>
                    <br>
                    <br>
                    <p class="tw-uppercase tw-font-bold" style="text-decoration: underline!important;">
                        {{ $skpGuru->pejabatPenilai->nama ?? $skp->pejabatPenilai->nama }}
                    </p>
                    <div class="tw-uppercase">
                        NIP {{$skpGuru->pejabatPenilai->nip ?? $skp->pejabatPenilai->nip }}
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-w-fit tw-text-center tw-mx-auto">
            <br>
            <div>
                {{ $i++ }}. Sidrap,
                {{ Carbon\Carbon::now()->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('.... F Y') }}
            </div>
            <div>
                Atasan Pejabat Penilai,
            </div>
            <br>
            <br>
            <br>
            <p class="tw-uppercase tw-font-bold" style="text-decoration: underline!important;">
                {{ $skpGuru->pejabatPenilai->atasanPejabat->nama }}
            </p>
            <div class="tw-uppercase">
                NIP {{ $skpGuru->pejabatPenilai->atasanPejabat->nip }}
            </div>
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
