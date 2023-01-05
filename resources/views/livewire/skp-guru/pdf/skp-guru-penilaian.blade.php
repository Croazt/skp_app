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
            font-size: 10px;
            margin: 0px;
        }

        .wrapping-div {
            display: block;
        }

        @page {
            size: LEGAL landscape;
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
    <div class="tw-text-base tw-font-bold tw-w-full tw-text-center">RENCANA SKP PEJABAT FUNGSIONAL</div>
    @include('livewire.skp-guru.pdf.partials.user-detail')
    <div style="display: block; padding-right: 1px;" class="wrapping-div">
        <table class="table-border" style="width: 100%;">
            <thead style="width: 100%;">
                <tr class="text-center">
                    <th style="width: 2%;" class="tw-align-middle" rowspan="2">NO</th>
                    <th style="width: 15.5%;" class="tw-align-middle" rowspan="2">RENCANA KINERJA ATASAN
                        LANGSUNG/UNIT KERJA DAN ATAU ORGANISASI YANG DIINTERVENSI</th>
                    <th style="width: 15.5%;" class="tw-align-middle" rowspan="2">RENCANA KINERJA</th>
                    <th style="width: 3%;" class="tw-align-middle" rowspan="2">ASPEK</th>
                    <th style="width: 12.5%;" class="tw-align-middle" rowspan="2">INDIKATOR KINERJA INDIVIDU</th>
                    <th style="width: 13%;" class="tw-align-middle" rowspan="2" colspan="2">TARGET</th>
                    <th style="width: 12.5%;" class="tw-align-middle" rowspan="2" colspan="2">REALISASI</th>
                    <th style="width: 4%;" class="tw-al-ign-middle" rowspan="2" colspan="1">CAPAIAN IKI</th>
                    <th style="width: 4%;" class="tw-align-middle" rowspan="2" colspan="1">KATEGORI CAPAIAN IKI
                    </th>
                    <th style="width: 5%;" class="tw-align-middle" rowspan="1" colspan="2">CAPAIAN RENCANA <br>
                        KINERJA</th>
                    <th style="width: 4%; word-wrap: break-all;" class="tw-align-middle  tw-break-all" rowspan="2"
                        colspan="1">METODE CASCADING</th>
                    <th style="width: 4%; word-wrap: break-all;" class="tw-align-middle  tw-break-all" rowspan="2"
                        colspan="1">NILAI TERTIMBANG</th>
                </tr>
                <tr class="text-center" style="width: 100%;">
                    <th style="width: 6%;" class="tw-align-middle" rowspan="1" colspan="1">KATEGORI</th>
                    <th style="width: 4%;" class="tw-align-middle" rowspan="1" colspan="1">NILAI</th>
                </tr>
                <tr class="text-center" style="width: 100%;">
                    <th style="width: 2%;" class="tw-align-middle" rowspan="1" colspan="1">(1)</th>
                    <th style="width: 15.5%;" class="tw-align-middle" rowspan="1" colspan="1">(2)</th>
                    <th style="width: 15.5%;" class="tw-align-middle" rowspan="1" colspan="1">(3)</th>
                    <th style="width: 3%;" cclass="tw-align-middle" rowspan="1" colspan="1">(4)</th>
                    <th style="width: 12.5%;" class="tw-align-middle" rowspan="1" colspan="1">(5)</th>
                    <th style="width: 13%;" class="tw-align-middle" rowspan="1" colspan="2">(6)</th>
                    <th style="width: 12.5%;" class="tw-align-middle" rowspan="1" colspan="2">(7)</th>
                    <th style="width: 4%;" class="tw-align-middle" rowspan="1" colspan="1">(8)</th>
                    <th style="width: 4%;" class="tw-align-middle" rowspan="1" colspan="1">(9)</th>
                    <th style="width: 6%;" class="tw-align-middle" rowspan="1" colspan="1">(10)</th>
                    <th style="width: 4%;" class="tw-align-middle" rowspan="1" colspan="1">(11)</th>
                    <th style="width: 4%;"class="tw-align-middle" rowspan="1" colspan="1">(12)</th>
                    <th style="width: 4%;" class="tw-align-middle" rowspan="1" colspan="1">(13)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="tw-align-middle" rowspan="1" colspan="15">A. KINERJA UTAMA</th>
                </tr>
            </tbody>
            @php
                $i = 1;
                $firstKey = $rencanaKinerjaUtama->first()->id;
                $deskripsi = $data['kinerja_desc'][$firstKey];
                $nilaiTertimbangUtama = 0;
                $totalTertimbangUtama = 0;
            @endphp
            @foreach ($rencanaKinerjaUtama as $rencanaKinerja)
                @if ($firstKey != $rencanaKinerja->id && $deskripsi != $data['kinerja_desc'][$rencanaKinerja->id])
                    @php
                        $deskripsi = $data['kinerja_desc'][$rencanaKinerja->id];
                        $i++;
                    @endphp
                @endif
                @if ($data['terkait'][$rencanaKinerja->id])
                    @php
                        $nilaiTertimbangUtama += $data['nilai_tertimbang'][$rencanaKinerja->id];
                        $totalTertimbangUtama++;
                    @endphp
                    @include('livewire.skp-guru.pdf.tables.penilaian')
                @endif
            @endforeach
            <tbody>
                <tr>
                    <th class="tw-text-right" rowspan="1" colspan="14">RATA-RATA NILAI TERTIMBANG CAPAIAN
                        RENCANA KINERJA UTAMA</th>
                    <th class="tw-text-center" rowspan="1" colspan="1">
                        {{ $nilaiTertimbangUtama / $totalTertimbangUtama }}</th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th class="tw-align-middle" rowspan="1" colspan="15">B. KINERJA TAMBAHAN</th>
                </tr>
            </tbody>
            @php
                $i = 1;
                $firstKey = $rencanaKinerjaTambahan->first()->id;
                $deskripsi = $data['kinerja_desc'][$firstKey];
                $nilaiTertimbangTambahan = 0;
            @endphp
            @foreach ($rencanaKinerjaTambahan as $rencanaKinerja)
                @if ($firstKey != $rencanaKinerja->id && $deskripsi != $data['kinerja_desc'][$rencanaKinerja->id])
                    @php
                        $deskripsi = $data['kinerja_desc'][$rencanaKinerja->id];
                        $i++;
                    @endphp
                @endif
                @if ($data['terkait'][$rencanaKinerja->id])
                    @php
                        $nilaiTertimbangTambahan += $data['nilai_tertimbang'][$rencanaKinerja->id];
                    @endphp
                    @include('livewire.skp-guru.pdf.tables.penilaian')
                @endif
            @endforeach
            <tbody>
                <tr>
                    <th class="tw-text-right" rowspan="1" colspan="14">TOTAL NILAI TERTIMBANG CAPAIAN RENCANA KINERJA TAMBAHAN</th>
                    <th class="tw-text-center" rowspan="1" colspan="1">
                        {{ $nilaiTertimbangUtama / $totalTertimbangUtama }}</th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th class="tw-text-right tw-font-bold" rowspan="1" colspan="14">NILAI AKHIR SKP = RATA-RATA NILAI TERTIMBANG CAPAIAN RENCANA KINERJA UTAMA + TOTAL NILAI TERTIMBANG CAPAIAN RENCANA KINERJA TAMBAHAN</th>
                    <th class="tw-text-center tw-font-bold" rowspan="1" colspan="1">
                        {{ ($nilaiTertimbangUtama / $totalTertimbangUtama) + ($nilaiTertimbangTambahan > 10 ? 10 : $nilaiTertimbangTambahan) }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tw-w-full tw-flex tw-justify-between tw-h-max tw-pt-20" style="break-inside: avoid;">
        <div style="break-inside: avoid;" class="tw-ml-20 tw-h-max tw-mt-auto tw-mb-0">
            <div>
                Pegawai yang dinilai,
            </div>
            <br>
            <br>
            <br>
            <p class="tw-uppercase tw-font-bold" style="text-decoration: underline!important;">
                {{ $skpGuru->user->nama }}
            </p>
            <div class="tw-uppercase">
                NIP {{ $skpGuru->user->nip }}
            </div>
        </div>
        <div style="break-inside: avoid;" class="tw-mr-20">
            <div>
                Sidrap, {{ Carbon\Carbon::parse($skpGuru->tanggal_realisasi)->translatedFormat('d F Y') }}
            </div>
            <div>
                Pejabat Penilai Kinerja,
            </div>
            <br>
            <br>
            <br>
            <p class="tw-uppercase tw-font-bold" style="text-decoration: underline!important;">
                {{ $skpGuru->pejabatPenilai->nama }}
            </p>
            <div class="tw-uppercase">
                NIP {{ $skpGuru->pejabatPenilai->nip }}
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
