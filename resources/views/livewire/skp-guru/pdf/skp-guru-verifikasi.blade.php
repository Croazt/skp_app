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
    <div class="tw-pb-7 tw-text-base tw-font-bold tw-w-full tw-text-center">VERIFIKASI KETERKAITAN SKP DENGAN ANGKA
        KREDIT PEJABAT FUNGSIONAL</div>
    @include('livewire.skp-guru.pdf.partials.user-detail')
    <div style="display: block; padding-right: 1px;" class="wrapping-div">
        <table class="table-border" style="width: 100%;">
            <thead style="width: 100%;">
                <tr class="text-center">
                    <th style="width: 2%;" class="tw-align-middle">NO</th>
                    <th style="width: 26%;" class="tw-align-middle">RENCANA KINERJA</th>
                    <th style="width: 26%;" class="tw-align-middle">BUTIR KEGIATAN YANG TERKAIT</th>
                    <th style="width: 26%;" class="tw-align-middle">OUTPUT BUTIR KEGIATAN</th>
                    <th style="width: 6%;" class="tw-align-middle">ANGKA KREDIT</th>
                    <th style="width: 14%;" class="tw-align-middle">VERIFIKASI TIM ANGKA KREDIT</th>
                </tr>
                <tr class="text-center">
                    <th class="tw-align-middle" rowspan="1" colspan="1">(1)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(2)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(3)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(4)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(5)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(6)</th>
                </tr>
            </thead>
            <tr>
                <th class="tw-align-middle" rowspan="1" colspan="6">A. KINERJA UTAMA</th>
            </tr>
            @php
                $i = 1;
            @endphp
            @foreach ($rencanaKinerjaUtama as $rencanaKinerja)
                @include('livewire.skp-guru.pdf.tables.verifikasi')
                @php
                    $i++;
                @endphp
            @endforeach
            <tr>
                <th class="tw-align-middle" rowspan="1" colspan="6">B. KINERJA TAMBAHAN</th>
            </tr>
            @if ($rencanaKinerjaTambahan->first())
                @php
                    $i = 1;
                @endphp
                @foreach ($rencanaKinerjaTambahan as $rencanaKinerja)
                    @include('livewire.skp-guru.pdf.tables.verifikasi')
                    @php
                        $i++;
                    @endphp
                @endforeach
            @else
                <tr>
                    <th class="tw-text-right" rowspan="1" colspan="6"></th>
                </tr>
            @endif
            <tr>
                <td class="tw-align-middle tw-text-center tw-uppercase tw-font-bold" rowspan="1" colspan="4">
                    JUMLAH ANGKA KREDIT</td>
                @php
                    $totalAk = 0;
                    foreach ($rencanaKinerjaGuru as $item) {
                        if (!$item->terkait) {
                            continue;
                        }
                        $totalAk += $data['angka_kredit'][$item->id];
                    }
                @endphp
                <td class="tw-align-middle tw-text-center tw-font-bold" rowspan="1" colspan="1">
                    {{ $totalAk }}</td>
                <td class="tw-align-middle tw-text-center tw-font-bold" rowspan="1" colspan="1"></td>
            </tr>
        </table>
    </div>
    <div style="float: right; display: block; break-inside: avoid;" class="tw-mr-3">
        <br>
        <div>
            Sidrap,
            {{ Carbon\Carbon::parse($skpGuru->tanggal_verifikasi)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}
        </div>
        <div>
            TIM penilai angka kredit,
        </div>
        <br>
        <br>
        <br>
        <p class="tw-uppercase tw-font-bold" style="text-decoration: underline!important;">
            {{ $skpGuru->verifikasi->nama ?? $skpGuru->skp->timAngkaKredit->nama }}
        </p>
        <div class="tw-uppercase">
            NIP {{ $skpGuru->verifikasi->nip ?? $skpGuru->skp->timAngkaKredit->nip }}
        </div>
    </div>
</body>

</html>
