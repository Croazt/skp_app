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
    <div class="tw-pb-7 tw-text-base tw-font-bold tw-w-full tw-text-center">KETERKAITAN SKP DENGAN ANGKA KREDIT PEJABAT
        FUNGSIONAL</div>
    @include('livewire.skp-guru.pdf.partials.user-detail')
    <div style="display: block; padding-right: 1px;" class="wrapping-div">
        <table class="table-border" style="width: 100%;">
            <thead style="width: 100%;">
                <tr class="text-center">
                    <th style="width: 2%;" class="tw-align-middle">NO</th>
                    <th style="width: 30%;" class="tw-align-middle">RENCANA KINERJA</th>
                    <th style="width: 30%;" class="tw-align-middle">BUTIR KEGIATAN YANG TERKAIT</th>
                    <th style="width: 28%;" class="tw-align-middle">OUTPUT BUTIR KEGIATAN</th>
                    <th style="width: 10%;" class="tw-align-middle">ANGKA KREDIT</th>
                </tr>
                <tr class="text-center">
                    <th class="tw-align-middle" rowspan="1" colspan="1">(1)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(2)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(3)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(4)</th>
                    <th class="tw-align-middle" rowspan="1" colspan="1">(5)</th>
                </tr>
            </thead>
            <tr>
                <th class="tw-align-middle" rowspan="1" colspan="5">A. KINERJA UTAMA</th>
            </tr>
            @php
                $i = 1;
            @endphp
            @foreach ($rencanaKinerjaUtama as $rencanaKinerja)
                @include('livewire.skp-guru.pdf.tables.keterkaitan')
                @php
                    $i++;
                @endphp
            @endforeach
            <tr>
                <th class="tw-align-middle" rowspan="1" colspan="5">B. KINERJA TAMBAHAN</th>
            </tr>
            @if ($rencanaKinerjaTambahan->first())
                @php
                    $i = 1;
                @endphp
                @foreach ($rencanaKinerjaTambahan as $rencanaKinerja)
                    @include('livewire.skp-guru.pdf.tables.keterkaitan')
                    @php
                        $i++;
                    @endphp
                @endforeach
            @else
                <tr>
                    <th class="tw-text-right" rowspan="1" colspan="5"></th>
                </tr>
            @endif
        </table>
    </div>
    <div style="float: right; display: block; break-inside: avoid;" class="tw-mr-3">
        <br>
        <div>
            Sidrap,
            {{ Carbon\Carbon::parse($skpGuru->tanggal_konfirmasi)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('d F Y') }}
        </div>
        <div>
            Pegawai yang membuat rencana,
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
</body>

</html>
